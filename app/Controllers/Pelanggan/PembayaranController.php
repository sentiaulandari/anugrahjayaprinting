<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\PesananModel;

class PembayaranController extends BaseController
{
    protected PembayaranModel $pembayaranModel;
    protected PesananModel $pesananModel;

    protected array $rekeningList = [
        'BCA' => [
            'nama'    => 'Bank BCA',
            'nomor'   => '1234567890',
            'atas_nama' => 'Anugrah Jaya Digital Printing',
            'icon'    => 'bi-bank',
            'warna'   => 'primary',
        ],
        'Mandiri' => [
            'nama'    => 'Bank Mandiri',
            'nomor'   => '1234567890123',
            'atas_nama' => 'Anugrah Jaya Digital Printing',
            'icon'    => 'bi-bank2',
            'warna'   => 'warning',
        ],
        'BRI' => [
            'nama'    => 'Bank BRI',
            'nomor'   => '123456789012345',
            'atas_nama' => 'Anugrah Jaya Digital Printing',
            'icon'    => 'bi-bank',
            'warna'   => 'info',
        ],
        'Dana' => [
            'nama'    => 'DANA',
            'nomor'   => '082287900182',
            'atas_nama' => 'Anugrah Jaya DP',
            'icon'    => 'bi-wallet2',
            'warna'   => 'primary',
        ],
        'OVO' => [
            'nama'    => 'OVO',
            'nomor'   => '082287900182',
            'atas_nama' => 'Anugrah Jaya DP',
            'icon'    => 'bi-wallet',
            'warna'   => 'success',
        ],
        'QRIS' => [
            'nama'    => 'QRIS',
            'nomor'   => '-',
            'atas_nama' => 'Anugrah Jaya Digital Printing',
            'icon'    => 'bi-qr-code',
            'warna'   => 'dark',
        ],
        'Tunai' => [
            'nama'    => 'Tunai (Bayar di Tempat)',
            'nomor'   => '-',
            'atas_nama' => '-',
            'icon'    => 'bi-cash-coin',
            'warna'   => 'success',
        ],
    ];

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->pesananModel    = new PesananModel();
    }

    public function index(): string
    {
        $idPelanggan = session()->get('id_pelanggan');

        $data = [
            'title'   => 'Pembayaran',
            'pesanan' => $this->pesananModel->getByPelanggan($idPelanggan),
        ];

        return view('pelanggan/pembayaran/index', $data);
    }

    public function form(string $no): string
    {
        $idPelanggan = session()->get('id_pelanggan');
        $pesanan     = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan || $pesanan['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/pembayaran')->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($pesanan['status_bayar'] === 'sudah bayar') {
            return redirect()->to('/pelanggan/pembayaran')->with('error', 'Pesanan ini sudah dibayar.');
        }

        $data = [
            'title'        => 'Konfirmasi Pembayaran',
            'pesanan'      => $pesanan,
            'rekeningList' => $this->rekeningList,
        ];

        return view('pelanggan/pembayaran/form', $data);
    }

    public function store()
    {
        $idPelanggan = session()->get('id_pelanggan');
        $noPesanan   = $this->request->getPost('no_pesanan');
        $pesanan     = $this->pesananModel->getDetailPesanan($noPesanan);

        if (!$pesanan || $pesanan['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/pembayaran')->with('error', 'Pesanan tidak ditemukan.');
        }

        $rules = [
            'metode_bayar' => 'required|max_length[50]',
        ];

        $metode = $this->request->getPost('metode_bayar');
        if ($metode !== 'Tunai') {
            $rules['bukti'] = 'uploaded[bukti]|max_size[bukti,2048]|ext_in[bukti,jpg,jpeg,png,pdf]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $namaFile = null;
        $file     = $this->request->getFile('bukti');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/pembayaran', $namaFile);
        }

        $this->pembayaranModel->insert([
            'no_pesanan'        => $noPesanan,
            'tgl_pembayaran'    => date('Y-m-d'),
            'jumlah_bayar'      => (float) $pesanan['total_harga'],
            'metode_bayar'      => $metode,
            'bukti_pembayaran'  => $namaFile,
            'status_konfirmasi' => 'menunggu',
        ]);

        return redirect()->to('/pelanggan/status/detail/' . $noPesanan)
                         ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu konfirmasi admin.');
    }
}
