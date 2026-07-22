<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Retur / Revisi</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/return') ?>">Retur</a></li>
            <li class="breadcrumb-item active"><?= $return['no_pesanan'] ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/return') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">

    <div class="col-lg-7">

        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-arrow-return-left me-2"></i>Detail Pengajuan</span>
                <?= view('layouts/partials/badge_status', ['status' => $return['status_return']]) ?>
            </div>
            <div class="card-body">
                <div class="row g-3 small">
                    <div class="col-md-6">
                        <div class="text-muted">No. Pesanan</div>
                        <div class="fw-bold"><?= $return['no_pesanan'] ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Pelanggan</div>
                        <div class="fw-semibold"><?= $return['nama_pelanggan'] ?? '-' ?></div>
                        <div class="text-muted"><?= $return['no_hp'] ?? '' ?></div>
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
                        <div>Rp <?= number_format($return['total_harga'] ?? 0, 0, ',', '.') ?></div>
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
                        <div class="fw-bold text-danger">Rp <?= number_format($return['biaya_tambahan'], 0, ',', '.') ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="col-12">
                        <div class="text-muted mb-1">Deskripsi Keluhan</div>
                        <div class="p-3 rounded-3 small" style="background:#f8f9fa;border:1px solid #e9ecef;line-height:1.7;">
                            <?= nl2br(esc($return['alasan'])) ?>
                        </div>
                    </div>
                </div>

                <?php if ($return['foto_bukti']): ?>
                <div class="mt-3">
                    <div class="text-muted small mb-2">Foto Bukti dari Pelanggan</div>
                    <a href="<?= base_url('uploads/return/' . $return['foto_bukti']) ?>" target="_blank">
                        <img src="<?= base_url('uploads/return/' . $return['foto_bukti']) ?>"
                            class="img-thumbnail" style="max-height:220px;" alt="Foto Bukti">
                    </a>
                </div>
                <?php endif; ?>

                <?php if ($return['catatan_admin']): ?>
                <div class="mt-3 p-3 rounded-3 small" style="background:rgba(13,110,253,0.05);border:1px solid rgba(13,110,253,0.15);">
                    <div class="fw-semibold mb-1 text-primary">
                        <i class="bi bi-chat-left-text me-1"></i>Catatan Admin Sebelumnya
                    </div>
                    <div><?= nl2br(esc($return['catatan_admin'])) ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card" style="border:1px solid rgba(26,26,46,0.12);background:rgba(26,26,46,0.02);">
            <div class="card-header fw-semibold small" style="background:rgba(26,26,46,0.04);">
                <i class="bi bi-info-circle me-2 text-primary"></i>Panduan Penanganan Retur
            </div>
            <div class="card-body small text-muted">
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="p-2 rounded-2" style="background:rgba(40,167,69,0.08);border:1px solid rgba(40,167,69,0.15);">
                            <div class="fw-semibold text-success mb-1">Kesalahan Percetakan</div>
                            <div>Pilih <strong>Cetak Ulang</strong> → biaya ditanggung percetakan</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-2 rounded-2" style="background:rgba(255,193,7,0.08);border:1px solid rgba(255,193,7,0.2);">
                            <div class="fw-semibold" style="color:#b8860b;">Kesalahan Desain Pelanggan</div>
                            <div>Pilih <strong>Revisi Desain</strong> → isi biaya tambahan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-5">

        <?php
        $statusSelesai   = ['selesai', 'verifikasi_ditolak'];
        $bisaProses      = !in_array($return['status_return'], $statusSelesai);
        ?>

        <?php if ($bisaProses): ?>
        <div class="card mb-3">
            <div class="card-header fw-semibold">
                <i class="bi bi-gear me-2"></i>Proses Retur
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/return/proses/' . $return['id_return']) ?>" method="POST" id="formProses">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Update Status <span class="text-danger">*</span></label>
                        <select name="status_return" class="form-select" id="selectStatus" required>
                            <option value="">-- Pilih Status --</option>
                            <?php
                            $opsiStatus = [
                                'menunggu_verifikasi'  => 'Menunggu Verifikasi',
                                'verifikasi_disetujui' => 'Retur Disetujui (Lanjut Proses)',
                                'verifikasi_ditolak'   => 'Retur Ditolak',
                                'proses_cetak_ulang'   => 'Proses Cetak Ulang (Gratis)',
                                'revisi_desain'        => 'Revisi Desain (Biaya Tambahan)',
                                'selesai'              => 'Selesai — Hasil Diserahkan ke Pelanggan',
                            ];
                            foreach ($opsiStatus as $val => $lbl):
                                $disabled = ($val === $return['status_return']) ? 'disabled' : '';
                            ?>
                            <option value="<?= $val ?>" <?= $disabled ?> <?= $return['status_return'] === $val ? 'selected' : '' ?>>
                                <?= $lbl ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3 d-none" id="wrapperBiaya">
                        <label class="form-label small fw-semibold">
                            Biaya Tambahan (Rp) <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="biaya_tambahan" class="form-control"
                            value="<?= $return['biaya_tambahan'] ?? 0 ?>"
                            min="0" step="1000" placeholder="0">
                        <div class="form-text text-warning">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Isi jika kesalahan dari desain yang sudah disetujui pelanggan
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold">Catatan untuk Pelanggan</label>
                        <textarea name="catatan_admin" class="form-control" rows="4"
                            placeholder="Jelaskan hasil verifikasi, alasan keputusan, atau langkah selanjutnya..."><?= esc($return['catatan_admin'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i>Simpan & Update Status
                    </button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <div class="card mb-3" style="border:1px solid rgba(40,167,69,0.2);">
            <div class="card-body text-center py-4">
                <i class="bi bi-check-circle-fill text-success fs-2 d-block mb-2"></i>
                <div class="fw-semibold"><?= $labelStatus[$return['status_return']] ?? '' ?></div>
                <div class="small text-muted mt-1">Proses retur sudah selesai</div>
            </div>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header fw-semibold">
                <i class="bi bi-clock-history me-2"></i>Alur Proses
            </div>
            <div class="card-body">
                <?php
                $allSteps = [
                    ['key' => 'menunggu_verifikasi',  'label' => 'Menunggu Verifikasi', 'icon' => 'bi-hourglass-split'],
                    ['key' => 'verifikasi_disetujui', 'label' => 'Retur Disetujui',      'icon' => 'bi-check-circle'],
                    ['key' => 'proses_cetak_ulang',   'label' => 'Proses Cetak Ulang',  'icon' => 'bi-printer'],
                    ['key' => 'selesai',              'label' => 'Selesai',              'icon' => 'bi-bag-check'],
                ];
                $altSteps = [
                    ['key' => 'menunggu_verifikasi',  'label' => 'Menunggu Verifikasi', 'icon' => 'bi-hourglass-split'],
                    ['key' => 'verifikasi_disetujui', 'label' => 'Retur Disetujui',      'icon' => 'bi-check-circle'],
                    ['key' => 'revisi_desain',        'label' => 'Revisi Desain',        'icon' => 'bi-pencil-square'],
                    ['key' => 'proses_cetak_ulang',   'label' => 'Proses Cetak Ulang',  'icon' => 'bi-printer'],
                    ['key' => 'selesai',              'label' => 'Selesai',              'icon' => 'bi-bag-check'],
                ];

                $currentStatus = $return['status_return'];
                $isDitolak     = $currentStatus === 'verifikasi_ditolak';
                $hasRevisi     = in_array($currentStatus, ['revisi_desain', 'proses_cetak_ulang', 'selesai']) && $return['tipe_revisi'] === 'revisi_desain';
                $steps         = $hasRevisi ? $altSteps : $allSteps;
                $stepKeys      = array_column($steps, 'key');
                $currentIdx    = array_search($currentStatus, $stepKeys);
                ?>

                <?php if ($isDitolak): ?>
                    <div class="text-center py-2">
                        <i class="bi bi-x-circle-fill text-danger fs-2 d-block mb-2"></i>
                        <div class="fw-semibold text-danger">Retur Ditolak</div>
                        <div class="small text-muted">Keluhan tidak terbukti dari pihak percetakan</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($steps as $idx => $step): ?>
                    <?php $done   = $currentIdx !== false && $idx <= $currentIdx; ?>
                    <?php $active = $currentIdx !== false && $idx === $currentIdx; ?>
                    <div class="d-flex gap-3 mb-2">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:34px;height:34px;min-width:34px;
                                background:<?= $done ? '#1a1a2e' : '#f0f0f0' ?>;
                                color:<?= $done ? '#ffc107' : '#adb5bd' ?>;">
                                <?php if ($done && !$active): ?>
                                    <i class="bi bi-check2" style="font-size:0.9rem;"></i>
                                <?php else: ?>
                                    <i class="bi <?= $step['icon'] ?>" style="font-size:0.85rem;"></i>
                                <?php endif; ?>
                            </div>
                            <?php if ($idx < count($steps) - 1): ?>
                                <div style="width:2px;height:18px;background:<?= ($currentIdx !== false && $idx < $currentIdx) ? '#1a1a2e' : '#dee2e6' ?>;margin-top:2px;"></div>
                            <?php endif; ?>
                        </div>
                        <div class="pt-1">
                            <div class="small fw-semibold <?= $active ? 'text-primary' : ($done ? '' : 'text-muted') ?>">
                                <?= $step['label'] ?>
                                <?php if ($active): ?>
                                    <span class="badge bg-primary ms-1" style="font-size:0.6rem;">Sekarang</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.getElementById('selectStatus')?.addEventListener('change', function() {
        const wrapper = document.getElementById('wrapperBiaya');
        if (this.value === 'revisi_desain') {
            wrapper.classList.remove('d-none');
        } else {
            wrapper.classList.add('d-none');
        }
    });

    <?php if ($return['status_return'] === 'revisi_desain'): ?>
    document.getElementById('wrapperBiaya')?.classList.remove('d-none');
    <?php endif; ?>
</script>
<?= $this->endSection() ?>
