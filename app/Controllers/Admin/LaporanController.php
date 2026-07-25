<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\PembayaranModel;
use App\Models\PembelianModel;
use App\Models\BahanModel;
use App\Models\LayananModel;

class LaporanController extends BaseController
{
    protected PesananModel $pesananModel;
    protected PembayaranModel $pembayaranModel;
    protected PembelianModel $pembelianModel;
    protected BahanModel $bahanModel;
    protected LayananModel $layananModel;

    public function __construct()
    {
        $this->pesananModel    = new PesananModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->pembelianModel  = new PembelianModel();
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

    public function pertahun(): string
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $pendapatanPerBulan = [];
        $pengeluaranPerBulan = [];
        $pesananPerBulan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $dari   = sprintf('%s-%02d-01', $tahun, $bulan);
            $akhir  = date('Y-m-t', strtotime($dari));

            $pendapatanPerBulan[$bulan] = $this->pembayaranModel->getTotalPendapatan($dari, $akhir);
            $pengeluaranPerBulan[$bulan] = $this->pembelianModel->getTotalByPeriode($dari, $akhir);
            $pesananPerBulan[$bulan]     = count($this->pesananModel->getPesananByPeriode($dari, $akhir));
        }

        $totalPendapatan  = array_sum($pendapatanPerBulan);
        $totalPengeluaran = array_sum($pengeluaranPerBulan);
        $totalPesanan     = array_sum($pesananPerBulan);

        $data = [
            'title'              => 'Laporan Pertahun',
            'tahun'              => $tahun,
            'pendapatanPerBulan' => $pendapatanPerBulan,
            'pengeluaranPerBulan'=> $pengeluaranPerBulan,
            'pesananPerBulan'    => $pesananPerBulan,
            'totalPendapatan'    => $totalPendapatan,
            'totalPengeluaran'   => $totalPengeluaran,
            'totalPesanan'       => $totalPesanan,
        ];

        return view('admin/laporan/pertahun', $data);
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

    public function cetakPertahun(): string
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $pendapatanPerBulan = [];
        $pengeluaranPerBulan = [];
        $pesananPerBulan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $dari  = sprintf('%s-%02d-01', $tahun, $bulan);
            $akhir = date('Y-m-t', strtotime($dari));

            $pendapatanPerBulan[$bulan]  = $this->pembayaranModel->getTotalPendapatan($dari, $akhir);
            $pengeluaranPerBulan[$bulan] = $this->pembelianModel->getTotalByPeriode($dari, $akhir);
            $pesananPerBulan[$bulan]     = count($this->pesananModel->getPesananByPeriode($dari, $akhir));
        }

        $data = [
            'title'              => 'Cetak Laporan Pertahun',
            'tahun'              => $tahun,
            'pendapatanPerBulan' => $pendapatanPerBulan,
            'pengeluaranPerBulan'=> $pengeluaranPerBulan,
            'pesananPerBulan'    => $pesananPerBulan,
            'totalPendapatan'    => array_sum($pendapatanPerBulan),
            'totalPengeluaran'   => array_sum($pengeluaranPerBulan),
            'totalPesanan'       => array_sum($pesananPerBulan),
        ];

        return view('admin/laporan/cetak_pertahun', $data);
    }
}
