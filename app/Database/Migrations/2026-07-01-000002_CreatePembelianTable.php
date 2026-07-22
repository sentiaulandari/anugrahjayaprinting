<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembelianTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_pembelian' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_pembelian' => [
                'type'       => 'CHAR',
                'constraint' => 20,
                'unique'     => true,
            ],
            'id_supplier' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_bahan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'tgl_pembelian' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'harga_satuan' => [
                'type'    => 'DOUBLE',
                'default' => 0,
            ],
            'total_harga' => [
                'type'    => 'DOUBLE',
                'default' => 0,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_pembelian');
        $this->forge->addForeignKey('id_supplier', 'supplier', 'id_supplier', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_bahan', 'bahan', 'id_bahan', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pembelian', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('pembelian', true);
    }
}
