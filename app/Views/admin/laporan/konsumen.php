<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Laporan Konsumen</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
            <li class="breadcrumb-item active">Konsumen</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/laporan/cetak/konsumen') ?>" target="_blank" class="btn btn-sm btn-outline-danger">
        <i class="bi bi-printer me-1"></i>Cetak
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3 mb-3">
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Total Konsumen</div>
            <div class="fs-4 fw-bold text-secondary"><?= count($pelanggan) ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Total Pesanan</div>
            <div class="fs-4 fw-bold text-primary"><?= array_sum(array_column($pelanggan, 'total_pesanan')) ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Pesanan Selesai</div>
            <div class="fs-4 fw-bold text-success"><?= array_sum(array_column($pelanggan, 'pesanan_selesai')) ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div class="text-muted small mb-1">Total Nilai Transaksi</div>
            <div class="fs-5 fw-bold text-success">Rp <?= number_format(array_sum(array_column($pelanggan, 'total_nilai')), 0, ',', '.') ?></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people me-2"></i>Data Konsumen & Ringkasan Transaksi</span>
        <span class="badge bg-secondary"><?= count($pelanggan) ?> konsumen</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="40">No</th>
                        <th>Nama Konsumen</th>
                        <th>Kontak</th>
                        <th class="text-center">Total Pesanan</th>
                        <th class="text-center">Selesai</th>
                        <th class="text-center">Batal</th>
                        <th class="text-end">Total Nilai</th>
                        <th>Terakhir Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pelanggan)): ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>Belum ada data konsumen
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($pelanggan as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td>
                                <div class="fw-semibold"><?= esc($p['nama_pelanggan']) ?></div>
                                <?php if ($p['email']): ?>
                                    <div class="small text-muted"><?= esc($p['email']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="small">
                                <?php if ($p['no_hp']): ?>
                                    <i class="bi bi-telephone me-1 text-muted"></i><?= esc($p['no_hp']) ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary"><?= $p['total_pesanan'] ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success"><?= $p['pesanan_selesai'] ?></span>
                            </td>
                            <td class="text-center">
                                <?php if ($p['pesanan_batal'] > 0): ?>
                                    <span class="badge bg-danger"><?= $p['pesanan_batal'] ?></span>
                                <?php else: ?>
                                    <span class="text-muted">0</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end fw-semibold <?= $p['total_nilai'] > 0 ? 'text-success' : 'text-muted' ?>">
                                Rp <?= number_format($p['total_nilai'], 0, ',', '.') ?>
                            </td>
                            <td class="small">
                                <?= $p['terakhir_pesan'] ? date('d/m/Y', strtotime($p['terakhir_pesan'])) : '<span class="text-muted">Belum pesan</span>' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-light fw-bold">
                            <td colspan="3" class="text-end">TOTAL</td>
                            <td class="text-center"><?= array_sum(array_column($pelanggan, 'total_pesanan')) ?></td>
                            <td class="text-center text-success"><?= array_sum(array_column($pelanggan, 'pesanan_selesai')) ?></td>
                            <td class="text-center text-danger"><?= array_sum(array_column($pelanggan, 'pesanan_batal')) ?></td>
                            <td class="text-end text-success">Rp <?= number_format(array_sum(array_column($pelanggan, 'total_nilai')), 0, ',', '.') ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
