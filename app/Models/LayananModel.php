<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table      = 'layanan';
    protected $primaryKey = 'kode_layanan';
    protected $returnType = 'array';

    protected $allowedFields = [
        'kode_layanan',
        'nama_layanan',
        'id_kategori',
        'id_bahan',
        'harga_satuan',
        'deskripsi',
        'gambar',
        'status',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'kode_layanan' => 'required|max_length[10]',
        'nama_layanan' => 'required|max_length[100]',
        'harga_satuan' => 'required|decimal|greater_than[0]',
        'status'       => 'required|in_list[aktif,nonaktif]',
    ];

    public function getWithRelasi(): array
    {
        return $this->select('layanan.*, kategori.nama_kategori, bahan.nama_bahan, bahan.satuan')
                    ->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left')
                    ->join('bahan', 'bahan.id_bahan = layanan.id_bahan', 'left')
                    ->findAll();
    }

    public function getDetailByKode(string $kode): array|null
    {
        return $this->select('layanan.*, kategori.nama_kategori, bahan.nama_bahan, bahan.satuan, bahan.stok')
                    ->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left')
                    ->join('bahan', 'bahan.id_bahan = layanan.id_bahan', 'left')
                    ->where('layanan.kode_layanan', $kode)
                    ->first();
    }

    public function getAktif(): array
    {
        return $this->select('layanan.*, kategori.nama_kategori, bahan.nama_bahan')
                    ->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left')
                    ->join('bahan', 'bahan.id_bahan = layanan.id_bahan', 'left')
                    ->where('layanan.status', 'aktif')
                    ->findAll();
    }

    public function generateKode(): string
    {
        $last = $this->select('kode_layanan')
                     ->orderBy('kode_layanan', 'DESC')
                     ->first();

        if (!$last) {
            return 'LY-001';
        }

        $angka = (int) substr($last['kode_layanan'], 3);
        return 'LY-' . str_pad($angka + 1, 3, '0', STR_PAD_LEFT);
    }
}
