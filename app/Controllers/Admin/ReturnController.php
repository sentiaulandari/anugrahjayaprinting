<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReturnPesananModel;
use App\Models\PesananModel;
use CodeIgniter\HTTP\RedirectResponse;

class ReturnController extends BaseController
{
    protected ReturnPesananModel $returnModel;
    protected PesananModel $pesananModel;

    public function __construct()
    {
        $this->returnModel  = new ReturnPesananModel();
        $this->pesananModel = new PesananModel();
    }

    public function index(): string
    {
        $data = [
            'title'       => 'Retur / Revisi Hasil Cetak',
            'returns'     => $this->returnModel->getWithPesanan(),
            'countStatus' => $this->returnModel->countByStatus(),
            'labelStatus' => ReturnPesananModel::labelStatus(),
        ];

        return view('admin/return/index', $data);
    }

    public function show(int $id): RedirectResponse|string
    {
        $return = $this->returnModel->getDetailById($id);

        if (!$return) {
            return redirect()->to('/admin/return')->with('error', 'Data retur tidak ditemukan.');
        }

        $data = [
            'title'          => 'Detail Retur',
            'return'         => $return,
            'labelStatus'    => ReturnPesananModel::labelStatus(),
            'labelJenis'     => ReturnPesananModel::labelJenisMasalah(),
            'labelTipeRevisi'=> ReturnPesananModel::labelTipeRevisi(),
        ];

        return view('admin/return/detail', $data);
    }

    public function prosesReturn(int $id): RedirectResponse
    {
        $return = $this->returnModel->find($id);

        if (!$return) {
            return redirect()->to('/admin/return')->with('error', 'Data retur tidak ditemukan.');
        }

        $status  = $this->request->getPost('status_return');
        $allowed = [
            'verifikasi_disetujui',
            'verifikasi_ditolak',
            'proses_cetak_ulang',
            'revisi_desain',
            'selesai',
        ];

        if (!in_array($status, $allowed)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $updateData = [
            'status_return' => $status,
            'catatan_admin' => $this->request->getPost('catatan_admin'),
        ];

        if ($status === 'revisi_desain') {
            $updateData['tipe_revisi']     = 'revisi_desain';
            $updateData['biaya_tambahan']  = (float) ($this->request->getPost('biaya_tambahan') ?? 0);
        }

        if ($status === 'proses_cetak_ulang') {
            $updateData['tipe_revisi']     = 'cetak_ulang';
            $updateData['biaya_tambahan']  = 0;
        }

        if ($status === 'selesai') {
            $this->pesananModel->update($return['no_pesanan'], [
                'status_pesanan' => 'selesai',
            ]);
        }

        if ($status === 'verifikasi_ditolak') {
            $this->pesananModel->update($return['no_pesanan'], [
                'status_pesanan' => 'selesai',
            ]);
        }

        $this->returnModel->update($id, $updateData);

        $labelStatus = ReturnPesananModel::labelStatus();
        $pesan = 'Status retur diperbarui menjadi: ' . ($labelStatus[$status] ?? $status);

        return redirect()->to('/admin/return/show/' . $id)->with('success', $pesan);
    }
}
