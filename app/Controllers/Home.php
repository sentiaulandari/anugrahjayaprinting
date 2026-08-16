<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\KategoriModel;

class Home extends BaseController
{
    public function index(): string
    {
        $layananModel  = new LayananModel();
        $kategoriModel = new KategoriModel();

        $layananData = $layananModel->getAktif();

        // Kumpulkan kategori unik dari layanan yang aktif
        $kategoriUnik = [];
        foreach ($layananData as $l) {
            if (!empty($l['nama_kategori']) && !in_array($l['nama_kategori'], $kategoriUnik)) {
                $kategoriUnik[] = $l['nama_kategori'];
            }
        }
        sort($kategoriUnik);

        $data = [
            'title'    => 'Anugrah Jaya Digital Printing',
            'layanan'  => $layananData,
            'kategori' => $kategoriUnik,
        ];

        return view('landing/index', $data);
    }
}
