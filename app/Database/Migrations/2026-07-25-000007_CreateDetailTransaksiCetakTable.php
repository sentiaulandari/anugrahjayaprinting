<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailTransaksiCetakTable extends Migration
{
    public function up(): void
    {
        if (!$this->db->tableExists('detail_transaksi_cetak')) {
            $this->forge->addField([
                'id_detail' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'no_transaksi' => [
                    'type'       => 'CHAR',
                    'constraint' => 20,
                ],
                'kode_layanan' => [
                    'type'       => 'CHAR',
                    'constraint' => 10,
                    'null'       => true,
                ],
                'nama_produk' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                ],
                'panjang' => [
                    'type' => 'DOUBLE',
                    'null' => true,
                ],
                'lebar' => [
                    'type' => 'DOUBLE',
                    'null' => true,
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
                'desain_sendiri' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'default'    => 0,
                ],
                'keterangan' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
            ]);

            $this->forge->addKey('id_detail', true);
            $this->forge->addForeignKey('no_transaksi', 'transaksi_cetak', 'no_transaksi', 'CASCADE', 'RESTRICT');
            $this->forge->createTable('detail_transaksi_cetak');
        }
    }

    public function down(): void
    {
        $this->forge->dropTable('detail_transaksi_cetak');
    }
}
