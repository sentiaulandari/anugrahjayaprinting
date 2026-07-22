<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLayananTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'kode_layanan' => [
                'type'       => 'CHAR',
                'constraint' => 10,
            ],
            'nama_layanan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'id_kategori' => [
                'type'     => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null'     => true,
            ],
            'id_bahan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'harga_satuan' => [
                'type' => 'DOUBLE',
                'default' => 0,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'nonaktif'],
                'default'    => 'aktif',
            ],
        ]);

        $this->forge->addPrimaryKey('kode_layanan');
        $this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_bahan', 'bahan', 'id_bahan', 'SET NULL', 'CASCADE');
        $this->forge->createTable('layanan', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('layanan', true);
    }
}
