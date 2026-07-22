<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Detail Pembelian</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pembelian') ?>">Pembelian</a></li>
            <li class="breadcrumb-item active"><?= $pembelian['no_pembelian'] ?></li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pembelian') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card" style="max-width:600px;">
    <div class="card-header"><i class="bi bi-bag-check me-2"></i><?= $pembelian['no_pembelian'] ?></div>
    <div class="card-body">
        <div class="row g-3 small">
            <div class="col-md-6">
                <div class="text-muted">No. Pembelian</div>
                <div class="fw-bold"><?= $pembelian['no_pembelian'] ?></div>
            </div>
            <div class="col-md-6">
                <div class="text-muted">Tanggal</div>
                <div class="fw-semibold"><?= date('d F Y', strtotime($pembelian['tgl_pembelian'])) ?></div>
            </div>
            <div class="col-md-6">
                <div class="text-muted">Supplier</div>
                <div class="fw-semibold"><?= $pembelian['nama_supplier'] ?? '-' ?></div>
            </div>
            <div class="col-md-6">
                <div class="text-muted">Bahan / Material</div>
                <div class="fw-semibold"><?= $pembelian['nama_bahan'] ?? '-' ?> <span class="text-muted fw-normal">(<?= $pembelian['satuan'] ?? '' ?>)</span></div>
            </div>
            <div class="col-md-4">
                <div class="text-muted">Jumlah</div>
                <div class="fw-bold text-primary"><?= number_format($pembelian['jumlah'], 0, ',', '.') ?> <?= $pembelian['satuan'] ?? '' ?></div>
            </div>
            <div class="col-md-4">
                <div class="text-muted">Harga Satuan</div>
                <div>Rp <?= number_format($pembelian['harga_satuan'], 0, ',', '.') ?></div>
            </div>
            <div class="col-md-4">
                <div class="text-muted">Total Harga</div>
                <div class="fw-bold text-success">Rp <?= number_format($pembelian['total_harga'], 0, ',', '.') ?></div>
            </div>
            <?php if ($pembelian['keterangan']): ?>
            <div class="col-12">
                <div class="text-muted">Keterangan</div>
                <div><?= esc($pembelian['keterangan']) ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
