<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Pengelolaan Supplier</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Supplier</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/supplier/create') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Supplier
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-truck me-2"></i>Daftar Supplier</span>
        <span class="badge bg-primary"><?= count($supplier) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Supplier</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th width="110">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($supplier)): ?>
                        <tr><td colspan="6" class="text-center py-5">
                            <i class="bi bi-truck fs-2 text-muted d-block mb-2"></i>
                            <span class="text-muted small">Belum ada data supplier</span>
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($supplier as $i => $s): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="fw-semibold"><?= $s['nama_supplier'] ?></td>
                            <td><?= $s['no_hp'] ?? '-' ?></td>
                            <td><?= $s['email'] ?? '-' ?></td>
                            <td class="small text-muted"><?= $s['alamat'] ? substr($s['alamat'], 0, 40) . '...' : '-' ?></td>
                            <td>
                                <a href="<?= base_url('admin/supplier/edit/' . $s['id_supplier']) ?>" class="btn btn-sm btn-outline-warning py-1 px-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/supplier/delete/' . $s['id_supplier']) ?>"
                                    class="btn btn-sm btn-outline-danger py-1 px-2 btn-hapus"
                                    data-nama="<?= $s['nama_supplier'] ?>">
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
            if (confirm('Hapus supplier "' + this.dataset.nama + '"?')) window.location.href = this.href;
        });
    });
</script>
<?= $this->endSection() ?>
