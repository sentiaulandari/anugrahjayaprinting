<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePesananTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'no_pesanan' => [
                'type'       => 'CHAR',
                'constraint' => 20,
            ],
            'id_pelanggan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'tgl_pesanan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tgl_selesai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'total_harga' => [
                'type'    => 'DOUBLE',
                'default' => 0,
            ],
            'status_pesanan' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => 'menunggu',
            ],
            'status_bayar' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'belum bayar',
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

        $this->forge->addPrimaryKey('no_pesanan');
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pesanan', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('pesanan', true);
    }
}
