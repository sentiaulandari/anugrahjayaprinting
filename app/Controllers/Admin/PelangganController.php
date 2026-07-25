<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use App\Models\UserModel;

class PelangganController extends BaseController
{
    protected PelangganModel $pelangganModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
        $this->userModel      = new UserModel();
    }

    public function index(): string
    {
        $data = [
            'title'     => 'Pengelolaan Konsumen',
            'pelanggan' => $this->pelangganModel->getWithUser(),
        ];

        return view('admin/pelanggan/index', $data);
    }

    public function show(int $id): string
    {
        $pelanggan = $this->pelangganModel->getDetailById($id);

        if (!$pelanggan) {
            return redirect()->to('/admin/pelanggan')->with('error', 'Konsumen tidak ditemukan.');
        }

        return view('admin/pelanggan/detail', ['title' => 'Detail Konsumen', 'pelanggan' => $pelanggan]);
    }

    public function edit(int $id): string
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return redirect()->to('/admin/pelanggan')->with('error', 'Konsumen tidak ditemukan.');
        }

        return view('admin/pelanggan/form', ['title' => 'Edit Konsumen', 'pelanggan' => $pelanggan]);
    }

    public function update(int $id)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return redirect()->to('/admin/pelanggan')->with('error', 'Konsumen tidak ditemukan.');
        }

        $rules = [
            'nama_pelanggan' => 'required|max_length[100]',
            'no_hp'          => 'permit_empty|max_length[15]',
            'email'          => 'permit_empty|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pelangganModel->update($id, [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'alamat'         => $this->request->getPost('alamat'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'email'          => $this->request->getPost('email'),
        ]);

        return redirect()->to('/admin/pelanggan')->with('success', 'Data konsumen berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return redirect()->to('/admin/pelanggan')->with('error', 'Konsumen tidak ditemukan.');
        }

        if ($pelanggan['id_user']) {
            $this->userModel->delete($pelanggan['id_user']);
        }

        $this->pelangganModel->delete($id);

        return redirect()->to('/admin/pelanggan')->with('success', 'Konsumen berhasil dihapus.');
    }
}
