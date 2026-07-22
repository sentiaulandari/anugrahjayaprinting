<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Dashboard</h4>
        <div class="d-flex align-items-center gap-2 mt-1">
            <span class="text-muted small">Selamat datang,</span>
            <span class="fw-semibold small" style="color:#1a1a2e;"><?= session('nama_lengkap') ?></span>
            <span class="badge" style="background:rgba(40,167,69,0.1);color:#28a745;font-size:0.65rem;">
                <i class="bi bi-circle-fill me-1" style="font-size:0.4rem;"></i><?= ucfirst(session('level')) ?>
            </span>
        </div>
    </div>
    <div class="text-end">
        <div class="small fw-semibold" style="color:#1a1a2e;"><?= date('d F Y') ?></div>
        <div class="small text-muted"><?= date('H:i') ?> WIB</div>
    </div>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-widget sw-blue h-100">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-cart3"></i></div>
                <span class="badge" style="background:rgba(255,255,255,0.15);color:#fff;font-size:0.65rem;">Total</span>
            </div>
            <div class="stat-value"><?= $totalPesanan ?></div>
            <div class="stat-label">Total Pesanan</div>
            <div class="stat-change mt-2">
                <i class="bi bi-arrow-up-right me-1"></i><?= $statusPesanan['diproses'] ?? 0 ?> sedang diproses
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-widget sw-green h-100">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-people"></i></div>
                <span class="badge" style="background:rgba(255,255,255,0.15);color:#fff;font-size:0.65rem;">Aktif</span>
            </div>
            <div class="stat-value"><?= $totalPelanggan ?></div>
            <div class="stat-label">Total Pelanggan</div>
            <div class="stat-change mt-2">
                <i class="bi bi-person-check me-1"></i>Terdaftar di sistem
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-widget sw-yellow h-100">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
                <span class="badge" style="background:rgba(255,255,255,0.15);color:#fff;font-size:0.65rem;">Pending</span>
            </div>
            <div class="stat-value"><?= $statusPesanan['menunggu'] ?? 0 ?></div>
            <div class="stat-label">Menunggu Konfirmasi</div>
            <div class="stat-change mt-2">
                <i class="bi bi-clock me-1"></i><?= count($menungguKonfirmasi) ?> pembayaran pending
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-widget sw-teal h-100">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
                <span class="badge" style="background:rgba(255,255,255,0.15);color:#fff;font-size:0.65rem;">Bulan Ini</span>
            </div>
            <div class="stat-value" style="font-size:1.3rem;">
                Rp <?= number_format($totalPendapatan / 1000, 0, ',', '.') ?>K
            </div>
            <div class="stat-label">Pendapatan</div>
            <div class="stat-change mt-2">
                <i class="bi bi-calendar3 me-1"></i><?= date('F Y') ?>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body py-3">
                <div class="row g-3 text-center">
                    <?php
                    $statusItems = [
                        ['key' => 'menunggu',   'label' => 'Menunggu',   'color' => '#ffc107', 'bg' => 'rgba(255,193,7,0.1)',   'icon' => 'bi-hourglass'],
                        ['key' => 'diproses',   'label' => 'Diproses',   'color' => '#0dcaf0', 'bg' => 'rgba(13,202,240,0.1)',  'icon' => 'bi-gear'],
                        ['key' => 'selesai',    'label' => 'Selesai',    'color' => '#28a745', 'bg' => 'rgba(40,167,69,0.1)',   'icon' => 'bi-check-circle'],
                        ['key' => 'dibatalkan', 'label' => 'Dibatalkan', 'color' => '#dc3545', 'bg' => 'rgba(220,53,69,0.1)',   'icon' => 'bi-x-circle'],
                    ];
                    ?>
                    <?php foreach ($statusItems as $si): ?>
                    <div class="col-6 col-md-3">
                        <a href="<?= base_url('admin/pesanan') ?>" class="text-decoration-none">
                            <div class="d-flex align-items-center gap-3 p-2 rounded-3" style="background:<?= $si['bg'] ?>;">
                                <div style="width:40px;height:40px;background:<?= $si['bg'] ?>;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi <?= $si['icon'] ?>" style="color:<?= $si['color'] ?>;font-size:1.1rem;"></i>
                                </div>
                                <div class="text-start">
                                    <div style="font-size:1.4rem;font-weight:800;color:<?= $si['color'] ?>;line-height:1;">
                                        <?= $statusPesanan[$si['key']] ?? 0 ?>
                                    </div>
                                    <div style="font-size:0.72rem;color:#6c757d;font-weight:500;"><?= $si['label'] ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:8px;height:8px;background:#1a1a2e;border-radius:50%;"></div>
                    <span>Pesanan Terbaru</span>
                </div>
                <a href="<?= base_url('admin/pesanan') ?>" class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pesananTerbaru)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="bi bi-inbox fs-2 text-muted d-block mb-2"></i>
                                        <span class="text-muted small">Belum ada pesanan</span>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach (array_slice($pesananTerbaru, 0, 7) as $p): ?>
                                <tr>
                                    <td>
                                        <a href="<?= base_url('admin/pesanan/show/' . $p['no_pesanan']) ?>"
                                            class="fw-semibold text-decoration-none" style="color:#1a1a2e;font-size:0.82rem;">
                                            <?= $p['no_pesanan'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:28px;height:28px;background:linear-gradient(135deg,#1a1a2e,#0f3460);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#ffc107;font-size:0.65rem;font-weight:700;flex-shrink:0;">
                                                <?= strtoupper(substr($p['nama_pelanggan'] ?? 'U', 0, 1)) ?>
                                            </div>
                                            <span style="font-size:0.85rem;"><?= $p['nama_pelanggan'] ?? '-' ?></span>
                                        </div>
                                    </td>
                                    <td style="font-size:0.82rem;color:#6c757d;"><?= date('d/m/Y', strtotime($p['tgl_pesanan'])) ?></td>
                                    <td style="font-size:0.85rem;font-weight:600;">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= view('layouts/partials/badge_status', ['status' => $p['status_pesanan']]) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:8px;height:8px;background:#ffc107;border-radius:50%;"></div>
                    <span>Pembayaran Pending</span>
                </div>
                <?php if (!empty($menungguKonfirmasi)): ?>
                <span class="badge bg-warning text-dark"><?= count($menungguKonfirmasi) ?></span>
                <?php endif; ?>
            </div>
            <div class="card-body p-0">
                <?php if (empty($menungguKonfirmasi)): ?>
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle fs-2 text-success d-block mb-2"></i>
                        <span class="text-muted small">Semua pembayaran sudah dikonfirmasi</span>
                    </div>
                <?php else: ?>
                    <?php foreach (array_slice($menungguKonfirmasi, 0, 6) as $m): ?>
                    <div class="d-flex align-items-center justify-content-between px-3 py-2" style="border-bottom:1px solid rgba(0,0,0,0.04);">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:8px;height:8px;background:#ffc107;border-radius:50%;flex-shrink:0;"></div>
                            <div>
                                <div style="font-size:0.82rem;font-weight:600;"><?= $m['nama_pelanggan'] ?? '-' ?></div>
                                <div style="font-size:0.72rem;color:#9ca3af;"><?= $m['no_pesanan'] ?></div>
                            </div>
                        </div>
                        <a href="<?= base_url('admin/pembayaran/show/' . $m['id_pembayaran']) ?>"
                            class="btn btn-sm" style="background:rgba(255,193,7,0.1);color:#b8860b;border:none;font-size:0.72rem;padding:0.25rem 0.6rem;border-radius:8px;">
                            Cek
                        </a>
                    </div>
                    <?php endforeach; ?>
                    <div class="p-2">
                        <a href="<?= base_url('admin/pembayaran') ?>" class="btn btn-sm w-100" style="background:rgba(26,26,46,0.05);color:#1a1a2e;border:none;font-size:0.78rem;">
                            Lihat Semua Pembayaran
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($stokMenurun)): ?>
<div class="card" style="border:1px solid rgba(220,53,69,0.2);">
    <div class="card-header d-flex align-items-center gap-2" style="background:rgba(220,53,69,0.04);">
        <div style="width:8px;height:8px;background:#dc3545;border-radius:50%;animation:pulse 1.5s infinite;"></div>
        <span style="color:#dc3545;font-weight:600;">Peringatan Stok Menipis</span>
        <span class="badge bg-danger ms-auto"><?= count($stokMenurun) ?> bahan</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th>Nama Bahan</th>
                        <th>Satuan</th>
                        <th>Stok Saat Ini</th>
                        <th>Min. Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stokMenurun as $b): ?>
                    <tr>
                        <td class="fw-semibold"><?= $b['nama_bahan'] ?></td>
                        <td><?= $b['satuan'] ?></td>
                        <td><span class="badge bg-danger"><?= $b['stok'] ?></span></td>
                        <td><span class="text-muted"><?= $b['stok_minimum'] ?></span></td>
                        <td>
                            <a href="<?= base_url('admin/bahan/edit/' . $b['id_bahan']) ?>"
                                class="btn btn-sm" style="background:rgba(220,53,69,0.1);color:#dc3545;border:none;font-size:0.72rem;padding:0.2rem 0.6rem;border-radius:6px;">
                                Update Stok
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}
</style>
<?= $this->endSection() ?>
