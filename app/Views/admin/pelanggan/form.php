<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0"><?= $title ?></h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pelanggan') ?>">Konsumen</a></li>
            <li class="breadcrumb-item active"><?= isset($pelanggan) ? 'Edit' : 'Tambah' ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pelanggan') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card" style="max-width:600px;">
    <div class="card-header"><i class="bi bi-person me-2"></i><?= $title ?></div>
    <div class="card-body">
        <?php if (isset($pelanggan)): ?>
            <form action="<?= base_url('admin/pelanggan/update/' . $pelanggan['id_pelanggan']) ?>" method="POST">
        <?php else: ?>
            <form action="<?= base_url('admin/pelanggan/store') ?>" method="POST">
        <?php endif; ?>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold small">Nama Pelanggan <span class="text-danger">*</span></label>
                <input type="text" name="nama_pelanggan" class="form-control"
                    value="<?= old('nama_pelanggan', $pelanggan['nama_pelanggan'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?= old('email', $pelanggan['email'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">No. HP</label>
                <input type="text" name="no_hp" class="form-control"
                    value="<?= old('no_hp', $pelanggan['no_hp'] ?? '') ?>">
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold small">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"><?= old('alamat', $pelanggan['alamat'] ?? '') ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="<?= base_url('admin/pelanggan') ?>" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
