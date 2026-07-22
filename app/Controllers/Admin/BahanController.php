<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BahanModel;

class BahanController extends BaseController
{
    protected BahanModel $bahanModel;

    public function __construct()
    {
        $this->bahanModel = new BahanModel();
    }

    public function index(): string
    {
        $data = [
            'title'        => 'Data Bahan/Material',
            'bahan'        => $this->bahanModel->findAll(),
            'stokMenurun'  => $this->bahanModel->getStokMenurun(),
        ];

        return view('admin/bahan/index', $data);
    }

    public function create(): string
    {
        return view('admin/bahan/form', ['title' => 'Tambah Bahan']);
    }

    public function store()
    {
        $rules = [
            'nama_bahan'   => 'required|max_length[100]',
            'satuan'       => 'required|max_length[20]',
            'stok'         => 'required|integer|greater_than_equal_to[0]',
            'stok_minimum' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->bahanModel->insert([
            'nama_bahan'   => $this->request->getPost('nama_bahan'),
            'satuan'       => $this->request->getPost('satuan'),
            'stok'         => $this->request->getPost('stok'),
            'stok_minimum' => $this->request->getPost('stok_minimum'),
            'keterangan'   => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/admin/bahan')->with('success', 'Bahan berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $bahan = $this->bahanModel->find($id);

        if (!$bahan) {
            return redirect()->to('/admin/bahan')->with('error', 'Bahan tidak ditemukan.');
        }

        return view('admin/bahan/form', ['title' => 'Edit Bahan', 'bahan' => $bahan]);
    }

    public function update(int $id)
    {
        $bahan = $this->bahanModel->find($id);

        if (!$bahan) {
            return redirect()->to('/admin/bahan')->with('error', 'Bahan tidak ditemukan.');
        }

        $rules = [
            'nama_bahan'   => 'required|max_length[100]',
            'satuan'       => 'required|max_length[20]',
            'stok'         => 'required|integer|greater_than_equal_to[0]',
            'stok_minimum' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->bahanModel->update($id, [
            'nama_bahan'   => $this->request->getPost('nama_bahan'),
            'satuan'       => $this->request->getPost('satuan'),
            'stok'         => $this->request->getPost('stok'),
            'stok_minimum' => $this->request->getPost('stok_minimum'),
            'keterangan'   => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/admin/bahan')->with('success', 'Bahan berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $bahan = $this->bahanModel->find($id);

        if (!$bahan) {
            return redirect()->to('/admin/bahan')->with('error', 'Bahan tidak ditemukan.');
        }

        $this->bahanModel->delete($id);

        return redirect()->to('/admin/bahan')->with('success', 'Bahan berhasil dihapus.');
    }
}
