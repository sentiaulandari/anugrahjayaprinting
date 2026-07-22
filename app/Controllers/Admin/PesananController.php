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
            'title'   => 'Data Pesanan',
            'pesanan' => $this->pesananModel->getWithPelanggan(),
        ];

        return view('admin/pesanan/index', $data);
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

    public function create(): string
    {
        $data = [
            'title'     => 'Tambah Pesanan',
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
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $noPesanan = $this->pesananModel->generateNoPesanan();
        $tglPesan  = date('Y-m-d');

        $this->pesananModel->insert([
            'no_pesanan'     => $noPesanan,
            'id_pelanggan'   => $this->request->getPost('id_pelanggan'),
            'tgl_pesanan'    => $tglPesan,
            'tgl_selesai'    => $this->request->getPost('tgl_selesai'),
            'status_pesanan' => 'menunggu',
            'status_bayar'   => 'belum bayar',
            'catatan'        => $this->request->getPost('catatan'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        $kodeLayanan = $this->request->getPost('kode_layanan');
        $qtys        = $this->request->getPost('qty');
        $ukurans     = $this->request->getPost('ukuran');
        $keterangans = $this->request->getPost('keterangan_detail');
        $total       = 0;

        foreach ($kodeLayanan as $i => $kode) {
            $layanan = $this->layananModel->find($kode);
            if (!$layanan) {
                continue;
            }

            $qty      = (int) $qtys[$i];
            $harga    = (float) $layanan['harga_satuan'];
            $subtotal = $qty * $harga;
            $total   += $subtotal;

            $this->detailModel->insert([
                'no_pesanan'   => $noPesanan,
                'kode_layanan' => $kode,
                'qty'          => $qty,
                'harga_satuan' => $harga,
                'subtotal'     => $subtotal,
                'ukuran'       => $ukurans[$i] ?? null,
                'keterangan'   => $keterangans[$i] ?? null,
            ]);
        }

        $this->pesananModel->update($noPesanan, ['total_harga' => $total]);

        return redirect()->to('/admin/pesanan')->with('success', 'Pesanan ' . $noPesanan . ' berhasil dibuat.');
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
}
