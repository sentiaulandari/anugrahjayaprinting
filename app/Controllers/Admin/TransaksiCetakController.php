<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiCetakModel;
use App\Models\DetailTransaksiCetakModel;
use App\Models\LayananModel;

class TransaksiCetakController extends BaseController
{
    protected TransaksiCetakModel $transaksiModel;
    protected DetailTransaksiCetakModel $detailModel;
    protected LayananModel $layananModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiCetakModel();
        $this->detailModel    = new DetailTransaksiCetakModel();
        $this->layananModel   = new LayananModel();
    }

    public function index(): string
    {
        $data = [
            'title'      => 'Transaksi Cetak',
            'transaksi'  => $this->transaksiModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('admin/transaksi_cetak/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title'     => 'Tambah Transaksi Cetak',
            'layanan'   => $this->layananModel->getAktif(),
            'no_baru'   => $this->transaksiModel->generateNoTransaksi(),
            'tgl_hari'  => date('Y-m-d'),
        ];

        return view('admin/transaksi_cetak/form', $data);
    }

    public function store()
    {
        $rules = [
            'tgl_transaksi' => 'required|valid_date',
            'metode_bayar'  => 'required|max_length[50]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $noTransaksi = $this->transaksiModel->generateNoTransaksi();

        $this->transaksiModel->insert([
            'no_transaksi'   => $noTransaksi,
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan') ?: null,
            'no_hp'          => $this->request->getPost('no_hp') ?: null,
            'id_pelanggan'   => $this->request->getPost('id_pelanggan') ?: null,
            'tgl_transaksi'  => $this->request->getPost('tgl_transaksi'),
            'metode_bayar'   => $this->request->getPost('metode_bayar'),
            'status_bayar'   => 'lunas',
            'catatan'        => $this->request->getPost('catatan'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        $kodeLayanan  = $this->request->getPost('kode_layanan');
        $qtys         = $this->request->getPost('qty');
        $panjangs     = $this->request->getPost('panjang');
        $lebars       = $this->request->getPost('lebar');
        $desains      = $this->request->getPost('desain_sendiri');
        $keterangans  = $this->request->getPost('keterangan_detail');
        $total        = 0;

        if ($kodeLayanan) {
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

                $this->detailModel->insert([
                    'no_transaksi'    => $noTransaksi,
                    'kode_layanan'    => $kode,
                    'nama_produk'     => $layanan['nama_layanan'],
                    'panjang'         => ($tipeHarga === 'per_meter' && $panjang > 0) ? $panjang : null,
                    'lebar'           => ($tipeHarga === 'per_meter' && $lebar > 0) ? $lebar : null,
                    'qty'             => $qty,
                    'harga_satuan'    => $hargaSatuan,
                    'subtotal'        => $subtotal,
                    'desain_sendiri'  => $desain,
                    'keterangan'      => $keterangans[$i] ?? null,
                ]);
            }
        }

        $this->transaksiModel->update($noTransaksi, ['total_harga' => $total]);

        return redirect()->to('/admin/transaksi-cetak/cetak/' . $noTransaksi . '?baru=1')->with('success', 'Transaksi cetak berhasil dibuat. Status: LUNAS.');
    }

    public function show(string $no): string
    {
        $transaksi = $this->transaksiModel->find($no);

        if (!$transaksi) {
            return redirect()->to('/admin/transaksi-cetak')->with('error', 'Transaksi tidak ditemukan.');
        }

        $data = [
            'title'     => 'Detail Transaksi Cetak',
            'transaksi' => $transaksi,
            'detail'    => $this->detailModel->getByNoTransaksi($no),
        ];

        return view('admin/transaksi_cetak/detail', $data);
    }

    public function cetakFaktur(string $no): string
    {
        $transaksi = $this->transaksiModel->find($no);

        if (!$transaksi) {
            return redirect()->to('/admin/transaksi-cetak')->with('error', 'Transaksi tidak ditemukan.');
        }

        $data = [
            'title'     => 'Faktur Transaksi',
            'transaksi' => $transaksi,
            'detail'    => $this->detailModel->getByNoTransaksi($no),
        ];

        return view('admin/transaksi_cetak/faktur', $data);
    }

    public function delete(string $no)
    {
        $transaksi = $this->transaksiModel->find($no);

        if (!$transaksi) {
            return redirect()->to('/admin/transaksi-cetak')->with('error', 'Transaksi tidak ditemukan.');
        }

        $this->detailModel->deleteByNoTransaksi($no);
        $this->transaksiModel->delete($no);

        return redirect()->to('/admin/transaksi-cetak')->with('success', 'Transaksi berhasil dihapus.');
    }
}
