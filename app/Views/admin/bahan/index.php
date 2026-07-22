<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Data Bahan/Material</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small"><li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Bahan</li></ol></nav>
    </div>
    <a href="<?= base_url('admin/bahan/create') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Bahan
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<?php if (!empty($stokMenurun)): ?>
<div class="alert alert-warning py-2 small mb-3">
    <i class="bi bi-exclamation-triangle me-1"></i>
    <strong><?= count($stokMenurun) ?> bahan</strong> memiliki stok di bawah minimum. Segera lakukan pengisian stok.
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-box-seam me-2"></i>Daftar Bahan/Material</span>
        <span class="badge bg-primary"><?= count($bahan) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Bahan</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Min. Stok</th>
                        <th>Kondisi</th>
                        <th>Keterangan</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bahan)): ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data bahan</td></tr>
                    <?php else: ?>
                        <?php foreach ($bahan as $i => $b): ?>
                        <?php $menipis = $b['stok'] <= $b['stok_minimum']; ?>
                        <tr class="<?= $menipis ? 'table-warning' : '' ?>">
                            <td><?= $i + 1 ?></td>
                            <td class="fw-semibold"><?= $b['nama_bahan'] ?></td>
                            <td><?= $b['satuan'] ?></td>
                            <td>
                                <span class="fw-bold <?= $menipis ? 'text-danger' : 'text-success' ?>">
                                    <?= $b['stok'] ?>
                                </span>
                            </td>
                            <td><?= $b['stok_minimum'] ?></td>
                            <td>
                                <?php if ($menipis): ?>
                                    <span class="badge bg-danger">Menipis</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Aman</span>
                                <?php endif; ?>
                            </td>
                            <td class="small text-muted"><?= $b['keterangan'] ?? '-' ?></td>
                            <td>
                                <a href="<?= base_url('admin/bahan/edit/' . $b['id_bahan']) ?>" class="btn btn-sm btn-outline-warning py-1 px-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/bahan/delete/' . $b['id_bahan']) ?>"
                                    class="btn btn-sm btn-outline-danger py-1 px-2 btn-hapus"
                                    data-nama="<?= $b['nama_bahan'] ?>">
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
            if (confirm('Hapus bahan "' + this.dataset.nama + '"?')) window.location.href = this.href;
        });
    });
</script>
<?= $this->endSection() ?>
