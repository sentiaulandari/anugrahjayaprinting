<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Retur / Revisi Hasil Cetak</h4>
        <small class="text-muted">Pantau status pengajuan retur Anda</small>
    </div>
    <a href="<?= base_url('pelanggan/pesanan') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-cart3 me-1"></i>Pesanan Saya
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-body p-0">
        <?php if (empty($returns)): ?>
            <div class="text-center py-5">
                <div style="width:64px;height:64px;background:rgba(220,53,69,0.06);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <i class="bi bi-arrow-return-left" style="font-size:1.6rem;color:#dc3545;"></i>
                </div>
                <p class="text-muted small mb-1">Belum ada pengajuan retur</p>
                <small class="text-muted">Retur bisa diajukan dari halaman detail pesanan yang sudah selesai</small>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Tgl Pengajuan</th>
                            <th>Jenis Masalah</th>
                            <th>Status</th>
                            <th>Biaya Tambahan</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($returns as $r): ?>
                        <tr>
                            <td class="fw-semibold small"><?= $r['no_pesanan'] ?></td>
                            <td class="small"><?= date('d/m/Y', strtotime($r['tgl_return'])) ?></td>
                            <td class="small"><?= $labelJenis[$r['jenis_masalah']] ?? '-' ?></td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $r['status_return']]) ?></td>
                            <td class="small">
                                <?php if ($r['biaya_tambahan'] > 0): ?>
                                    <span class="fw-semibold text-danger">Rp <?= number_format($r['biaya_tambahan'], 0, ',', '.') ?></span>
                                <?php else: ?>
                                    <span class="text-success small">Gratis</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('pelanggan/return/detail/' . $r['id_return']) ?>"
                                    class="btn btn-sm btn-outline-info py-1 px-2">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
