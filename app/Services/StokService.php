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

            $this->bahanModel->kurangiStok(
                (int) $layanan['id_bahan'],
                (int) $detail['qty']
            );
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

            $this->bahanModel->tambahStok(
                (int) $layanan['id_bahan'],
                (int) $detail['qty']
            );
        }
    }
}
