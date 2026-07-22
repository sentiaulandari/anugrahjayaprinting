<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\PembayaranModel;
use App\Models\BahanModel;
use App\Models\PelangganModel;

class DashboardController extends BaseController
{
    protected PesananModel $pesananModel;
    protected PembayaranModel $pembayaranModel;
    protected BahanModel $bahanModel;
    protected PelangganModel $pelangganModel;

    public function __construct()
    {
        $this->pesananModel    = new PesananModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->bahanModel      = new BahanModel();
        $this->pelangganModel  = new PelangganModel();
    }

    public function index(): string
    {
        $data = [
            'title'              => 'Dashboard',
            'totalPesanan'       => $this->pesananModel->countAll(),
            'statusPesanan'      => $this->pesananModel->countByStatus(),
            'totalPelanggan'     => $this->pelangganModel->countAll(),
            'stokMenurun'        => $this->bahanModel->getStokMenurun(),
            'pesananTerbaru'     => $this->pesananModel->getWithPelanggan(),
            'menungguKonfirmasi' => $this->pembayaranModel->getMenungguKonfirmasi(),
            'totalPendapatan'    => $this->pembayaranModel->getTotalPendapatan(
                date('Y-m-01'),
                date('Y-m-d')
            ),
        ];

        return view('admin/dashboard/index', $data);
    }
}
