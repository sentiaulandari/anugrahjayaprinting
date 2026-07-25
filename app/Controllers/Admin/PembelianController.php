<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembelianModel;
use App\Models\SupplierModel;
use App\Models\BahanModel;

class PembelianController extends BaseController
{
    protected PembelianModel $pembelianModel;
    protected SupplierModel $supplierModel;
    protected BahanModel $bahanModel;

    public function __construct()
    {
        $this->pembelianModel = new PembelianModel();
        $this->supplierModel  = new SupplierModel();
        $this->bahanModel     = new BahanModel();
    }

    public function index(): string
    {
        $data = [
            'title'     => 'Pengelolaan Pembelian',
            'pembelian' => $this->pembelianModel->getWithRelasi(),
        ];

        return view('admin/pembelian/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title'    => 'Tambah Pembelian',
            'supplier' => $this->supplierModel->findAll(),
            'bahan'    => $this->bahanModel->findAll(),
        ];

        return view('admin/pembelian/form', $data);
    }

    public function store()
    {
        $rules = [
            'id_supplier'   => 'required|integer',
            'id_bahan'      => 'required|integer',
            'jumlah'        => 'required|integer|greater_than[0]',
            'harga_satuan'  => 'required|decimal|greater_than_equal_to[0]',
            'tgl_pembelian' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $jumlah     = (int) $this->request->getPost('jumlah');
        $hargaSatuan = (float) $this->request->getPost('harga_satuan');
        $hargaTotal  = $jumlah * $hargaSatuan;

        $this->pembelianModel->insert([
            'id_supplier'    => $this->request->getPost('id_supplier'),
            'id_bahan'       => $this->request->getPost('id_bahan'),
            'jumlah'         => $jumlah,
            'harga_satuan'   => $hargaSatuan,
            'harga_total'    => $hargaTotal,
            'tgl_pembelian'  => $this->request->getPost('tgl_pembelian'),
            'catatan'        => $this->request->getPost('catatan'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        $idBahan = $this->request->getPost('id_bahan');
        $bahan   = $this->bahanModel->find($idBahan);

        if ($bahan) {
            $stokBaru = $bahan['stok'] + $jumlah;
            $this->bahanModel->update($idBahan, [
                'stok'  => $stokBaru,
                'harga' => $hargaSatuan,
            ]);
        }

        return redirect()->to('/admin/pembelian')->with('success', 'Pembelian berhasil ditambahkan dan stok bahan bertambah.');
    }

    public function show(int $id): string
    {
        $pembelian = $this->pembelianModel->find($id);

        if (!$pembelian) {
            return redirect()->to('/admin/pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }

        $supplier = $this->supplierModel->find($pembelian['id_supplier']);
        $bahan    = $this->bahanModel->find($pembelian['id_bahan']);

        $data = [
            'title'     => 'Detail Pembelian',
            'pembelian' => $pembelian,
            'supplier'  => $supplier,
            'bahan'     => $bahan,
        ];

        return view('admin/pembelian/detail', $data);
    }

    public function delete(int $id)
    {
        $pembelian = $this->pembelianModel->find($id);

        if (!$pembelian) {
            return redirect()->to('/admin/pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }

        $idBahan = $pembelian['id_bahan'];
        $jumlah  = (int) $pembelian['jumlah'];
        $bahan   = $this->bahanModel->find($idBahan);

        if ($bahan) {
            $stokBaru = max(0, $bahan['stok'] - $jumlah);
            $this->bahanModel->update($idBahan, ['stok' => $stokBaru]);
        }

        $this->pembelianModel->delete($id);

        return redirect()->to('/admin/pembelian')->with('success', 'Pembelian berhasil dihapus dan stok bahan dikurangi.');
    }
}
