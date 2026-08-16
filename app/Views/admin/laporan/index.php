<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="mb-4">
    <h4 class="page-title mb-0">Laporan</h4>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small"><li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Laporan</li></ol></nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-3"><i class="bi bi-cart3 fs-1 text-primary"></i></div>
            <h6 class="fw-bold">Laporan Pesanan</h6>
            <p class="text-muted small">Laporan data pesanan berdasarkan periode waktu</p>
            <a href="<?= base_url('admin/laporan/pesanan') ?>" class="btn btn-primary btn-sm mt-auto">
                <i class="bi bi-eye me-1"></i>Lihat Laporan
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-3"><i class="bi bi-box-seam fs-1 text-warning"></i></div>
            <h6 class="fw-bold">Laporan Stok Bahan</h6>
            <p class="text-muted small">Laporan kondisi stok bahan/material saat ini</p>
            <a href="<?= base_url('admin/laporan/bahan') ?>" class="btn btn-warning btn-sm mt-auto">
                <i class="bi bi-eye me-1"></i>Lihat Laporan
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-3"><i class="bi bi-scissors fs-1 text-danger"></i></div>
            <h6 class="fw-bold">Laporan Bahan Terpakai</h6>
            <p class="text-muted small">Laporan penggunaan bahan dari pesanan & transaksi cetak per periode</p>
            <a href="<?= base_url('admin/laporan/bahan-terpakai') ?>" class="btn btn-danger btn-sm mt-auto">
                <i class="bi bi-eye me-1"></i>Lihat Laporan
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-3"><i class="bi bi-cash-stack fs-1 text-success"></i></div>
            <h6 class="fw-bold">Laporan Keuangan</h6>
            <p class="text-muted small">Laporan pendapatan dan transaksi pembayaran</p>
            <a href="<?= base_url('admin/laporan/keuangan') ?>" class="btn btn-success btn-sm mt-auto">
                <i class="bi bi-eye me-1"></i>Lihat Laporan
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-3"><i class="bi bi-calendar3 fs-1 text-info"></i></div>
            <h6 class="fw-bold">Laporan Pertahun</h6>
            <p class="text-muted small">Ringkasan pendapatan, pengeluaran, dan pesanan per bulan dalam satu tahun</p>
            <a href="<?= base_url('admin/laporan/pertahun') ?>" class="btn btn-info btn-sm mt-auto">
                <i class="bi bi-eye me-1"></i>Lihat Laporan
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-3"><i class="bi bi-truck fs-1" style="color:#6f42c1;"></i></div>
            <h6 class="fw-bold">Laporan Supplier</h6>
            <p class="text-muted small">Ringkasan data supplier dan riwayat pembelian bahan</p>
            <a href="<?= base_url('admin/laporan/supplier') ?>" class="btn btn-sm mt-auto" style="background:#6f42c1;color:#fff;">
                <i class="bi bi-eye me-1"></i>Lihat Laporan
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 text-center p-4">
            <div class="mb-3"><i class="bi bi-people fs-1 text-secondary"></i></div>
            <h6 class="fw-bold">Laporan Konsumen</h6>
            <p class="text-muted small">Data konsumen beserta ringkasan total pesanan dan nilai transaksi</p>
            <a href="<?= base_url('admin/laporan/konsumen') ?>" class="btn btn-secondary btn-sm mt-auto">
                <i class="bi bi-eye me-1"></i>Lihat Laporan
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
