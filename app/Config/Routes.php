<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');

$routes->get('admin', function() {
    return redirect()->to('/admin/dashboard');
});

$routes->get('pelanggan', function() {
    return redirect()->to('/pelanggan/dashboard');
});

$routes->group('auth', function ($routes) {
    $routes->get('login',     'Auth\AuthController::login');
    $routes->post('login',    'Auth\AuthController::loginProcess');
    $routes->get('register',  'Auth\AuthController::register');
    $routes->post('register', 'Auth\AuthController::registerProcess');
    $routes->get('logout',    'Auth\AuthController::logout');
});

$routes->group('admin', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');

    $routes->get('layanan',                   'Admin\LayananController::index');
    $routes->get('layanan/create',            'Admin\LayananController::create');
    $routes->post('layanan/store',            'Admin\LayananController::store');
    $routes->get('layanan/edit/(:any)',       'Admin\LayananController::edit/$1');
    $routes->post('layanan/update/(:any)',    'Admin\LayananController::update/$1');
    $routes->get('layanan/delete/(:any)',     'Admin\LayananController::delete/$1');

    $routes->get('bahan',                    'Admin\BahanController::index');
    $routes->get('bahan/create',             'Admin\BahanController::create');
    $routes->post('bahan/store',             'Admin\BahanController::store');
    $routes->get('bahan/edit/(:num)',        'Admin\BahanController::edit/$1');
    $routes->post('bahan/update/(:num)',     'Admin\BahanController::update/$1');
    $routes->get('bahan/delete/(:num)',      'Admin\BahanController::delete/$1');

    $routes->get('pelanggan',                'Admin\PelangganController::index');
    $routes->get('pelanggan/create',         'Admin\PelangganController::create');
    $routes->post('pelanggan/store',         'Admin\PelangganController::store');
    $routes->get('pelanggan/show/(:num)',    'Admin\PelangganController::show/$1');
    $routes->get('pelanggan/edit/(:num)',    'Admin\PelangganController::edit/$1');
    $routes->post('pelanggan/update/(:num)', 'Admin\PelangganController::update/$1');
    $routes->get('pelanggan/delete/(:num)',  'Admin\PelangganController::delete/$1');

    $routes->get('pelanggan/search',         'Admin\PelangganController::search');

    $routes->get('pesanan',                  'Admin\PesananController::index');
    $routes->get('pesanan/create',           'Admin\PesananController::create');
    $routes->post('pesanan/store',           'Admin\PesananController::store');
    $routes->get('pesanan/show/(:any)',      'Admin\PesananController::show/$1');
    $routes->get('pesanan/edit/(:any)',      'Admin\PesananController::edit/$1');
    $routes->post('pesanan/update/(:any)',   'Admin\PesananController::update/$1');
    $routes->post('pesanan/status/(:any)',   'Admin\PesananController::updateStatus/$1');
    $routes->get('pesanan/delete/(:any)',    'Admin\PesananController::delete/$1');
    $routes->get('pesanan/cetak/(:any)',     'Admin\PesananController::cetakFaktur/$1');

    $routes->get('pembayaran',                   'Admin\PembayaranController::index');
    $routes->get('pembayaran/show/(:num)',        'Admin\PembayaranController::show/$1');
    $routes->post('pembayaran/konfirmasi/(:num)', 'Admin\PembayaranController::konfirmasi/$1');

    $routes->get('transaksi-cetak',                      'Admin\TransaksiCetakController::index');
    $routes->get('transaksi-cetak/create',               'Admin\TransaksiCetakController::create');
    $routes->post('transaksi-cetak/store',               'Admin\TransaksiCetakController::store');
    $routes->get('transaksi-cetak/show/(:any)',          'Admin\TransaksiCetakController::show/$1');
    $routes->get('transaksi-cetak/cetak/(:any)',         'Admin\TransaksiCetakController::cetakFaktur/$1');
    $routes->get('transaksi-cetak/delete/(:any)',        'Admin\TransaksiCetakController::delete/$1');

    $routes->get('laporan',                'Admin\LaporanController::index');
    $routes->get('laporan/pesanan',        'Admin\LaporanController::pesanan');
    $routes->get('laporan/bahan',          'Admin\LaporanController::bahan');
    $routes->get('laporan/keuangan',       'Admin\LaporanController::keuangan');
    $routes->get('laporan/pertahun',       'Admin\LaporanController::pertahun');
    $routes->get('laporan/pertahun/detail','Admin\LaporanController::pertahunDetail');
    $routes->get('laporan/bahan-terpakai', 'Admin\LaporanController::bahanTerpakai');
    $routes->get('laporan/supplier',       'Admin\LaporanController::supplier');
    $routes->get('laporan/konsumen',       'Admin\LaporanController::konsumen');
    $routes->get('laporan/cetak/pesanan',        'Admin\LaporanController::cetakPesanan');
    $routes->get('laporan/cetak/bahan',          'Admin\LaporanController::cetakBahan');
    $routes->get('laporan/cetak/keuangan',       'Admin\LaporanController::cetakKeuangan');
    $routes->get('laporan/cetak/pertahun',       'Admin\LaporanController::cetakPertahun');
    $routes->get('laporan/cetak/bahan-terpakai', 'Admin\LaporanController::cetakBahanTerpakai');
    $routes->get('laporan/cetak/supplier',       'Admin\LaporanController::cetakSupplier');
    $routes->get('laporan/cetak/konsumen',       'Admin\LaporanController::cetakKonsumen');

    $routes->get('supplier',                'Admin\SupplierController::index');
    $routes->get('supplier/create',         'Admin\SupplierController::create');
    $routes->post('supplier/store',         'Admin\SupplierController::store');
    $routes->get('supplier/edit/(:num)',    'Admin\SupplierController::edit/$1');
    $routes->post('supplier/update/(:num)', 'Admin\SupplierController::update/$1');
    $routes->get('supplier/delete/(:num)',  'Admin\SupplierController::delete/$1');

    $routes->get('pembelian',               'Admin\PembelianController::index');
    $routes->get('pembelian/create',        'Admin\PembelianController::create');
    $routes->post('pembelian/store',        'Admin\PembelianController::store');
    $routes->get('pembelian/show/(:num)',   'Admin\PembelianController::show/$1');
    $routes->get('pembelian/delete/(:num)', 'Admin\PembelianController::delete/$1');


});

$routes->group('pelanggan', ['filter' => 'pelangganFilter'], function ($routes) {
    $routes->get('dashboard', 'Pelanggan\DashboardController::index');

    $routes->get('pesanan',             'Pelanggan\PesananController::index');
    $routes->get('pesanan/show/(:any)', 'Pelanggan\PesananController::show/$1');
    $routes->get('pesanan/create',      'Pelanggan\PesananController::create');
    $routes->post('pesanan/store',      'Pelanggan\PesananController::store');
    $routes->get('pesanan/cetak/(:any)','Pelanggan\PesananController::cetakFaktur/$1');

    $routes->get('pembayaran',              'Pelanggan\PembayaranController::index');
    $routes->get('pembayaran/form/(:any)', 'Pelanggan\PembayaranController::form/$1');
    $routes->post('pembayaran/store',       'Pelanggan\PembayaranController::store');

    $routes->get('status',               'Pelanggan\StatusController::index');
    $routes->get('status/detail/(:any)', 'Pelanggan\StatusController::detail/$1');
});

$routes->set404Override(function() {
    return view('errors/html/error_404');
});
