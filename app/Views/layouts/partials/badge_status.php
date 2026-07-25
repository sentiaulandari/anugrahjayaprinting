<?php
$map = [
    'menunggu'      => 'warning',
    'diproses'      => 'info',
    'selesai'       => 'success',
    'dibatalkan'    => 'danger',
    'belum bayar'   => 'secondary',
    'sudah bayar'   => 'success',
    'diterima'      => 'success',
    'ditolak'       => 'danger',
    'aktif'         => 'success',
    'nonaktif'      => 'secondary',
];

$color = $map[$status] ?? 'secondary';
$label = ucfirst(str_replace('_', ' ', $status));

echo '<span class="badge bg-' . $color . '">' . $label . '</span>';
