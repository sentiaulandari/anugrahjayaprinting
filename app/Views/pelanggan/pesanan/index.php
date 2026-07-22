<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="page-title mb-0">Pesanan Saya</h4>
    <a href="<?= base_url('pelanggan/pesanan/create') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Buat Pesanan
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-body p-0">
        <?php if (empty($pesanan)): ?>
            <div class="text-center py-5">
                <i class="bi bi-cart-x fs-1 text-muted d-block mb-3"></i>
                <p class="text-muted">Anda belum memiliki pesanan</p>
                <a href="<?= base_url('pelanggan/pesanan/create') ?>" class="btn btn-primary">
                    <i class="bi bi-cart-plus me-1"></i>Buat Pesanan Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No Pesanan</th>
                            <th>Tgl Pesanan</th>
                            <th>Est. Selesai</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td class="fw-semibold small"><?= $p['no_pesanan'] ?></td>
                            <td class="small"><?= date('d/m/Y', strtotime($p['tgl_pesanan'])) ?></td>
                            <td class="small"><?= $p['tgl_selesai'] ? date('d/m/Y', strtotime($p['tgl_selesai'])) : '-' ?></td>
                            <td class="small fw-semibold">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $p['status_pesanan']]) ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $p['status_bayar']]) ?></td>
                            <td>
                                <a href="<?= base_url('pelanggan/pesanan/show/' . $p['no_pesanan']) ?>" class="btn btn-sm btn-outline-info py-1 px-2" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
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
