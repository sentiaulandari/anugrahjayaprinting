<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table      = 'pesanan';
    protected $primaryKey = 'no_pesanan';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_pesanan',
        'id_pelanggan',
        'tgl_pesanan',
        'tgl_selesai',
        'total_harga',
        'status_pesanan',
        'status_bayar',
        'catatan',
        'created_at',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_pelanggan' => 'required|integer',
        'tgl_pesanan'  => 'required|valid_date',
    ];

    public function getWithPelanggan(): array
    {
        return $this->select('pesanan.*, pelanggan.nama_pelanggan, pelanggan.no_hp')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left')
                    ->orderBy('pesanan.created_at', 'DESC')
                    ->findAll();
    }

    public function getDetailPesanan(string $noPesanan): array|null
    {
        return $this->select('pesanan.*, pelanggan.nama_pelanggan, pelanggan.no_hp, pelanggan.alamat, pelanggan.email')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left')
                    ->where('pesanan.no_pesanan', $noPesanan)
                    ->first();
    }

    public function getByPelanggan(int $idPelanggan): array
    {
        return $this->where('id_pelanggan', $idPelanggan)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getByStatus(string $status): array
    {
        return $this->select('pesanan.*, pelanggan.nama_pelanggan')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left')
                    ->where('pesanan.status_pesanan', $status)
                    ->orderBy('pesanan.created_at', 'DESC')
                    ->findAll();
    }

    public function generateNoPesanan(): string
    {
        $prefix = 'PS-' . date('Ymd') . '-';
        $last   = $this->like('no_pesanan', $prefix, 'after')
                       ->orderBy('no_pesanan', 'DESC')
                       ->first();

        if (!$last) {
            return $prefix . '001';
        }

        $angka = (int) substr($last['no_pesanan'], strlen($prefix));
        return $prefix . str_pad($angka + 1, 3, '0', STR_PAD_LEFT);
    }

    public function countByStatus(): array
    {
        $result = [];
        $statuses = ['menunggu', 'diproses', 'selesai', 'dibatalkan'];

        foreach ($statuses as $status) {
            $result[$status] = $this->where('status_pesanan', $status)->countAllResults();
        }

        return $result;
    }

    public function getPesananByPeriode(string $dari, string $sampai): array
    {
        return $this->select('pesanan.*, pelanggan.nama_pelanggan')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left')
                    ->where('pesanan.tgl_pesanan >=', $dari)
                    ->where('pesanan.tgl_pesanan <=', $sampai)
                    ->orderBy('pesanan.tgl_pesanan', 'ASC')
                    ->findAll();
    }
}
