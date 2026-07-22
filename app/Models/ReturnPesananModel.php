<?php

namespace App\Models;

use CodeIgniter\Model;

class ReturnPesananModel extends Model
{
    protected $table      = 'return_pesanan';
    protected $primaryKey = 'id_return';
    protected $returnType = 'array';

    protected $allowedFields = [
        'no_pesanan',
        'id_pelanggan',
        'tgl_return',
        'alasan',
        'jenis_masalah',
        'tipe_revisi',
        'biaya_tambahan',
        'foto_bukti',
        'status_return',
        'catatan_admin',
        'created_at',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'no_pesanan'    => 'required|max_length[20]',
        'id_pelanggan'  => 'required|integer',
        'alasan'        => 'required|min_length[10]',
        'jenis_masalah' => 'required|in_list[salah_ukuran,salah_warna,teks_gambar_tidak_sesuai,hasil_rusak_cacat,lainnya]',
    ];

    public static function labelJenisMasalah(): array
    {
        return [
            'salah_ukuran'             => 'Salah Ukuran Cetak',
            'salah_warna'              => 'Salah Warna Cetak',
            'teks_gambar_tidak_sesuai' => 'Teks / Gambar Tidak Sesuai Desain',
            'hasil_rusak_cacat'        => 'Hasil Cetak Rusak / Cacat',
            'lainnya'                  => 'Lainnya',
        ];
    }

    public static function labelStatus(): array
    {
        return [
            'menunggu_verifikasi'  => 'Menunggu Verifikasi',
            'verifikasi_disetujui' => 'Retur Disetujui',
            'verifikasi_ditolak'   => 'Retur Ditolak',
            'proses_cetak_ulang'   => 'Proses Cetak Ulang',
            'revisi_desain'        => 'Revisi Desain',
            'selesai'              => 'Selesai',
        ];
    }

    public static function labelTipeRevisi(): array
    {
        return [
            'cetak_ulang'   => 'Cetak Ulang (Tanpa Biaya Tambahan)',
            'revisi_desain' => 'Revisi Desain (Biaya Tambahan)',
        ];
    }

    public function getWithPesanan(): array
    {
        return $this->select('return_pesanan.*, pesanan.total_harga, pesanan.tgl_pesanan, pelanggan.nama_pelanggan, pelanggan.no_hp')
                    ->join('pesanan', 'pesanan.no_pesanan = return_pesanan.no_pesanan', 'left')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = return_pesanan.id_pelanggan', 'left')
                    ->orderBy('return_pesanan.created_at', 'DESC')
                    ->findAll();
    }

    public function getDetailById(int $id): array|null
    {
        return $this->select('return_pesanan.*, pesanan.total_harga, pesanan.tgl_pesanan, pesanan.status_pesanan, pelanggan.nama_pelanggan, pelanggan.no_hp, pelanggan.email')
                    ->join('pesanan', 'pesanan.no_pesanan = return_pesanan.no_pesanan', 'left')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = return_pesanan.id_pelanggan', 'left')
                    ->where('return_pesanan.id_return', $id)
                    ->first();
    }

    public function getByPelanggan(int $idPelanggan): array
    {
        return $this->select('return_pesanan.*, pesanan.total_harga, pesanan.tgl_pesanan')
                    ->join('pesanan', 'pesanan.no_pesanan = return_pesanan.no_pesanan', 'left')
                    ->where('return_pesanan.id_pelanggan', $idPelanggan)
                    ->orderBy('return_pesanan.created_at', 'DESC')
                    ->findAll();
    }

    public function getByNoPesanan(string $noPesanan): array|null
    {
        return $this->where('no_pesanan', $noPesanan)
                    ->orderBy('created_at', 'DESC')
                    ->first();
    }

    public function countByStatus(): array
    {
        $result = [];
        foreach (array_keys(self::labelStatus()) as $status) {
            $result[$status] = $this->where('status_return', $status)->countAllResults();
        }
        return $result;
    }
}
