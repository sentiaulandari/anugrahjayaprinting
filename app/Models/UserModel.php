<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id_user';
    protected $returnType    = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'username',
        'password',
        'nama_lengkap',
        'email',
        'no_hp',
        'level',
        'created_at',
    ];

    protected $useTimestamps  = false;

    protected $validationRules = [
        'username'     => 'required|min_length[3]|max_length[50]|is_unique[users.username,id_user,{id_user}]',
        'email'        => 'required|valid_email|is_unique[users.email,id_user,{id_user}]',
        'nama_lengkap' => 'required|max_length[100]',
        'level'        => 'required|in_list[admin,pelanggan,pimpinan]',
    ];

    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Username sudah digunakan.',
        ],
        'email' => [
            'is_unique' => 'Email sudah terdaftar.',
        ],
    ];

    public function findByUsername(string $username): array|null
    {
        return $this->where('username', $username)->first();
    }

    public function findByEmail(string $email): array|null
    {
        return $this->where('email', $email)->first();
    }

    public function getByLevel(string $level): array
    {
        return $this->where('level', $level)->findAll();
    }
}
