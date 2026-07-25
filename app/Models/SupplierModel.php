<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table      = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nama_supplier',
        'alamat',
        'no_hp',
        'email',
        'nama_produk',
        'created_at',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_supplier' => 'required|max_length[100]',
    ];

    public function search(string $keyword): array
    {
        return $this->like('nama_supplier', $keyword)
                    ->orLike('nama_produk', $keyword)
                    ->findAll();
    }
}
