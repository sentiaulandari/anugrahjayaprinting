<?php

namespace App\Services;

use App\Models\LayananModel;
use App\Models\BahanModel;
use App\Models\DetailPesananModel;

class StokService
{
    protected LayananModel $layananModel;
    protected BahanModel $bahanModel;
    protected DetailPesananModel $detailModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        $this->bahanModel   = new BahanModel();
        $this->detailModel  = new DetailPesananModel();
    }

    public function kurangiStokDariPesanan(string $noPesanan): void
    {
        $details = $this->detailModel->getByNoPesanan($noPesanan);

        foreach ($details as $detail) {
            $layanan = $this->layananModel->find($detail['kode_layanan']);
            if (!$layanan || empty($layanan['id_bahan'])) {
                continue;
            }

            $tipeHarga = $layanan['tipe_harga'] ?? 'per_pcs';
            $jumlah    = $this->hitungKebutuhanStok($detail, $tipeHarga);

            if ($jumlah > 0) {
                $this->bahanModel->kurangiStok(
                    (int) $layanan['id_bahan'],
                    $jumlah
                );
            }
        }
    }

    public function kembalikanStokDariPesanan(string $noPesanan): void
    {
        $details = $this->detailModel->getByNoPesanan($noPesanan);

        foreach ($details as $detail) {
            $layanan = $this->layananModel->find($detail['kode_layanan']);
            if (!$layanan || empty($layanan['id_bahan'])) {
                continue;
            }

            $tipeHarga = $layanan['tipe_harga'] ?? 'per_pcs';
            $jumlah    = $this->hitungKebutuhanStok($detail, $tipeHarga);

            if ($jumlah > 0) {
                $this->bahanModel->tambahStok(
                    (int) $layanan['id_bahan'],
                    $jumlah
                );
            }
        }
    }

    private function hitungKebutuhanStok(array $detail, string $tipeHarga): int
    {
        $qty = (int) $detail['qty'];

        switch ($tipeHarga) {
            case 'per_meter':
                $panjang = (float) ($detail['panjang'] ?? 0);
                $lebar   = (float) ($detail['lebar'] ?? 0);
                if ($panjang > 0 && $lebar > 0) {
                    return (int) ceil($panjang * $lebar * $qty);
                }
                return $qty;

            case 'per_lembar':
            case 'per_set':
            case 'per_buku':
                return $qty;

            case 'per_pcs':
            case 'per_huruf':
            default:
                return $qty;
        }
    }
}
