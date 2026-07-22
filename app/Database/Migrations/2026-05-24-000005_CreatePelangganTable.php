<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelangganTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_pelanggan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'nama_pelanggan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
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
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_pelanggan');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pelanggan', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('pelanggan', true);
    }
}
