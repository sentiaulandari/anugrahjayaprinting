<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHargaPerMeterToLayanan extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('harga_per_meter', 'layanan')) {
            $this->forge->addColumn('layanan', [
                'harga_per_meter' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
            ]);
        }

        if (!$this->db->fieldExists('diskon_desain_sendiri', 'layanan')) {
            $this->forge->addColumn('layanan', [
                'diskon_desain_sendiri' => [
                    'type'    => 'DOUBLE',
                    'default' => 5000,
                ],
            ]);
        }
    }

    public function down(): void
    {
        $this->forge->dropColumn('layanan', ['harga_per_meter', 'diskon_desain_sendiri']);
    }
}
