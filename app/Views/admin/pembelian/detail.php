<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Pembelian</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pembelian') ?>">Pembelian</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pembelian') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header fw-semibold"><i class="bi bi-info-circle me-2"></i>Informasi Pembelian</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%;">Tanggal</td>
                        <td class="fw-semibold"><?= date('d F Y', strtotime($pembelian['tgl_pembelian'])) ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Supplier</td>
                        <td class="fw-semibold"><?= esc($supplier['nama_supplier'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Bahan</td>
                        <td class="fw-semibold"><?= esc($bahan['nama_bahan'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jumlah</td>
                        <td class="fw-semibold"><?= $pembelian['jumlah'] ?> <?= esc($bahan['satuan'] ?? '') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Harga Total</td>
                        <td class="fw-bold" style="color:#28a745;">Rp <?= number_format($pembelian['harga_total'], 0, ',', '.') ?></td>
                    </tr>
                    <?php if ($pembelian['catatan']): ?>
                    <tr>
                        <td class="text-muted">Catatan</td>
                        <td><?= esc($pembelian['catatan']) ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
