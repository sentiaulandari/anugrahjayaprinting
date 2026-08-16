<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Pesanan</h4>
        <small class="text-muted"><?= $pesanan['no_pesanan'] ?></small>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('pelanggan/pesanan/cetak/' . $pesanan['no_pesanan']) ?>" target="_blank" class="btn btn-sm btn-success">
            <i class="bi bi-printer me-1"></i>Cetak Faktur
        </a>
        <a href="<?= base_url('pelanggan/pesanan') ?>" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">

    <div class="col-lg-8">

        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-receipt me-2"></i><?= $pesanan['no_pesanan'] ?></span>
                <?= view('layouts/partials/badge_status', ['status' => $pesanan['status_pesanan']]) ?>
            </div>
            <div class="card-body">
                <div class="row g-2 small">
                    <div class="col-md-6">
                        <div class="text-muted">Tanggal Pesanan</div>
                        <div class="fw-semibold"><?= date('d F Y', strtotime($pesanan['tgl_pesanan'])) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Estimasi Selesai</div>
                        <div class="fw-semibold"><?= $pesanan['tgl_selesai'] ? date('d F Y', strtotime($pesanan['tgl_selesai'])) : '-' ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Status Pembayaran</div>
                        <div><?= view('layouts/partials/badge_status', ['status' => $pesanan['status_bayar']]) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Total Harga</div>
                        <div class="fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></div>
                    </div>
                    <?php if ($pesanan['catatan']): ?>
                    <div class="col-12">
                        <div class="text-muted">Catatan</div>
                        <div><?= esc($pesanan['catatan']) ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><i class="bi bi-list-ul me-2"></i>Item Pesanan</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Layanan</th>
                                <th>Ukuran</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Desain</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $d): ?>
                            <tr>
                                <td>
                                    <div class="fw-semibold small"><?= $d['nama_layanan'] ?? $d['kode_layanan'] ?></div>
                                    <span class="badge bg-secondary" style="font-size:0.6rem;">
                                        <?= $d['tipe_harga'] === 'per_meter' ? 'Per Meter' : ($d['tipe_harga'] === 'per_lembar' ? 'Per Lembar' : ($d['tipe_harga'] === 'per_set' ? 'Per Set' : ($d['tipe_harga'] === 'per_huruf' ? 'Per Huruf' : ($d['tipe_harga'] === 'per_buku' ? 'Per Buku' : 'Per Pcs')))) ?>
                                    </span>
                                    <?php if ($d['desain_sendiri']): ?>
                                        <span class="badge bg-info" style="font-size:0.6rem;">Desain Sendiri</span>
                                    <?php endif; ?>
                                    <?php if ($d['keterangan']): ?>
                                        <div class="text-muted" style="font-size:0.75rem;"><?= esc($d['keterangan']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="small">
                                    <?= $d['ukuran'] ?? '-' ?>
                                    <?php if ($d['panjang'] && $d['lebar']): ?>
                                        <div class="text-muted" style="font-size:0.7rem;"><?= $d['panjang'] ?>m × <?= $d['lebar'] ?>m</div>
                                    <?php endif; ?>
                                </td>
                                <td><?= $d['qty'] ?></td>
                                <td class="small">Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                                <td class="fw-semibold small">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if (!empty($d['file_desain'])): ?>
                                        <a href="<?= base_url($d['file_desain']) ?>" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size:0.7rem;">
                                            <i class="bi bi-file-earmark me-1"></i>Lihat
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Total</td>
                                <td class="fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-4">

        <?php if ($pesanan['status_bayar'] === 'belum bayar' && $pesanan['status_pesanan'] !== 'dibatalkan'): ?>
        <div class="card mb-3" style="border:1px solid rgba(255,193,7,0.3);">
            <div class="card-header fw-semibold" style="color:#b8860b;">
                <i class="bi bi-exclamation-triangle me-2"></i>Belum Dibayar
            </div>
            <div class="card-body small">
                <p class="text-muted mb-3">Segera lakukan pembayaran agar pesanan Anda dapat diproses.</p>
                <a href="<?= base_url('pelanggan/pembayaran/form/' . $pesanan['no_pesanan']) ?>" class="btn btn-warning w-100">
                    <i class="bi bi-credit-card me-1"></i>Bayar Sekarang
                </a>
            </div>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header"><i class="bi bi-clock-history me-2"></i>Alur Status</div>
            <div class="card-body">
                <?php
                $steps      = ['menunggu', 'diproses', 'selesai'];
                $current    = $pesanan['status_pesanan'];
                $isBatal    = $current === 'dibatalkan';
                $currentIdx = array_search($current, $steps);
                ?>

                <?php foreach ($steps as $idx => $step): ?>
                <?php $done   = $currentIdx !== false && $idx <= $currentIdx; ?>
                <?php $active = $currentIdx !== false && $idx === $currentIdx; ?>
                <div class="d-flex gap-3 mb-2">
                    <div class="d-flex flex-column align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:32px;height:32px;min-width:32px;
                            background:<?= $done ? '#1a1a2e' : '#f0f0f0' ?>;
                            color:<?= $done ? '#ffc107' : '#adb5bd' ?>;">
                            <?php if ($done && !$active): ?>
                                <i class="bi bi-check2"></i>
                            <?php else: ?>
                                <?= $idx + 1 ?>
                            <?php endif; ?>
                        </div>
                        <?php if ($idx < count($steps) - 1): ?>
                            <div style="width:2px;height:20px;background:<?= ($currentIdx !== false && $idx < $currentIdx) ? '#1a1a2e' : '#dee2e6' ?>;margin-top:2px;"></div>
                        <?php endif; ?>
                    </div>
                    <div class="pt-1">
                        <div class="small fw-semibold <?= $active ? 'text-primary' : ($done ? '' : 'text-muted') ?>">
                            <?= ucfirst($step) ?>
                            <?php if ($active): ?>
                                <span class="badge bg-primary ms-1" style="font-size:0.6rem;">Sekarang</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php if ($isBatal): ?>
                <div class="d-flex gap-3 mt-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-danger"
                        style="width:32px;height:32px;min-width:32px;">
                        <i class="bi bi-x text-white"></i>
                    </div>
                    <div class="pt-1">
                        <div class="small fw-semibold text-danger">Dibatalkan</div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
