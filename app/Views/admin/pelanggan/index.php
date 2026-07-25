<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Pengelolaan Konsumen</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small"><li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Pelanggan</li></ol></nav>
    </div>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people me-2"></i>Daftar Pelanggan</span>
        <span class="badge bg-primary"><?= count($pelanggan) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Pelanggan</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Tgl Daftar</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pelanggan)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data pelanggan</td></tr>
                    <?php else: ?>
                        <?php foreach ($pelanggan as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="width:34px;height:34px;font-size:0.8rem;">
                                        <?= strtoupper(substr($p['nama_pelanggan'], 0, 1)) ?>
                                    </div>
                                    <span class="fw-semibold"><?= $p['nama_pelanggan'] ?></span>
                                </div>
                            </td>
                            <td><?= $p['username'] ?? '-' ?></td>
                            <td><?= $p['email'] ?? '-' ?></td>
                            <td><?= $p['no_hp'] ?? '-' ?></td>
                            <td><?= $p['created_at'] ? date('d/m/Y', strtotime($p['created_at'])) : '-' ?></td>
                            <td>
                                <a href="<?= base_url('admin/pelanggan/show/' . $p['id_pelanggan']) ?>" class="btn btn-sm btn-outline-info py-1 px-2" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/pelanggan/edit/' . $p['id_pelanggan']) ?>" class="btn btn-sm btn-outline-warning py-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
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
