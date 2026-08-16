<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table      = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_faktur',
        'id_supplier',
        'tgl_pembelian',
        'catatan',
        'created_at',
    ];

    protected $useTimestamps = false;

    public function getWithRelasi(): array
    {
        return $this->select('pembelian.*, supplier.nama_supplier,
                            (SELECT COUNT(*) FROM detail_pembelian WHERE detail_pembelian.id_pembelian = pembelian.id_pembelian) as total_item,
                            (SELECT IFNULL(SUM(subtotal), 0) FROM detail_pembelian WHERE detail_pembelian.id_pembelian = pembelian.id_pembelian) as total_harga')
                    ->join('supplier', 'supplier.id_supplier = pembelian.id_supplier', 'left')
                    ->orderBy('pembelian.tgl_pembelian', 'DESC')
                    ->findAll();
    }

    public function generateNoFaktur(): string
    {
        $prefix = 'FB-' . date('Ymd') . '-';
        $last   = $this->like('no_faktur', $prefix, 'after')
                       ->orderBy('no_faktur', 'DESC')
                       ->first();

        if (!$last) {
            return $prefix . '001';
        }

        $angka = (int) substr($last['no_faktur'], strlen($prefix));
        return $prefix . str_pad($angka + 1, 3, '0', STR_PAD_LEFT);
    }

    public function getTotalByPeriode(string $dari, string $sampai): float
    {
        $result = $this->db->query('
            SELECT IFNULL(SUM(dp.subtotal), 0) as total
            FROM pembelian p
            LEFT JOIN detail_pembelian dp ON dp.id_pembelian = p.id_pembelian
            WHERE p.tgl_pembelian >= ? AND p.tgl_pembelian <= ?
        ', [$dari, $sampai])->getRow();
        return (float) ($result->total ?? 0);
    }
}
