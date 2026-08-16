<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNoFakturToPembelian extends Migration
{
    public function up(): void
    {
        if (!$this->db->fieldExists('no_faktur', 'pembelian')) {
            $this->forge->addColumn('pembelian', [
                'no_faktur' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => true,
                    'after'      => 'id_pembelian',
                ],
            ]);
        }

        $this->db->query("UPDATE `pembelian` SET `no_faktur` = CONCAT('FB-', DATE_FORMAT(`tgl_pembelian`, '%Y%m%d'), '-001') WHERE `no_faktur` IS NULL");
    }

    public function down(): void
    {
        if ($this->db->fieldExists('no_faktur', 'pembelian')) {
            $this->forge->dropColumn('pembelian', 'no_faktur');
        }
    }
}
