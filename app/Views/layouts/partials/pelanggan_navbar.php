<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#1a1a2e;">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="<?= base_url('/') ?>">
            <i class="bi bi-printer-fill fs-5"></i>
            Anugrah Jaya
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPelanggan">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navPelanggan">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == 'pelanggan/dashboard') ? 'active fw-semibold' : '' ?>" href="<?= base_url('pelanggan/dashboard') ?>">
                        <i class="bi bi-house me-1"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (strpos(uri_string(), 'pelanggan/pesanan') !== false) ? 'active fw-semibold' : '' ?>" href="<?= base_url('pelanggan/pesanan') ?>">
                        <i class="bi bi-cart3 me-1"></i>Pesanan Saya
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (strpos(uri_string(), 'pelanggan/pembayaran') !== false) ? 'active fw-semibold' : '' ?>" href="<?= base_url('pelanggan/pembayaran') ?>">
                        <i class="bi bi-credit-card me-1"></i>Pembayaran
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (strpos(uri_string(), 'pelanggan/status') !== false) ? 'active fw-semibold' : '' ?>" href="<?= base_url('pelanggan/status') ?>">
                        <i class="bi bi-clock-history me-1"></i>Status Pesanan
                    </a>
                </li>

                <li class="nav-item ms-lg-2">
                    <div class="dropdown">
                        <button class="btn btn-outline-light btn-sm d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            <span><?= session('nama_lengkap') ?? 'Konsumen' ?></span>
                            <i class="bi bi-chevron-down small"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="bi bi-box-arrow-left me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</nav>
