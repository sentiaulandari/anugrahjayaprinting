<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdPelangganToTransaksiCetak extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('id_pelanggan', 'transaksi_cetak')) {
            $this->db->query('ALTER TABLE `transaksi_cetak` ADD COLUMN `id_pelanggan` INT NULL');
            $this->db->query('ALTER TABLE `transaksi_cetak` ADD CONSTRAINT `transaksi_cetak_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE CASCADE');
        }
    }

    public function down(): void
    {
    }
}
