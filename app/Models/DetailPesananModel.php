<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPesananModel extends Model
{
    protected $table      = 'detail_pesanan';
    protected $primaryKey = 'id_detail';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_pesanan',
        'kode_layanan',
        'qty',
        'harga_satuan',
        'subtotal',
        'ukuran',
        'panjang',
        'lebar',
        'desain_sendiri',
        'file_desain',
        'keterangan',
    ];

    protected $useTimestamps = false;

    public function getByNoPesanan(string $noPesanan): array
    {
        return $this->select('detail_pesanan.*, layanan.nama_layanan, layanan.gambar, layanan.tipe_harga, kategori.nama_kategori')
                    ->join('layanan', 'layanan.kode_layanan = detail_pesanan.kode_layanan', 'left')
                    ->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left')
                    ->where('detail_pesanan.no_pesanan', $noPesanan)
                    ->findAll();
    }

    public function deleteByNoPesanan(string $noPesanan): bool
    {
        return $this->where('no_pesanan', $noPesanan)->delete();
    }

    public function hitungTotal(string $noPesanan): float
    {
        $result = $this->selectSum('subtotal')
                       ->where('no_pesanan', $noPesanan)
                       ->first();

        return (float) ($result['subtotal'] ?? 0);
    }

    /**
     * Laporan bahan terpakai dari pesanan per periode
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
                        WHEN l.tipe_harga = 'per_meter' THEN CEIL(dp.panjang * dp.lebar * dp.qty)
                        ELSE dp.qty
                    END
                ) AS total_terpakai,
                COUNT(DISTINCT dp.no_pesanan) AS total_pesanan
            FROM detail_pesanan dp
            JOIN pesanan p ON p.no_pesanan = dp.no_pesanan
            JOIN layanan l ON l.kode_layanan = dp.kode_layanan
            JOIN bahan b ON b.id_bahan = l.id_bahan
            WHERE p.tgl_pesanan >= ? AND p.tgl_pesanan <= ?
              AND p.status_pesanan NOT IN ('dibatalkan')
            GROUP BY b.id_bahan, b.nama_bahan, b.satuan
            ORDER BY total_terpakai DESC
        ", [$dari, $sampai])->getResultArray();
    }
}
