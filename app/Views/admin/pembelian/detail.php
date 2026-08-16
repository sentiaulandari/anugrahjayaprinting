<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Pembelian</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pembelian') ?>">Pembelian</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pembelian') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header fw-semibold"><i class="bi bi-info-circle me-2"></i>Informasi Pembelian</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%;">No. Faktur</td>
                        <td class="fw-semibold font-monospace"><?= esc($pembelian['no_faktur'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td class="fw-semibold"><?= date('d F Y', strtotime($pembelian['tgl_pembelian'])) ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Supplier</td>
                        <td class="fw-semibold"><?= esc($supplier['nama_supplier'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jumlah Item</td>
                        <td class="fw-semibold"><?= count($details) ?> item</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Grand Total</td>
                        <td class="fw-bold" style="color:#28a745;">Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
                    </tr>
                    <?php if ($pembelian['catatan']): ?>
                    <tr>
                        <td class="text-muted">Catatan</td>
                        <td><?= esc($pembelian['catatan']) ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header fw-semibold"><i class="bi bi-list-ul me-2"></i>Detail Item</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bahan</th>
                                <th>Jumlah</th>
                                <th>Harga/Satuan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($details)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-3 text-muted small">Tidak ada item</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($details as $i => $d): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td class="fw-semibold" style="font-size:0.85rem;"><?= esc($d['nama_bahan'] ?? '-') ?></td>
                                    <td style="font-size:0.85rem;"><?= $d['jumlah'] ?> <?= esc($d['satuan'] ?? '') ?></td>
                                    <td style="font-size:0.85rem;">Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                                    <td style="font-size:0.85rem;font-weight:600;">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <td colspan="4" class="fw-bold text-end">Grand Total</td>
                                <td class="fw-bold" style="color:#28a745;">Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
