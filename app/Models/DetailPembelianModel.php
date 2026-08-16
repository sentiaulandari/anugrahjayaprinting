<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPembelianModel extends Model
{
    protected $table      = 'detail_pembelian';
    protected $primaryKey = 'id_detail';
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_pembelian',
        'id_bahan',
        'jumlah',
        'harga_satuan',
        'subtotal',
    ];

    protected $useTimestamps = false;

    public function getByPembelian(int $idPembelian): array
    {
        return $this->select('detail_pembelian.*, bahan.nama_bahan, bahan.satuan')
                    ->join('bahan', 'bahan.id_bahan = detail_pembelian.id_bahan', 'left')
                    ->where('detail_pembelian.id_pembelian', $idPembelian)
                    ->findAll();
    }

    public function deleteByPembelian(int $idPembelian): bool
    {
        return $this->where('id_pembelian', $idPembelian)->delete();
    }
}
