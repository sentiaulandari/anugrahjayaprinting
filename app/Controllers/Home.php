<?php

namespace App\Controllers;

use App\Models\LayananModel;

class Home extends BaseController
{
    public function index(): string
    {
        $layananModel = new LayananModel();

        $data = [
            'title'   => 'Anugrah Jaya Digital Printing',
            'layanan' => $layananModel->getAktif(),
        ];

        return view('landing/index', $data);
    }
}
