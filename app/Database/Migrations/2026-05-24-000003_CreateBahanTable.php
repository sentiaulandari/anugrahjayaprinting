<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBahanTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_bahan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_bahan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'stok_minimum' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_bahan');
        $this->forge->createTable('bahan', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('bahan', true);
    }
}
