<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Laporan Bahan Terpakai</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
            <li class="breadcrumb-item active">Bahan Terpakai</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/laporan/cetak/bahan-terpakai?dari=' . $dari . '&sampai=' . $sampai) ?>" target="_blank" class="btn btn-sm btn-outline-danger">
        <i class="bi bi-printer me-1"></i>Cetak
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-semibold mb-1">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control form-control-sm" value="<?= $dari ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold mb-1">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control form-control-sm" value="<?= $sampai ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-search me-1"></i>Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Total Jenis Bahan Terpakai</div>
            <div class="fs-4 fw-bold text-danger"><?= count($bahan) ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Periode</div>
            <div class="fw-semibold small"><?= date('d/m/Y', strtotime($dari)) ?> — <?= date('d/m/Y', strtotime($sampai)) ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Total Pemakaian (semua bahan)</div>
            <div class="fs-4 fw-bold text-primary"><?= array_sum(array_column($bahan, 'total')) ?></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-scissors me-2"></i>Rincian Bahan Terpakai</span>
        <span class="badge bg-danger"><?= count($bahan) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="40">No</th>
                        <th>Nama Bahan</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Dari Pesanan Online</th>
                        <th class="text-center">Dari Transaksi Cetak</th>
                        <th class="text-center fw-bold">Total Terpakai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bahan)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                            Tidak ada data pada periode ini
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($bahan as $i => $b): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="fw-semibold"><?= esc($b['nama_bahan']) ?></td>
                            <td class="text-center"><?= esc($b['satuan']) ?></td>
                            <td class="text-center"><?= number_format($b['dari_pesanan']) ?></td>
                            <td class="text-center"><?= number_format($b['dari_transaksi']) ?></td>
                            <td class="text-center">
                                <span class="badge bg-danger fs-6 px-3"><?= number_format($b['total']) ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-light fw-bold">
                            <td colspan="3" class="text-end">TOTAL</td>
                            <td class="text-center"><?= number_format(array_sum(array_column($bahan, 'dari_pesanan'))) ?></td>
                            <td class="text-center"><?= number_format(array_sum(array_column($bahan, 'dari_transaksi'))) ?></td>
                            <td class="text-center text-danger"><?= number_format(array_sum(array_column($bahan, 'total'))) ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
