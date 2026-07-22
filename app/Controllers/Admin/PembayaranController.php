<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\PesananModel;
use App\Services\StokService;

class PembayaranController extends BaseController
{
    protected PembayaranModel $pembayaranModel;
    protected PesananModel $pesananModel;
    protected StokService $stokService;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->pesananModel    = new PesananModel();
        $this->stokService     = new StokService();
    }

    public function index(): string
    {
        $data = [
            'title'      => 'Konfirmasi Pembayaran',
            'pembayaran' => $this->pembayaranModel->getWithPesanan(),
        ];

        return view('admin/pembayaran/index', $data);
    }

    public function show(int $id): string
    {
        $pembayaran = $this->pembayaranModel->find($id);

        if (!$pembayaran) {
            return redirect()->to('/admin/pembayaran')->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $pesanan = $this->pesananModel->getDetailPesanan($pembayaran['no_pesanan']);

        $data = [
            'title'      => 'Detail Pembayaran',
            'pembayaran' => $pembayaran,
            'pesanan'    => $pesanan,
        ];

        return view('admin/pembayaran/detail', $data);
    }

    public function konfirmasi(int $id)
    {
        $pembayaran = $this->pembayaranModel->find($id);

        if (!$pembayaran) {
            return redirect()->to('/admin/pembayaran')->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $status  = $this->request->getPost('status_konfirmasi');
        $allowed = ['diterima', 'ditolak'];

        if (!in_array($status, $allowed)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $this->pembayaranModel->update($id, [
            'status_konfirmasi' => $status,
            'catatan_admin'     => $this->request->getPost('catatan_admin'),
        ]);

        if ($status === 'diterima') {
            $pesanan = $this->pesananModel->find($pembayaran['no_pesanan']);

            $this->pesananModel->update($pembayaran['no_pesanan'], [
                'status_bayar'   => 'sudah bayar',
                'status_pesanan' => 'diproses',
            ]);

            if ($pesanan && $pesanan['status_pesanan'] !== 'diproses') {
                $this->stokService->kurangiStokDariPesanan($pembayaran['no_pesanan']);
            }
        }

        $pesan = $status === 'diterima'
            ? 'Pembayaran diterima. Pesanan otomatis diproses dan stok bahan dikurangi.'
            : 'Pembayaran ditolak. Pelanggan akan diberitahu.';

        return redirect()->to('/admin/pembayaran')->with('success', $pesan);
    }
}
