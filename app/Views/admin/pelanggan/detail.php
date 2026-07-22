<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Pelanggan</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pelanggan') ?>">Pelanggan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol></nav>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('admin/pelanggan/edit/' . $pelanggan['id_pelanggan']) ?>" class="btn btn-sm btn-warning">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
        <a href="<?= base_url('admin/pelanggan') ?>" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card text-center p-4">
            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-3"
                style="width:70px;height:70px;font-size:1.8rem;">
                <?= strtoupper(substr($pelanggan['nama_pelanggan'], 0, 1)) ?>
            </div>
            <h5 class="fw-bold mb-1"><?= $pelanggan['nama_pelanggan'] ?></h5>
            <span class="badge bg-primary mb-3">Pelanggan</span>
            <div class="text-start small">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-person text-muted"></i>
                    <span><?= $pelanggan['username'] ?? '-' ?></span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-envelope text-muted"></i>
                    <span><?= $pelanggan['email'] ?? '-' ?></span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-telephone text-muted"></i>
                    <span><?= $pelanggan['no_hp'] ?? '-' ?></span>
                </div>
                <div class="d-flex align-items-start gap-2 mb-2">
                    <i class="bi bi-geo-alt text-muted mt-1"></i>
                    <span><?= $pelanggan['alamat'] ?? '-' ?></span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar text-muted"></i>
                    <span>Daftar: <?= $pelanggan['created_at'] ? date('d F Y', strtotime($pelanggan['created_at'])) : '-' ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
