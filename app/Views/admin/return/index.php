<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Retur / Revisi Hasil Cetak</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Retur</li>
        </ol></nav>
    </div>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3 mb-4">
    <?php
    $statusWidgets = [
        ['key' => 'menunggu_verifikasi',  'grad' => 'linear-gradient(135deg,#b8860b,#ffc107)'],
        ['key' => 'verifikasi_disetujui', 'grad' => 'linear-gradient(135deg,#0d6e6e,#20c997)'],
        ['key' => 'proses_cetak_ulang',   'grad' => 'linear-gradient(135deg,#1a1a2e,#0f3460)'],
        ['key' => 'selesai',              'grad' => 'linear-gradient(135deg,#1a6b3c,#28a745)'],
        ['key' => 'verifikasi_ditolak',   'grad' => 'linear-gradient(135deg,#8b1a1a,#dc3545)'],
        ['key' => 'revisi_desain',        'grad' => 'linear-gradient(135deg,#4a1a6b,#6f42c1)'],
    ];
    ?>
    <?php foreach ($statusWidgets as $sw): ?>
    <div class="col-6 col-lg-2">
        <div class="stat-widget h-100 py-3" style="background:<?= $sw['grad'] ?>;">
            <div class="stat-value" style="font-size:1.5rem;"><?= $countStatus[$sw['key']] ?? 0 ?></div>
            <div class="stat-label" style="font-size:0.7rem;"><?= $labelStatus[$sw['key']] ?? $sw['key'] ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-arrow-return-left me-2"></i>Daftar Pengajuan Retur</span>
        <span class="badge bg-primary"><?= count($returns) ?> total</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>No Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Tgl Pengajuan</th>
                        <th>Jenis Masalah</th>
                        <th>Status</th>
                        <th>Biaya Tambahan</th>
                        <th width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($returns)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-arrow-return-left fs-2 text-muted d-block mb-2"></i>
                                <span class="text-muted small">Belum ada pengajuan retur</span>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php
                        $labelJenis = \App\Models\ReturnPesananModel::labelJenisMasalah();
                        ?>
                        <?php foreach ($returns as $i => $r): ?>
                        <tr>
                            <td class="fw-semibold small"><?= $r['no_pesanan'] ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:28px;height:28px;background:linear-gradient(135deg,#1a1a2e,#0f3460);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#ffc107;font-size:0.65rem;font-weight:700;flex-shrink:0;">
                                        <?= strtoupper(substr($r['nama_pelanggan'] ?? 'U', 0, 1)) ?>
                                    </div>
                                    <span style="font-size:0.875rem;"><?= $r['nama_pelanggan'] ?? '-' ?></span>
                                </div>
                            </td>
                            <td class="small"><?= date('d/m/Y', strtotime($r['tgl_return'])) ?></td>
                            <td>
                                <span class="small"><?= $labelJenis[$r['jenis_masalah']] ?? '-' ?></span>
                            </td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $r['status_return']]) ?></td>
                            <td class="small">
                                <?php if ($r['biaya_tambahan'] > 0): ?>
                                    <span class="fw-semibold text-danger">Rp <?= number_format($r['biaya_tambahan'], 0, ',', '.') ?></span>
                                <?php elseif ($r['tipe_revisi']): ?>
                                    <span class="text-success">Gratis</span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/return/show/' . $r['id_return']) ?>"
                                    class="btn btn-sm btn-outline-info py-1 px-2" title="Detail & Proses">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
