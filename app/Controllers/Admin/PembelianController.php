<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembelianModel;
use App\Models\SupplierModel;
use App\Models\BahanModel;
use CodeIgniter\HTTP\RedirectResponse;

class PembelianController extends BaseController
{
    protected PembelianModel $pembelianModel;
    protected SupplierModel  $supplierModel;
    protected BahanModel     $bahanModel;

    public function __construct()
    {
        $this->pembelianModel = new PembelianModel();
        $this->supplierModel  = new SupplierModel();
        $this->bahanModel     = new BahanModel();
    }

    public function index(): string
    {
        $data = [
            'title'      => 'Pengelolaan Pembelian',
            'pembelian'  => $this->pembelianModel->getWithRelasi(),
            'totalBulan' => $this->pembelianModel->getTotalPembelian(date('Y-m-01'), date('Y-m-d')),
        ];

        return view('admin/pembelian/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title'    => 'Tambah Pembelian',
            'supplier' => $this->supplierModel->getForSelect(),
            'bahan'    => $this->bahanModel->getForSelect(),
            'no_baru'  => $this->pembelianModel->generateNoPembelian(),
            'tgl_hari' => date('Y-m-d'),
        ];

        return view('admin/pembelian/form', $data);
    }

    public function store(): RedirectResponse
    {
        $rules = [
            'id_bahan'      => 'required|integer',
            'jumlah'        => 'required|integer|greater_than[0]',
            'harga_satuan'  => 'required|decimal|greater_than[0]',
            'tgl_pembelian' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $jumlah      = (int)   $this->request->getPost('jumlah');
        $hargaSatuan = (float) $this->request->getPost('harga_satuan');
        $totalHarga  = $jumlah * $hargaSatuan;
        $noPembelian = $this->pembelianModel->generateNoPembelian();

        $this->pembelianModel->insert([
            'no_pembelian'  => $noPembelian,
            'id_supplier'   => $this->request->getPost('id_supplier') ?: null,
            'id_bahan'      => $this->request->getPost('id_bahan'),
            'tgl_pembelian' => $this->request->getPost('tgl_pembelian'),
            'jumlah'        => $jumlah,
            'harga_satuan'  => $hargaSatuan,
            'total_harga'   => $totalHarga,
            'keterangan'    => $this->request->getPost('keterangan'),
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        $this->bahanModel->tambahStok((int) $this->request->getPost('id_bahan'), $jumlah);

        return redirect()->to('/admin/pembelian')->with('success', 'Pembelian ' . $noPembelian . ' berhasil dicatat. Stok bahan bertambah ' . $jumlah . '.');
    }

    public function show(int $id): RedirectResponse|string
    {
        $pembelian = $this->pembelianModel->getDetailById($id);

        if (!$pembelian) {
            return redirect()->to('/admin/pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }

        return view('admin/pembelian/detail', ['title' => 'Detail Pembelian', 'pembelian' => $pembelian]);
    }

    public function delete(int $id): RedirectResponse
    {
        $pembelian = $this->pembelianModel->find($id);

        if (!$pembelian) {
            return redirect()->to('/admin/pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }

        $this->bahanModel->kurangiStok((int) $pembelian['id_bahan'], (int) $pembelian['jumlah']);
        $this->pembelianModel->delete($id);

        return redirect()->to('/admin/pembelian')->with('success', 'Pembelian dihapus. Stok bahan dikembalikan.');
    }
}
