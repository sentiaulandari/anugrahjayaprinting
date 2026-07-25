<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Edit Pesanan</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pesanan') ?>">Pesanan</a></li>
            <li class="breadcrumb-item active">Edit <?= $pesanan['no_pesanan'] ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pesanan') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<form action="<?= base_url('admin/pesanan/update/' . $pesanan['no_pesanan']) ?>" method="POST">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header"><i class="bi bi-person me-2"></i>Informasi Pesanan</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">No. Pesanan</label>
                            <input type="text" class="form-control bg-light" value="<?= $pesanan['no_pesanan'] ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Tanggal Pesanan</label>
                            <input type="text" class="form-control bg-light" value="<?= date('d F Y', strtotime($pesanan['tgl_pesanan'])) ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Est. Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_selesai" class="form-control"
                                value="<?= $pesanan['tgl_selesai'] ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold">Pelanggan <span class="text-danger">*</span></label>
                            <select name="id_pelanggan" class="form-select" required>
                                <?php foreach ($pelanggan as $p): ?>
                                    <option value="<?= $p['id_pelanggan'] ?>" <?= $pesanan['id_pelanggan'] == $p['id_pelanggan'] ? 'selected' : '' ?>>
                                        <?= $p['nama_pelanggan'] ?> <?= $p['no_hp'] ? '(' . $p['no_hp'] . ')' : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="2"
                                placeholder="Catatan tambahan..."><?= $pesanan['catatan'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><i class="bi bi-list-ul me-2"></i>Item Pesanan (Read Only)</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Layanan</th>
                                    <th>Ukuran</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $d): ?>
                                <tr>
                                    <td class="fw-semibold small"><?= $d['nama_layanan'] ?? $d['kode_layanan'] ?></td>
                                    <td class="small"><?= $d['ukuran'] ?? '-' ?></td>
                                    <td class="text-center"><?= $d['qty'] ?></td>
                                    <td class="text-end small">Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                                    <td class="text-end fw-semibold small">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total</td>
                                    <td class="text-end fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><i class="bi bi-receipt me-2"></i>Ringkasan</div>
                <div class="card-body small">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">No. Pesanan</span>
                        <span class="fw-semibold"><?= $pesanan['no_pesanan'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status</span>
                        <?= view('layouts/partials/badge_status', ['status' => $pesanan['status_pesanan']]) ?>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Pembayaran</span>
                        <?= view('layouts/partials/badge_status', ['status' => $pesanan['status_bayar']]) ?>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                    </button>
                    <a href="<?= base_url('admin/pesanan') ?>" class="btn btn-outline-secondary w-100">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>
