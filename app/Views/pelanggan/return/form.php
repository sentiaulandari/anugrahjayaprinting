<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Ajukan Retur / Revisi</h4>
        <small class="text-muted">Pesanan: <?= $pesanan['no_pesanan'] ?></small>
    </div>
    <a href="<?= base_url('pelanggan/pesanan/show/' . $pesanan['no_pesanan']) ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="row g-3">

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header fw-semibold">
                <i class="bi bi-receipt me-2"></i>Info Pesanan
            </div>
            <div class="card-body small">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">No. Pesanan</span>
                    <span class="fw-semibold"><?= $pesanan['no_pesanan'] ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tgl Pesanan</span>
                    <span><?= date('d F Y', strtotime($pesanan['tgl_pesanan'])) ?></span>
                </div>
                <hr class="my-2">
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold text-primary">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

        <div class="card" style="border:1px solid rgba(255,193,7,0.3);background:rgba(255,193,7,0.03);">
            <div class="card-header fw-semibold" style="color:#b8860b;background:rgba(255,193,7,0.06);">
                <i class="bi bi-info-circle me-2"></i>Ketentuan Retur
            </div>
            <div class="card-body small">
                <ul class="text-muted mb-0 ps-3" style="line-height:2;">
                    <li>Retur hanya untuk pesanan <strong>berstatus Selesai</strong></li>
                    <li>Sertakan <strong>foto bukti</strong> kerusakan / cacat</li>
                    <li>Admin akan memverifikasi dalam <strong>1x24 jam</strong></li>
                    <li>Jika kesalahan dari percetakan → <strong>cetak ulang gratis</strong></li>
                    <li>Jika kesalahan dari desain pelanggan → <strong>biaya tambahan</strong></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header fw-semibold">
                <i class="bi bi-arrow-return-left me-2"></i>Form Pengajuan Retur / Revisi
            </div>
            <div class="card-body">
                <form action="<?= base_url('pelanggan/return/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="no_pesanan" value="<?= $pesanan['no_pesanan'] ?>">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            Jenis Masalah <span class="text-danger">*</span>
                        </label>
                        <div class="row g-2">
                            <?php foreach ($labelJenis as $key => $label): ?>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="jenis_masalah"
                                    id="jenis-<?= $key ?>" value="<?= $key ?>"
                                    <?= old('jenis_masalah') === $key ? 'checked' : '' ?> required>
                                <label class="btn btn-outline-secondary w-100 text-start py-2 px-3" for="jenis-<?= $key ?>" style="font-size:0.82rem;">
                                    <?php
                                    $icons = [
                                        'salah_ukuran'             => 'bi-rulers',
                                        'salah_warna'              => 'bi-palette',
                                        'teks_gambar_tidak_sesuai' => 'bi-file-image',
                                        'hasil_rusak_cacat'        => 'bi-exclamation-triangle',
                                        'lainnya'                  => 'bi-three-dots',
                                    ];
                                    ?>
                                    <i class="bi <?= $icons[$key] ?? 'bi-dot' ?> me-2"></i><?= $label ?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            Deskripsi Keluhan <span class="text-danger">*</span>
                        </label>
                        <textarea name="alasan" class="form-control" rows="4"
                            placeholder="Jelaskan secara detail keluhan Anda. Contoh: ukuran yang dicetak 100x200cm namun yang diterima 80x160cm, warna background seharusnya merah namun yang dicetak biru, dll..."
                            required minlength="10" maxlength="500"><?= old('alasan') ?></textarea>
                        <div class="form-text d-flex justify-content-between">
                            <span>Minimal 10 karakter, semakin detail semakin baik</span>
                            <span id="charCount" class="fw-semibold">0 / 500</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">
                            Foto Bukti <span class="text-muted fw-normal">(sangat disarankan)</span>
                        </label>
                        <input type="file" name="foto_bukti" class="form-control" accept="image/*" id="inputFoto">
                        <div class="form-text">Foto hasil cetak yang bermasalah. Format JPG / PNG, maks 2MB</div>
                        <div id="previewFoto" class="mt-2 d-none">
                            <img id="imgPreview" src="" class="img-thumbnail" style="max-height:160px;" alt="Preview">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="bi bi-send me-1"></i>Kirim Pengajuan Retur
                        </button>
                        <a href="<?= base_url('pelanggan/pesanan/show/' . $pesanan['no_pesanan']) ?>" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const textarea = document.querySelector('textarea[name="alasan"]');
    const counter  = document.getElementById('charCount');
    textarea.addEventListener('input', function() {
        counter.textContent = this.value.length + ' / 500';
    });

    document.getElementById('inputFoto').addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imgPreview').src = e.target.result;
                document.getElementById('previewFoto').classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('previewFoto').classList.add('d-none');
        }
    });
</script>
<?= $this->endSection() ?>
