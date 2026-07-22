<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="landingNavbar">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-5" href="<?= base_url('/') ?>">
            <i class="bi bi-printer-fill text-warning"></i>
            Anugrah Jaya
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navLanding">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navLanding">
            <ul class="navbar-nav mx-auto gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/') ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#layanan">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#keunggulan">Keunggulan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li>
            </ul>

            <div class="d-flex gap-2 mt-3 mt-lg-0">
                <?php if (session()->get('logged_in')): ?>
                    <?php
                    $level     = session('level');
                    $dashUrl   = ($level === 'pelanggan') ? 'pelanggan/dashboard' : 'admin/dashboard';
                    ?>
                    <a href="<?= base_url($dashUrl) ?>" class="btn btn-warning btn-sm px-3 fw-semibold">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-light btn-sm px-3">
                        <i class="bi bi-box-arrow-left me-1"></i>Logout
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light btn-sm px-3">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                    <a href="<?= base_url('auth/register') ?>" class="btn btn-warning btn-sm px-3 fw-semibold">
                        <i class="bi bi-person-plus me-1"></i>Daftar
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</nav>
