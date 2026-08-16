<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="page-title mb-0">Detail Status Pesanan</h4>
    <a href="<?= base_url('pelanggan/status') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">

    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-receipt me-2"></i><?= $pesanan['no_pesanan'] ?></span>
                <?= view('layouts/partials/badge_status', ['status' => $pesanan['status_pesanan']]) ?>
            </div>
            <div class="card-body">
                <div class="row g-2 small">
                    <div class="col-md-6">
                        <div class="text-muted">Tanggal Pesanan</div>
                        <div class="fw-semibold"><?= date('d F Y', strtotime($pesanan['tgl_pesanan'])) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Estimasi Selesai</div>
                        <div class="fw-semibold"><?= $pesanan['tgl_selesai'] ? date('d F Y', strtotime($pesanan['tgl_selesai'])) : '-' ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Status Pembayaran</div>
                        <div><?= view('layouts/partials/badge_status', ['status' => $pesanan['status_bayar']]) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Total Harga</div>
                        <div class="fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></div>
                    </div>
                    <?php if ($pesanan['catatan']): ?>
                    <div class="col-12">
                        <div class="text-muted">Catatan</div>
                        <div><?= $pesanan['catatan'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><i class="bi bi-list-ul me-2"></i>Item Pesanan</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Layanan</th>
                                <th>Ukuran</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Desain</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $d): ?>
                            <tr>
                                <td>
                                    <div class="fw-semibold small"><?= $d['nama_layanan'] ?? $d['kode_layanan'] ?></div>
                                    <?php if ($d['desain_sendiri']): ?>
                                        <span class="badge bg-info" style="font-size:0.6rem;">Desain Sendiri</span>
                                    <?php endif; ?>
                                    <?php if ($d['keterangan']): ?>
                                        <div class="text-muted" style="font-size:0.75rem;"><?= $d['keterangan'] ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="small"><?= $d['ukuran'] ?? '-' ?></td>
                                <td><?= $d['qty'] ?></td>
                                <td class="small fw-semibold">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if (!empty($d['file_desain'])): ?>
                                        <a href="<?= base_url($d['file_desain']) ?>" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size:0.7rem;">
                                            <i class="bi bi-file-earmark me-1"></i>Lihat
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total</td>
                                <td class="fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <?php if ($pembayaran): ?>
        <div class="card">
            <div class="card-header"><i class="bi bi-credit-card me-2"></i>Informasi Pembayaran</div>
            <div class="card-body small">
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="text-muted">Tgl Pembayaran</div>
                        <div><?= date('d F Y', strtotime($pembayaran['tgl_pembayaran'])) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Metode</div>
                        <div><?= $pembayaran['metode_bayar'] ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Jumlah Dibayar</div>
                        <div class="fw-bold text-success">Rp <?= number_format($pembayaran['jumlah_bayar'], 0, ',', '.') ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Status Konfirmasi</div>
                        <div><?= view('layouts/partials/badge_status', ['status' => $pembayaran['status_konfirmasi']]) ?></div>
                    </div>
                    <?php if ($pembayaran['catatan_admin']): ?>
                    <div class="col-12">
                        <div class="text-muted">Catatan Admin</div>
                        <div class="alert alert-info py-2 mb-0 small"><?= $pembayaran['catatan_admin'] ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($pesanan['status_bayar'] === 'sudah bayar' || $pesanan['status_pesanan'] === 'selesai'): ?>
        <div class="card mt-3 border-success">
            <div class="card-header bg-success text-white"><i class="bi bi-receipt-cutoff me-2"></i>Faktur Pembayaran</div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <h5 class="fw-bold mb-0">Anugrah Jaya Digital Printing</h5>
                    <div class="small text-muted">Cetak Digital & Percetakan</div>
                    <div class="small text-muted">Telp: 0822 8790 0182 | Budi: 0352 8766 0078</div>
                </div>
                <hr>
                <div class="row g-2 small mb-3">
                    <div class="col-6">
                        <div class="text-muted">No. Pesanan</div>
                        <div class="fw-bold"><?= $pesanan['no_pesanan'] ?></div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted">Tanggal</div>
                        <div><?= date('d F Y', strtotime($pesanan['tgl_pesanan'])) ?></div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted">Pelanggan</div>
                        <div class="fw-semibold"><?= $pesanan['nama_pelanggan'] ?? '-' ?></div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted">Status</div>
                        <div class="badge bg-success">Lunas</div>
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table table-sm table-bordered mb-0 small">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $d): ?>
                            <tr>
                                <td>
                                    <?= $d['nama_layanan'] ?? $d['kode_layanan'] ?>
                                    <?php if ($d['ukuran']): ?>
                                        <br><span class="text-muted"><?= $d['ukuran'] ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?= $d['qty'] ?></td>
                                <td class="text-end">Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                                <td class="text-end fw-semibold">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="3" class="text-end fw-bold">Total</td>
                                <td class="text-end fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-center small text-muted">
                    Terima kasih atas kepercayaan Anda 🙏
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><i class="bi bi-clock-history me-2"></i>Alur Status Pesanan</div>
            <div class="card-body">
                <?php
                $steps = [
                    ['key' => 'menunggu',  'label' => 'Pesanan Diterima',  'icon' => 'bi-cart-check',    'desc' => 'Pesanan Anda telah masuk ke sistem'],
                    ['key' => 'diproses',  'label' => 'Sedang Diproses',   'icon' => 'bi-gear',          'desc' => 'Pesanan sedang dalam proses produksi'],
                    ['key' => 'selesai',   'label' => 'Selesai',           'icon' => 'bi-check-circle',  'desc' => 'Pesanan siap diambil / dikirim'],
                ];
                $current = $pesanan['status_pesanan'];
                $currentIdx = array_search($current, array_column($steps, 'key'));
                $isBatal = $current === 'dibatalkan';
                ?>

                <?php if ($isBatal): ?>
                    <div class="text-center py-3">
                        <i class="bi bi-x-circle-fill text-danger fs-1 d-block mb-2"></i>
                        <div class="fw-semibold text-danger">Pesanan Dibatalkan</div>
                        <div class="small text-muted mt-1">Hubungi kami untuk informasi lebih lanjut</div>
                    </div>
                <?php else: ?>
                    <?php foreach ($steps as $idx => $step): ?>
                    <?php $done   = $currentIdx !== false && $idx <= $currentIdx; ?>
                    <?php $active = $currentIdx !== false && $idx === $currentIdx; ?>
                    <div class="d-flex gap-3 mb-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width:40px;height:40px;min-width:40px;
                                background:<?= $done ? '#1a1a2e' : '#f0f0f0' ?>;
                                color:<?= $done ? '#ffc107' : '#adb5bd' ?>;">
                                <i class="bi <?= $step['icon'] ?>"></i>
                            </div>
                            <?php if ($idx < count($steps) - 1): ?>
                                <div style="width:2px;height:30px;background:<?= ($currentIdx !== false && $idx < $currentIdx) ? '#1a1a2e' : '#dee2e6' ?>;margin-top:4px;"></div>
                            <?php endif; ?>
                        </div>
                        <div class="pt-1">
                            <div class="small fw-semibold <?= $active ? 'text-primary' : ($done ? '' : 'text-muted') ?>">
                                <?= $step['label'] ?>
                                <?php if ($active): ?>
                                    <span class="badge bg-primary ms-1" style="font-size:0.65rem;">Sekarang</span>
                                <?php endif; ?>
                            </div>
                            <div class="text-muted" style="font-size:0.75rem;"><?= $step['desc'] ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($pesanan['status_bayar'] === 'belum bayar' && !$isBatal): ?>
        <div class="card mt-3 border-warning">
            <div class="card-body text-center py-3">
                <i class="bi bi-credit-card text-warning fs-3 d-block mb-2"></i>
                <div class="small fw-semibold mb-1">Menunggu Konfirmasi Pembayaran</div>
                <div class="text-muted" style="font-size:0.75rem;">Admin akan segera mengkonfirmasi pembayaran, mohon tunggu sejenak</div>
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>
