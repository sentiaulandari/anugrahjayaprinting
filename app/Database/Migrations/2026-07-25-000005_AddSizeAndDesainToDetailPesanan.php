<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSizeAndDesainToDetailPesanan extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('panjang', 'detail_pesanan')) {
            $this->forge->addColumn('detail_pesanan', [
                'panjang' => [
                    'type' => 'DOUBLE',
                    'null' => true,
                ],
            ]);
        }

        if (!$this->db->fieldExists('lebar', 'detail_pesanan')) {
            $this->forge->addColumn('detail_pesanan', [
                'lebar' => [
                    'type' => 'DOUBLE',
                    'null' => true,
                ],
            ]);
        }

        if (!$this->db->fieldExists('desain_sendiri', 'detail_pesanan')) {
            $this->forge->addColumn('detail_pesanan', [
                'desain_sendiri' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'default'    => 0,
                ],
            ]);
        }
    }

    public function down(): void
    {
        $this->forge->dropColumn('detail_pesanan', ['panjang', 'lebar', 'desain_sendiri']);
    }
}
