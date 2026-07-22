<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="mb-4">
    <h4 class="page-title mb-0">Status Pesanan</h4>
    <small class="text-muted">Pantau perkembangan pesanan Anda secara real-time</small>
</div>

<?= view('layouts/partials/alert') ?>

<?php if (empty($pesanan)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-clock-history fs-1 text-muted d-block mb-3"></i>
            <p class="text-muted">Belum ada pesanan untuk dipantau</p>
            <a href="<?= base_url('pelanggan/pesanan/create') ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-cart-plus me-1"></i>Buat Pesanan
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="row g-3">
        <?php foreach ($pesanan as $p): ?>
        <?php
            $steps = ['menunggu', 'diproses', 'selesai'];
            $currentIdx = array_search($p['status_pesanan'], $steps);
            $isBatal = $p['status_pesanan'] === 'dibatalkan';
        ?>
        <div class="col-12">
            <div class="card <?= $isBatal ? 'border-danger' : '' ?>">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="fw-semibold"><?= $p['no_pesanan'] ?></div>
                            <div class="small text-muted"><?= date('d F Y', strtotime($p['tgl_pesanan'])) ?></div>
                            <div class="small fw-semibold text-primary mt-1">
                                Rp <?= number_format($p['total_harga'], 0, ',', '.') ?>
                            </div>
                            <div class="mt-1">
                                <?= view('layouts/partials/badge_status', ['status' => $p['status_bayar']]) ?>
                            </div>
                        </div>

                        <div class="col-md-7 mb-3 mb-md-0">
                            <?php if ($isBatal): ?>
                                <div class="d-flex align-items-center gap-2 text-danger">
                                    <i class="bi bi-x-circle-fill fs-4"></i>
                                    <span class="fw-semibold">Pesanan Dibatalkan</span>
                                </div>
                            <?php else: ?>
                                <div class="d-flex align-items-center">
                                    <?php foreach ($steps as $idx => $step): ?>
                                    <?php $done = $currentIdx !== false && $idx <= $currentIdx; ?>
                                    <?php $active = $currentIdx !== false && $idx === $currentIdx; ?>

                                    <div class="d-flex flex-column align-items-center" style="flex:1;">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold mb-1"
                                            style="width:36px;height:36px;
                                            background:<?= $done ? '#1a1a2e' : '#e9ecef' ?>;
                                            color:<?= $done ? '#ffc107' : '#adb5bd' ?>;
                                            border:2px solid <?= $active ? '#ffc107' : ($done ? '#1a1a2e' : '#dee2e6') ?>;">
                                            <?php if ($done && !$active): ?>
                                                <i class="bi bi-check2" style="font-size:1rem;"></i>
                                            <?php else: ?>
                                                <?= $idx + 1 ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="small text-center <?= $active ? 'fw-bold' : 'text-muted' ?>" style="font-size:0.7rem;">
                                            <?= ucfirst($step) ?>
                                        </div>
                                    </div>

                                    <?php if ($idx < count($steps) - 1): ?>
                                    <div style="flex:1;height:2px;background:<?= ($currentIdx !== false && $idx < $currentIdx) ? '#1a1a2e' : '#dee2e6' ?>;margin-bottom:20px;"></div>
                                    <?php endif; ?>

                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-2 text-md-end">
                            <a href="<?= base_url('pelanggan/status/detail/' . $p['no_pesanan']) ?>"
                                class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
