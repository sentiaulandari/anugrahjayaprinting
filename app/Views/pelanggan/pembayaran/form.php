<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="page-title mb-0">Konfirmasi Pembayaran</h4>
    <a href="<?= base_url('pelanggan/pembayaran') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">

    <div class="col-lg-5">
        <div class="card mb-3">
            <div class="card-header fw-semibold">
                <i class="bi bi-receipt me-2"></i>Ringkasan Pesanan
            </div>
            <div class="card-body small">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">No. Pesanan</span>
                    <span class="fw-semibold"><?= $pesanan['no_pesanan'] ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tanggal Pesanan</span>
                    <span><?= date('d F Y', strtotime($pesanan['tgl_pesanan'])) ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Est. Selesai</span>
                    <span><?= $pesanan['tgl_selesai'] ? date('d F Y', strtotime($pesanan['tgl_selesai'])) : '-' ?></span>
                </div>
                <hr class="my-2">
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total Tagihan</span>
                    <span class="fw-bold text-primary fs-6">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

        <div class="card" id="cardInfoRekening">
            <div class="card-header fw-semibold text-warning" style="background:#1a1a2e;">
                <i class="bi bi-info-circle me-2"></i>Pilih Metode Pembayaran
            </div>
            <div class="card-body small text-muted text-center py-4" id="infoRekeningDefault">
                <i class="bi bi-hand-index fs-2 d-block mb-2 text-muted"></i>
                Pilih metode pembayaran di sebelah kanan untuk melihat detail rekening
            </div>

            <?php foreach ($rekeningList as $key => $rek): ?>
            <div class="info-rekening d-none" id="info-<?= $key ?>">
                <div class="card-body">
                    <?php if ($key === 'QRIS'): ?>
                        <div class="text-center">
                            <div class="fw-semibold mb-3">Scan QRIS untuk Pembayaran</div>
                            <div class="border rounded p-3 d-inline-block mb-3" style="background:#fff;">
                                <svg width="180" height="180" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="180" height="180" fill="white"/>
                                    <rect x="10" y="10" width="60" height="60" fill="none" stroke="#1a1a2e" stroke-width="4"/>
                                    <rect x="20" y="20" width="40" height="40" fill="#1a1a2e"/>
                                    <rect x="110" y="10" width="60" height="60" fill="none" stroke="#1a1a2e" stroke-width="4"/>
                                    <rect x="120" y="20" width="40" height="40" fill="#1a1a2e"/>
                                    <rect x="10" y="110" width="60" height="60" fill="none" stroke="#1a1a2e" stroke-width="4"/>
                                    <rect x="20" y="120" width="40" height="40" fill="#1a1a2e"/>
                                    <rect x="80" y="10" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="80" y="30" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="80" y="50" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="10" y="80" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="30" y="80" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="50" y="80" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="80" y="80" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="100" y="80" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="120" y="80" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="140" y="80" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="160" y="80" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="110" y="100" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="130" y="100" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="150" y="100" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="110" y="120" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="130" y="120" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="150" y="120" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="110" y="140" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="130" y="140" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="150" y="140" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="80" y="100" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="80" y="120" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="80" y="140" width="10" height="10" fill="#1a1a2e"/>
                                    <rect x="80" y="160" width="10" height="10" fill="#1a1a2e"/>
                                    <text x="90" y="175" text-anchor="middle" font-size="8" fill="#1a1a2e">ANUGRAH JAYA DP</text>
                                </svg>
                            </div>
                            <div class="small text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Scan QR di atas menggunakan aplikasi e-wallet atau m-banking Anda
                            </div>
                            <div class="badge bg-success mt-2">Berlaku untuk semua bank & e-wallet</div>
                        </div>
                    <?php elseif ($key === 'Tunai'): ?>
                        <div class="text-center py-2">
                            <i class="bi bi-cash-coin fs-1 text-success d-block mb-2"></i>
                            <div class="fw-semibold">Bayar Langsung di Tempat</div>
                            <div class="small text-muted mt-2">
                                Jl. Gajah Mada Kel. Kp. Olo - Kec. Nanggalo Padang<br>
                                (Sebelah Kharisma Motor dekat ITP Simpang Tinju)
                            </div>
                            <div class="small text-muted mt-2">
                                <i class="bi bi-clock me-1"></i>Senin - Sabtu, 08.00 - 17.00 WIB
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-circle bg-<?= $rek['warna'] ?> bg-opacity-10 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="bi <?= $rek['icon'] ?> fs-4 text-<?= $rek['warna'] ?>"></i>
                            </div>
                            <div>
                                <div class="fw-bold"><?= $rek['nama'] ?></div>
                                <div class="small text-muted">Transfer ke rekening berikut</div>
                            </div>
                        </div>
                        <div class="bg-light rounded p-3 mb-2">
                            <div class="small text-muted mb-1">Nomor Rekening / Akun</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-bold fs-5 font-monospace" id="noRek-<?= $key ?>"><?= $rek['nomor'] ?></span>
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-copy"
                                    data-nomor="<?= $rek['nomor'] ?>">
                                    <i class="bi bi-copy me-1"></i>Salin
                                </button>
                            </div>
                        </div>
                        <div class="small text-muted">
                            <i class="bi bi-person me-1"></i>A/N: <strong><?= $rek['atas_nama'] ?></strong>
                        </div>
                        <div class="alert alert-warning py-2 mt-3 mb-0 small">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Transfer tepat <strong>Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></strong> sesuai total tagihan
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header fw-semibold">
                <i class="bi bi-upload me-2"></i>Form Konfirmasi Pembayaran
            </div>
            <div class="card-body">
                <form action="<?= base_url('pelanggan/pembayaran/store') ?>" method="POST" enctype="multipart/form-data" id="formBayar">
                    <?= csrf_field() ?>
                    <input type="hidden" name="no_pesanan" value="<?= $pesanan['no_pesanan'] ?>">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Pilih Metode Pembayaran <span class="text-danger">*</span></label>
                        <div class="row g-2" id="metodePilihan">
                            <?php foreach ($rekeningList as $key => $rek): ?>
                            <div class="col-6 col-md-4">
                                <input type="radio" class="btn-check" name="metode_bayar"
                                    id="metode-<?= $key ?>" value="<?= $rek['nama'] ?>" required>
                                <label class="btn btn-outline-secondary w-100 py-2 metode-label" for="metode-<?= $key ?>" data-key="<?= $key ?>">
                                    <i class="bi <?= $rek['icon'] ?> d-block fs-4 mb-1"></i>
                                    <span style="font-size:0.75rem;"><?= $rek['nama'] ?></span>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Jumlah yang Dibayar (Rp) <span class="text-danger">*</span></label>
                        <input type="text" name="jumlah_bayar" class="form-control bg-light fw-bold text-primary"
                            id="inputJumlahBayar"
                            value="<?= $pesanan['total_harga'] ?>"
                            readonly>
                        <div class="form-text">
                            <i class="bi bi-lock-fill me-1"></i>
                            Otomatis sesuai total tagihan: <strong>Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></strong>
                        </div>
                    </div>

                    <div class="mb-4" id="wrapperBukti">
                        <label class="form-label fw-semibold small">
                            Bukti Transfer <span class="text-danger" id="labelWajib">*</span>
                        </label>
                        <input type="file" name="bukti" class="form-control" accept="image/*,.pdf" id="inputBukti">
                        <div class="form-text">Format: JPG, PNG, PDF. Maks 2MB</div>
                        <div id="previewBukti" class="mt-2 d-none">
                            <img id="imgPreview" src="" class="img-thumbnail" style="max-height:150px;" alt="Preview">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send me-1"></i>Kirim Konfirmasi
                        </button>
                        <a href="<?= base_url('pelanggan/pembayaran') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.querySelectorAll('.metode-label').forEach(function(label) {
        label.addEventListener('click', function() {
            const key = this.dataset.key;

            document.querySelectorAll('.info-rekening').forEach(function(el) {
                el.classList.add('d-none');
            });
            document.getElementById('infoRekeningDefault').classList.add('d-none');

            const target = document.getElementById('info-' + key);
            if (target) target.classList.remove('d-none');

            if (key === 'Tunai') {
                document.getElementById('wrapperBukti').classList.add('d-none');
                document.getElementById('inputBukti').removeAttribute('required');
                document.getElementById('labelWajib').classList.add('d-none');
            } else {
                document.getElementById('wrapperBukti').classList.remove('d-none');
                document.getElementById('labelWajib').classList.remove('d-none');
            }
        });
    });

    document.getElementById('inputBukti').addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imgPreview').src = e.target.result;
                document.getElementById('previewBukti').classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('previewBukti').classList.add('d-none');
        }
    });

    document.querySelectorAll('.btn-copy').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const nomor = this.dataset.nomor;
            navigator.clipboard.writeText(nomor).then(() => {
                this.innerHTML = '<i class="bi bi-check2 me-1"></i>Tersalin';
                const self = this;
                setTimeout(() => {
                    self.innerHTML = '<i class="bi bi-copy me-1"></i>Salin';
                }, 2000);
            });
        });
    });
</script>
<?= $this->endSection() ?>
