<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Outdoor',       'deskripsi' => 'Cetak untuk kebutuhan luar ruangan'],
            ['nama_kategori' => 'Indoor',         'deskripsi' => 'Cetak untuk kebutuhan dalam ruangan'],
            ['nama_kategori' => 'Cetak Offset',   'deskripsi' => 'Cetak offset untuk kebutuhan massal'],
            ['nama_kategori' => 'Promosi',        'deskripsi' => 'Cetak untuk keperluan promosi dan marketing'],
        ];

        $this->db->table('kategori')->insertBatch($data);
    }
}
