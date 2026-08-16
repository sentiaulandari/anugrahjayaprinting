<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CleanupPembelianOldColumns extends Migration
{
    public function up(): void
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        if ($this->db->fieldExists('id_bahan', 'pembelian')) {
            $this->db->query('ALTER TABLE `pembelian` DROP FOREIGN KEY `pembelian_id_bahan_foreign`');
            $this->forge->dropColumn('pembelian', 'id_bahan');
        }

        if ($this->db->fieldExists('jumlah', 'pembelian')) {
            $this->forge->dropColumn('pembelian', 'jumlah');
        }

        if ($this->db->fieldExists('harga_satuan', 'pembelian')) {
            $this->forge->dropColumn('pembelian', 'harga_satuan');
        }

        if ($this->db->fieldExists('harga_total', 'pembelian')) {
            $this->forge->dropColumn('pembelian', 'harga_total');
        }

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }

    public function down(): void
    {
    }
}
