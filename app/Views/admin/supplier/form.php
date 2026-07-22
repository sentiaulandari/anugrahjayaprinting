<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = isset($supplier); ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0"><?= $title ?></h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/supplier') ?>">Supplier</a></li>
            <li class="breadcrumb-item active"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/supplier') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card" style="max-width:620px;">
    <div class="card-header"><i class="bi bi-truck me-2"></i><?= $title ?></div>
    <div class="card-body">
        <form action="<?= $isEdit ? base_url('admin/supplier/update/' . $supplier['id_supplier']) : base_url('admin/supplier/store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold small">Nama Supplier <span class="text-danger">*</span></label>
                <input type="text" name="nama_supplier" class="form-control"
                    value="<?= old('nama_supplier', $supplier['nama_supplier'] ?? '') ?>"
                    placeholder="Nama perusahaan / toko supplier" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">No. HP</label>
                    <input type="text" name="no_hp" class="form-control"
                        value="<?= old('no_hp', $supplier['no_hp'] ?? '') ?>"
                        placeholder="08xxxxxxxxxx">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="<?= old('email', $supplier['email'] ?? '') ?>"
                        placeholder="email@supplier.com">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2"
                    placeholder="Alamat lengkap supplier"><?= old('alamat', $supplier['alamat'] ?? '') ?></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold small">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2"
                    placeholder="Keterangan tambahan"><?= old('keterangan', $supplier['keterangan'] ?? '') ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i><?= $isEdit ? 'Simpan Perubahan' : 'Tambah Supplier' ?>
                </button>
                <a href="<?= base_url('admin/supplier') ?>" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
