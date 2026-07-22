<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembayaranTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_pembayaran' => [
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
            'tgl_pembayaran' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jumlah_bayar' => [
                'type'    => 'DOUBLE',
                'default' => 0,
            ],
            'metode_bayar' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'bukti_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'status_konfirmasi' => [
                'type'       => 'ENUM',
                'constraint' => ['menunggu', 'diterima', 'ditolak'],
                'default'    => 'menunggu',
            ],
            'catatan_admin' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_pembayaran');
        $this->forge->addForeignKey('no_pesanan', 'pesanan', 'no_pesanan', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pembayaran', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('pembayaran', true);
    }
}
