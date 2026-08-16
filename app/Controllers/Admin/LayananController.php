<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LayananModel;
use App\Models\KategoriModel;
use App\Models\BahanModel;
use CodeIgniter\HTTP\RedirectResponse;

class LayananController extends BaseController
{
    protected LayananModel $layananModel;
    protected KategoriModel $kategoriModel;
    protected BahanModel $bahanModel;

    public function __construct()
    {
        $this->layananModel  = new LayananModel();
        $this->kategoriModel = new KategoriModel();
        $this->bahanModel    = new BahanModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Pengelolaan Produk',
            'layanan' => $this->layananModel->getWithRelasi(),
        ];

        return view('admin/layanan/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title'     => 'Tambah Produk',
            'kategori'  => $this->kategoriModel->getForSelect(),
            'bahan'     => $this->bahanModel->getForSelect(),
            'kode_baru' => $this->layananModel->generateKode(),
        ];

        return view('admin/layanan/form', $data);
    }

    public function store(): RedirectResponse
    {
        $rules = [
            'kode_layanan' => 'required|max_length[10]|is_unique[layanan.kode_layanan]',
            'nama_layanan' => 'required|max_length[100]',
            'harga_satuan' => 'required|decimal|greater_than_equal_to[0]',
            'tipe_harga'   => 'required|in_list[per_meter,per_lembar,per_pcs,per_set,per_huruf,per_buku]',
            'status'       => 'required|in_list[aktif,nonaktif]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambar = null;
        $file   = $this->request->getFile('gambar');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/layanan', $namaFile);
            $gambar = $namaFile;
        }

        $this->layananModel->insert([
            'kode_layanan'            => $this->request->getPost('kode_layanan'),
            'nama_layanan'            => $this->request->getPost('nama_layanan'),
            'id_kategori'             => $this->request->getPost('id_kategori') ?: null,
            'id_bahan'                => $this->request->getPost('id_bahan') ?: null,
            'harga_satuan'            => $this->request->getPost('harga_satuan') ?? 0,
            'harga_per_meter'         => $this->request->getPost('harga_per_meter') ?? 0,
            'diskon_desain_sendiri'   => $this->request->getPost('diskon_desain_sendiri') ?? 5000,
            'tipe_harga'              => $this->request->getPost('tipe_harga') ?? 'per_pcs',
            'deskripsi'               => $this->request->getPost('deskripsi'),
            'gambar'                  => $gambar,
            'status'                  => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/layanan')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(string $kode): RedirectResponse|string
    {
        $layanan = $this->layananModel->find($kode);

        if (!$layanan) {
            return redirect()->to('/admin/layanan')->with('error', 'Produk tidak ditemukan.');
        }

        $data = [
            'title'    => 'Edit Produk',
            'layanan'  => $layanan,
            'kategori' => $this->kategoriModel->getForSelect(),
            'bahan'    => $this->bahanModel->getForSelect(),
        ];

        return view('admin/layanan/form', $data);
    }

    public function update(string $kode): RedirectResponse
    {
        $layanan = $this->layananModel->find($kode);

        if (!$layanan) {
            return redirect()->to('/admin/layanan')->with('error', 'Produk tidak ditemukan.');
        }

        $rules = [
            'nama_layanan' => 'required|max_length[100]',
            'harga_satuan' => 'required|decimal|greater_than_equal_to[0]',
            'tipe_harga'   => 'required|in_list[per_meter,per_lembar,per_pcs,per_set,per_huruf,per_buku]',
            'status'       => 'required|in_list[aktif,nonaktif]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambar = $layanan['gambar'];
        $file   = $this->request->getFile('gambar');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($gambar && file_exists(ROOTPATH . 'public/uploads/layanan/' . $gambar)) {
                unlink(ROOTPATH . 'public/uploads/layanan/' . $gambar);
            }
            $namaFile = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/layanan', $namaFile);
            $gambar = $namaFile;
        }

        $this->layananModel->update($kode, [
            'nama_layanan'            => $this->request->getPost('nama_layanan'),
            'id_kategori'             => $this->request->getPost('id_kategori') ?: null,
            'id_bahan'                => $this->request->getPost('id_bahan') ?: null,
            'harga_satuan'            => $this->request->getPost('harga_satuan') ?? 0,
            'harga_per_meter'         => $this->request->getPost('harga_per_meter') ?? 0,
            'diskon_desain_sendiri'   => $this->request->getPost('diskon_desain_sendiri') ?? 5000,
            'tipe_harga'              => $this->request->getPost('tipe_harga') ?? 'per_pcs',
            'deskripsi'               => $this->request->getPost('deskripsi'),
            'gambar'                  => $gambar,
            'status'                  => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/layanan')->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete(string $kode): RedirectResponse
    {
        $layanan = $this->layananModel->find($kode);

        if (!$layanan) {
            return redirect()->to('/admin/layanan')->with('error', 'Produk tidak ditemukan.');
        }

        if ($layanan['gambar'] && file_exists(ROOTPATH . 'public/uploads/layanan/' . $layanan['gambar'])) {
            unlink(ROOTPATH . 'public/uploads/layanan/' . $layanan['gambar']);
        }

        $this->layananModel->delete($kode);

        return redirect()->to('/admin/layanan')->with('success', 'Produk berhasil dihapus.');
    }
}
