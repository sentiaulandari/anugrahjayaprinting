<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<?php
$namaBulanList = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                  7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
$laba = $pendapatan - $pengeluaran;
?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail <?= $namaBulan ?> <?= $tahun ?></h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/laporan/pertahun?tahun=' . $tahun) ?>">Laporan Pertahun <?= $tahun ?></a></li>
            <li class="breadcrumb-item active"><?= $namaBulan ?></li>
        </ol></nav>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('admin/laporan/pertahun?tahun=' . $tahun) ?>" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>

<!-- Filter Bulan -->
<div class="card mb-4">
    <div class="card-body py-2">
        <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
            <input type="hidden" name="tahun" value="<?= $tahun ?>">
            <label class="fw-semibold small mb-0">Pilih Bulan:</label>
            <select name="bulan" class="form-select form-select-sm" style="width:auto;" onchange="this.form.submit()">
                <?php for ($b = 1; $b <= 12; $b++): ?>
                    <option value="<?= $b ?>" <?= $b == $bulan ? 'selected' : '' ?>><?= $namaBulanList[$b] ?></option>
                <?php endfor; ?>
            </select>
            <span class="text-muted small"><?= date('d/m/Y', strtotime($dari)) ?> — <?= date('d/m/Y', strtotime($sampai)) ?></span>
        </form>
    </div>
</div>

<!-- Statistik -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-widget sw-green h-100">
            <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
            <div class="stat-value" style="font-size:1.1rem;">Rp <?= number_format($pendapatan, 0, ',', '.') ?></div>
            <div class="stat-label">Pendapatan</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-widget sw-yellow h-100">
            <div class="stat-icon"><i class="bi bi-bag"></i></div>
            <div class="stat-value" style="font-size:1.1rem;">Rp <?= number_format($pengeluaran, 0, ',', '.') ?></div>
            <div class="stat-label">Pengeluaran</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-widget <?= $laba >= 0 ? 'sw-blue' : 'sw-red' ?> h-100">
            <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
            <div class="stat-value" style="font-size:1.1rem;">Rp <?= number_format(abs($laba), 0, ',', '.') ?></div>
            <div class="stat-label">Laba <?= $laba < 0 ? '(Rugi)' : 'Bersih' ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-widget sw-blue h-100">
            <div class="stat-icon"><i class="bi bi-cart3"></i></div>
            <div class="stat-value"><?= count($pesanan) ?></div>
            <div class="stat-label">Total Pesanan</div>
        </div>
    </div>
</div>

<!-- Tabel Pesanan Bulan Ini -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-cart3 me-2"></i>Detail Pesanan — <?= $namaBulan ?> <?= $tahun ?></span>
        <span class="badge bg-primary"><?= count($pesanan) ?> pesanan</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Konsumen</th>
                        <th>Tgl Pesanan</th>
                        <th>Est. Selesai</th>
                        <th class="text-end">Total Harga</th>
                        <th class="text-center">Status Pesanan</th>
                        <th class="text-center">Status Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pesanan)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>Tidak ada pesanan pada bulan ini
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('admin/pesanan/show/' . $p['no_pesanan']) ?>" class="fw-semibold text-decoration-none">
                                    <?= $p['no_pesanan'] ?>
                                </a>
                            </td>
                            <td><?= esc($p['nama_pelanggan'] ?? '-') ?></td>
                            <td><?= $p['tgl_pesanan'] ? date('d/m/Y', strtotime($p['tgl_pesanan'])) : '-' ?></td>
                            <td><?= $p['tgl_selesai'] ? date('d/m/Y', strtotime($p['tgl_selesai'])) : '-' ?></td>
                            <td class="text-end fw-semibold">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <?php
                                $badges = ['menunggu'=>'warning text-dark','diproses'=>'info text-dark','selesai'=>'success','dibatalkan'=>'danger'];
                                $badge  = $badges[$p['status_pesanan']] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?= $badge ?>"><?= ucfirst($p['status_pesanan']) ?></span>
                            </td>
                            <td class="text-center">
                                <?php if ($p['status_bayar'] === 'sudah bayar'): ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Belum Bayar</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-light fw-bold">
                            <td colspan="4" class="text-end">TOTAL</td>
                            <td class="text-end text-success">Rp <?= number_format(array_sum(array_column($pesanan, 'total_harga')), 0, ',', '.') ?></td>
                            <td colspan="2"></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
