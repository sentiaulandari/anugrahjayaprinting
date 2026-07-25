<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Transaksi Cetak</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/transaksi-cetak') ?>">Transaksi Cetak</a></li>
            <li class="breadcrumb-item active"><?= $transaksi['no_transaksi'] ?></li>
        </ol></nav>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('admin/transaksi-cetak/cetak/' . $transaksi['no_transaksi']) ?>" target="_blank" class="btn btn-sm btn-success">
            <i class="bi bi-printer me-1"></i>Cetak Faktur
        </a>
        <a href="<?= base_url('admin/transaksi-cetak') ?>" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-receipt me-2"></i>Informasi Transaksi</span>
                <span class="badge bg-success">Lunas</span>
            </div>
            <div class="card-body">
                <div class="row g-3 small">
                    <div class="col-md-4">
                        <div class="text-muted">No. Transaksi</div>
                        <div class="fw-bold"><?= $transaksi['no_transaksi'] ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Pelanggan</div>
                        <div class="fw-semibold"><?= $transaksi['nama_pelanggan'] ?? 'Walk-in' ?></div>
                        <div class="text-muted"><?= $transaksi['no_hp'] ?? '' ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Metode Bayar</div>
                        <div class="fw-semibold"><?= $transaksi['metode_bayar'] ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Tanggal</div>
                        <div><?= date('d F Y H:i', strtotime($transaksi['created_at'])) ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Total Harga</div>
                        <div class="fw-bold text-primary fs-5">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></div>
                    </div>
                    <?php if ($transaksi['catatan']): ?>
                    <div class="col-12">
                        <div class="text-muted">Catatan</div>
                        <div class="alert alert-light py-2 mb-0 small"><?= $transaksi['catatan'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><i class="bi bi-list-ul me-2"></i>Detail Item</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th>Ukuran</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $d): ?>
                            <tr>
                                <td>
                                    <div class="fw-semibold small"><?= $d['nama_produk'] ?></div>
                                    <?php if ($d['desain_sendiri']): ?>
                                        <span class="badge bg-info" style="font-size:0.65rem;">Desain Sendiri</span>
                                    <?php endif; ?>
                                    <?php if ($d['keterangan']): ?>
                                        <div class="text-muted" style="font-size:0.72rem;"><i class="bi bi-chat-left-text me-1"></i><?= $d['keterangan'] ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="small">
                                    <?php if ($d['panjang'] && $d['lebar']): ?>
                                        <?= $d['panjang'] ?>m × <?= $d['lebar'] ?>m
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?= $d['qty'] ?></td>
                                <td class="text-end small">Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                                <td class="text-end fw-semibold small">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total</td>
                                <td class="text-end fw-bold text-primary">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><i class="bi bi-printer me-2"></i>Aksi</div>
            <div class="card-body">
                <a href="<?= base_url('admin/transaksi-cetak/cetak/' . $transaksi['no_transaksi']) ?>" target="_blank" class="btn btn-success w-100 mb-2">
                    <i class="bi bi-printer me-1"></i>Cetak Faktur
                </a>
                <a href="<?= base_url('admin/transaksi-cetak') ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
