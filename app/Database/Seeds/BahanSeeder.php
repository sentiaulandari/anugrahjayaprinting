<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BahanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_bahan'   => 'Flexi China 280gr',
                'satuan'       => 'meter',
                'stok'         => 500,
                'stok_minimum' => 50,
                'keterangan'   => 'Bahan spanduk outdoor standar',
            ],
            [
                'nama_bahan'   => 'Flexi Korea 340gr',
                'satuan'       => 'meter',
                'stok'         => 300,
                'stok_minimum' => 30,
                'keterangan'   => 'Bahan spanduk outdoor premium',
            ],
            [
                'nama_bahan'   => 'Albatros',
                'satuan'       => 'meter',
                'stok'         => 200,
                'stok_minimum' => 20,
                'keterangan'   => 'Bahan baliho dan umbul-umbul',
            ],
            [
                'nama_bahan'   => 'One Way Vision',
                'satuan'       => 'meter',
                'stok'         => 100,
                'stok_minimum' => 10,
                'keterangan'   => 'Bahan stiker kaca satu arah',
            ],
            [
                'nama_bahan'   => 'Stiker Vinyl',
                'satuan'       => 'meter',
                'stok'         => 200,
                'stok_minimum' => 20,
                'keterangan'   => 'Bahan stiker cutting dan print',
            ],
            [
                'nama_bahan'   => 'Art Paper 100gr',
                'satuan'       => 'lembar',
                'stok'         => 2000,
                'stok_minimum' => 200,
                'keterangan'   => 'Kertas brosur dan flyer',
            ],
            [
                'nama_bahan'   => 'Art Carton 260gr',
                'satuan'       => 'lembar',
                'stok'         => 1000,
                'stok_minimum' => 100,
                'keterangan'   => 'Kertas kartu nama dan ID card',
            ],
            [
                'nama_bahan'   => 'Kertas HVS 80gr',
                'satuan'       => 'lembar',
                'stok'         => 5000,
                'stok_minimum' => 500,
                'keterangan'   => 'Kertas faktur dan label',
            ],
            [
                'nama_bahan'   => 'Kertas Foto Glossy',
                'satuan'       => 'lembar',
                'stok'         => 500,
                'stok_minimum' => 50,
                'keterangan'   => 'Kertas foto untuk piagam dan plakat',
            ],
            [
                'nama_bahan'   => 'Kain Parasut',
                'satuan'       => 'meter',
                'stok'         => 150,
                'stok_minimum' => 15,
                'keterangan'   => 'Bahan umbul-umbul dan Y banner',
            ],
            [
                'nama_bahan'   => 'Mug Polos Putih',
                'satuan'       => 'pcs',
                'stok'         => 100,
                'stok_minimum' => 10,
                'keterangan'   => 'Mug untuk cetak sublimasi',
            ],
            [
                'nama_bahan'   => 'PIN Polos',
                'satuan'       => 'pcs',
                'stok'         => 500,
                'stok_minimum' => 50,
                'keterangan'   => 'PIN kosong untuk cetak',
            ],
            [
                'nama_bahan'   => 'Gantungan Kunci Akrilik',
                'satuan'       => 'pcs',
                'stok'         => 300,
                'stok_minimum' => 30,
                'keterangan'   => 'Gantungan kunci bahan akrilik',
            ],
            [
                'nama_bahan'   => 'Akrilik 3mm',
                'satuan'       => 'lembar',
                'stok'         => 50,
                'stok_minimum' => 5,
                'keterangan'   => 'Bahan plakat dan neon box',
            ],
            [
                'nama_bahan'   => 'Tinta Solvent',
                'satuan'       => 'liter',
                'stok'         => 20,
                'stok_minimum' => 5,
                'keterangan'   => 'Tinta printer outdoor',
            ],
            [
                'nama_bahan'   => 'Tinta Sublimasi',
                'satuan'       => 'liter',
                'stok'         => 10,
                'stok_minimum' => 3,
                'keterangan'   => 'Tinta untuk cetak mug dan PIN',
            ],
        ];

        foreach ($data as $item) {
            $exists = $this->db->table('bahan')
                ->where('nama_bahan', $item['nama_bahan'])
                ->get()->getRow();
            if (!$exists) {
                $this->db->table('bahan')->insert($item);
            }
        }
    }
}
