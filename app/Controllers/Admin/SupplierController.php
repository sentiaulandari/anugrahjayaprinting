<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SupplierModel;
use CodeIgniter\HTTP\RedirectResponse;

class SupplierController extends BaseController
{
    protected SupplierModel $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
    }

    public function index(): string
    {
        $data = [
            'title'    => 'Data Supplier',
            'supplier' => $this->supplierModel->findAll(),
        ];

        return view('admin/supplier/index', $data);
    }

    public function create(): string
    {
        return view('admin/supplier/form', ['title' => 'Tambah Supplier']);
    }

    public function store(): RedirectResponse
    {
        $rules = [
            'nama_supplier' => 'required|max_length[100]',
            'no_hp'         => 'permit_empty|max_length[15]',
            'email'         => 'permit_empty|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->supplierModel->insert([
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'no_hp'         => $this->request->getPost('no_hp'),
            'email'         => $this->request->getPost('email'),
            'alamat'        => $this->request->getPost('alamat'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/supplier')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(int $id): RedirectResponse|string
    {
        $supplier = $this->supplierModel->find($id);

        if (!$supplier) {
            return redirect()->to('/admin/supplier')->with('error', 'Supplier tidak ditemukan.');
        }

        return view('admin/supplier/form', ['title' => 'Edit Supplier', 'supplier' => $supplier]);
    }

    public function update(int $id): RedirectResponse
    {
        $supplier = $this->supplierModel->find($id);

        if (!$supplier) {
            return redirect()->to('/admin/supplier')->with('error', 'Supplier tidak ditemukan.');
        }

        $rules = [
            'nama_supplier' => 'required|max_length[100]',
            'no_hp'         => 'permit_empty|max_length[15]',
            'email'         => 'permit_empty|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->supplierModel->update($id, [
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'no_hp'         => $this->request->getPost('no_hp'),
            'email'         => $this->request->getPost('email'),
            'alamat'        => $this->request->getPost('alamat'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/admin/supplier')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function delete(int $id): RedirectResponse
    {
        $supplier = $this->supplierModel->find($id);

        if (!$supplier) {
            return redirect()->to('/admin/supplier')->with('error', 'Supplier tidak ditemukan.');
        }

        $this->supplierModel->delete($id);

        return redirect()->to('/admin/supplier')->with('success', 'Supplier berhasil dihapus.');
    }
}
