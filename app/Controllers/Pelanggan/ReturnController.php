<?php

namespace App\Controllers\Pelanggan;

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
        $idPelanggan = session()->get('id_pelanggan');

        $data = [
            'title'       => 'Retur / Revisi Hasil Cetak',
            'returns'     => $this->returnModel->getByPelanggan($idPelanggan),
            'labelStatus' => ReturnPesananModel::labelStatus(),
            'labelJenis'  => ReturnPesananModel::labelJenisMasalah(),
        ];

        return view('pelanggan/return/index', $data);
    }

    public function form(string $no): RedirectResponse|string
    {
        $idPelanggan = session()->get('id_pelanggan');
        $pesanan     = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan || $pesanan['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/return')->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($pesanan['status_pesanan'] !== 'selesai') {
            return redirect()->to('/pelanggan/pesanan')->with('error', 'Retur hanya bisa diajukan untuk pesanan yang sudah selesai.');
        }

        $sudahReturn = $this->returnModel->getByNoPesanan($no);
        if ($sudahReturn) {
            return redirect()->to('/pelanggan/return/detail/' . $sudahReturn['id_return'])
                             ->with('error', 'Pesanan ini sudah pernah diajukan retur.');
        }

        $data = [
            'title'       => 'Ajukan Retur / Revisi',
            'pesanan'     => $pesanan,
            'labelJenis'  => ReturnPesananModel::labelJenisMasalah(),
        ];

        return view('pelanggan/return/form', $data);
    }

    public function store(): RedirectResponse
    {
        $idPelanggan = session()->get('id_pelanggan');
        $noPesanan   = $this->request->getPost('no_pesanan');
        $pesanan     = $this->pesananModel->getDetailPesanan($noPesanan);

        if (!$pesanan || $pesanan['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/return')->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($pesanan['status_pesanan'] !== 'selesai') {
            return redirect()->to('/pelanggan/pesanan')->with('error', 'Retur hanya bisa diajukan untuk pesanan yang sudah selesai.');
        }

        $rules = [
            'alasan'        => 'required|min_length[10]|max_length[500]',
            'jenis_masalah' => 'required|in_list[salah_ukuran,salah_warna,teks_gambar_tidak_sesuai,hasil_rusak_cacat,lainnya]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fotoBukti = null;
        $file      = $this->request->getFile('foto_bukti');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile  = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/return', $namaFile);
            $fotoBukti = $namaFile;
        }

        $this->returnModel->insert([
            'no_pesanan'    => $noPesanan,
            'id_pelanggan'  => $idPelanggan,
            'tgl_return'    => date('Y-m-d'),
            'alasan'        => $this->request->getPost('alasan'),
            'jenis_masalah' => $this->request->getPost('jenis_masalah'),
            'foto_bukti'    => $fotoBukti,
            'status_return' => 'menunggu_verifikasi',
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/pelanggan/return')->with('success', 'Pengajuan retur berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function detail(int $id): RedirectResponse|string
    {
        $idPelanggan = session()->get('id_pelanggan');
        $return      = $this->returnModel->getDetailById($id);

        if (!$return || $return['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/return')->with('error', 'Data retur tidak ditemukan.');
        }

        $data = [
            'title'          => 'Detail Retur',
            'return'         => $return,
            'labelStatus'    => ReturnPesananModel::labelStatus(),
            'labelJenis'     => ReturnPesananModel::labelJenisMasalah(),
            'labelTipeRevisi'=> ReturnPesananModel::labelTipeRevisi(),
        ];

        return view('pelanggan/return/detail', $data);
    }
}
