<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\LayananModel;
use App\Models\PelangganModel;

class DashboardController extends BaseController
{
    protected PesananModel $pesananModel;
    protected LayananModel $layananModel;
    protected PelangganModel $pelangganModel;

    public function __construct()
    {
        $this->pesananModel   = new PesananModel();
        $this->layananModel   = new LayananModel();
        $this->pelangganModel = new PelangganModel();
    }

    public function index(): string
    {
        $idPelanggan = session()->get('id_pelanggan');

        $pesanan = $this->pesananModel->getByPelanggan($idPelanggan);

        $statusCount = [
            'menunggu'   => 0,
            'diproses'   => 0,
            'selesai'    => 0,
            'dibatalkan' => 0,
        ];

        foreach ($pesanan as $p) {
            if (isset($statusCount[$p['status_pesanan']])) {
                $statusCount[$p['status_pesanan']]++;
            }
        }

        $data = [
            'title'          => 'Dashboard',
            'pesananTerbaru' => array_slice($pesanan, 0, 5),
            'statusCount'    => $statusCount,
            'layananAktif'   => $this->layananModel->getAktif(),
        ];

        return view('pelanggan/dashboard/index', $data);
    }
}
