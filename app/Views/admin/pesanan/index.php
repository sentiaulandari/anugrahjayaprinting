<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Pemesanan</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small"><li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Pesanan</li></ol></nav>
    </div>
    <a href="<?= base_url('admin/pesanan/create') ?>" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Buat Pesanan
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-cart3 me-2"></i>Daftar Pesanan (Booking dari Konsumen)</span>
        <span class="badge bg-primary"><?= count($pesanan) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Tgl Pesanan</th>
                        <th>Est. Selesai</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pesanan)): ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data pesanan</td></tr>
                    <?php else: ?>
                        <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td><span class="fw-semibold small"><?= $p['no_pesanan'] ?></span></td>
                            <td><?= $p['nama_pelanggan'] ?? '-' ?></td>
                            <td><?= date('d/m/Y', strtotime($p['tgl_pesanan'])) ?></td>
                            <td><?= $p['tgl_selesai'] ? date('d/m/Y', strtotime($p['tgl_selesai'])) : '-' ?></td>
                            <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $p['status_pesanan']]) ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $p['status_bayar']]) ?></td>
                            <td>
                                <a href="<?= base_url('admin/pesanan/show/' . $p['no_pesanan']) ?>" class="btn btn-sm btn-outline-info py-1 px-2" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/pesanan/edit/' . $p['no_pesanan']) ?>" class="btn btn-sm btn-outline-warning py-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/pesanan/delete/' . $p['no_pesanan']) ?>"
                                    class="btn btn-sm btn-outline-danger py-1 px-2 btn-hapus"
                                    data-nama="<?= $p['no_pesanan'] ?>">
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
            if (confirm('Hapus pesanan "' + this.dataset.nama + '"?')) window.location.href = this.href;
        });
    });
</script>
<?= $this->endSection() ?>
