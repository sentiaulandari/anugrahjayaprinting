<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Transaksi Cetak</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small"><li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Transaksi Cetak</li></ol></nav>
    </div>
    <a href="<?= base_url('admin/transaksi-cetak/create') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Transaksi Baru
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-printer me-2"></i>Daftar Transaksi Cetak (Offline/Offline Store)</span>
        <span class="badge bg-primary"><?= count($transaksi) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No Transaksi</th>
                        <th>Konsumen</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transaksi)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada transaksi cetak</td></tr>
                    <?php else: ?>
                        <?php foreach ($transaksi as $t): ?>
                        <tr>
                            <td><span class="fw-semibold small"><?= $t['no_transaksi'] ?></span></td>
                            <td><?= $t['nama_pelanggan'] ?? '-' ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($t['created_at'])) ?></td>
                            <td>Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                            <td><span class="badge bg-success">Lunas</span></td>
                            <td>
                                <a href="<?= base_url('admin/transaksi-cetak/show/' . $t['no_transaksi']) ?>" class="btn btn-sm btn-outline-info py-1 px-2" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/transaksi-cetak/cetak/' . $t['no_transaksi']) ?>" target="_blank" class="btn btn-sm btn-outline-success py-1 px-2" title="Cetak Faktur">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <a href="<?= base_url('admin/transaksi-cetak/delete/' . $t['no_transaksi']) ?>"
                                    class="btn btn-sm btn-outline-danger py-1 px-2 btn-hapus"
                                    data-nama="<?= $t['no_transaksi'] ?>">
                                    <i class="bi bi-trash"></i>
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
<?= $this->section('scripts') ?>
<script>
    document.querySelectorAll('.btn-hapus').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Hapus transaksi "' + this.dataset.nama + '"?')) window.location.href = this.href;
        });
    });
</script>
<?= $this->endSection() ?>
