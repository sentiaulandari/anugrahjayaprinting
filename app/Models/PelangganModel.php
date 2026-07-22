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
}
