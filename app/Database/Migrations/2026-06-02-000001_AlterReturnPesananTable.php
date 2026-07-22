<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterReturnPesananTable extends Migration
{
    public function up(): void
    {
        $fields = [
            'jenis_masalah' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'salah_ukuran',
                    'salah_warna',
                    'teks_gambar_tidak_sesuai',
                    'hasil_rusak_cacat',
                    'lainnya',
                ],
                'after' => 'alasan',
                'null'  => true,
            ],
            'tipe_revisi' => [
                'type'       => 'ENUM',
                'constraint' => ['cetak_ulang', 'revisi_desain'],
                'after'      => 'jenis_masalah',
                'null'       => true,
            ],
            'biaya_tambahan' => [
                'type'    => 'DOUBLE',
                'after'   => 'tipe_revisi',
                'default' => 0,
                'null'    => true,
            ],
        ];

        $this->forge->addColumn('return_pesanan', $fields);

        $this->db->query("ALTER TABLE `return_pesanan` MODIFY `status_return` ENUM(
            'menunggu_verifikasi',
            'verifikasi_disetujui',
            'verifikasi_ditolak',
            'proses_cetak_ulang',
            'revisi_desain',
            'selesai'
        ) NOT NULL DEFAULT 'menunggu_verifikasi'");
    }

    public function down(): void
    {
        $this->forge->dropColumn('return_pesanan', ['jenis_masalah', 'tipe_revisi', 'biaya_tambahan']);

        $this->db->query("ALTER TABLE `return_pesanan` MODIFY `status_return` ENUM(
            'menunggu', 'diproses', 'diterima', 'ditolak'
        ) NOT NULL DEFAULT 'menunggu'");
    }
}
