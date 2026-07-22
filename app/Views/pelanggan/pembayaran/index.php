<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="mb-4">
    <h4 class="page-title mb-0">Pembayaran</h4>
    <small class="text-muted">Kelola konfirmasi pembayaran pesanan Anda</small>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-body p-0">
        <?php if (empty($pesanan)): ?>
            <div class="text-center py-5">
                <i class="bi bi-credit-card fs-1 text-muted d-block mb-3"></i>
                <p class="text-muted">Belum ada pesanan yang perlu dibayar</p>
                <a href="<?= base_url('pelanggan/pesanan/create') ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-cart-plus me-1"></i>Buat Pesanan
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No Pesanan</th>
                            <th>Tgl Pesanan</th>
                            <th>Total Harga</th>
                            <th>Status Pesanan</th>
                            <th>Status Bayar</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td class="fw-semibold small"><?= $p['no_pesanan'] ?></td>
                            <td class="small"><?= date('d/m/Y', strtotime($p['tgl_pesanan'])) ?></td>
                            <td class="fw-semibold">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $p['status_pesanan']]) ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $p['status_bayar']]) ?></td>
                            <td>
                                <?php if ($p['status_bayar'] === 'belum bayar' && $p['status_pesanan'] !== 'dibatalkan'): ?>
                                    <a href="<?= base_url('pelanggan/pembayaran/form/' . $p['no_pesanan']) ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-credit-card me-1"></i>Bayar
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">
                                        <i class="bi bi-check-circle text-success me-1"></i>Lunas
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
