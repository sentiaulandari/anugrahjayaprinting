<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Laporan Pertahun <?= esc($tahun) ?></h4>
        <small class="text-muted">Ringkasan pendapatan, pengeluaran, dan pesanan per bulan</small>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('admin/laporan/cetak/pertahun?tahun=' . $tahun) ?>" target="_blank"
            class="btn btn-sm btn-outline-danger">
            <i class="bi bi-printer me-1"></i>Cetak
        </a>
        <a href="<?= base_url('admin/laporan') ?>" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="<?= base_url('admin/laporan/pertahun') ?>" class="d-flex align-items-center gap-3">
            <label class="fw-semibold small">Pilih Tahun:</label>
            <select name="tahun" class="form-select form-select-sm" style="width:auto;" onchange="this.form.submit()">
                <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                    <option value="<?= $y ?>" <?= $y == $tahun ? 'selected' : '' ?>><?= $y ?></option>
                <?php endfor; ?>
            </select>
        </form>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-widget sw-green h-100">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
                <span class="badge" style="background:rgba(255,255,255,0.15);color:#fff;font-size:0.65rem;">Tahun <?= $tahun ?></span>
            </div>
            <div class="stat-value" style="font-size:1.2rem;">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></div>
            <div class="stat-label">Total Pendapatan</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-widget sw-yellow h-100">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-bag"></i></div>
                <span class="badge" style="background:rgba(255,255,255,0.15);color:#fff;font-size:0.65rem;">Tahun <?= $tahun ?></span>
            </div>
            <div class="stat-value" style="font-size:1.2rem;">Rp <?= number_format($totalPengeluaran, 0, ',', '.') ?></div>
            <div class="stat-label">Total Pengeluaran</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-widget sw-blue h-100">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-cart3"></i></div>
                <span class="badge" style="background:rgba(255,255,255,0.15);color:#fff;font-size:0.65rem;">Tahun <?= $tahun ?></span>
            </div>
            <div class="stat-value"><?= $totalPesanan ?></div>
            <div class="stat-label">Total Pesanan</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header fw-semibold"><i class="bi bi-table me-2"></i>Detail Per Bulan - Tahun <?= $tahun ?></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th class="text-end">Pendapatan</th>
                        <th class="text-end">Pengeluaran</th>
                        <th class="text-end">Laba Bersih</th>
                        <th class="text-center">Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $namaBulan = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                    ?>
                    <?php for ($b = 1; $b <= 12; $b++): ?>
                    <?php $laba = $pendapatanPerBulan[$b] - $pengeluaranPerBulan[$b]; ?>
                    <tr>
                        <td class="fw-semibold"><?= $namaBulan[$b] ?></td>
                        <td class="text-end" style="color:#28a745;">Rp <?= number_format($pendapatanPerBulan[$b], 0, ',', '.') ?></td>
                        <td class="text-end" style="color:#dc3545;">Rp <?= number_format($pengeluaranPerBulan[$b], 0, ',', '.') ?></td>
                        <td class="text-end fw-semibold" style="color:<?= $laba >= 0 ? '#28a745' : '#dc3545' ?>;">
                            Rp <?= number_format($laba, 0, ',', '.') ?>
                        </td>
                        <td class="text-center"><?= $pesananPerBulan[$b] ?></td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td class="fw-bold">TOTAL</td>
                        <td class="text-end fw-bold" style="color:#28a745;">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></td>
                        <td class="text-end fw-bold" style="color:#dc3545;">Rp <?= number_format($totalPengeluaran, 0, ',', '.') ?></td>
                        <td class="text-end fw-bold" style="color:<?= ($totalPendapatan - $totalPengeluaran) >= 0 ? '#28a745' : '#dc3545' ?>;">
                            Rp <?= number_format($totalPendapatan - $totalPengeluaran, 0, ',', '.') ?>
                        </td>
                        <td class="text-center fw-bold"><?= $totalPesanan ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
