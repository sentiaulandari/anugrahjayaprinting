<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHargaSatuanToPembelian extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('harga_satuan', 'pembelian')) {
            $this->forge->addColumn('pembelian', [
                'harga_satuan' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
            ]);
        }
    }

    public function down(): void
    {
        $this->forge->dropColumn('pembelian', 'harga_satuan');
    }
}
