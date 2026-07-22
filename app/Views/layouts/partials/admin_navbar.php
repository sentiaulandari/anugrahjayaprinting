<?php
use App\Models\PesananModel;
use App\Models\PembayaranModel;
use App\Models\BahanModel;

$pesananModel    = new PesananModel();
$pembayaranModel = new PembayaranModel();
$bahanModel      = new BahanModel();

$jmlMenunggu     = $pesananModel->where('status_pesanan', 'menunggu')->countAllResults();
$jmlKonfirmasi   = count($pembayaranModel->getMenungguKonfirmasi());
$jmlStokMenurun  = count($bahanModel->getStokMenurun());
$totalNotif      = $jmlMenunggu + $jmlKonfirmasi + $jmlStokMenurun;
?>

<nav class="admin-navbar d-flex align-items-center justify-content-between px-4">

    <button class="btn btn-sm btn-light" id="sidebarToggle">
        <i class="bi bi-list fs-5"></i>
    </button>

    <div class="d-flex align-items-center gap-3">

        <?php if ($totalNotif > 0): ?>
        <div class="dropdown">
            <button class="btn btn-sm btn-light position-relative" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-bell fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">
                    <?= $totalNotif ?>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="min-width:260px;">
                <li><h6 class="dropdown-header">Notifikasi</h6></li>

                <?php if ($jmlMenunggu > 0): ?>
                <li>
                    <a class="dropdown-item small d-flex align-items-center gap-2" href="<?= base_url('admin/pesanan') ?>">
                        <span class="badge bg-warning text-dark"><?= $jmlMenunggu ?></span>
                        Pesanan menunggu konfirmasi
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($jmlKonfirmasi > 0): ?>
                <li>
                    <a class="dropdown-item small d-flex align-items-center gap-2" href="<?= base_url('admin/pembayaran') ?>">
                        <span class="badge bg-info text-dark"><?= $jmlKonfirmasi ?></span>
                        Pembayaran menunggu verifikasi
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($jmlStokMenurun > 0): ?>
                <li>
                    <a class="dropdown-item small d-flex align-items-center gap-2" href="<?= base_url('admin/bahan') ?>">
                        <span class="badge bg-danger"><?= $jmlStokMenurun ?></span>
                        Stok bahan menipis
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </div>
        <?php else: ?>
        <button class="btn btn-sm btn-light" disabled>
            <i class="bi bi-bell fs-5"></i>
        </button>
        <?php endif; ?>

        <div class="dropdown">
            <button class="btn btn-sm d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                <div class="avatar-circle">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="text-start">
                    <div class="small fw-semibold lh-1"><?= session('nama_lengkap') ?? 'Admin' ?></div>
                    <div style="font-size:0.7rem;" class="text-muted text-capitalize"><?= session('level') ?? 'admin' ?></div>
                </div>
                <i class="bi bi-chevron-down small"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><h6 class="dropdown-header text-capitalize"><?= session('level') ?? 'admin' ?></h6></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>">
                        <i class="bi bi-box-arrow-left me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>

    </div>

</nav>
