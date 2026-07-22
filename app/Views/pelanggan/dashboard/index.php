<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<?= view('layouts/partials/alert') ?>

<div class="welcome-banner mb-4">
    <div class="row align-items-center position-relative" style="z-index:1;">
        <div class="col-md-8">
            <div style="font-size:0.75rem;color:rgba(255,255,255,0.5);letter-spacing:0.05em;text-transform:uppercase;margin-bottom:0.35rem;">
                <?= date('l, d F Y') ?>
            </div>
            <h4 class="fw-bold text-white mb-1" style="font-size:1.4rem;letter-spacing:-0.02em;">
                Halo, <?= session('nama_lengkap') ?> 👋
            </h4>
            <p class="mb-0" style="color:rgba(255,255,255,0.6);font-size:0.875rem;">
                Selamat datang di Anugrah Jaya Digital Printing
            </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="<?= base_url('pelanggan/pesanan/create') ?>"
                style="background:linear-gradient(135deg,#ffc107,#ff9800);color:#1a1a2e;padding:0.65rem 1.5rem;border-radius:12px;font-weight:700;font-size:0.875rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;box-shadow:0 4px 16px rgba(255,193,7,0.35);">
                <i class="bi bi-cart-plus"></i>Buat Pesanan
            </a>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <?php
    $statCards = [
        ['key' => 'menunggu',   'label' => 'Menunggu',   'icon' => 'bi-hourglass-split', 'grad' => 'linear-gradient(135deg,#b8860b,#ffc107)'],
        ['key' => 'diproses',   'label' => 'Diproses',   'icon' => 'bi-gear-fill',        'grad' => 'linear-gradient(135deg,#0d6e6e,#20c997)'],
        ['key' => 'selesai',    'label' => 'Selesai',    'icon' => 'bi-check-circle-fill','grad' => 'linear-gradient(135deg,#1a6b3c,#28a745)'],
        ['key' => 'dibatalkan', 'label' => 'Dibatalkan', 'icon' => 'bi-x-circle-fill',    'grad' => 'linear-gradient(135deg,#8b1a1a,#dc3545)'],
    ];
    ?>
    <?php foreach ($statCards as $sc): ?>
    <div class="col-6 col-md-3">
        <div class="stat-card-pelanggan h-100" style="background:<?= $sc['grad'] ?>;">
            <div class="d-flex align-items-start justify-content-between mb-2">
                <i class="bi <?= $sc['icon'] ?>" style="font-size:1.4rem;color:rgba(255,255,255,0.7);"></i>
            </div>
            <div class="stat-val"><?= $statusCount[$sc['key']] ?></div>
            <div class="stat-lbl"><?= $sc['label'] ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:8px;height:8px;background:#1a1a2e;border-radius:50%;"></div>
                    <span>Pesanan Terbaru</span>
                </div>
                <a href="<?= base_url('pelanggan/pesanan') ?>" class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;">
                    Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($pesananTerbaru)): ?>
                    <div class="text-center py-5">
                        <div style="width:64px;height:64px;background:rgba(26,26,46,0.06);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                            <i class="bi bi-cart-x" style="font-size:1.6rem;color:#9ca3af;"></i>
                        </div>
                        <p class="text-muted small mb-3">Belum ada pesanan</p>
                        <a href="<?= base_url('pelanggan/pesanan/create') ?>" class="btn btn-sm btn-primary px-4">
                            <i class="bi bi-cart-plus me-1"></i>Buat Pesanan Pertama
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesananTerbaru as $p): ?>
                                <tr>
                                    <td>
                                        <a href="<?= base_url('pelanggan/pesanan/show/' . $p['no_pesanan']) ?>"
                                            class="fw-semibold text-decoration-none" style="color:#1a1a2e;font-size:0.82rem;">
                                            <?= $p['no_pesanan'] ?>
                                        </a>
                                    </td>
                                    <td style="font-size:0.82rem;color:#6c757d;"><?= date('d/m/Y', strtotime($p['tgl_pesanan'])) ?></td>
                                    <td style="font-size:0.85rem;font-weight:600;">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= view('layouts/partials/badge_status', ['status' => $p['status_pesanan']]) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:8px;height:8px;background:#ffc107;border-radius:50%;"></div>
                    <span>Layanan Tersedia</span>
                </div>
                <span class="badge" style="background:rgba(26,26,46,0.08);color:#1a1a2e;"><?= count($layananAktif) ?></span>
            </div>
            <div class="card-body p-0">
                <?php if (empty($layananAktif)): ?>
                    <div class="text-center text-muted py-4 small">Belum ada layanan</div>
                <?php else: ?>
                    <?php
                    $iconColors2 = ['#1a1a2e','#28a745','#b8860b','#dc3545','#0dcaf0','#6f42c1'];
                    $iconBgs2    = ['rgba(26,26,46,0.08)','rgba(40,167,69,0.1)','rgba(255,193,7,0.12)','rgba(220,53,69,0.1)','rgba(13,202,240,0.1)','rgba(111,66,193,0.1)'];
                    $icons2      = ['bi-image','bi-file-earmark-text','bi-credit-card-2-front','bi-sticker','bi-calendar3','bi-grid-3x3-gap'];
                    ?>
                    <?php foreach (array_slice($layananAktif, 0, 5) as $i => $l): ?>
                    <?php $idx = $i % 6; ?>
                    <div class="d-flex align-items-center justify-content-between px-3 py-2" style="border-bottom:1px solid rgba(0,0,0,0.04);">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:36px;height:36px;background:<?= $iconBgs2[$idx] ?>;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi <?= $icons2[$idx] ?>" style="color:<?= $iconColors2[$idx] ?>;font-size:0.9rem;"></i>
                            </div>
                            <div>
                                <div style="font-size:0.85rem;font-weight:600;"><?= $l['nama_layanan'] ?></div>
                                <div style="font-size:0.72rem;color:#9ca3af;">Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?></div>
                            </div>
                        </div>
                        <a href="<?= base_url('pelanggan/pesanan/create') ?>"
                            style="width:30px;height:30px;background:rgba(26,26,46,0.06);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#1a1a2e;text-decoration:none;transition:all 0.2s;"
                            title="Pesan">
                            <i class="bi bi-cart-plus" style="font-size:0.85rem;"></i>
                        </a>
                    </div>
                    <?php endforeach; ?>
                    <div class="p-3">
                        <a href="<?= base_url('pelanggan/pesanan/create') ?>" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-cart-plus me-1"></i>Buat Pesanan Baru
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
