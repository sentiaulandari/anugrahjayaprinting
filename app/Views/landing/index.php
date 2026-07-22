<?= $this->extend('layouts/landing_layout') ?>
<?= $this->section('content') ?>

<section id="beranda" class="hero-section d-flex align-items-center">
    <div class="container position-relative" style="z-index:2;">
        <div class="row align-items-center g-5 py-5">

            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="bi bi-patch-check-fill"></i>
                    Jasa Cetak Digital Terpercaya Sejak 2019
                </div>
                <h1 class="hero-title">
                    Cetak Apapun,<br>
                    <span class="accent-text">Hasil Terbaik</span>
                </h1>
                <p class="hero-desc mb-4">
                    Anugrah Jaya Digital Printing — solusi cetak indoor & outdoor berkualitas tinggi.
                    Spanduk, baliho, brosur, kartu nama, dan 20+ layanan lainnya.
                </p>

                <div class="d-flex gap-3 flex-wrap mb-5">
                    <?php if (session()->get('logged_in')): ?>
                        <a href="<?= base_url(session('level') === 'pelanggan' ? 'pelanggan/pesanan/create' : 'admin/dashboard') ?>"
                            class="hero-btn-primary">
                            <i class="bi bi-cart-plus"></i>Pesan Sekarang
                        </a>
                        <a href="<?= base_url(session('level') === 'pelanggan' ? 'pelanggan/dashboard' : 'admin/dashboard') ?>"
                            class="hero-btn-secondary">
                            <i class="bi bi-speedometer2"></i>Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('auth/register') ?>" class="hero-btn-primary">
                            <i class="bi bi-cart-plus"></i>Pesan Sekarang
                        </a>
                        <a href="<?= base_url('auth/login') ?>" class="hero-btn-secondary">
                            <i class="bi bi-box-arrow-in-right"></i>Masuk
                        </a>
                    <?php endif; ?>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <div class="hero-stat-pill">
                        <i class="bi bi-people-fill"></i>500+ Pelanggan
                    </div>
                    <div class="hero-stat-pill">
                        <i class="bi bi-check-circle-fill"></i>1000+ Pesanan
                    </div>
                    <div class="hero-stat-pill">
                        <i class="bi bi-star-fill"></i>Rating 4.9
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-visual text-center">
                    <div class="hero-card-float mx-auto" style="max-width:340px;">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width:44px;height:44px;background:linear-gradient(135deg,#ffc107,#ff9800);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-printer-fill text-dark fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-white" style="font-size:0.9rem;">Anugrah Jaya DP</div>
                                <div style="font-size:0.72rem;color:rgba(255,255,255,0.5);">Digital Printing</div>
                            </div>
                            <span class="ms-auto badge" style="background:rgba(40,167,69,0.2);color:#4ade80;font-size:0.65rem;">Online</span>
                        </div>

                        <div class="mb-3">
                            <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);margin-bottom:0.5rem;">Layanan Populer</div>
                            <?php
                            $preview = array_slice($layanan, 0, 3);
                            $previewDefault = [
                                ['nama_layanan' => 'Spanduk', 'harga_satuan' => 15000],
                                ['nama_layanan' => 'Brosur', 'harga_satuan' => 500],
                                ['nama_layanan' => 'Kartu Nama', 'harga_satuan' => 25000],
                            ];
                            $items = !empty($preview) ? $preview : $previewDefault;
                            ?>
                            <?php foreach ($items as $item): ?>
                            <div class="d-flex align-items-center justify-content-between py-2" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:6px;height:6px;background:#ffc107;border-radius:50%;"></div>
                                    <span style="font-size:0.82rem;color:rgba(255,255,255,0.8);"><?= $item['nama_layanan'] ?></span>
                                </div>
                                <span style="font-size:0.78rem;color:#ffc107;font-weight:600;">
                                    Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?>
                                </span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <a href="<?= base_url('auth/register') ?>" style="display:block;background:linear-gradient(135deg,#ffc107,#ff9800);color:#1a1a2e;text-align:center;padding:0.65rem;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;">
                            Pesan Sekarang →
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="position:absolute;bottom:0;left:0;right:0;height:80px;background:linear-gradient(to bottom,transparent,#fff);pointer-events:none;"></div>
</section>

<section class="stats-section">
    <div class="container">
        <div class="row g-0">
            <?php
            $stats = [
                ['num' => '500+',  'lbl' => 'Pelanggan Puas',   'icon' => 'bi-people-fill'],
                ['num' => '1000+', 'lbl' => 'Pesanan Selesai',  'icon' => 'bi-check-circle-fill'],
                ['num' => count($layanan) . '+', 'lbl' => 'Jenis Layanan', 'icon' => 'bi-grid-fill'],
                ['num' => '5+',    'lbl' => 'Tahun Pengalaman', 'icon' => 'bi-award-fill'],
            ];
            ?>
            <?php foreach ($stats as $s): ?>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number"><?= $s['num'] ?></div>
                    <div class="stat-label">
                        <i class="bi <?= $s['icon'] ?> me-1"></i><?= $s['lbl'] ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="layanan" class="py-5 py-lg-6" style="background:#f8f9fc;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-badge">Layanan Kami</div>
            <h2 class="section-title">Apa yang Kami Tawarkan?</h2>
            <p class="text-muted" style="max-width:500px;margin:0 auto;">Berbagai layanan cetak digital berkualitas tinggi untuk semua kebutuhan Anda</p>
        </div>

        <div class="row g-4">
            <?php
            $iconWraps = [
                ['bg' => 'rgba(26,26,46,0.08)',   'color' => '#1a1a2e'],
                ['bg' => 'rgba(40,167,69,0.1)',    'color' => '#28a745'],
                ['bg' => 'rgba(255,193,7,0.12)',   'color' => '#b8860b'],
                ['bg' => 'rgba(220,53,69,0.1)',    'color' => '#dc3545'],
                ['bg' => 'rgba(13,202,240,0.1)',   'color' => '#0dcaf0'],
                ['bg' => 'rgba(111,66,193,0.1)',   'color' => '#6f42c1'],
            ];
            $icons = ['bi-image','bi-file-earmark-text','bi-credit-card-2-front','bi-sticker','bi-calendar3','bi-grid-3x3-gap'];
            $btnClass = ['btn-dark','btn-success','btn-warning','btn-danger','btn-info','btn-secondary'];
            $displayLayanan = !empty($layanan) ? $layanan : [];
            ?>
            <?php foreach ($displayLayanan as $i => $l): ?>
            <?php $idx = $i % 6; ?>
            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 p-4 text-center border-0 shadow-sm">
                    <div class="service-icon-wrap" style="background:<?= $iconWraps[$idx]['bg'] ?>;">
                        <?php if (!empty($l['gambar'])): ?>
                            <img src="<?= base_url('uploads/layanan/' . $l['gambar']) ?>"
                                style="width:36px;height:36px;object-fit:cover;border-radius:8px;" alt="">
                        <?php else: ?>
                            <i class="bi <?= $icons[$idx] ?>" style="color:<?= $iconWraps[$idx]['color'] ?>;font-size:1.6rem;"></i>
                        <?php endif; ?>
                    </div>
                    <h5 class="fw-700 mb-2" style="font-size:1rem;font-weight:700;"><?= $l['nama_layanan'] ?></h5>
                    <p class="text-muted mb-3" style="font-size:0.82rem;line-height:1.6;">
                        <?= !empty($l['deskripsi']) ? character_limiter($l['deskripsi'], 75) : 'Layanan cetak berkualitas tinggi dengan hasil terbaik dan harga terjangkau.' ?>
                    </p>
                    <div class="service-price mb-3">
                        Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?>
                        <span class="text-muted fw-normal" style="font-size:0.75rem;">/ <?= $l['satuan'] ?? 'pcs' ?></span>
                    </div>
                    <?php if (session()->get('logged_in') && session('level') === 'pelanggan'): ?>
                        <a href="<?= base_url('pelanggan/pesanan/create') ?>" class="btn btn-sm <?= $btnClass[$idx] ?> mt-auto px-4">
                            <i class="bi bi-cart-plus me-1"></i>Pesan
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('auth/register') ?>" class="btn btn-sm <?= $btnClass[$idx] ?> mt-auto px-4">
                            <i class="bi bi-cart-plus me-1"></i>Pesan
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="keunggulan" class="py-5 py-lg-6">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-badge">Mengapa Kami?</div>
            <h2 class="section-title">Keunggulan Kami</h2>
        </div>
        <div class="row g-4">
            <?php
            $features = [
                ['icon' => 'bi-award-fill',        'bg' => 'rgba(26,26,46,0.08)',  'color' => '#1a1a2e', 'judul' => 'Kualitas Terjamin',  'desc' => 'Mesin cetak modern dan bahan premium untuk hasil terbaik yang memuaskan.'],
                ['icon' => 'bi-lightning-charge-fill','bg' => 'rgba(40,167,69,0.1)', 'color' => '#28a745', 'judul' => 'Pengerjaan Cepat',   'desc' => 'Proses produksi efisien dengan estimasi waktu yang jelas dan tepat.'],
                ['icon' => 'bi-tags-fill',          'bg' => 'rgba(255,193,7,0.12)', 'color' => '#b8860b', 'judul' => 'Harga Terjangkau',   'desc' => 'Harga kompetitif dengan kualitas premium untuk semua kalangan.'],
                ['icon' => 'bi-headset',            'bg' => 'rgba(13,202,240,0.1)', 'color' => '#0dcaf0', 'judul' => 'Layanan Responsif',  'desc' => 'Tim siap membantu 6 hari seminggu via WhatsApp dan kunjungan langsung.'],
            ];
            ?>
            <?php foreach ($features as $f): ?>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon-wrap" style="background:<?= $f['bg'] ?>;">
                        <i class="bi <?= $f['icon'] ?>" style="color:<?= $f['color'] ?>;font-size:1.4rem;"></i>
                    </div>
                    <h6 class="fw-700 mb-2" style="font-weight:700;"><?= $f['judul'] ?></h6>
                    <p class="text-muted mb-0" style="font-size:0.85rem;line-height:1.6;"><?= $f['desc'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center position-relative" style="z-index:1;">
        <div class="hero-badge mb-4" style="margin:0 auto 1.5rem;">
            <i class="bi bi-rocket-takeoff-fill"></i>Mulai Sekarang
        </div>
        <h2 class="fw-900 text-white mb-3" style="font-size:clamp(1.8rem,4vw,2.8rem);font-weight:900;letter-spacing:-0.02em;">
            Siap Memesan?
        </h2>
        <p class="text-white-50 mb-5" style="font-size:1.05rem;max-width:480px;margin:0 auto 2rem;">
            Daftar gratis dan nikmati kemudahan pemesanan cetak secara online kapan saja
        </p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url(session('level') === 'pelanggan' ? 'pelanggan/pesanan/create' : 'admin/dashboard') ?>"
                    class="hero-btn-primary">
                    <i class="bi bi-cart-plus"></i>Buat Pesanan
                </a>
                <a href="<?= base_url(session('level') === 'pelanggan' ? 'pelanggan/dashboard' : 'admin/dashboard') ?>"
                    class="hero-btn-secondary">
                    <i class="bi bi-speedometer2"></i>Dashboard
                </a>
            <?php else: ?>
                <a href="<?= base_url('auth/register') ?>" class="hero-btn-primary">
                    <i class="bi bi-person-plus-fill"></i>Daftar Gratis
                </a>
                <a href="<?= base_url('auth/login') ?>" class="hero-btn-secondary">
                    <i class="bi bi-box-arrow-in-right"></i>Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
