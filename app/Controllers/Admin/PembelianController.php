<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembelianModel;
use App\Models\DetailPembelianModel;
use App\Models\SupplierModel;
use App\Models\BahanModel;

class PembelianController extends BaseController
{
    protected PembelianModel $pembelianModel;
    protected DetailPembelianModel $detailModel;
    protected SupplierModel $supplierModel;
    protected BahanModel $bahanModel;

    public function __construct()
    {
        $this->pembelianModel = new PembelianModel();
        $this->detailModel    = new DetailPembelianModel();
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
            'no_faktur' => $this->pembelianModel->generateNoFaktur(),
        ];

        return view('admin/pembelian/form', $data);
    }

    public function store()
    {
        $rules = [
            'id_supplier'    => 'required|integer',
            'tgl_pembelian'  => 'required|valid_date',
            'id_bahan'       => 'required',
            'jumlah'         => 'required',
            'harga_satuan_beli' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $idSupplier   = (int) $this->request->getPost('id_supplier');
        $tglPembelian = $this->request->getPost('tgl_pembelian');
        $catatan      = $this->request->getPost('catatan');
        $idBahanArr   = $this->request->getPost('id_bahan');
        $jumlahArr    = $this->request->getPost('jumlah');
        $hargaArr     = $this->request->getPost('harga_satuan_beli');

        if (empty($idBahanArr) || !is_array($idBahanArr)) {
            return redirect()->back()->withInput()->with('errors', ['Minimal harus ada 1 item pembelian.']);
        }

        $noFaktur = $this->pembelianModel->generateNoFaktur();

        $grandTotal = 0;
        $detailData = [];

        foreach ($idBahanArr as $i => $idBahan) {
            $idBahan = (int) $idBahan;
            $jumlah  = (int) ($jumlahArr[$i] ?? 0);
            $harga   = (float) ($hargaArr[$i] ?? 0);

            if ($idBahan <= 0 || $jumlah <= 0 || $harga < 0) {
                continue;
            }

            $subtotal = $jumlah * $harga;
            $grandTotal += $subtotal;

            $detailData[] = [
                'id_bahan'     => $idBahan,
                'jumlah'       => $jumlah,
                'harga_satuan' => $harga,
                'subtotal'     => $subtotal,
            ];
        }

        if (empty($detailData)) {
            return redirect()->back()->withInput()->with('errors', ['Minimal harus ada 1 item pembelian yang valid.']);
        }

        $idPembelian = $this->pembelianModel->insert([
            'no_faktur'      => $noFaktur,
            'id_supplier'    => $idSupplier,
            'tgl_pembelian'  => $tglPembelian,
            'catatan'        => $catatan,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        foreach ($detailData as $item) {
            $item['id_pembelian'] = $idPembelian;
            $this->detailModel->insert($item);

            $bahan = $this->bahanModel->find($item['id_bahan']);
            if ($bahan) {
                $this->bahanModel->update($item['id_bahan'], [
                    'stok'  => $bahan['stok'] + $item['jumlah'],
                    'harga' => $item['harga_satuan'],
                ]);
            }
        }

        return redirect()->to('/admin/pembelian/show/' . $idPembelian)->with('success', 'Pembelian berhasil ditambahkan. No Faktur: ' . $noFaktur);
    }

    public function show(int $id): string
    {
        $pembelian = $this->pembelianModel->find($id);

        if (!$pembelian) {
            return redirect()->to('/admin/pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }

        $supplier = $this->supplierModel->find($pembelian['id_supplier']);
        $details  = $this->detailModel->getByPembelian($id);

        $grandTotal = 0;
        foreach ($details as &$d) {
            $grandTotal += $d['subtotal'];
        }

        $data = [
            'title'      => 'Detail Pembelian',
            'pembelian'  => $pembelian,
            'supplier'   => $supplier,
            'details'    => $details,
            'grandTotal' => $grandTotal,
        ];

        return view('admin/pembelian/detail', $data);
    }

    public function delete(int $id)
    {
        $pembelian = $this->pembelianModel->find($id);

        if (!$pembelian) {
            return redirect()->to('/admin/pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }

        $details = $this->detailModel->getByPembelian($id);

        foreach ($details as $d) {
            $bahan = $this->bahanModel->find($d['id_bahan']);
            if ($bahan) {
                $stokBaru = max(0, $bahan['stok'] - $d['jumlah']);
                $this->bahanModel->update($d['id_bahan'], ['stok' => $stokBaru]);
            }
        }

        $this->detailModel->deleteByPembelian($id);
        $this->pembelianModel->delete($id);

        return redirect()->to('/admin/pembelian')->with('success', 'Pembelian berhasil dihapus dan stok bahan dikurangi.');
    }
}
