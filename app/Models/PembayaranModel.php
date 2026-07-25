<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table      = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_pesanan',
        'tgl_pembayaran',
        'jumlah_bayar',
        'metode_bayar',
        'bukti_pembayaran',
        'status_konfirmasi',
        'catatan_admin',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'no_pesanan'    => 'required|max_length[20]',
        'jumlah_bayar'  => 'required|decimal|greater_than[0]',
        'metode_bayar'  => 'required|max_length[50]',
    ];

    public function getWithPesanan(): array
    {
        return $this->select('pembayaran.*, pesanan.total_harga, pesanan.status_pesanan, pelanggan.nama_pelanggan')
                    ->join('pesanan', 'pesanan.no_pesanan = pembayaran.no_pesanan', 'left')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left')
                    ->orderBy('pembayaran.tgl_pembayaran', 'DESC')
                    ->findAll();
    }

    public function getByNoPesanan(string $noPesanan): array|null
    {
        return $this->where('no_pesanan', $noPesanan)
                    ->orderBy('id_pembayaran', 'DESC')
                    ->first();
    }

    public function getMenungguKonfirmasi(): array
    {
        return $this->select('pembayaran.*, pesanan.total_harga, pelanggan.nama_pelanggan')
                    ->join('pesanan', 'pesanan.no_pesanan = pembayaran.no_pesanan', 'left')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left')
                    ->where('pembayaran.status_konfirmasi', 'menunggu')
                    ->orderBy('pembayaran.tgl_pembayaran', 'ASC')
                    ->findAll();
    }

    public function getTotalPendapatan(string $dari = '', string $sampai = ''): float
    {
        $builder = $this->where('status_konfirmasi', 'diterima');

        if ($dari && $sampai) {
            $builder->where('tgl_pembayaran >=', $dari)
                    ->where('tgl_pembayaran <=', $sampai);
        }

        $result = $builder->selectSum('jumlah_bayar')->first();
        return (float) ($result['jumlah_bayar'] ?? 0);
    }

    public function getTransaksiTerbaru(int $limit = 10): array
    {
        return $this->select('pembayaran.*, pesanan.total_harga, pesanan.status_pesanan, pelanggan.nama_pelanggan')
                    ->join('pesanan', 'pesanan.no_pesanan = pembayaran.no_pesanan', 'left')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left')
                    ->orderBy('pembayaran.id_pembayaran', 'DESC')
                    ->findAll($limit);
    }
}
