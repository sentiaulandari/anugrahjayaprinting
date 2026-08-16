<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFileDesainToDetailPesanan extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('file_desain', 'detail_pesanan')) {
            $this->forge->addColumn('detail_pesanan', [
                'file_desain' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'desain_sendiri',
                ],
            ]);
        }
    }

    public function down(): void
    {
        if ($this->db->fieldExists('file_desain', 'detail_pesanan')) {
            $this->forge->dropColumn('detail_pesanan', 'file_desain');
        }
    }
}
