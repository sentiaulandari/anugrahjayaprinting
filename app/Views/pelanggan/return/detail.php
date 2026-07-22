<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Retur / Revisi</h4>
        <small class="text-muted">Pesanan: <?= $return['no_pesanan'] ?></small>
    </div>
    <a href="<?= base_url('pelanggan/return') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">

    <div class="col-lg-8">

        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-arrow-return-left me-2"></i>Informasi Pengajuan</span>
                <?= view('layouts/partials/badge_status', ['status' => $return['status_return']]) ?>
            </div>
            <div class="card-body">
                <div class="row g-3 small">
                    <div class="col-md-6">
                        <div class="text-muted">No. Pesanan</div>
                        <div class="fw-bold"><?= $return['no_pesanan'] ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Tanggal Pengajuan</div>
                        <div><?= date('d F Y', strtotime($return['tgl_return'])) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Jenis Masalah</div>
                        <div class="fw-semibold"><?= $labelJenis[$return['jenis_masalah']] ?? '-' ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Total Pesanan</div>
                        <div class="fw-semibold">Rp <?= number_format($return['total_harga'] ?? 0, 0, ',', '.') ?></div>
                    </div>

                    <?php if ($return['tipe_revisi']): ?>
                    <div class="col-md-6">
                        <div class="text-muted">Tipe Penanganan</div>
                        <div class="fw-semibold"><?= $labelTipeRevisi[$return['tipe_revisi']] ?? '-' ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if ($return['biaya_tambahan'] > 0): ?>
                    <div class="col-md-6">
                        <div class="text-muted">Biaya Tambahan</div>
                        <div class="fw-bold text-danger fs-6">Rp <?= number_format($return['biaya_tambahan'], 0, ',', '.') ?></div>
                    </div>
                    <?php elseif ($return['tipe_revisi']): ?>
                    <div class="col-md-6">
                        <div class="text-muted">Biaya Tambahan</div>
                        <div class="fw-semibold text-success">Gratis (Kesalahan Percetakan)</div>
                    </div>
                    <?php endif; ?>

                    <div class="col-12">
                        <div class="text-muted mb-1">Deskripsi Keluhan</div>
                        <div class="p-3 rounded-3" style="background:#f8f9fa;border:1px solid #e9ecef;line-height:1.7;font-size:0.875rem;">
                            <?= nl2br(esc($return['alasan'])) ?>
                        </div>
                    </div>
                </div>

                <?php if ($return['foto_bukti']): ?>
                <div class="mt-3">
                    <div class="text-muted small mb-2">Foto Bukti yang Dilampirkan</div>
                    <a href="<?= base_url('uploads/return/' . $return['foto_bukti']) ?>" target="_blank">
                        <img src="<?= base_url('uploads/return/' . $return['foto_bukti']) ?>"
                            class="img-thumbnail" style="max-height:200px;" alt="Foto Bukti">
                    </a>
                </div>
                <?php endif; ?>

                <?php if ($return['catatan_admin']): ?>
                <div class="mt-3 p-3 rounded-3 small" style="background:rgba(13,110,253,0.05);border:1px solid rgba(13,110,253,0.15);">
                    <div class="fw-semibold mb-1 text-primary">
                        <i class="bi bi-chat-left-text me-1"></i>Tanggapan Admin
                    </div>
                    <div><?= nl2br(esc($return['catatan_admin'])) ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($return['status_return'] === 'revisi_desain' && $return['biaya_tambahan'] > 0): ?>
        <div class="card" style="border:1px solid rgba(255,193,7,0.3);background:rgba(255,193,7,0.03);">
            <div class="card-body small">
                <div class="fw-semibold mb-2" style="color:#b8860b;">
                    <i class="bi bi-cash-coin me-2"></i>Informasi Biaya Tambahan
                </div>
                <p class="text-muted mb-2">
                    Berdasarkan hasil verifikasi, masalah yang terjadi disebabkan oleh desain yang telah disetujui sebelumnya.
                    Proses revisi dan cetak ulang dikenakan biaya tambahan sebesar:
                </p>
                <div class="fs-5 fw-bold text-danger">Rp <?= number_format($return['biaya_tambahan'], 0, ',', '.') ?></div>
                <p class="text-muted mt-2 mb-0">
                    Silakan hubungi admin untuk konfirmasi pembayaran biaya tambahan sebelum proses cetak ulang dimulai.
                </p>
                <div class="mt-3">
                    <a href="https://wa.me/6282287900182?text=Halo, saya ingin konfirmasi biaya tambahan untuk retur pesanan <?= $return['no_pesanan'] ?>"
                        target="_blank" class="btn btn-sm btn-success">
                        <i class="bi bi-whatsapp me-1"></i>Konfirmasi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header fw-semibold">
                <i class="bi bi-clock-history me-2"></i>Alur Proses Retur
            </div>
            <div class="card-body">
                <?php
                $allSteps = [
                    ['key' => 'menunggu_verifikasi',  'label' => 'Menunggu Verifikasi', 'icon' => 'bi-hourglass-split', 'desc' => 'Pengajuan retur diterima sistem'],
                    ['key' => 'verifikasi_disetujui', 'label' => 'Retur Disetujui',      'icon' => 'bi-check-circle',    'desc' => 'Admin menyetujui keluhan'],
                    ['key' => 'proses_cetak_ulang',   'label' => 'Proses Cetak Ulang',  'icon' => 'bi-printer',         'desc' => 'Produk sedang dicetak ulang'],
                    ['key' => 'selesai',              'label' => 'Selesai',              'icon' => 'bi-bag-check',       'desc' => 'Hasil cetak diserahkan kembali'],
                ];

                $altSteps = [
                    ['key' => 'menunggu_verifikasi',  'label' => 'Menunggu Verifikasi', 'icon' => 'bi-hourglass-split', 'desc' => 'Pengajuan retur diterima sistem'],
                    ['key' => 'verifikasi_disetujui', 'label' => 'Retur Disetujui',      'icon' => 'bi-check-circle',    'desc' => 'Admin menyetujui keluhan'],
                    ['key' => 'revisi_desain',        'label' => 'Revisi Desain',        'icon' => 'bi-pencil-square',   'desc' => 'Menunggu konfirmasi biaya tambahan'],
                    ['key' => 'proses_cetak_ulang',   'label' => 'Proses Cetak Ulang',  'icon' => 'bi-printer',         'desc' => 'Produk sedang dicetak ulang'],
                    ['key' => 'selesai',              'label' => 'Selesai',              'icon' => 'bi-bag-check',       'desc' => 'Hasil cetak diserahkan kembali'],
                ];

                $currentStatus = $return['status_return'];
                $isDitolak     = $currentStatus === 'verifikasi_ditolak';
                $hasRevisi     = in_array($currentStatus, ['revisi_desain', 'proses_cetak_ulang', 'selesai']) && $return['tipe_revisi'] === 'revisi_desain';
                $steps         = $hasRevisi ? $altSteps : $allSteps;
                $stepKeys      = array_column($steps, 'key');
                $currentIdx    = array_search($currentStatus, $stepKeys);
                ?>

                <?php if ($isDitolak): ?>
                    <div class="text-center py-3">
                        <i class="bi bi-x-circle-fill text-danger fs-1 d-block mb-2"></i>
                        <div class="fw-semibold text-danger">Retur Ditolak</div>
                        <div class="small text-muted mt-1">
                            Keluhan tidak terbukti disebabkan oleh pihak percetakan
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($steps as $idx => $step): ?>
                    <?php $done   = $currentIdx !== false && $idx <= $currentIdx; ?>
                    <?php $active = $currentIdx !== false && $idx === $currentIdx; ?>
                    <div class="d-flex gap-3 mb-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:38px;height:38px;min-width:38px;
                                background:<?= $done ? '#1a1a2e' : '#f0f0f0' ?>;
                                color:<?= $done ? '#ffc107' : '#adb5bd' ?>;">
                                <?php if ($done && !$active): ?>
                                    <i class="bi bi-check2" style="font-size:1rem;"></i>
                                <?php else: ?>
                                    <i class="bi <?= $step['icon'] ?>" style="font-size:0.9rem;"></i>
                                <?php endif; ?>
                            </div>
                            <?php if ($idx < count($steps) - 1): ?>
                                <div style="width:2px;height:22px;background:<?= ($currentIdx !== false && $idx < $currentIdx) ? '#1a1a2e' : '#dee2e6' ?>;margin-top:2px;"></div>
                            <?php endif; ?>
                        </div>
                        <div class="pt-1">
                            <div class="small fw-semibold <?= $active ? 'text-primary' : ($done ? '' : 'text-muted') ?>">
                                <?= $step['label'] ?>
                                <?php if ($active): ?>
                                    <span class="badge bg-primary ms-1" style="font-size:0.6rem;">Sekarang</span>
                                <?php endif; ?>
                            </div>
                            <div class="text-muted" style="font-size:0.72rem;"><?= $step['desc'] ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
