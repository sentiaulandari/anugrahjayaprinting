<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table      = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_pembelian',
        'id_supplier',
        'id_bahan',
        'tgl_pembelian',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'keterangan',
        'created_at',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_bahan'     => 'required|integer',
        'jumlah'       => 'required|integer|greater_than[0]',
        'harga_satuan' => 'required|decimal|greater_than[0]',
        'tgl_pembelian'=> 'required|valid_date',
    ];

    public function getWithRelasi(): array
    {
        return $this->select('pembelian.*, supplier.nama_supplier, bahan.nama_bahan, bahan.satuan')
                    ->join('supplier', 'supplier.id_supplier = pembelian.id_supplier', 'left')
                    ->join('bahan', 'bahan.id_bahan = pembelian.id_bahan', 'left')
                    ->orderBy('pembelian.created_at', 'DESC')
                    ->findAll();
    }

    public function getDetailById(int $id): array|null
    {
        return $this->select('pembelian.*, supplier.nama_supplier, bahan.nama_bahan, bahan.satuan')
                    ->join('supplier', 'supplier.id_supplier = pembelian.id_supplier', 'left')
                    ->join('bahan', 'bahan.id_bahan = pembelian.id_bahan', 'left')
                    ->where('pembelian.id_pembelian', $id)
                    ->first();
    }

    public function generateNoPembelian(): string
    {
        $prefix = 'PB-' . date('Ymd') . '-';
        $last   = $this->like('no_pembelian', $prefix, 'after')
                       ->orderBy('no_pembelian', 'DESC')
                       ->first();

        if (!$last) {
            return $prefix . '001';
        }

        $angka = (int) substr($last['no_pembelian'], strlen($prefix));
        return $prefix . str_pad($angka + 1, 3, '0', STR_PAD_LEFT);
    }

    public function getTotalPembelian(string $dari = '', string $sampai = ''): float
    {
        $builder = $this->selectSum('total_harga');
        if ($dari && $sampai) {
            $builder->where('tgl_pembelian >=', $dari)->where('tgl_pembelian <=', $sampai);
        }
        $result = $builder->first();
        return (float) ($result['total_harga'] ?? 0);
    }
}
