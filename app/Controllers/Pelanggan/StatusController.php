<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\PembayaranModel;

class StatusController extends BaseController
{
    protected PesananModel $pesananModel;
    protected DetailPesananModel $detailModel;
    protected PembayaranModel $pembayaranModel;

    public function __construct()
    {
        $this->pesananModel    = new PesananModel();
        $this->detailModel     = new DetailPesananModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index(): string
    {
        $idPelanggan = session()->get('id_pelanggan');

        $data = [
            'title'   => 'Status Pesanan',
            'pesanan' => $this->pesananModel->getByPelanggan($idPelanggan),
        ];

        return view('pelanggan/status/index', $data);
    }

    public function detail(string $no): string
    {
        $idPelanggan = session()->get('id_pelanggan');
        $pesanan     = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan || $pesanan['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/status')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'      => 'Detail Status Pesanan',
            'pesanan'    => $pesanan,
            'detail'     => $this->detailModel->getByNoPesanan($no),
            'pembayaran' => $this->pembayaranModel->getByNoPesanan($no),
        ];

        return view('pelanggan/status/detail', $data);
    }
}
