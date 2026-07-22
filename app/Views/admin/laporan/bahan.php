<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Laporan Stok Bahan</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
            <li class="breadcrumb-item active">Stok Bahan</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/laporan/cetak/bahan') ?>" target="_blank" class="btn btn-sm btn-success">
        <i class="bi bi-printer me-1"></i>Cetak
    </a>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-box-seam me-2"></i>Data Stok Bahan/Material</span>
        <span class="badge bg-primary"><?= count($bahan) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Bahan</th>
                        <th>Satuan</th>
                        <th>Stok Tersedia</th>
                        <th>Stok Minimum</th>
                        <th>Kondisi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bahan)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data bahan</td></tr>
                    <?php else: ?>
                        <?php foreach ($bahan as $i => $b): ?>
                        <?php $menipis = $b['stok'] <= $b['stok_minimum']; ?>
                        <tr class="<?= $menipis ? 'table-warning' : '' ?>">
                            <td><?= $i + 1 ?></td>
                            <td class="fw-semibold"><?= $b['nama_bahan'] ?></td>
                            <td><?= $b['satuan'] ?></td>
                            <td class="fw-bold <?= $menipis ? 'text-danger' : 'text-success' ?>"><?= $b['stok'] ?></td>
                            <td><?= $b['stok_minimum'] ?></td>
                            <td>
                                <?php if ($menipis): ?>
                                    <span class="badge bg-danger">Menipis</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Aman</span>
                                <?php endif; ?>
                            </td>
                            <td class="small text-muted"><?= $b['keterangan'] ?? '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
