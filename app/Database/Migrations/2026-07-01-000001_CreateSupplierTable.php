<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupplierTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_supplier' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_supplier' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
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

        $this->forge->addPrimaryKey('id_supplier');
        $this->forge->createTable('supplier', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('supplier', true);
    }
}
