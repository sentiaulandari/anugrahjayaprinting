<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table      = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_supplier',
        'id_bahan',
        'jumlah',
        'harga_satuan',
        'harga_total',
        'tgl_pembelian',
        'catatan',
        'created_at',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_supplier'    => 'required|integer',
        'id_bahan'       => 'required|integer',
        'jumlah'         => 'required|integer|greater_than[0]',
        'harga_total'    => 'required|decimal|greater_than[0]',
        'tgl_pembelian'  => 'required|valid_date',
    ];

    public function getWithRelasi(): array
    {
        return $this->select('pembelian.*, supplier.nama_supplier, bahan.nama_bahan, bahan.satuan')
                    ->join('supplier', 'supplier.id_supplier = pembelian.id_supplier', 'left')
                    ->join('bahan', 'bahan.id_bahan = pembelian.id_bahan', 'left')
                    ->orderBy('pembelian.tgl_pembelian', 'DESC')
                    ->findAll();
    }

    public function getTotalByPeriode(string $dari, string $sampai): float
    {
        $result = $this->selectSum('harga_total')
                       ->where('tgl_pembelian >=', $dari)
                       ->where('tgl_pembelian <=', $sampai)
                       ->first();
        return (float) ($result['harga_total'] ?? 0);
    }
}
