<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\PembayaranModel;
use App\Models\PembelianModel;
use App\Models\BahanModel;
use App\Models\LayananModel;
use App\Models\SupplierModel;
use App\Models\PelangganModel;
use App\Models\DetailPesananModel;
use App\Models\DetailTransaksiCetakModel;

class LaporanController extends BaseController
{
    protected PesananModel $pesananModel;
    protected PembayaranModel $pembayaranModel;
    protected PembelianModel $pembelianModel;
    protected BahanModel $bahanModel;
    protected LayananModel $layananModel;
    protected SupplierModel $supplierModel;
    protected PelangganModel $pelangganModel;
    protected DetailPesananModel $detailPesananModel;
    protected DetailTransaksiCetakModel $detailTransaksiModel;

    public function __construct()
    {
        $this->pesananModel         = new PesananModel();
        $this->pembayaranModel      = new PembayaranModel();
        $this->pembelianModel       = new PembelianModel();
        $this->bahanModel           = new BahanModel();
        $this->layananModel         = new LayananModel();
        $this->supplierModel        = new SupplierModel();
        $this->pelangganModel       = new PelangganModel();
        $this->detailPesananModel   = new DetailPesananModel();
        $this->detailTransaksiModel = new DetailTransaksiCetakModel();
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

    // ================================================================
    // LAPORAN BAHAN TERPAKAI
    // ================================================================
    public function bahanTerpakai(): string
    {
        $dari   = $this->request->getGet('dari')   ?? date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?? date('Y-m-d');

        $bahanDariPesanan    = $this->detailPesananModel->getBahanTerpakaiByPeriode($dari, $sampai);
        $bahanDariTransaksi  = $this->detailTransaksiModel->getBahanTerpakaiByPeriode($dari, $sampai);

        // Merge kedua sumber
        $merged = [];
        foreach ($bahanDariPesanan as $b) {
            $id = $b['id_bahan'];
            $merged[$id] = [
                'id_bahan'      => $id,
                'nama_bahan'    => $b['nama_bahan'],
                'satuan'        => $b['satuan'],
                'dari_pesanan'  => (int) $b['total_terpakai'],
                'dari_transaksi'=> 0,
                'total'         => (int) $b['total_terpakai'],
            ];
        }
        foreach ($bahanDariTransaksi as $b) {
            $id = $b['id_bahan'];
            if (isset($merged[$id])) {
                $merged[$id]['dari_transaksi'] += (int) $b['total_terpakai'];
                $merged[$id]['total']          += (int) $b['total_terpakai'];
            } else {
                $merged[$id] = [
                    'id_bahan'      => $id,
                    'nama_bahan'    => $b['nama_bahan'],
                    'satuan'        => $b['satuan'],
                    'dari_pesanan'  => 0,
                    'dari_transaksi'=> (int) $b['total_terpakai'],
                    'total'         => (int) $b['total_terpakai'],
                ];
            }
        }
        usort($merged, fn($a, $b) => $b['total'] - $a['total']);

        $data = [
            'title'  => 'Laporan Bahan Terpakai',
            'dari'   => $dari,
            'sampai' => $sampai,
            'bahan'  => $merged,
        ];

        return view('admin/laporan/bahan_terpakai', $data);
    }

    public function cetakBahanTerpakai(): string
    {
        $dari   = $this->request->getGet('dari')   ?? date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?? date('Y-m-d');

        $bahanDariPesanan    = $this->detailPesananModel->getBahanTerpakaiByPeriode($dari, $sampai);
        $bahanDariTransaksi  = $this->detailTransaksiModel->getBahanTerpakaiByPeriode($dari, $sampai);

        $merged = [];
        foreach ($bahanDariPesanan as $b) {
            $id = $b['id_bahan'];
            $merged[$id] = ['id_bahan' => $id, 'nama_bahan' => $b['nama_bahan'], 'satuan' => $b['satuan'], 'dari_pesanan' => (int) $b['total_terpakai'], 'dari_transaksi' => 0, 'total' => (int) $b['total_terpakai']];
        }
        foreach ($bahanDariTransaksi as $b) {
            $id = $b['id_bahan'];
            if (isset($merged[$id])) {
                $merged[$id]['dari_transaksi'] += (int) $b['total_terpakai'];
                $merged[$id]['total']          += (int) $b['total_terpakai'];
            } else {
                $merged[$id] = ['id_bahan' => $id, 'nama_bahan' => $b['nama_bahan'], 'satuan' => $b['satuan'], 'dari_pesanan' => 0, 'dari_transaksi' => (int) $b['total_terpakai'], 'total' => (int) $b['total_terpakai']];
            }
        }
        usort($merged, fn($a, $b) => $b['total'] - $a['total']);

        $data = [
            'title'  => 'Cetak Laporan Bahan Terpakai',
            'dari'   => $dari,
            'sampai' => $sampai,
            'bahan'  => $merged,
        ];

        return view('admin/laporan/cetak_bahan_terpakai', $data);
    }

    // ================================================================
    // LAPORAN SUPPLIER
    // ================================================================
    public function supplier(): string
    {
        $data = [
            'title'    => 'Laporan Supplier',
            'supplier' => $this->supplierModel->getWithTotalPembelian(),
        ];

        return view('admin/laporan/supplier', $data);
    }

    public function cetakSupplier(): string
    {
        $data = [
            'title'    => 'Cetak Laporan Supplier',
            'supplier' => $this->supplierModel->getWithTotalPembelian(),
        ];

        return view('admin/laporan/cetak_supplier', $data);
    }

    // ================================================================
    // LAPORAN KONSUMEN
    // ================================================================
    public function konsumen(): string
    {
        $data = [
            'title'     => 'Laporan Konsumen',
            'pelanggan' => $this->pelangganModel->getWithRingkasanPesanan(),
        ];

        return view('admin/laporan/konsumen', $data);
    }

    public function cetakKonsumen(): string
    {
        $data = [
            'title'     => 'Cetak Laporan Konsumen',
            'pelanggan' => $this->pelangganModel->getWithRingkasanPesanan(),
        ];

        return view('admin/laporan/cetak_konsumen', $data);
    }

    // ================================================================
    // LAPORAN PERTAHUN — Detail per bulan
    // ================================================================
    public function pertahunDetail(): string
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $bulan = (int) ($this->request->getGet('bulan') ?? date('n'));

        $dari   = sprintf('%s-%02d-01', $tahun, $bulan);
        $sampai = date('Y-m-t', strtotime($dari));

        $namaBulan = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                      7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];

        $data = [
            'title'      => 'Detail Laporan ' . $namaBulan[$bulan] . ' ' . $tahun,
            'tahun'      => $tahun,
            'bulan'      => $bulan,
            'namaBulan'  => $namaBulan[$bulan],
            'dari'       => $dari,
            'sampai'     => $sampai,
            'pesanan'    => $this->pesananModel->getPesananByPeriode($dari, $sampai),
            'pembayaran' => $this->pembayaranModel->getWithPesanan(),
            'pendapatan' => $this->pembayaranModel->getTotalPendapatan($dari, $sampai),
            'pengeluaran'=> $this->pembelianModel->getTotalByPeriode($dari, $sampai),
        ];

        return view('admin/laporan/pertahun_detail', $data);
    }
}
