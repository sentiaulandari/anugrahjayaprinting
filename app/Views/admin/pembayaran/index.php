<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Konfirmasi Pembayaran</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small"><li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Pembayaran</li></ol></nav>
    </div>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-credit-card me-2"></i>Daftar Konfirmasi Pembayaran</span>
        <span class="badge bg-primary"><?= count($pembayaran) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Tgl Bayar</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pembayaran)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data pembayaran</td></tr>
                    <?php else: ?>
                        <?php foreach ($pembayaran as $p): ?>
                        <tr>
                            <td class="fw-semibold small"><?= $p['no_pesanan'] ?></td>
                            <td><?= $p['nama_pelanggan'] ?? '-' ?></td>
                            <td><?= date('d/m/Y', strtotime($p['tgl_pembayaran'])) ?></td>
                            <td>Rp <?= number_format($p['jumlah_bayar'], 0, ',', '.') ?></td>
                            <td><?= $p['metode_bayar'] ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $p['status_konfirmasi']]) ?></td>
                            <td>
                                <a href="<?= base_url('admin/pembayaran/show/' . $p['id_pembayaran']) ?>" class="btn btn-sm btn-outline-info py-1 px-2">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
