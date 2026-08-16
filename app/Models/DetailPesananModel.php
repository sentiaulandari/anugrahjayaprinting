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
        'file_desain',
        'keterangan',
    ];

    protected $useTimestamps = false;

    public function getByNoPesanan(string $noPesanan): array
    {
        return $this->select('detail_pesanan.*, layanan.nama_layanan, layanan.gambar, layanan.tipe_harga, kategori.nama_kategori')
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
