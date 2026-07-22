<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReturnPesananTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_return' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_pesanan' => [
                'type'       => 'CHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'id_pelanggan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'tgl_return' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'alasan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'foto_bukti' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'status_return' => [
                'type'       => 'ENUM',
                'constraint' => ['menunggu', 'diproses', 'diterima', 'ditolak'],
                'default'    => 'menunggu',
            ],
            'catatan_admin' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_return');
        $this->forge->addForeignKey('no_pesanan', 'pesanan', 'no_pesanan', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'SET NULL', 'CASCADE');
        $this->forge->createTable('return_pesanan', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('return_pesanan', true);
    }
}
