<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Pesanan</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pesanan') ?>">Pesanan</a></li>
            <li class="breadcrumb-item active"><?= $pesanan['no_pesanan'] ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pesanan') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">
    <div class="col-lg-8">

        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-receipt me-2"></i>Informasi Pesanan</span>
                <?= view('layouts/partials/badge_status', ['status' => $pesanan['status_pesanan']]) ?>
            </div>
            <div class="card-body">
                <div class="row g-3 small">
                    <div class="col-md-4">
                        <div class="text-muted">No. Pesanan</div>
                        <div class="fw-bold"><?= $pesanan['no_pesanan'] ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Pelanggan</div>
                        <div class="fw-semibold"><?= $pesanan['nama_pelanggan'] ?? '-' ?></div>
                        <div class="text-muted"><?= $pesanan['no_hp'] ?? '' ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Status Bayar</div>
                        <div><?= view('layouts/partials/badge_status', ['status' => $pesanan['status_bayar']]) ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Tgl Pesanan</div>
                        <div><?= date('d F Y', strtotime($pesanan['tgl_pesanan'])) ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Est. Selesai</div>
                        <div><?= $pesanan['tgl_selesai'] ? date('d F Y', strtotime($pesanan['tgl_selesai'])) : '-' ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Dibuat</div>
                        <div><?= $pesanan['created_at'] ? date('d/m/Y H:i', strtotime($pesanan['created_at'])) : '-' ?></div>
                    </div>
                    <?php if ($pesanan['catatan']): ?>
                    <div class="col-12">
                        <div class="text-muted">Catatan</div>
                        <div class="alert alert-light py-2 mb-0 small"><?= $pesanan['catatan'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><i class="bi bi-list-ul me-2"></i>Detail Item Pesanan</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Layanan</th>
                                <th>Ukuran</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $d): ?>
                            <tr>
                                <td>
                                    <div class="fw-semibold small"><?= $d['nama_layanan'] ?? $d['kode_layanan'] ?></div>
                                    <?php if ($d['nama_kategori']): ?>
                                        <div class="text-muted" style="font-size:0.72rem;"><?= $d['nama_kategori'] ?></div>
                                    <?php endif; ?>
                                    <?php if ($d['keterangan']): ?>
                                        <div class="text-muted" style="font-size:0.72rem;"><i class="bi bi-chat-left-text me-1"></i><?= $d['keterangan'] ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="small"><?= $d['ukuran'] ?? '-' ?></td>
                                <td class="text-center"><?= $d['qty'] ?></td>
                                <td class="text-end small">Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                                <td class="text-end fw-semibold small">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total Harga</td>
                                <td class="text-end fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-4">

        <?php if (session('level') === 'admin'): ?>
        <div class="card mb-3">
            <div class="card-header"><i class="bi bi-arrow-repeat me-2"></i>Update Status</div>
            <div class="card-body">
                <form action="<?= base_url('admin/pesanan/status/' . $pesanan['no_pesanan']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status Pesanan</label>
                        <select name="status_pesanan" class="form-select form-select-sm">
                            <?php foreach (['menunggu', 'diproses', 'selesai', 'dibatalkan'] as $s): ?>
                                <option value="<?= $s ?>" <?= $pesanan['status_pesanan'] === $s ? 'selected' : '' ?>>
                                    <?= ucfirst($s) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Stok bahan otomatis berkurang saat status <strong>Diproses</strong>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-save me-1"></i>Update Status
                    </button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header"><i class="bi bi-clock-history me-2"></i>Alur Status</div>
            <div class="card-body">
                <?php
                $steps = ['menunggu', 'diproses', 'selesai'];
                $current = $pesanan['status_pesanan'];
                $currentIdx = array_search($current, $steps);
                $isBatal = $current === 'dibatalkan';
                ?>
                <?php if ($isBatal): ?>
                    <div class="text-center py-2">
                        <i class="bi bi-x-circle-fill text-danger fs-2 d-block mb-2"></i>
                        <div class="fw-semibold text-danger">Pesanan Dibatalkan</div>
                        <div class="small text-muted mt-1">Stok bahan telah dikembalikan</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($steps as $idx => $step): ?>
                    <?php $done = $currentIdx !== false && $idx <= $currentIdx; ?>
                    <?php $active = $currentIdx !== false && $idx === $currentIdx; ?>
                    <div class="d-flex gap-3 mb-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:36px;height:36px;min-width:36px;
                                background:<?= $done ? '#1a1a2e' : '#f0f0f0' ?>;
                                color:<?= $done ? '#ffc107' : '#adb5bd' ?>;">
                                <?php if ($done && !$active): ?>
                                    <i class="bi bi-check2"></i>
                                <?php else: ?>
                                    <?= $idx + 1 ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($idx < count($steps) - 1): ?>
                                <div style="width:2px;height:24px;background:<?= ($currentIdx !== false && $idx < $currentIdx) ? '#1a1a2e' : '#dee2e6' ?>;margin-top:2px;"></div>
                            <?php endif; ?>
                        </div>
                        <div class="pt-1">
                            <div class="small fw-semibold <?= $active ? 'text-primary' : ($done ? '' : 'text-muted') ?>">
                                <?= ucfirst($step) ?>
                                <?php if ($active): ?>
                                    <span class="badge bg-primary ms-1" style="font-size:0.6rem;">Sekarang</span>
                                <?php endif; ?>
                            </div>
                            <?php if ($step === 'diproses'): ?>
                                <div class="text-muted" style="font-size:0.72rem;">Stok bahan berkurang</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
