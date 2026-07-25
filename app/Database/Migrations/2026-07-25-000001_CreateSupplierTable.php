<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupplierTable extends Migration
{
    public function up()
    {
        if (!$this->db->tableExists('supplier')) {
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
                'nama_produk' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => true,
                ],
                'created_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => true,
                ],
            ]);

            $this->forge->addKey('id_supplier', true);
            $this->forge->createTable('supplier');
        }
    }

    public function down()
    {
        $this->forge->dropTable('supplier');
    }
}
