<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Laporan Supplier</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
            <li class="breadcrumb-item active">Supplier</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/laporan/cetak/supplier') ?>" target="_blank" class="btn btn-sm btn-outline-danger">
        <i class="bi bi-printer me-1"></i>Cetak
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Total Supplier</div>
            <div class="fs-4 fw-bold" style="color:#6f42c1;"><?= count($supplier) ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Total Nilai Pembelian</div>
            <div class="fs-5 fw-bold text-success">Rp <?= number_format(array_sum(array_column($supplier, 'total_nilai')), 0, ',', '.') ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Total Transaksi</div>
            <div class="fs-4 fw-bold text-primary"><?= array_sum(array_column($supplier, 'total_transaksi')) ?></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-truck me-2"></i>Daftar Supplier & Riwayat Pembelian</span>
        <span class="badge bg-secondary"><?= count($supplier) ?> supplier</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="40">No</th>
                        <th>Nama Supplier</th>
                        <th>Produk yang Disupply</th>
                        <th>No. HP</th>
                        <th class="text-center">Total Transaksi</th>
                        <th class="text-end">Total Nilai</th>
                        <th>Terakhir Beli</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($supplier)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>Belum ada data supplier
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($supplier as $i => $s): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <div class="fw-semibold"><?= esc($s['nama_supplier']) ?></div>
                                <?php if ($s['email']): ?>
                                    <div class="small text-muted"><?= esc($s['email']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="small"><?= esc($s['nama_produk'] ?? '-') ?></td>
                            <td class="small"><?= esc($s['no_hp'] ?? '-') ?></td>
                            <td class="text-center">
                                <span class="badge bg-primary"><?= $s['total_transaksi'] ?></span>
                            </td>
                            <td class="text-end fw-semibold text-success">
                                Rp <?= number_format($s['total_nilai'], 0, ',', '.') ?>
                            </td>
                            <td class="small">
                                <?= $s['terakhir_beli'] ? date('d/m/Y', strtotime($s['terakhir_beli'])) : '<span class="text-muted">Belum ada</span>' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-light fw-bold">
                            <td colspan="4" class="text-end">TOTAL</td>
                            <td class="text-center"><?= array_sum(array_column($supplier, 'total_transaksi')) ?></td>
                            <td class="text-end text-success">Rp <?= number_format(array_sum(array_column($supplier, 'total_nilai')), 0, ',', '.') ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
