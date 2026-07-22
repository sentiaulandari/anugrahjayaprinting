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
        'no_hp',
        'email',
        'alamat',
        'keterangan',
        'created_at',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_supplier' => 'required|max_length[100]',
        'no_hp'         => 'permit_empty|max_length[15]',
        'email'         => 'permit_empty|valid_email',
    ];

    public function getForSelect(): array
    {
        return $this->findAll();
    }
}
