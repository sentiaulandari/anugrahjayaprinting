<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = isset($bahan); ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0"><?= $title ?></h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/bahan') ?>">Bahan</a></li>
            <li class="breadcrumb-item active"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/bahan') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card" style="max-width:600px;">
    <div class="card-header"><i class="bi bi-box-seam me-2"></i><?= $title ?></div>
    <div class="card-body">
        <form action="<?= $isEdit ? base_url('admin/bahan/update/' . $bahan['id_bahan']) : base_url('admin/bahan/store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold small">Nama Bahan <span class="text-danger">*</span></label>
                <input type="text" name="nama_bahan" class="form-control"
                    value="<?= old('nama_bahan', $bahan['nama_bahan'] ?? '') ?>"
                    placeholder="Nama bahan/material" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Satuan <span class="text-danger">*</span></label>
                    <input type="text" name="satuan" class="form-control"
                        value="<?= old('satuan', $bahan['satuan'] ?? '') ?>"
                        placeholder="meter / lembar / pcs" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok" class="form-control"
                        value="<?= old('stok', $bahan['stok'] ?? 0) ?>"
                        min="0" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Min. Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok_minimum" class="form-control"
                        value="<?= old('stok_minimum', $bahan['stok_minimum'] ?? 0) ?>"
                        min="0" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small">Harga per Satuan (Rp)</label>
                <input type="number" name="harga" class="form-control"
                    value="<?= old('harga', $bahan['harga'] ?? 0) ?>"
                    placeholder="0" min="0" step="100">
                <div class="form-text">Harga satuan bahan ini. Akan otomatis terupdate saat pembelian baru.</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold small">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2"
                    placeholder="Keterangan tambahan..."><?= old('keterangan', $bahan['keterangan'] ?? '') ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i><?= $isEdit ? 'Simpan Perubahan' : 'Tambah Bahan' ?>
                </button>
                <a href="<?= base_url('admin/bahan') ?>" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
