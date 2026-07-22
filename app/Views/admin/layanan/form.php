<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<?php $isEdit = isset($layanan); ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0"><?= $title ?></h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/layanan') ?>">Layanan</a></li>
            <li class="breadcrumb-item active"><?= $isEdit ? 'Edit' : 'Tambah' ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/layanan') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-grid-3x3-gap me-2"></i><?= $title ?>
    </div>
    <div class="card-body">
        <form action="<?= $isEdit ? base_url('admin/layanan/update/' . $layanan['kode_layanan']) : base_url('admin/layanan/store') ?>"
              method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Kode Layanan <span class="text-danger">*</span></label>
                    <input type="text" name="kode_layanan" class="form-control"
                        value="<?= $isEdit ? $layanan['kode_layanan'] : ($kode_baru ?? '') ?>"
                        <?= $isEdit ? 'readonly' : '' ?> required>
                    <div class="form-text">Format: LY-001</div>
                </div>

                <div class="col-md-8">
                    <label class="form-label fw-semibold small">Nama Layanan <span class="text-danger">*</span></label>
                    <input type="text" name="nama_layanan" class="form-control"
                        value="<?= old('nama_layanan', $layanan['nama_layanan'] ?? '') ?>"
                        placeholder="Nama layanan percetakan" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Kategori</label>
                    <select name="id_kategori" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id_kategori'] ?>"
                                <?= old('id_kategori', $layanan['id_kategori'] ?? '') == $k['id_kategori'] ? 'selected' : '' ?>>
                                <?= $k['nama_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Bahan/Material</label>
                    <select name="id_bahan" class="form-select">
                        <option value="">-- Pilih Bahan --</option>
                        <?php foreach ($bahan as $b): ?>
                            <option value="<?= $b['id_bahan'] ?>"
                                <?= old('id_bahan', $layanan['id_bahan'] ?? '') == $b['id_bahan'] ? 'selected' : '' ?>>
                                <?= $b['nama_bahan'] ?> (<?= $b['satuan'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_satuan" class="form-control"
                        value="<?= old('harga_satuan', $layanan['harga_satuan'] ?? '') ?>"
                        placeholder="0" min="0" step="100" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="aktif" <?= old('status', $layanan['status'] ?? 'aktif') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="nonaktif" <?= old('status', $layanan['status'] ?? '') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Gambar</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" id="inputGambar">
                    <?php if ($isEdit && !empty($layanan['gambar'])): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/layanan/' . $layanan['gambar']) ?>" height="60" class="rounded border" alt="">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar</div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold small">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"
                        placeholder="Keterangan detail layanan..."><?= old('deskripsi', $layanan['deskripsi'] ?? '') ?></textarea>
                </div>
            </div>

            <hr class="my-4">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i><?= $isEdit ? 'Simpan Perubahan' : 'Tambah Layanan' ?>
                </button>
                <a href="<?= base_url('admin/layanan') ?>" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
