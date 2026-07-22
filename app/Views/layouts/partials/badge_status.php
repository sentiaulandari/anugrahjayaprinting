<?php
$map = [
    'menunggu'             => 'warning',
    'diproses'             => 'info',
    'selesai'              => 'success',
    'dibatalkan'           => 'danger',
    'belum bayar'          => 'secondary',
    'sudah bayar'          => 'success',
    'diterima'             => 'success',
    'ditolak'              => 'danger',
    'aktif'                => 'success',
    'nonaktif'             => 'secondary',
    'menunggu_verifikasi'  => 'warning',
    'verifikasi_disetujui' => 'primary',
    'verifikasi_ditolak'   => 'danger',
    'proses_cetak_ulang'   => 'info',
    'revisi_desain'        => 'purple',
];

$labelMap = [
    'menunggu_verifikasi'  => 'Menunggu Verifikasi',
    'verifikasi_disetujui' => 'Retur Disetujui',
    'verifikasi_ditolak'   => 'Retur Ditolak',
    'proses_cetak_ulang'   => 'Proses Cetak Ulang',
    'revisi_desain'        => 'Revisi Desain',
];

$color = $map[$status] ?? 'secondary';
$label = $labelMap[$status] ?? ucfirst(str_replace('_', ' ', $status));

if ($color === 'purple') {
    echo '<span class="badge" style="background:#6f42c1;">' . $label . '</span>';
} else {
    echo '<span class="badge bg-' . $color . '">' . $label . '</span>';
}
