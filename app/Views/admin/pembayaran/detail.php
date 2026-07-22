<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Pembayaran</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pembayaran') ?>">Pembayaran</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pembayaran') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header"><i class="bi bi-receipt me-2"></i>Informasi Pembayaran</div>
            <div class="card-body">
                <div class="row g-3 small">
                    <div class="col-md-6">
                        <div class="text-muted">No. Pesanan</div>
                        <div class="fw-semibold"><?= $pembayaran['no_pesanan'] ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Pelanggan</div>
                        <div class="fw-semibold"><?= $pesanan['nama_pelanggan'] ?? '-' ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Tgl Pembayaran</div>
                        <div><?= date('d F Y', strtotime($pembayaran['tgl_pembayaran'])) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Metode Bayar</div>
                        <div><?= $pembayaran['metode_bayar'] ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Jumlah Bayar</div>
                        <div class="fw-bold text-success fs-6">Rp <?= number_format($pembayaran['jumlah_bayar'], 0, ',', '.') ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Total Pesanan</div>
                        <div>Rp <?= number_format($pesanan['total_harga'] ?? 0, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Status Konfirmasi</div>
                        <div><?= view('layouts/partials/badge_status', ['status' => $pembayaran['status_konfirmasi']]) ?></div>
                    </div>
                </div>

                <?php if ($pembayaran['bukti_pembayaran']): ?>
                <div class="mt-3">
                    <div class="text-muted small mb-2">Bukti Pembayaran</div>
                    <a href="<?= base_url('uploads/pembayaran/' . $pembayaran['bukti_pembayaran']) ?>" target="_blank">
                        <img src="<?= base_url('uploads/pembayaran/' . $pembayaran['bukti_pembayaran']) ?>"
                            class="img-thumbnail" style="max-height:200px;" alt="Bukti Pembayaran">
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ($pembayaran['status_konfirmasi'] === 'menunggu'): ?>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header"><i class="bi bi-check2-circle me-2"></i>Konfirmasi Pembayaran</div>
            <div class="card-body">
                <form action="<?= base_url('admin/pembayaran/konfirmasi/' . $pembayaran['id_pembayaran']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Keputusan</label>
                        <select name="status_konfirmasi" class="form-select" required>
                            <option value="diterima">Terima Pembayaran</option>
                            <option value="ditolak">Tolak Pembayaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Catatan Admin</label>
                        <textarea name="catatan_admin" class="form-control" rows="3"
                            placeholder="Catatan untuk pelanggan..."><?= $pembayaran['catatan_admin'] ?? '' ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i>Simpan Konfirmasi
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
