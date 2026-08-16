<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table      = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_user',
        'nama_pelanggan',
        'alamat',
        'no_hp',
        'email',
        'created_at',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_pelanggan' => 'required|max_length[100]',
        'email'          => 'permit_empty|valid_email|max_length[100]',
        'no_hp'          => 'permit_empty|max_length[15]',
    ];

    public function getWithUser(): array
    {
        return $this->select('pelanggan.*, users.username, users.level')
                    ->join('users', 'users.id_user = pelanggan.id_user', 'left')
                    ->findAll();
    }

    public function getByIdUser(int $idUser): array|null
    {
        return $this->where('id_user', $idUser)->first();
    }

    public function getDetailById(int $id): array|null
    {
        return $this->select('pelanggan.*, users.username, users.level')
                    ->join('users', 'users.id_user = pelanggan.id_user', 'left')
                    ->where('pelanggan.id_pelanggan', $id)
                    ->first();
    }

    /**
     * Pelanggan dengan ringkasan total pesanan dan nilai transaksi
     */
    public function getWithRingkasanPesanan(): array
    {
        return $this->db->query("
            SELECT
                pl.*,
                COUNT(DISTINCT ps.no_pesanan) AS total_pesanan,
                IFNULL(SUM(ps.total_harga), 0) AS total_nilai,
                SUM(CASE WHEN ps.status_pesanan = 'selesai' THEN 1 ELSE 0 END) AS pesanan_selesai,
                SUM(CASE WHEN ps.status_pesanan = 'dibatalkan' THEN 1 ELSE 0 END) AS pesanan_batal,
                MAX(ps.tgl_pesanan) AS terakhir_pesan
            FROM pelanggan pl
            LEFT JOIN pesanan ps ON ps.id_pelanggan = pl.id_pelanggan
            GROUP BY pl.id_pelanggan
            ORDER BY total_nilai DESC
        ")->getResultArray();
    }
}
