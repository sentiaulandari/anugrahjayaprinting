<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Pengelolaan Supplier</h4>
        <small class="text-muted">Kelola data supplier bahan/material</small>
    </div>
    <a href="<?= base_url('admin/supplier/create') ?>" class="btn btn-sm" style="background:#1a1a2e;color:#fff;">
        <i class="bi bi-plus-lg me-1"></i>Tambah Supplier
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Produk</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($supplier)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox fs-2 text-muted d-block mb-2"></i>
                                <span class="text-muted small">Belum ada data supplier</span>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($supplier as $i => $s): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="fw-semibold"><?= esc($s['nama_supplier']) ?></td>
                            <td><?= esc($s['nama_produk'] ?? '-') ?></td>
                            <td><?= esc($s['no_hp'] ?? '-') ?></td>
                            <td><?= esc($s['email'] ?? '-') ?></td>
                            <td style="max-width:200px;"><?= esc($s['alamat'] ?? '-') ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?= base_url('admin/supplier/edit/' . $s['id_supplier']) ?>"
                                        class="btn btn-sm btn-warning" style="font-size:0.75rem;">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= base_url('admin/supplier/delete/' . $s['id_supplier']) ?>"
                                        class="btn btn-sm btn-danger" style="font-size:0.75rem;"
                                        onclick="return confirm('Yakin hapus supplier ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
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
