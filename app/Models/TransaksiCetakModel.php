<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiCetakModel extends Model
{
    protected $table      = 'transaksi_cetak';
    protected $primaryKey = 'no_transaksi';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_transaksi',
        'nama_pelanggan',
        'no_hp',
        'tgl_transaksi',
        'total_harga',
        'metode_bayar',
        'status_bayar',
        'catatan',
        'created_at',
    ];

    protected $useTimestamps = false;

    public function generateNoTransaksi(): string
    {
        $prefix = 'TC-' . date('Ymd') . '-';
        $last   = $this->like('no_transaksi', $prefix, 'after')
                       ->orderBy('no_transaksi', 'DESC')
                       ->first();

        if (!$last) {
            return $prefix . '001';
        }

        $angka = (int) substr($last['no_transaksi'], strlen($prefix));
        return $prefix . str_pad($angka + 1, 3, '0', STR_PAD_LEFT);
    }

    public function getTransaksiByPeriode(string $dari, string $sampai): array
    {
        return $this->where('tgl_transaksi >=', $dari)
                    ->where('tgl_transaksi <=', $sampai)
                    ->orderBy('tgl_transaksi', 'ASC')
                    ->findAll();
    }

    public function getTotalByPeriode(string $dari, string $sampai): float
    {
        $result = $this->selectSum('total_harga')
                       ->where('tgl_transaksi >=', $dari)
                       ->where('tgl_transaksi <=', $sampai)
                       ->first();
        return (float) ($result['total_harga'] ?? 0);
    }
}
