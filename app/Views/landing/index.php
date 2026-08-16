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
                <div class="hero-slider-wrap">
                    <div class="hero-slider" id="heroSlider">

                        <!-- Slide 1 — foto toko (ganti src dengan foto asli) -->
                        <div class="hero-slide active">
                            <div class="hero-slide-img" style="background:linear-gradient(135deg,#0f3460 0%,#1a1a2e 100%);">
                                <img src="<?= base_url('uploads/hero/slide1.jpg') ?>"
                                     onerror="this.style.display='none'"
                                     alt="Toko Anugrah Jaya Digital Printing">
                                <div class="hero-slide-overlay"></div>
                                <div class="hero-slide-caption">
                                    <span class="hero-slide-badge"><i class="bi bi-shop me-1"></i>Toko Kami</span>
                                    <div class="hero-slide-text">Modern & Lengkap</div>
                                </div>
                                <!-- Placeholder visual jika belum ada foto -->
                                <div class="hero-slide-placeholder">
                                    <div class="placeholder-inner">
                                        <i class="bi bi-printer-fill"></i>
                                        <span>Anugrah Jaya<br>Digital Printing</span>
                                        <small>Cetak Indoor & Outdoor</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="hero-slide">
                            <div class="hero-slide-img" style="background:linear-gradient(135deg,#1a6b3c 0%,#0d4a2a 100%);">
                                <img src="<?= base_url('uploads/hero/slide2.jpg') ?>"
                                     onerror="this.style.display='none'"
                                     alt="Hasil Cetak Berkualitas">
                                <div class="hero-slide-overlay"></div>
                                <div class="hero-slide-caption">
                                    <span class="hero-slide-badge"><i class="bi bi-stars me-1"></i>Kualitas Premium</span>
                                    <div class="hero-slide-text">Hasil Cetak Terbaik</div>
                                </div>
                                <div class="hero-slide-placeholder">
                                    <div class="placeholder-inner">
                                        <i class="bi bi-image-fill"></i>
                                        <span>Kualitas<br>Terjamin</span>
                                        <small>Warna tajam & tahan lama</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="hero-slide">
                            <div class="hero-slide-img" style="background:linear-gradient(135deg,#7c3aed 0%,#4c1d95 100%);">
                                <img src="<?= base_url('uploads/hero/slide3.jpg') ?>"
                                     onerror="this.style.display:'none'"
                                     alt="Layanan Desain Grafis">
                                <div class="hero-slide-overlay"></div>
                                <div class="hero-slide-caption">
                                    <span class="hero-slide-badge"><i class="bi bi-palette-fill me-1"></i>Desain Grafis</span>
                                    <div class="hero-slide-text">Bawa Desain Sendiri</div>
                                </div>
                                <div class="hero-slide-placeholder">
                                    <div class="placeholder-inner">
                                        <i class="bi bi-palette-fill"></i>
                                        <span>Layanan<br>Desain</span>
                                        <small>Desain sendiri = hemat lebih</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div class="hero-slide">
                            <div class="hero-slide-img" style="background:linear-gradient(135deg,#b45309 0%,#78350f 100%);">
                                <img src="<?= base_url('uploads/hero/slide4.jpg') ?>"
                                     onerror="this.style.display='none'"
                                     alt="Pengiriman Cepat">
                                <div class="hero-slide-overlay"></div>
                                <div class="hero-slide-caption">
                                    <span class="hero-slide-badge"><i class="bi bi-lightning-charge-fill me-1"></i>Proses Cepat</span>
                                    <div class="hero-slide-text">Selesai Tepat Waktu</div>
                                </div>
                                <div class="hero-slide-placeholder">
                                    <div class="placeholder-inner">
                                        <i class="bi bi-lightning-charge-fill"></i>
                                        <span>Pengerjaan<br>Cepat</span>
                                        <small>Estimasi waktu yang jelas</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.hero-slider -->

                    <!-- Dots navigasi -->
                    <div class="hero-slider-dots">
                        <button class="hero-dot active" data-idx="0" aria-label="Slide 1"></button>
                        <button class="hero-dot" data-idx="1" aria-label="Slide 2"></button>
                        <button class="hero-dot" data-idx="2" aria-label="Slide 3"></button>
                        <button class="hero-dot" data-idx="3" aria-label="Slide 4"></button>
                    </div>

                    <!-- Tombol prev/next -->
                    <button class="hero-slider-btn hero-slider-prev" id="heroPrev" aria-label="Sebelumnya">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="hero-slider-btn hero-slider-next" id="heroNext" aria-label="Berikutnya">
                        <i class="bi bi-chevron-right"></i>
                    </button>

                    <!-- Progress bar autoplay -->
                    <div class="hero-slider-progress">
                        <div class="hero-slider-progress-bar" id="heroProgressBar"></div>
                    </div>

                </div><!-- /.hero-slider-wrap -->
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

<section id="layanan" class="py-5 py-lg-6" style="background:#f4f5f7;">
    <div class="container">
        <div class="text-center mb-4">
            <div class="section-badge">Layanan Kami</div>
            <h2 class="section-title">Apa yang Kami Tawarkan?</h2>
            <p class="text-muted" style="max-width:500px;margin:0 auto;">Berbagai layanan cetak digital berkualitas tinggi untuk semua kebutuhan Anda</p>
        </div>

        <!-- Search & Filter Bar -->
        <div class="produk-search-wrap mb-4">
            <div class="produk-search-box">
                <i class="bi bi-search produk-search-icon"></i>
                <input type="text" id="inputCariProduk" class="produk-search-input"
                    placeholder="Cari layanan cetak... contoh: spanduk, brosur, kartu nama">
                <button type="button" id="btnClearSearch" class="produk-search-clear" style="display:none;" title="Hapus">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            </div>
        </div>

        <!-- Filter Kategori -->
        <?php if (!empty($kategori)): ?>
        <div class="produk-filter-wrap mb-4">
            <button class="produk-filter-pill active" data-kat="semua">
                <i class="bi bi-grid-fill me-1"></i>Semua
            </button>
            <?php foreach ($kategori as $kat): ?>
            <button class="produk-filter-pill" data-kat="<?= esc($kat) ?>">
                <?= esc($kat) ?>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Hasil & Counter -->
        <div class="d-flex align-items-center justify-content-between mb-3">
            <span id="produkCounter" class="small text-muted">
                Menampilkan <strong id="produkCount"><?= count($displayLayanan ?? $layanan) ?></strong> layanan
            </span>
            <span id="produkNoResult" class="small text-danger fw-semibold" style="display:none;">
                <i class="bi bi-search me-1"></i>Tidak ada layanan yang cocok
            </span>
        </div>

        <div class="row g-4" id="produkGrid">
            <?php
            $categoryColors = [
                0 => ['badge_bg'=>'#1a1a2e', 'badge_color'=>'#fff', 'price_color'=>'#1a1a2e'],
                1 => ['badge_bg'=>'#28a745', 'badge_color'=>'#fff', 'price_color'=>'#1a8a36'],
                2 => ['badge_bg'=>'#e07b00', 'badge_color'=>'#fff', 'price_color'=>'#e07b00'],
                3 => ['badge_bg'=>'#dc3545', 'badge_color'=>'#fff', 'price_color'=>'#c82333'],
                4 => ['badge_bg'=>'#0077cc', 'badge_color'=>'#fff', 'price_color'=>'#0077cc'],
                5 => ['badge_bg'=>'#6f42c1', 'badge_color'=>'#fff', 'price_color'=>'#6f42c1'],
            ];
            $placeholderGradients = [
                0 => 'linear-gradient(135deg,#1a1a2e,#2d3561)',
                1 => 'linear-gradient(135deg,#28a745,#20c55e)',
                2 => 'linear-gradient(135deg,#e07b00,#ffc107)',
                3 => 'linear-gradient(135deg,#dc3545,#ff6b81)',
                4 => 'linear-gradient(135deg,#0077cc,#00b4db)',
                5 => 'linear-gradient(135deg,#6f42c1,#a855f7)',
            ];
            $icons = ['bi-image-fill','bi-file-earmark-text-fill','bi-credit-card-2-front-fill','bi-sticker-fill','bi-calendar3','bi-grid-3x3-gap-fill'];
            $displayLayanan = !empty($layanan) ? $layanan : [];
            ?>
            <?php foreach ($displayLayanan as $i => $l): ?>
            <?php
                $idx         = $i % 6;
                $cc          = $categoryColors[$idx];
                $gradBg      = $placeholderGradients[$idx];
                $tipeLabel   = ['per_meter'=>'/m²','per_lembar'=>'/lembar','per_pcs'=>'/pcs','per_set'=>'/set','per_huruf'=>'/huruf','per_buku'=>'/buku'][$l['tipe_harga'] ?? 'per_pcs'] ?? '/pcs';
                $hargaDisplay = ($l['tipe_harga'] === 'per_meter' && ($l['harga_per_meter'] ?? 0) > 0)
                    ? $l['harga_per_meter'] : $l['harga_satuan'];
                $linkPesan   = (session()->get('logged_in') && session('level') === 'pelanggan')
                    ? base_url('pelanggan/pesanan/create')
                    : base_url('auth/register');
                // Atribut untuk filtering
                $dataNama = strtolower($l['nama_layanan'] . ' ' . ($l['deskripsi'] ?? '') . ' ' . ($l['nama_bahan'] ?? '') . ' ' . ($l['nama_kategori'] ?? ''));
                $dataKat  = $l['nama_kategori'] ?? '';
            ?>
            <div class="col-sm-6 col-lg-4 col-xl-3 produk-item"
                 data-nama="<?= esc(strtolower($l['nama_layanan'])) ?>"
                 data-kata="<?= esc(strtolower($dataNama)) ?>"
                 data-kat="<?= esc($dataKat) ?>">
                <div class="produk-card">
                    <div class="produk-card-img">
                        <?php if (!empty($l['gambar'])): ?>
                            <img src="<?= base_url('uploads/layanan/' . $l['gambar']) ?>"
                                 alt="<?= esc($l['nama_layanan']) ?>">
                        <?php else: ?>
                            <div class="produk-placeholder" style="background:<?= $gradBg ?>;">
                                <i class="bi <?= $icons[$idx] ?>"></i>
                                <span><?= esc($l['nama_layanan']) ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($l['nama_kategori'])): ?>
                        <span class="produk-badge" style="background:<?= $cc['badge_bg'] ?>;color:<?= $cc['badge_color'] ?>;">
                            <?= esc($l['nama_kategori']) ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="produk-card-body">
                        <h5 class="produk-nama"><?= esc($l['nama_layanan']) ?></h5>
                        <?php if (!empty($l['nama_bahan'])): ?>
                        <div class="produk-meta">
                            <i class="bi bi-layers me-1"></i><?= esc($l['nama_bahan']) ?>
                        </div>
                        <?php endif; ?>
                        <p class="produk-desc">
                            <?= !empty($l['deskripsi'])
                                ? esc(mb_strimwidth($l['deskripsi'], 0, 80, '...'))
                                : 'Layanan cetak berkualitas tinggi dengan hasil terbaik dan harga terjangkau.' ?>
                        </p>
                        <div class="produk-divider"></div>
                        <div class="produk-footer">
                            <div class="produk-harga" style="color:<?= $cc['price_color'] ?>;">
                                Rp <?= number_format($hargaDisplay, 0, ',', '.') ?>
                                <span class="produk-satuan"><?= $tipeLabel ?></span>
                            </div>
                            <a href="<?= $linkPesan ?>" class="produk-btn-pesan" style="background:<?= $cc['badge_bg'] ?>;">
                                <i class="bi bi-cart-plus me-1"></i>Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty state -->
        <div id="produkEmpty" class="text-center py-5" style="display:none;">
            <i class="bi bi-search" style="font-size:3rem;color:#d1d5db;"></i>
            <p class="mt-3 fw-semibold" style="color:#6b7280;">Tidak ada layanan yang cocok dengan pencarian Anda</p>
            <button type="button" id="btnResetFilter" class="btn btn-outline-secondary btn-sm mt-1">
                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset Pencarian
            </button>
        </div>

        <?php if (empty($displayLayanan)): ?>
        <div class="col-12 text-center py-5 text-muted">
            <i class="bi bi-grid fs-1 d-block mb-2 opacity-25"></i>
            Belum ada layanan tersedia
        </div>
        <?php endif; ?>
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

<?= $this->section('scripts') ?>
<script>
(function () {
    var inputCari   = document.getElementById('inputCariProduk');
    var btnClear    = document.getElementById('btnClearSearch');
    var btnReset    = document.getElementById('btnResetFilter');
    var produkItems = document.querySelectorAll('.produk-item');
    var counterEl   = document.getElementById('produkCount');
    var emptyEl     = document.getElementById('produkEmpty');
    var noResultEl  = document.getElementById('produkNoResult');
    var filterBtns  = document.querySelectorAll('.produk-filter-pill');

    var activeKat   = 'semua';
    var activeQuery = '';

    function applyFilter() {
        var q    = activeQuery.toLowerCase().trim();
        var kat  = activeKat;
        var visible = 0;

        produkItems.forEach(function (item) {
            var kata    = item.dataset.kata  || '';
            var itemKat = item.dataset.kat   || '';

            var matchQ   = !q || kata.indexOf(q) !== -1;
            var matchKat = kat === 'semua' || itemKat === kat;

            if (matchQ && matchKat) {
                item.style.display = '';
                visible++;
            } else {
                item.style.display = 'none';
            }
        });

        // Counter
        if (counterEl) counterEl.textContent = visible;

        // Empty state
        if (emptyEl)     emptyEl.style.display    = visible === 0 ? 'block' : 'none';
        if (noResultEl)  noResultEl.style.display  = (visible === 0 && q) ? 'inline' : 'none';

        // Clear button
        if (btnClear) btnClear.style.display = q ? 'flex' : 'none';
    }

    // Input search — debounce 200ms
    var timer;
    if (inputCari) {
        inputCari.addEventListener('input', function () {
            clearTimeout(timer);
            activeQuery = this.value;
            timer = setTimeout(applyFilter, 200);
        });
        inputCari.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                this.value = '';
                activeQuery = '';
                applyFilter();
            }
        });
    }

    // Clear button
    if (btnClear) {
        btnClear.addEventListener('click', function () {
            inputCari.value = '';
            activeQuery = '';
            applyFilter();
            inputCari.focus();
        });
    }

    // Reset filter
    if (btnReset) {
        btnReset.addEventListener('click', function () {
            if (inputCari) inputCari.value = '';
            activeQuery = '';
            activeKat   = 'semua';
            filterBtns.forEach(function (b) {
                b.classList.toggle('active', b.dataset.kat === 'semua');
            });
            applyFilter();
        });
    }

    // Filter kategori
    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filterBtns.forEach(function (b) { b.classList.remove('active'); });
            this.classList.add('active');
            activeKat = this.dataset.kat;
            applyFilter();

            // Scroll ke section layanan
            var section = document.getElementById('layanan');
            if (section) {
                var top = section.getBoundingClientRect().top + window.scrollY - 80;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

    // Init
    applyFilter();
})();
</script>

<script>
// Hero Image Slider
(function () {
    var slider   = document.getElementById('heroSlider');
    if (!slider) return;

    var slides   = slider.querySelectorAll('.hero-slide');
    var dots     = document.querySelectorAll('.hero-dot');
    var progressBar = document.getElementById('heroProgressBar');
    var current  = 0;
    var total    = slides.length;
    var autoplayMs = 4500;
    var timer, progressTimer, progressStart;

    function goTo(idx) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (idx + total) % total;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
        startProgress();
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startProgress() {
        clearInterval(timer);
        if (progressBar) {
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            // Force reflow
            progressBar.offsetWidth;
            progressBar.style.transition = 'width ' + autoplayMs + 'ms linear';
            progressBar.style.width = '100%';
        }
        timer = setTimeout(next, autoplayMs);
    }

    // Dots
    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            goTo(parseInt(this.dataset.idx));
        });
    });

    // Prev / Next buttons
    var btnPrev = document.getElementById('heroPrev');
    var btnNext = document.getElementById('heroNext');
    if (btnPrev) btnPrev.addEventListener('click', function () { goTo(current - 1); });
    if (btnNext) btnNext.addEventListener('click', function () { goTo(current + 1); });

    // Pause on hover
    var wrap = slider.closest('.hero-slider-wrap');
    if (wrap) {
        wrap.addEventListener('mouseenter', function () {
            clearTimeout(timer);
            if (progressBar) progressBar.style.animationPlayState = 'paused';
        });
        wrap.addEventListener('mouseleave', function () {
            startProgress();
        });
    }

    // Touch/swipe
    var touchStartX = 0;
    slider.addEventListener('touchstart', function (e) {
        touchStartX = e.touches[0].clientX;
    }, { passive: true });
    slider.addEventListener('touchend', function (e) {
        var diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) diff > 0 ? next() : prev();
    }, { passive: true });

    // Init
    startProgress();
})();
</script>
<?= $this->endSection() ?>
