<?php $level = session('level'); ?>

<div class="sidebar d-flex flex-column" id="sidebar">

    <div class="sidebar-brand d-flex align-items-center gap-3 py-4 px-3">
        <div class="brand-logo">
            <i class="bi bi-printer-fill"></i>
        </div>
        <div>
            <div class="brand-text">AJDP</div>
            <div class="brand-sub"><?= $level === 'pimpinan' ? 'Pimpinan' : 'Admin Panel' ?></div>
        </div>
    </div>

    <nav class="sidebar-nav flex-grow-1 px-3">

        <?php if ($level === 'admin'): ?>

        <div class="nav-label small text-uppercase mb-2">Menu Utama</div>

        <a href="<?= base_url('admin/dashboard') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (uri_string() === 'admin/dashboard') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <div class="nav-label small text-uppercase mt-3 mb-2">Master Data</div>

        <a href="<?= base_url('admin/layanan') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/layanan') !== false) ? 'active' : '' ?>">
            <i class="bi bi-grid-3x3-gap"></i>
            <span>Data Layanan</span>
        </a>

        <a href="<?= base_url('admin/bahan') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/bahan') !== false) ? 'active' : '' ?>">
            <i class="bi bi-box-seam"></i>
            <span>Data Bahan/Material</span>
        </a>

        <a href="<?= base_url('admin/pelanggan') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/pelanggan') !== false) ? 'active' : '' ?>">
            <i class="bi bi-people"></i>
            <span>Data Pelanggan</span>
        </a>

        <a href="<?= base_url('admin/supplier') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/supplier') !== false) ? 'active' : '' ?>">
            <i class="bi bi-truck"></i>
            <span>Data Supplier</span>
        </a>

        <div class="nav-label small text-uppercase mt-3 mb-2">Transaksi</div>

        <a href="<?= base_url('admin/pembelian') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/pembelian') !== false) ? 'active' : '' ?>">
            <i class="bi bi-bag-check"></i>
            <span>Pembelian Bahan</span>
        </a>

        <a href="<?= base_url('admin/pesanan') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/pesanan') !== false) ? 'active' : '' ?>">
            <i class="bi bi-cart3"></i>
            <span>Pesanan</span>
        </a>

        <a href="<?= base_url('admin/pembayaran') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/pembayaran') !== false) ? 'active' : '' ?>">
            <i class="bi bi-credit-card"></i>
            <span>Konfirmasi Pembayaran</span>
        </a>

        <?php endif; ?>

        <div class="nav-label small text-uppercase mt-3 mb-2">Laporan</div>

        <a href="<?= base_url('admin/laporan') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/laporan') !== false) ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-bar-graph"></i>
            <span>Laporan</span>
        </a>

        <?php if ($level === 'admin'): ?>
        <div class="nav-label small text-uppercase mt-3 mb-2">Lainnya</div>
        <a href="<?= base_url('admin/return') ?>"
            class="nav-item d-flex align-items-center gap-2 <?= (strpos(uri_string(), 'admin/return') !== false) ? 'active' : '' ?>">
            <i class="bi bi-arrow-return-left"></i>
            <span>Return Pesanan</span>
        </a>
        <?php endif; ?>

    </nav>

    <div class="sidebar-footer px-3 py-3">
        <a href="<?= base_url('auth/logout') ?>" class="nav-item d-flex align-items-center gap-2 text-danger">
            <i class="bi bi-box-arrow-left"></i>
            <span>Logout</span>
        </a>
    </div>

</div>
