<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTipeHargaToLayanan extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('tipe_harga', 'layanan')) {
            $this->forge->addColumn('layanan', [
                'tipe_harga' => [
                    'type'       => 'ENUM',
                    'constraint' => ['per_meter', 'per_lembar', 'per_pcs', 'per_set', 'per_huruf', 'per_buku'],
                    'default'    => 'per_pcs',
                    'after'      => 'diskon_desain_sendiri',
                ],
            ]);
        }
    }

    public function down(): void
    {
        if ($this->db->fieldExists('tipe_harga', 'layanan')) {
            $this->forge->dropColumn('layanan', 'tipe_harga');
        }
    }
}
