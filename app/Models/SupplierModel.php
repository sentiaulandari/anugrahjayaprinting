<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table      = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nama_supplier',
        'alamat',
        'no_hp',
        'email',
        'nama_produk',
        'created_at',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_supplier' => 'required|max_length[100]',
    ];

    public function search(string $keyword): array
    {
        return $this->like('nama_supplier', $keyword)
                    ->orLike('nama_produk', $keyword)
                    ->findAll();
    }

    /**
     * Supplier dengan ringkasan total pembelian
     */
    public function getWithTotalPembelian(): array
    {
        return $this->db->query("
            SELECT
                s.*,
                COUNT(DISTINCT p.id_pembelian) AS total_transaksi,
                IFNULL(SUM(dp.subtotal), 0) AS total_nilai,
                MAX(p.tgl_pembelian) AS terakhir_beli
            FROM supplier s
            LEFT JOIN pembelian p ON p.id_supplier = s.id_supplier
            LEFT JOIN detail_pembelian dp ON dp.id_pembelian = p.id_pembelian
            GROUP BY s.id_supplier
            ORDER BY total_nilai DESC
        ")->getResultArray();
    }
}
