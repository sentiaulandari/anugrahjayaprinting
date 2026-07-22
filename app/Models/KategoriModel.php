<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nama_kategori',
        'deskripsi',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_kategori' => 'required|max_length[100]',
    ];

    public function getForSelect(): array
    {
        return $this->findAll();
    }
}
