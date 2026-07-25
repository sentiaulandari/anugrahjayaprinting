<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPesananModel extends Model
{
    protected $table      = 'detail_pesanan';
    protected $primaryKey = 'id_detail';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_pesanan',
        'kode_layanan',
        'qty',
        'harga_satuan',
        'subtotal',
        'ukuran',
        'panjang',
        'lebar',
        'desain_sendiri',
        'keterangan',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'no_pesanan'   => 'required|max_length[20]',
        'kode_layanan' => 'required|max_length[10]',
        'qty'          => 'required|integer|greater_than[0]',
        'harga_satuan' => 'required|decimal|greater_than[0]',
    ];

    public function getByNoPesanan(string $noPesanan): array
    {
        return $this->select('detail_pesanan.*, layanan.nama_layanan, layanan.gambar, kategori.nama_kategori')
                    ->join('layanan', 'layanan.kode_layanan = detail_pesanan.kode_layanan', 'left')
                    ->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left')
                    ->where('detail_pesanan.no_pesanan', $noPesanan)
                    ->findAll();
    }

    public function deleteByNoPesanan(string $noPesanan): bool
    {
        return $this->where('no_pesanan', $noPesanan)->delete();
    }

    public function hitungTotal(string $noPesanan): float
    {
        $result = $this->selectSum('subtotal')
                       ->where('no_pesanan', $noPesanan)
                       ->first();

        return (float) ($result['subtotal'] ?? 0);
    }
}
