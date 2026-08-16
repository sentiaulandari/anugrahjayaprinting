<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\LayananModel;

class PesananController extends BaseController
{
    protected PesananModel $pesananModel;
    protected DetailPesananModel $detailModel;
    protected LayananModel $layananModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->detailModel  = new DetailPesananModel();
        $this->layananModel = new LayananModel();
    }

    public function index(): string
    {
        $idPelanggan = session()->get('id_pelanggan');

        $data = [
            'title'   => 'Pesanan Saya',
            'pesanan' => $this->pesananModel->getByPelanggan($idPelanggan),
        ];

        return view('pelanggan/pesanan/index', $data);
    }

    public function show(string $no): string
    {
        $idPelanggan = session()->get('id_pelanggan');
        $pesanan     = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan || $pesanan['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Detail Pesanan',
            'pesanan' => $pesanan,
            'detail'  => $this->detailModel->getByNoPesanan($no),
        ];

        return view('pelanggan/pesanan/detail', $data);
    }

    public function create(): string
    {
        $data = [
            'title'    => 'Buat Pesanan',
            'layanan'  => $this->layananModel->getAktif(),
            'tgl_hari' => date('Y-m-d'),
            'tgl_min'  => date('Y-m-d', strtotime('+1 day')),
        ];

        return view('pelanggan/pesanan/form', $data);
    }

    public function store()
    {
        $idPelanggan = session()->get('id_pelanggan');

        $rules = [
            'tgl_selesai'  => 'required|valid_date',
            'kode_layanan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $noPesanan = $this->pesananModel->generateNoPesanan();
        $tglPesan  = date('Y-m-d');

        $this->pesananModel->insert([
            'no_pesanan'     => $noPesanan,
            'id_pelanggan'   => $idPelanggan,
            'tgl_pesanan'    => $tglPesan,
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
        // getFiles() untuk input name="file_desain[]" mengembalikan ['file_desain' => [...]]
        $filesDesainArr = $filesDesain['file_desain'] ?? [];

        $uploadPath = WRITEPATH . '../public/uploads/desain';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

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
                    $hargaSatuan = (float) ($layanan['harga_satuan'] ?? 0);
                    break;

                case 'per_set':
                    $hargaSatuan = (float) ($layanan['harga_satuan'] ?? 0);
                    break;

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
            if (isset($filesDesainArr[$i]) && $filesDesainArr[$i]->isValid() && !$filesDesainArr[$i]->hasMoved()) {
                $fileName = $noPesanan . '_' . $i . '_' . $filesDesainArr[$i]->getClientName();
                $filesDesainArr[$i]->move($uploadPath, $fileName);
                $fileDesainPath = 'uploads/desain/' . $fileName;
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

        return redirect()->to('/pelanggan/pembayaran/form/' . $noPesanan)
                         ->with('success', 'Pesanan ' . $noPesanan . ' berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function cetakFaktur(string $no): string
    {
        $idPelanggan = session()->get('id_pelanggan');
        $pesanan     = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan || $pesanan['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Faktur Pesanan',
            'pesanan' => $pesanan,
            'detail'  => $this->detailModel->getByNoPesanan($no),
        ];

        return view('pelanggan/pesanan/faktur', $data);
    }
}
