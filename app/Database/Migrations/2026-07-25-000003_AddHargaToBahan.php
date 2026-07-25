<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHargaToBahan extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('harga', 'bahan')) {
            $this->forge->addColumn('bahan', [
                'harga' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
            ]);
        }
    }

    public function down(): void
    {
        $this->forge->dropColumn('bahan', 'harga');
    }
}
