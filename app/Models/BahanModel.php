<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanModel extends Model
{
    protected $table      = 'bahan';
    protected $primaryKey = 'id_bahan';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nama_bahan',
        'satuan',
        'stok',
        'stok_minimum',
        'keterangan',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_bahan'   => 'required|max_length[100]',
        'satuan'       => 'required|max_length[20]',
        'stok'         => 'required|integer|greater_than_equal_to[0]',
        'stok_minimum' => 'required|integer|greater_than_equal_to[0]',
    ];

    public function getStokMenurun(): array
    {
        return $this->where('stok <=', $this->db->protectIdentifiers('stok_minimum'), false)
                    ->findAll();
    }

    public function kurangiStok(int $idBahan, int $jumlah): bool
    {
        $bahan = $this->find($idBahan);
        if (!$bahan) {
            return false;
        }
        $stokBaru = max(0, $bahan['stok'] - $jumlah);
        return $this->update($idBahan, ['stok' => $stokBaru]);
    }

    public function tambahStok(int $idBahan, int $jumlah): bool
    {
        $bahan = $this->find($idBahan);
        if (!$bahan) {
            return false;
        }
        return $this->update($idBahan, ['stok' => $bahan['stok'] + $jumlah]);
    }

    public function updateStok(int $id, int $jumlah, string $tipe = 'kurang'): bool
    {
        return $tipe === 'tambah'
            ? $this->tambahStok($id, $jumlah)
            : $this->kurangiStok($id, $jumlah);
    }

    public function getForSelect(): array
    {
        return $this->findAll();
    }
}
