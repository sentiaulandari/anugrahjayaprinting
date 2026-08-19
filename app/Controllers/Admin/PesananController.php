<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\PelangganModel;
use App\Models\LayananModel;
use App\Services\StokService;

class PesananController extends BaseController
{
    protected PesananModel $pesananModel;
    protected DetailPesananModel $detailModel;
    protected PelangganModel $pelangganModel;
    protected LayananModel $layananModel;
    protected StokService $stokService;

    public function __construct()
    {
        $this->pesananModel   = new PesananModel();
        $this->detailModel    = new DetailPesananModel();
        $this->pelangganModel = new PelangganModel();
        $this->layananModel   = new LayananModel();
        $this->stokService    = new StokService();
    }

    public function index(): string
    {
        $data = [
            'title'   => 'Pemesanan',
            'pesanan' => $this->pesananModel->getWithPelanggan(),
        ];

        return view('admin/pesanan/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title'    => 'Buat Pesanan',
            'pelanggan' => $this->pelangganModel->findAll(),
            'layanan'   => $this->layananModel->getAktif(),
            'no_baru'   => $this->pesananModel->generateNoPesanan(),
            'tgl_hari'  => date('Y-m-d'),
        ];

        return view('admin/pesanan/form', $data);
    }

    public function store()
    {
        $rules = [
            'id_pelanggan' => 'required|integer',
            'tgl_selesai'  => 'required|valid_date',
            'kode_layanan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $noPesanan = $this->pesananModel->generateNoPesanan();

        $this->pesananModel->insert([
            'no_pesanan'     => $noPesanan,
            'id_pelanggan'   => $this->request->getPost('id_pelanggan'),
            'tgl_pesanan'    => date('Y-m-d'),
            'tgl_selesai'    => $this->request->getPost('tgl_selesai'),
            'status_pesanan' => 'menunggu',
            'status_bayar'   => 'belum bayar',
            'catatan'        => $this->request->getPost('catatan'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        $kodeLayanan = $this->request->getPost('kode_layanan');
        $qtys        = $this->request->getPost('qty');
        $panjangs    = $this->request->getPost('panjang');
        $lebars      = $this->request->getPost('lebar');
        $desains     = $this->request->getPost('desain_sendiri');
        $keterangans = $this->request->getPost('keterangan_detail');
        $total       = 0;

        $filesDesain = $this->request->getFiles('file_desain');

        // Build absolute upload path dan pastikan folder ada dengan permission yang benar
        $uploadBase = rtrim(FCPATH, '/\\');
        $uploadPath = $uploadBase . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'desain';

        // Buat folder bertahap jika belum ada
        if (!is_dir($uploadBase . DIRECTORY_SEPARATOR . 'uploads')) {
            @mkdir($uploadBase . DIRECTORY_SEPARATOR . 'uploads', 0775, true);
        }
        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0775, true);
        }

        // Verifikasi folder bisa ditulis
        $canUpload = is_dir($uploadPath) && is_writable($uploadPath);

        foreach ($kodeLayanan as $i => $kode) {
            $layanan = $this->layananModel->find($kode);
            if (!$layanan) {
                continue;
            }

            $panjang    = (float) ($panjangs[$i] ?? 0);
            $lebar      = (float) ($lebars[$i] ?? 0);
            $qty        = (int) ($qtys[$i] ?? 1);
            $desain     = isset($desains[$i]) ? 1 : 0;
            $diskon     = (float) ($layanan['diskon_desain_sendiri'] ?? 5000);
            $tipeHarga  = $layanan['tipe_harga'] ?? 'per_pcs';
            $hargaSatuan = 0;

            switch ($tipeHarga) {
                case 'per_meter':
                    $hargaSatuan = $panjang * $lebar * (float) ($layanan['harga_per_meter'] ?? 0);
                    if ($desain && $hargaSatuan > 0) {
                        $hargaSatuan = max(0, $hargaSatuan - $diskon);
                    }
                    break;

                case 'per_lembar':
                case 'per_pcs':
                case 'per_huruf':
                case 'per_buku':
                case 'per_set':
                default:
                    $hargaSatuan = (float) ($layanan['harga_satuan'] ?? 0);
                    break;
            }

            if ($hargaSatuan <= 0) {
                $hargaSatuan = (float) ($layanan['harga_satuan'] ?? 0);
            }

            $subtotal = $hargaSatuan * $qty;
            $total   += $subtotal;

            $ukuranStr = null;
            if ($tipeHarga === 'per_meter' && $panjang > 0 && $lebar > 0) {
                $ukuranStr = $panjang . 'x' . $lebar . 'm';
            }

            $fileDesainPath = null;
            if (isset($filesDesain[$i]) && $filesDesain[$i]->isValid() && !$filesDesain[$i]->hasMoved()) {
                if ($canUpload) {
                    $fileName = $noPesanan . '_' . $i . '_' . $filesDesain[$i]->getRandomName();
                    $filesDesain[$i]->move($uploadPath, $fileName);
                    $fileDesainPath = 'uploads/desain/' . $fileName;
                }
                // jika tidak bisa upload, pesanan tetap disimpan tanpa file
            }

            $this->detailModel->insert([
                'no_pesanan'      => $noPesanan,
                'kode_layanan'    => $kode,
                'qty'             => $qty,
                'harga_satuan'    => $hargaSatuan,
                'subtotal'        => $subtotal,
                'ukuran'          => $ukuranStr,
                'panjang'         => ($tipeHarga === 'per_meter' && $panjang > 0) ? $panjang : null,
                'lebar'           => ($tipeHarga === 'per_meter' && $lebar > 0) ? $lebar : null,
                'desain_sendiri'  => $desain,
                'file_desain'     => $fileDesainPath,
                'keterangan'      => $keterangans[$i] ?? null,
            ]);
        }

        $this->pesananModel->update($noPesanan, ['total_harga' => $total]);

        return redirect()->to('/admin/pesanan/show/' . $noPesanan)->with('success', 'Pesanan berhasil dibuat.');
    }

    public function show(string $no): string
    {
        $pesanan = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Detail Pesanan',
            'pesanan' => $pesanan,
            'detail'  => $this->detailModel->getByNoPesanan($no),
        ];

        return view('admin/pesanan/detail', $data);
    }

    public function edit(string $no): string
    {
        $pesanan = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Pesanan',
            'pesanan' => $pesanan,
            'detail'  => $this->detailModel->getByNoPesanan($no),
            'pelanggan' => $this->pelangganModel->findAll(),
            'layanan'   => $this->layananModel->getAktif(),
        ];

        return view('admin/pesanan/form_edit', $data);
    }

    public function update(string $no)
    {
        $pesanan = $this->pesananModel->find($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $this->pesananModel->update($no, [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tgl_selesai'  => $this->request->getPost('tgl_selesai'),
            'catatan'      => $this->request->getPost('catatan'),
        ]);

        return redirect()->to('/admin/pesanan/show/' . $no)->with('success', 'Data pesanan berhasil diperbarui.');
    }

    public function updateStatus(string $no)
    {
        $pesanan = $this->pesananModel->find($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $statusBaru = $this->request->getPost('status_pesanan');
        $statusLama = $pesanan['status_pesanan'];
        $allowed    = ['menunggu', 'diproses', 'selesai', 'dibatalkan'];

        if (!in_array($statusBaru, $allowed)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        if ($statusBaru === 'diproses' && $statusLama !== 'diproses') {
            $this->stokService->kurangiStokDariPesanan($no);
        }

        if ($statusBaru === 'dibatalkan' && in_array($statusLama, ['diproses', 'selesai'])) {
            $this->stokService->kembalikanStokDariPesanan($no);
        }

        $this->pesananModel->update($no, ['status_pesanan' => $statusBaru]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . ucfirst($statusBaru) . '.');
    }

    public function delete(string $no)
    {
        $pesanan = $this->pesananModel->find($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        if (in_array($pesanan['status_pesanan'], ['diproses', 'selesai'])) {
            $this->stokService->kembalikanStokDariPesanan($no);
        }

        $this->detailModel->deleteByNoPesanan($no);
        $this->pesananModel->delete($no);

        return redirect()->to('/admin/pesanan')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function cetakFaktur(string $no): string
    {
        $pesanan = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Faktur Pesanan',
            'pesanan' => $pesanan,
            'detail'  => $this->detailModel->getByNoPesanan($no),
        ];

        return view('admin/pesanan/faktur', $data);
    }
}
