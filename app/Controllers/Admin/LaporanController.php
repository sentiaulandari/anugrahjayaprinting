<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\PembayaranModel;
use App\Models\BahanModel;
use App\Models\LayananModel;

class LaporanController extends BaseController
{
    protected PesananModel $pesananModel;
    protected PembayaranModel $pembayaranModel;
    protected BahanModel $bahanModel;
    protected LayananModel $layananModel;

    public function __construct()
    {
        $this->pesananModel    = new PesananModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->bahanModel      = new BahanModel();
        $this->layananModel    = new LayananModel();
    }

    public function index(): string
    {
        return view('admin/laporan/index', ['title' => 'Laporan']);
    }

    public function pesanan(): string
    {
        $dari    = $this->request->getGet('dari')    ?? date('Y-m-01');
        $sampai  = $this->request->getGet('sampai')  ?? date('Y-m-d');

        $data = [
            'title'   => 'Laporan Pesanan',
            'dari'    => $dari,
            'sampai'  => $sampai,
            'pesanan' => $this->pesananModel->getPesananByPeriode($dari, $sampai),
        ];

        return view('admin/laporan/pesanan', $data);
    }

    public function bahan(): string
    {
        $data = [
            'title' => 'Laporan Stok Bahan',
            'bahan' => $this->bahanModel->findAll(),
        ];

        return view('admin/laporan/bahan', $data);
    }

    public function keuangan(): string
    {
        $dari   = $this->request->getGet('dari')   ?? date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?? date('Y-m-d');

        $data = [
            'title'           => 'Laporan Keuangan',
            'dari'            => $dari,
            'sampai'          => $sampai,
            'pembayaran'      => $this->pembayaranModel->getWithPesanan(),
            'totalPendapatan' => $this->pembayaranModel->getTotalPendapatan($dari, $sampai),
        ];

        return view('admin/laporan/keuangan', $data);
    }

    public function cetakPesanan(): string
    {
        $dari   = $this->request->getGet('dari')   ?? date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?? date('Y-m-d');

        $data = [
            'title'   => 'Cetak Laporan Pesanan',
            'dari'    => $dari,
            'sampai'  => $sampai,
            'pesanan' => $this->pesananModel->getPesananByPeriode($dari, $sampai),
        ];

        return view('admin/laporan/cetak_pesanan', $data);
    }

    public function cetakBahan(): string
    {
        $data = [
            'title' => 'Cetak Laporan Stok Bahan',
            'bahan' => $this->bahanModel->findAll(),
        ];

        return view('admin/laporan/cetak_bahan', $data);
    }

    public function cetakKeuangan(): string
    {
        $dari   = $this->request->getGet('dari')   ?? date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?? date('Y-m-d');

        $data = [
            'title'           => 'Cetak Laporan Keuangan',
            'dari'            => $dari,
            'sampai'          => $sampai,
            'pembayaran'      => $this->pembayaranModel->getWithPesanan(),
            'totalPendapatan' => $this->pembayaranModel->getTotalPendapatan($dari, $sampai),
        ];

        return view('admin/laporan/cetak_keuangan', $data);
    }
}
