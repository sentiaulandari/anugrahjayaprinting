<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\PelangganModel;
use App\Models\LayananModel;
use App\Services\StokService;

class PesananController extends BaseController
{
    protected PesananModel $pesananModel;
    protected DetailPesananModel $detailModel;
    protected PelangganModel $pelangganModel;
    protected LayananModel $layananModel;
    protected StokService $stokService;

    public function __construct()
    {
        $this->pesananModel   = new PesananModel();
        $this->detailModel    = new DetailPesananModel();
        $this->pelangganModel = new PelangganModel();
        $this->layananModel   = new LayananModel();
        $this->stokService    = new StokService();
    }

    public function index(): string
    {
        $data = [
            'title'   => 'Pemesanan',
            'pesanan' => $this->pesananModel->getWithPelanggan(),
        ];

        return view('admin/pesanan/index', $data);
    }

    public function show(string $no): string
    {
        $pesanan = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Detail Pesanan',
            'pesanan' => $pesanan,
            'detail'  => $this->detailModel->getByNoPesanan($no),
        ];

        return view('admin/pesanan/detail', $data);
    }

    public function edit(string $no): string
    {
        $pesanan = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Pesanan',
            'pesanan' => $pesanan,
            'detail'  => $this->detailModel->getByNoPesanan($no),
            'pelanggan' => $this->pelangganModel->findAll(),
            'layanan'   => $this->layananModel->getAktif(),
        ];

        return view('admin/pesanan/form_edit', $data);
    }

    public function update(string $no)
    {
        $pesanan = $this->pesananModel->find($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $this->pesananModel->update($no, [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tgl_selesai'  => $this->request->getPost('tgl_selesai'),
            'catatan'      => $this->request->getPost('catatan'),
        ]);

        return redirect()->to('/admin/pesanan/show/' . $no)->with('success', 'Data pesanan berhasil diperbarui.');
    }

    public function updateStatus(string $no)
    {
        $pesanan = $this->pesananModel->find($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $statusBaru = $this->request->getPost('status_pesanan');
        $statusLama = $pesanan['status_pesanan'];
        $allowed    = ['menunggu', 'diproses', 'selesai', 'dibatalkan'];

        if (!in_array($statusBaru, $allowed)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        if ($statusBaru === 'diproses' && $statusLama !== 'diproses') {
            $this->stokService->kurangiStokDariPesanan($no);
        }

        if ($statusBaru === 'dibatalkan' && in_array($statusLama, ['diproses', 'selesai'])) {
            $this->stokService->kembalikanStokDariPesanan($no);
        }

        $this->pesananModel->update($no, ['status_pesanan' => $statusBaru]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . ucfirst($statusBaru) . '.');
    }

    public function delete(string $no)
    {
        $pesanan = $this->pesananModel->find($no);

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        if (in_array($pesanan['status_pesanan'], ['diproses', 'selesai'])) {
            $this->stokService->kembalikanStokDariPesanan($no);
        }

        $this->detailModel->deleteByNoPesanan($no);
        $this->pesananModel->delete($no);

        return redirect()->to('/admin/pesanan')->with('success', 'Pesanan berhasil dihapus.');
    }
}
