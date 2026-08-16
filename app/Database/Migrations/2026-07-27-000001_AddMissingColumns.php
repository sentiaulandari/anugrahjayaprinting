<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMissingColumns extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('nama_produk', 'supplier')) {
            $this->db->query("ALTER TABLE `supplier` ADD COLUMN `nama_produk` VARCHAR(100) NULL AFTER `email`");
        }
    }

    public function down(): void
    {
        if ($this->db->fieldExists('nama_produk', 'supplier')) {
            $this->forge->dropColumn('supplier', 'nama_produk');
        }
    }
}
