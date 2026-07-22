<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\LayananModel;
use App\Models\ReturnPesananModel;

class PesananController extends BaseController
{
    protected PesananModel $pesananModel;
    protected DetailPesananModel $detailModel;
    protected LayananModel $layananModel;
    protected ReturnPesananModel $returnModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->detailModel  = new DetailPesananModel();
        $this->layananModel = new LayananModel();
        $this->returnModel  = new ReturnPesananModel();
    }

    public function index(): string
    {
        $idPelanggan = session()->get('id_pelanggan');

        $data = [
            'title'   => 'Pesanan Saya',
            'pesanan' => $this->pesananModel->getByPelanggan($idPelanggan),
        ];

        return view('pelanggan/pesanan/index', $data);
    }

    public function show(string $no): string
    {
        $idPelanggan = session()->get('id_pelanggan');
        $pesanan     = $this->pesananModel->getDetailPesanan($no);

        if (!$pesanan || $pesanan['id_pelanggan'] != $idPelanggan) {
            return redirect()->to('/pelanggan/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $sudahReturn = $this->returnModel->getByNoPesanan($no);

        $data = [
            'title'       => 'Detail Pesanan',
            'pesanan'     => $pesanan,
            'detail'      => $this->detailModel->getByNoPesanan($no),
            'sudahReturn' => $sudahReturn,
        ];

        return view('pelanggan/pesanan/detail', $data);
    }

    public function create(): string
    {
        $data = [
            'title'    => 'Buat Pesanan',
            'layanan'  => $this->layananModel->getAktif(),
            'tgl_hari' => date('Y-m-d'),
            'tgl_min'  => date('Y-m-d', strtotime('+1 day')),
        ];

        return view('pelanggan/pesanan/form', $data);
    }

    public function store()
    {
        $idPelanggan = session()->get('id_pelanggan');

        $rules = [
            'tgl_selesai'  => 'required|valid_date',
            'kode_layanan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $noPesanan = $this->pesananModel->generateNoPesanan();
        $tglPesan  = date('Y-m-d');

        $this->pesananModel->insert([
            'no_pesanan'     => $noPesanan,
            'id_pelanggan'   => $idPelanggan,
            'tgl_pesanan'    => $tglPesan,
            'tgl_selesai'    => $this->request->getPost('tgl_selesai'),
            'status_pesanan' => 'menunggu',
            'status_bayar'   => 'belum bayar',
            'catatan'        => $this->request->getPost('catatan'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        $kodeLayanan = $this->request->getPost('kode_layanan');
        $qtys        = $this->request->getPost('qty');
        $ukurans     = $this->request->getPost('ukuran');
        $keterangans = $this->request->getPost('keterangan_detail');
        $total       = 0;

        foreach ($kodeLayanan as $i => $kode) {
            $layanan = $this->layananModel->find($kode);
            if (!$layanan) {
                continue;
            }

            $qty      = (int) $qtys[$i];
            $harga    = (float) $layanan['harga_satuan'];
            $subtotal = $qty * $harga;
            $total   += $subtotal;

            $this->detailModel->insert([
                'no_pesanan'   => $noPesanan,
                'kode_layanan' => $kode,
                'qty'          => $qty,
                'harga_satuan' => $harga,
                'subtotal'     => $subtotal,
                'ukuran'       => $ukurans[$i] ?? null,
                'keterangan'   => $keterangans[$i] ?? null,
            ]);
        }

        $this->pesananModel->update($noPesanan, ['total_harga' => $total]);

        return redirect()->to('/pelanggan/pembayaran/form/' . $noPesanan)
                         ->with('success', 'Pesanan ' . $noPesanan . ' berhasil dibuat. Silakan lakukan pembayaran.');
    }
}
