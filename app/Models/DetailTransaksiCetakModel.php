<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiCetakModel extends Model
{
    protected $table      = 'detail_transaksi_cetak';
    protected $primaryKey = 'id_detail';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_transaksi',
        'kode_layanan',
        'nama_produk',
        'panjang',
        'lebar',
        'qty',
        'harga_satuan',
        'subtotal',
        'desain_sendiri',
        'keterangan',
    ];

    protected $useTimestamps = false;

    public function getByNoTransaksi(string $noTransaksi): array
    {
        return $this->select('detail_transaksi_cetak.*, layanan.nama_layanan, kategori.nama_kategori')
                    ->join('layanan', 'layanan.kode_layanan = detail_transaksi_cetak.kode_layanan', 'left')
                    ->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left')
                    ->where('detail_transaksi_cetak.no_transaksi', $noTransaksi)
                    ->findAll();
    }

    public function deleteByNoTransaksi(string $noTransaksi): bool
    {
        return $this->where('no_transaksi', $noTransaksi)->delete();
    }

    /**
     * Laporan bahan terpakai dari transaksi cetak per periode
     */
    public function getBahanTerpakaiByPeriode(string $dari, string $sampai): array
    {
        return $this->db->query("
            SELECT
                b.id_bahan,
                b.nama_bahan,
                b.satuan,
                SUM(
                    CASE
                        WHEN l.tipe_harga = 'per_meter' THEN CEIL(dtc.panjang * dtc.lebar * dtc.qty)
                        ELSE dtc.qty
                    END
                ) AS total_terpakai,
                COUNT(DISTINCT dtc.no_transaksi) AS total_transaksi
            FROM detail_transaksi_cetak dtc
            JOIN transaksi_cetak tc ON tc.no_transaksi = dtc.no_transaksi
            JOIN layanan l ON l.kode_layanan = dtc.kode_layanan
            JOIN bahan b ON b.id_bahan = l.id_bahan
            WHERE tc.tgl_transaksi >= ? AND tc.tgl_transaksi <= ?
            GROUP BY b.id_bahan, b.nama_bahan, b.satuan
            ORDER BY total_terpakai DESC
        ", [$dari, $sampai])->getResultArray();
    }
}
