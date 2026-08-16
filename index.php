<?php

/**
 * ------------------------------------------------------------
 * ROOT index.php — untuk shared hosting
 * ------------------------------------------------------------
 * File ini digunakan ketika document root hosting mengarah ke
 * root project (bukan ke /public).
 *
 * Semua request diteruskan ke public/index.php
 * ------------------------------------------------------------
 */

// Redirect semua ke folder public
// Ini hanya fallback — gunakan .htaccess di bawah sebagai solusi utama

chdir(__DIR__ . '/public');
define('FCPATH', __DIR__ . '/public/');

require __DIR__ . '/app/Config/Paths.php';

use Config\Paths;
use CodeIgniter\Boot;

$paths = new Paths();

require $paths->systemDirectory . '/Boot.php';

exit(Boot::bootWeb($paths));
