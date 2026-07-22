<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Pengelolaan Pembelian</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Pembelian</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pembelian/create') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Pembelian
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card mb-3">
    <div class="card-body d-flex align-items-center gap-3 py-3">
        <div class="rounded-3 p-3" style="background:rgba(13,110,253,0.1);">
            <i class="bi bi-cart-check fs-4 text-primary"></i>
        </div>
        <div>
            <div class="small text-muted">Total Pembelian Bulan Ini</div>
            <div class="fw-bold fs-5">Rp <?= number_format($totalBulan, 0, ',', '.') ?></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-bag-check me-2"></i>Riwayat Pembelian Bahan</span>
        <span class="badge bg-primary"><?= count($pembelian) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>No Pembelian</th>
                        <th>Tgl Pembelian</th>
                        <th>Supplier</th>
                        <th>Bahan</th>
                        <th class="text-center">Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                        <th width="90">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pembelian)): ?>
                        <tr><td colspan="8" class="text-center py-5">
                            <i class="bi bi-bag fs-2 text-muted d-block mb-2"></i>
                            <span class="text-muted small">Belum ada data pembelian</span>
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($pembelian as $p): ?>
                        <tr>
                            <td class="fw-semibold small"><?= $p['no_pembelian'] ?></td>
                            <td class="small"><?= date('d/m/Y', strtotime($p['tgl_pembelian'])) ?></td>
                            <td><?= $p['nama_supplier'] ?? '<span class="text-muted">-</span>' ?></td>
                            <td>
                                <div class="fw-semibold small"><?= $p['nama_bahan'] ?? '-' ?></div>
                                <div class="text-muted" style="font-size:0.72rem;"><?= $p['satuan'] ?? '' ?></div>
                            </td>
                            <td class="text-center fw-semibold"><?= number_format($p['jumlah'], 0, ',', '.') ?></td>
                            <td class="small">Rp <?= number_format($p['harga_satuan'], 0, ',', '.') ?></td>
                            <td class="fw-semibold small">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <a href="<?= base_url('admin/pembelian/show/' . $p['id_pembelian']) ?>" class="btn btn-sm btn-outline-info py-1 px-2" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/pembelian/delete/' . $p['id_pembelian']) ?>"
                                    class="btn btn-sm btn-outline-danger py-1 px-2 btn-hapus"
                                    data-nama="<?= $p['no_pembelian'] ?>">
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
            if (confirm('Hapus pembelian "' + this.dataset.nama + '"?\nStok bahan akan dikembalikan.')) window.location.href = this.href;
        });
    });
</script>
<?= $this->endSection() ?>
