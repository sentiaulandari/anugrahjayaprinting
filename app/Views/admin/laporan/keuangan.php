<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Laporan Keuangan</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
            <li class="breadcrumb-item active">Keuangan</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/laporan/cetak/keuangan?dari=' . $dari . '&sampai=' . $sampai) ?>" target="_blank" class="btn btn-sm btn-success">
        <i class="bi bi-printer me-1"></i>Cetak
    </a>
</div>

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
            <div class="text-muted small mb-1">Total Pendapatan Periode Ini</div>
            <div class="fs-4 fw-bold text-success">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Jumlah Transaksi</div>
            <div class="fs-4 fw-bold text-primary"><?= count($pembayaran) ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Periode</div>
            <div class="fw-semibold small"><?= date('d/m/Y', strtotime($dari)) ?> - <?= date('d/m/Y', strtotime($sampai)) ?></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><i class="bi bi-cash-stack me-2"></i>Rincian Transaksi Pembayaran</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Tgl Bayar</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pembayaran)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data pada periode ini</td></tr>
                    <?php else: ?>
                        <?php foreach ($pembayaran as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="small fw-semibold"><?= $p['no_pesanan'] ?></td>
                            <td><?= $p['nama_pelanggan'] ?? '-' ?></td>
                            <td><?= date('d/m/Y', strtotime($p['tgl_pembayaran'])) ?></td>
                            <td><?= $p['metode_bayar'] ?></td>
                            <td class="fw-semibold">Rp <?= number_format($p['jumlah_bayar'], 0, ',', '.') ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $p['status_konfirmasi']]) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-light fw-bold">
                            <td colspan="5" class="text-end">Total Pendapatan</td>
                            <td class="text-success">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
