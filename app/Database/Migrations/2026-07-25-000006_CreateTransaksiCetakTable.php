<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiCetakTable extends Migration
{
    public function up(): void
    {
        if (!$this->db->tableExists('transaksi_cetak')) {
            $this->forge->addField([
                'no_transaksi' => [
                    'type'       => 'CHAR',
                    'constraint' => 20,
                ],
                'nama_pelanggan' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => true,
                ],
                'no_hp' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => true,
                ],
                'tgl_transaksi' => [
                    'type' => 'DATE',
                ],
                'total_harga' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
                'metode_bayar' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                ],
                'status_bayar' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'default'    => 'lunas',
                ],
                'catatan' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'created_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => true,
                ],
            ]);

            $this->forge->addKey('no_transaksi', true);
            $this->forge->createTable('transaksi_cetak');
        }
    }

    public function down(): void
    {
        $this->forge->dropTable('transaksi_cetak');
    }
}
