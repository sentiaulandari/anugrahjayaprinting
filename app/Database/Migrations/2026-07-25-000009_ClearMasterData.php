<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClearMasterData extends Migration
{
    public function up(): void
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        $this->db->table('detail_transaksi_cetak')->truncate();
        $this->db->table('transaksi_cetak')->truncate();
        $this->db->table('detail_pesanan')->truncate();
        $this->db->table('pembayaran')->truncate();
        $this->db->table('pesanan')->truncate();
        $this->db->table('pembelian')->truncate();
        $this->db->table('pelanggan')->truncate();
        $this->db->table('layanan')->truncate();
        $this->db->table('bahan')->truncate();
        $this->db->table('kategori')->truncate();

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }

    public function down(): void
    {
    }
}
