<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailPesananTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_detail' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_pesanan' => [
                'type'       => 'CHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'kode_layanan' => [
                'type'       => 'CHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'harga_satuan' => [
                'type'    => 'DOUBLE',
                'default' => 0,
            ],
            'subtotal' => [
                'type'    => 'DOUBLE',
                'default' => 0,
            ],
            'ukuran' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_detail');
        $this->forge->addForeignKey('no_pesanan', 'pesanan', 'no_pesanan', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('kode_layanan', 'layanan', 'kode_layanan', 'SET NULL', 'CASCADE');
        $this->forge->createTable('detail_pesanan', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('detail_pesanan', true);
    }
}
