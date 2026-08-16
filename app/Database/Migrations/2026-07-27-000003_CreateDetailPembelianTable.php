<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailPembelianTable extends Migration
{
    public function up(): void
    {
        if (!$this->db->tableExists('detail_pembelian')) {
            $this->forge->addField([
                'id_detail' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'id_pembelian' => [
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
                'subtotal' => [
                    'type' => 'DOUBLE',
                ],
            ]);

            $this->forge->addKey('id_detail', true);
            $this->forge->addForeignKey('id_pembelian', 'pembelian', 'id_pembelian', 'CASCADE', 'RESTRICT');
            $this->forge->addForeignKey('id_bahan', 'bahan', 'id_bahan', 'CASCADE', 'RESTRICT');
            $this->forge->createTable('detail_pembelian');
        }
    }

    public function down(): void
    {
        $this->forge->dropTable('detail_pembelian', true);
    }
}
