<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RebuildPembelianTable extends Migration
{
    public function up(): void
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->query('DROP TABLE IF EXISTS `pembelian`');
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        $this->forge->addField([
            'id_pembelian' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_supplier' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_bahan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'harga_satuan' => [
                'type'    => 'DOUBLE',
                'default' => 0,
            ],
            'harga_total' => [
                'type' => 'DOUBLE',
            ],
            'tgl_pembelian' => [
                'type' => 'DATE',
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

        $this->forge->addKey('id_pembelian', true);
        $this->forge->addForeignKey('id_supplier', 'supplier', 'id_supplier', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_bahan', 'bahan', 'id_bahan', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('pembelian');
    }

    public function down(): void
    {
        $this->forge->dropTable('pembelian');
    }
}
