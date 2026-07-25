<?= $this->extend('layouts/pelanggan_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Buat Pesanan Baru</h4>
        <small class="text-muted">Tanggal: <?= date('d F Y') ?></small>
    </div>
    <a href="<?= base_url('pelanggan/pesanan') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<form action="<?= base_url('pelanggan/pesanan/store') ?>" method="POST" id="formPesanan">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div class="col-lg-8">

            <div class="card mb-3">
                <div class="card-header"><i class="bi bi-info-circle me-2"></i>Informasi Pesanan</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Tanggal Pesanan</label>
                            <input type="text" class="form-control bg-light" value="<?= date('d F Y') ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Estimasi Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_selesai" class="form-control"
                                min="<?= $tgl_min ?>"
                                value="<?= old('tgl_selesai') ?>" required>
                            <div class="form-text">Minimal besok: <?= date('d F Y', strtotime('+1 day')) ?></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Catatan Tambahan</label>
                            <textarea name="catatan" class="form-control" rows="2"
                                placeholder="Contoh: desain sudah disiapkan, warna khusus, dll..."><?= old('catatan') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-list-ul me-2"></i>Pilih Layanan</span>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btnTambahItem">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body">
                    <div id="itemContainer">
                        <div class="item-row border rounded p-3 mb-2 bg-light">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Layanan <span class="text-danger">*</span></label>
                                    <select name="kode_layanan[]" class="form-select form-select-sm layanan-select" required
                                        data-harga-per-meter data-diskon>
                                        <option value="">-- Pilih Layanan --</option>
                                        <?php foreach ($layanan as $l): ?>
                                            <option value="<?= $l['kode_layanan'] ?>"
                                                data-harga="<?= $l['harga_satuan'] ?>"
                                                data-hpm="<?= $l['harga_per_meter'] ?>"
                                                data-diskon="<?= $l['diskon_desain_sendiri'] ?? 5000 ?>">
                                                <?= $l['nama_layanan'] ?>
                                                — Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?>
                                                <?php if (($l['harga_per_meter'] ?? 0) > 0): ?>
                                                    (Rp <?= number_format($l['harga_per_meter'], 0, ',', '.') ?>/m²)
                                                <?php endif; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Qty</label>
                                    <input type="number" name="qty[]" class="form-control form-control-sm qty-input" value="1" min="1">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label small fw-semibold">P (m)</label>
                                    <input type="number" name="panjang[]" class="form-control form-control-sm panjang-input"
                                        step="0.01" min="0" placeholder="0">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label small fw-semibold">L (m)</label>
                                    <input type="number" name="lebar[]" class="form-control form-control-sm lebar-input"
                                        step="0.01" min="0" placeholder="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Desain Sendiri</label>
                                    <div class="form-check form-switch mt-1">
                                        <input type="checkbox" name="desain_sendiri[]" class="form-check-input desain-input" value="1">
                                        <label class="form-check-label small text-muted">Diskon -Rp5.000</label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label small fw-semibold">Subtotal</label>
                                    <input type="text" class="form-control form-control-sm subtotal-display bg-white fw-semibold text-primary" readonly value="Rp 0">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-item w-100 mt-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="keterangan_detail[]" class="form-control form-control-sm"
                                        placeholder="Keterangan item (opsional)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <span class="small text-muted">
                            <i class="bi bi-info-circle me-1"></i>Harga dihitung per meter². Jika bawa desain sendiri, diskon Rp5.000/item
                        </span>
                        <div>
                            <span class="fw-semibold">Total Estimasi: </span>
                            <span class="fw-bold text-primary fs-5" id="grandTotal">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header"><i class="bi bi-clock me-2"></i>Alur Pesanan</div>
                <div class="card-body small">
                    <div class="d-flex gap-2 mb-2">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width:28px;height:28px;font-size:0.75rem;">1</div>
                        <div><div class="fw-semibold">Buat Pesanan</div><div class="text-muted">Pilih layanan & isi detail</div></div>
                    </div>
                    <div class="d-flex gap-2 mb-2">
                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center text-dark fw-bold flex-shrink-0" style="width:28px;height:28px;font-size:0.75rem;">2</div>
                        <div><div class="fw-semibold">Upload Bukti Bayar</div><div class="text-muted">Transfer & upload bukti</div></div>
                    </div>
                    <div class="d-flex gap-2 mb-2">
                        <div class="rounded-circle bg-info d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width:28px;height:28px;font-size:0.75rem;">3</div>
                        <div><div class="fw-semibold">Konfirmasi Admin</div><div class="text-muted">Admin verifikasi pembayaran</div></div>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width:28px;height:28px;font-size:0.75rem;">4</div>
                        <div><div class="fw-semibold">Pesanan Diproses</div><div class="text-muted">Produksi dimulai</div></div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><i class="bi bi-bank me-2"></i>Info Pembayaran</div>
                <div class="card-body small">
                    <div class="mb-2">
                        <div class="text-muted">Bank BCA</div>
                        <div class="fw-bold font-monospace">1234 5678 90</div>
                        <div class="text-muted">A/N: Anugrah Jaya DP</div>
                    </div>
                    <hr class="my-2">
                    <div class="mb-2">
                        <div class="text-muted">DANA / OVO</div>
                        <div class="fw-bold font-monospace">0822 8790 0182</div>
                    </div>
                    <hr class="my-2">
                    <div class="text-muted">
                        <i class="bi bi-telephone me-1"></i>Dihan: 0822 8790 0182<br>
                        <i class="bi bi-telephone me-1"></i>Budi: 0352 8766 0078
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100 mb-2" id="btnSubmit">
                        <i class="bi bi-send me-1"></i>Kirim Pesanan
                    </button>
                    <a href="<?= base_url('pelanggan/pesanan') ?>" class="btn btn-outline-secondary w-100">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const layananOptions = `<?php foreach ($layanan as $l): ?><option value="<?= $l['kode_layanan'] ?>" data-harga="<?= $l['harga_satuan'] ?>" data-hpm="<?= $l['harga_per_meter'] ?>" data-diskon="<?= $l['diskon_desain_sendiri'] ?? 5000 ?>"><?= $l['nama_layanan'] ?> — Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?><?php if (($l['harga_per_meter'] ?? 0) > 0): ?> (Rp <?= number_format($l['harga_per_meter'], 0, ',', '.') ?>/m²)<?php endif; ?></option><?php endforeach; ?>`;

    function formatRp(n) {
        return 'Rp ' + parseInt(n || 0).toLocaleString('id-ID');
    }

    function hitungSubtotal(row) {
        var sel = row.querySelector('.layanan-select');
        var opt = sel.selectedOptions[0];
        if (!opt) return 0;

        var hpm = parseFloat(opt.dataset.hpm) || 0;
        var diskon = parseFloat(opt.dataset.diskon) || 5000;
        var hargaFix = parseFloat(opt.dataset.harga) || 0;
        var panjang = parseFloat(row.querySelector('.panjang-input').value) || 0;
        var lebar = parseFloat(row.querySelector('.lebar-input').value) || 0;
        var qty = parseInt(row.querySelector('.qty-input').value) || 0;
        var desain = row.querySelector('.desain-input').checked;

        var hargaSatuan = panjang * lebar * hpm;
        if (desain && hargaSatuan > 0) {
            hargaSatuan = Math.max(0, hargaSatuan - diskon);
        }
        if (hargaSatuan <= 0) {
            hargaSatuan = hargaFix;
        }

        return hargaSatuan * qty;
    }

    function hitungTotal() {
        var total = 0;
        document.querySelectorAll('.item-row').forEach(function(row) {
            var sub = hitungSubtotal(row);
            row.querySelector('.subtotal-display').value = formatRp(sub);
            total += sub;
        });
        document.getElementById('grandTotal').textContent = formatRp(total);
    }

    document.getElementById('itemContainer').addEventListener('change', hitungTotal);
    document.getElementById('itemContainer').addEventListener('input', hitungTotal);

    document.getElementById('btnTambahItem').addEventListener('click', function() {
        var template = document.querySelector('.item-row').cloneNode(true);
        template.querySelectorAll('input').forEach(function(i) {
            if (i.type === 'number') i.value = i.classList.contains('qty-input') ? 1 : '';
            else if (i.type === 'checkbox') i.checked = false;
            else if (!i.classList.contains('subtotal-display')) i.value = '';
        });
        template.querySelector('.layanan-select').innerHTML = '<option value="">-- Pilih Layanan --</option>' + layananOptions;
        template.querySelector('.subtotal-display').value = 'Rp 0';
        document.getElementById('itemContainer').appendChild(template);
        hitungTotal();
    });

    document.getElementById('itemContainer').addEventListener('click', function(e) {
        if (e.target.closest('.btn-hapus-item')) {
            var rows = document.querySelectorAll('.item-row');
            if (rows.length > 1) {
                e.target.closest('.item-row').remove();
                hitungTotal();
            }
        }
    });

    document.getElementById('formPesanan').addEventListener('submit', function() {
        var btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Mengirim...';
    });
</script>
<?= $this->endSection() ?>
