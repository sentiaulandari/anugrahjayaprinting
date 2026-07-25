<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0"><?= $title ?></h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/supplier') ?>">Supplier</a></li>
            <li class="breadcrumb-item active"><?= isset($supplier) ? 'Edit' : 'Tambah' ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/supplier') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('admin/supplier/' . (isset($supplier) ? 'update/' . $supplier['id_supplier'] : 'store')) ?>" method="POST">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Nama Supplier <span class="text-danger">*</span></label>
                    <input type="text" name="nama_supplier" class="form-control"
                        value="<?= esc($supplier['nama_supplier'] ?? old('nama_supplier')) ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Nama Produk / Barang</label>
                    <input type="text" name="nama_produk" class="form-control"
                        value="<?= esc($supplier['nama_produk'] ?? old('nama_produk')) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">No HP</label>
                    <input type="text" name="no_hp" class="form-control"
                        value="<?= esc($supplier['no_hp'] ?? old('no_hp')) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="<?= esc($supplier['email'] ?? old('email')) ?>">
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold small">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"><?= esc($supplier['alamat'] ?? old('alamat')) ?></textarea>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-sm" style="background:#1a1a2e;color:#fff;">
                    <i class="bi bi-check-lg me-1"></i><?= isset($supplier) ? 'Perbarui' : 'Simpan' ?>
                </button>
                <a href="<?= base_url('admin/supplier') ?>" class="btn btn-sm btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
