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

<form action="<?= base_url('pelanggan/pesanan/store') ?>" method="POST" id="formPesanan" enctype="multipart/form-data">
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
                        <div class="item-row border rounded p-3 mb-3 bg-light" data-tipe="per_pcs">
                            
                            <!-- Baris 1: Layanan (full width) -->
                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Layanan <span class="text-danger">*</span></label>
                                    <select name="kode_layanan[]" class="form-select form-select-sm layanan-select" required>
                                        <option value="">-- Pilih Layanan --</option>
                                        <?php foreach ($layanan as $l): ?>
                                            <option value="<?= $l['kode_layanan'] ?>"
                                                data-harga="<?= $l['harga_satuan'] ?>"
                                                data-hpm="<?= $l['harga_per_meter'] ?? 0 ?>"
                                                data-diskon="<?= $l['diskon_desain_sendiri'] ?? 5000 ?>"
                                                data-tipe="<?= $l['tipe_harga'] ?? 'per_pcs' ?>">
                                                <?= $l['nama_layanan'] ?>
                                                <?php if (($l['tipe_harga'] ?? 'per_pcs') === 'per_meter'): ?>
                                                    — Rp <?= number_format($l['harga_per_meter'] ?? 0, 0, ',', '.') ?>/m²
                                                <?php else: ?>
                                                    — Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?>/<?= $l['tipe_harga'] === 'per_lembar' ? 'lembar' : ($l['tipe_harga'] === 'per_set' ? 'set' : ($l['tipe_harga'] === 'per_buku' ? 'buku' : 'pcs')) ?>
                                                <?php endif; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Baris 2: Ukuran (meter, tersembunyi) -->
                            <div class="row g-2 mb-2 input-meter" style="display:none;">
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Ukuran (Panjang × Lebar meter)</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="number" name="panjang[]" class="form-control form-control-sm panjang-input"
                                            step="0.01" min="0.01" placeholder="Panjang (m)">
                                        <span class="text-muted fw-semibold">×</span>
                                        <input type="number" name="lebar[]" class="form-control form-control-sm lebar-input"
                                            step="0.01" min="0.01" placeholder="Lebar (m)">
                                    </div>
                                </div>
                            </div>
                            <!-- Baris 3: Qty + Subtotal + Desain Sendiri + Hapus -->
                            <div class="row g-2 mb-2">
                                <div class="col-4 col-md-3 input-qty">
                                    <label class="form-label small fw-semibold mb-1">Qty <span class="text-danger">*</span></label>
                                    <input type="number" name="qty[]" class="form-control form-control-sm qty-input" value="1" min="1" required>
                                    <small class="text-muted qty-label d-block" style="min-height:1.2rem;">lembar</small>
                                </div>
                                <div class="col-5 col-md-4">
                                    <label class="form-label small fw-semibold mb-1">Subtotal</label>
                                    <input type="text" class="form-control form-control-sm subtotal-display bg-light fw-semibold text-primary" readonly value="Rp 0">
                                    <small class="d-block" style="min-height:1.2rem;"></small>
                                </div>
                                <div class="col-10 col-md-4 desain-toggle" style="display:none;">
                                    <label class="form-label small fw-semibold mb-1">Desain Sendiri</label>
                                    <div class="form-check form-switch mt-1">
                                        <input type="checkbox" name="desain_sendiri[]" class="form-check-input desain-input" value="1">
                                        <label class="form-check-label small text-muted">Diskon −Rp5.000/m²</label>
                                    </div>
                                    <small class="d-block" style="min-height:1.2rem;"></small>
                                </div>
                                <div class="col-3 col-md-1 d-flex flex-column">
                                    <label class="form-label small fw-semibold mb-1 invisible">-</label>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-item">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <small class="d-block" style="min-height:1.2rem;"></small>
                                </div>
                            </div>
                            <!-- Baris 3: Upload Desain -->
                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Upload Desain <span class="text-muted fw-normal">(Opsional)</span></label>
                                    <input type="file" name="file_desain[]" class="form-control form-control-sm file-desain-input"
                                        accept=".jpg,.jpeg,.png,.pdf,.ai,.cdr,.psd" onchange="validasiFile(this)">
                                    <div class="form-text">Format: JPG, PNG, PDF, AI, CDR, PSD · Maks 10MB</div>
                                </div>
                            </div>
                            <!-- Baris 4: Keterangan -->
                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Keterangan</label>
                                    <input type="text" name="keterangan_detail[]" class="form-control form-control-sm"
                                        placeholder="Keterangan item (opsional)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <span class="small text-muted" id="infoHarga">
                            <i class="bi bi-info-circle me-1"></i>Pilih layanan untuk melihat info harga
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
    const layananData = <?= json_encode(array_map(function($l) {
        return [
            'kode'   => $l['kode_layanan'],
            'nama'   => $l['nama_layanan'],
            'harga'  => $l['harga_satuan'],
            'hpm'    => $l['harga_per_meter'] ?? 0,
            'diskon' => $l['diskon_desain_sendiri'] ?? 5000,
            'tipe'   => $l['tipe_harga'] ?? 'per_pcs',
        ];
    }, $layanan)) ?>;

    function formatRp(n) {
        return 'Rp ' + parseInt(n || 0).toLocaleString('id-ID');
    }

    function getQtyLabel(tipe) {
        const labels = {
            'per_meter':  'm²',
            'per_lembar': 'lembar',
            'per_pcs':    'pcs',
            'per_set':    'set',
            'per_huruf':  'huruf',
            'per_buku':   'buku',
        };
        return labels[tipe] || 'pcs';
    }

    function hitungSubtotal(row) {
        var sel  = row.querySelector('.layanan-select');
        var opt  = sel.selectedOptions[0];
        if (!opt || !opt.value) return 0;

        var tipe     = opt.dataset.tipe || 'per_pcs';
        var hpm      = parseFloat(opt.dataset.hpm) || 0;
        var diskon   = parseFloat(opt.dataset.diskon) || 5000;
        var hargaFix = parseFloat(opt.dataset.harga) || 0;
        var qty      = parseInt(row.querySelector('.qty-input').value) || 0;

        if (tipe === 'per_meter') {
            var panjang = parseFloat(row.querySelector('.panjang-input').value) || 0;
            var lebar   = parseFloat(row.querySelector('.lebar-input').value) || 0;
            var hargaSatuan = panjang * lebar * hpm;
            var desain  = row.querySelector('.desain-input').checked;
            if (desain && hargaSatuan > 0) {
                hargaSatuan = Math.max(0, hargaSatuan - diskon);
            }
            return hargaSatuan * qty;
        }

        return hargaFix * qty;
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

    function updateTipeLayout(row) {
        var sel = row.querySelector('.layanan-select');
        var opt = sel.selectedOptions[0];
        var meterInputs  = row.querySelectorAll('.input-meter');
        var qtyLabel     = row.querySelector('.qty-label');
        var desainToggle = row.querySelector('.desain-toggle');

        if (!opt || !opt.value) {
            meterInputs.forEach(function(el) { el.style.display = 'none'; });
            qtyLabel.textContent = 'lembar';
            if (desainToggle) desainToggle.style.display = 'none';
            return;
        }

        var tipe = opt.dataset.tipe || 'per_pcs';
        row.dataset.tipe = tipe;

        if (tipe === 'per_meter') {
            meterInputs.forEach(function(el) { el.style.display = ''; });
            qtyLabel.textContent = 'kali';
            if (desainToggle) desainToggle.style.display = '';
        } else {
            meterInputs.forEach(function(el) {
                el.style.display = 'none';
                el.querySelectorAll('input').forEach(function(i) { i.value = ''; });
            });
            qtyLabel.textContent = getQtyLabel(tipe);
            if (desainToggle) {
                desainToggle.style.display = 'none';
                var cb = desainToggle.querySelector('.desain-input');
                if (cb) cb.checked = false;
            }
        }

        hitungTotal();
    }

    function updateInfoHarga() {
        var firstSelect = document.querySelector('.item-row .layanan-select');
        if (!firstSelect || !firstSelect.selectedOptions[0] || !firstSelect.selectedOptions[0].value) {
            document.getElementById('infoHarga').innerHTML = '<i class="bi bi-info-circle me-1"></i>Pilih layanan untuk melihat info harga';
            return;
        }
        var tipe = firstSelect.selectedOptions[0].dataset.tipe;
        var texts = {
            'per_meter':  'Harga per meter persegi (P x L x Harga/m²)',
            'per_lembar': 'Harga per lembar (Qty x Harga/lembar)',
            'per_pcs':    'Harga per pcs (Qty x Harga/pcs)',
            'per_set':    'Harga per set (Qty x Harga/set)',
            'per_huruf':  'Harga per huruf (Qty x Harga/huruf)',
            'per_buku':   'Harga per buku (Qty x Harga/buku)',
        };
        document.getElementById('infoHarga').innerHTML = '<i class="bi bi-info-circle me-1"></i>' + (texts[tipe] || '');
    }

    document.getElementById('itemContainer').addEventListener('change', function(e) {
        if (e.target.classList.contains('layanan-select')) {
            updateTipeLayout(e.target.closest('.item-row'));
            updateInfoHarga();
        }
        hitungTotal();
    });

    document.getElementById('itemContainer').addEventListener('input', function(e) {
        if (e.target.classList.contains('panjang-input') ||
            e.target.classList.contains('lebar-input') ||
            e.target.classList.contains('qty-input')) {
            hitungTotal();
        }
    });

    document.getElementById('btnTambahItem').addEventListener('click', function() {
        var template = document.querySelector('.item-row').cloneNode(true);
        template.querySelectorAll('input').forEach(function(i) {
            if (i.type === 'number') i.value = i.classList.contains('qty-input') ? 1 : '';
            else if (i.type === 'checkbox') i.checked = false;
            else if (i.type === 'file') i.value = '';
            else if (!i.classList.contains('subtotal-display')) i.value = '';
        });

        var layananOpts = '<option value="">-- Pilih Layanan --</option>';
        layananData.forEach(function(l) {
            var unitLabel = l.tipe === 'per_meter' ? 'Rp ' + parseInt(l.hpm).toLocaleString('id-ID') + '/m²' :
                           'Rp ' + parseInt(l.harga).toLocaleString('id-ID') + '/' + getQtyLabel(l.tipe);
            layananOpts += '<option value="' + l.kode + '" data-harga="' + l.harga + '" data-hpm="' + l.hpm + '" data-diskon="' + l.diskon + '" data-tipe="' + l.tipe + '">' + l.nama + ' — ' + unitLabel + '</option>';
        });
        template.querySelector('.layanan-select').innerHTML = layananOpts;
        template.querySelector('.subtotal-display').value = 'Rp 0';
        template.dataset.tipe = 'per_pcs';

        var meterInputs = template.querySelectorAll('.input-meter');
        meterInputs.forEach(function(el) { el.style.display = 'none'; });

        var desainToggle = template.querySelector('.desain-toggle');
        if (desainToggle) desainToggle.style.display = 'none';

        template.querySelector('.qty-label').textContent = 'lembar';

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

    function validasiFile(input) {
        if (input.files && input.files[0]) {
            var file = input.files[0];
            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran file maksimal 10MB!');
                input.value = '';
                return;
            }
            var allowed = ['image/jpeg', 'image/png', 'application/pdf', 'application/illustrator', 'image/vnd.corelDRAW', 'image/vnd.adobe.photoshop'];
            if (!allowed.includes(file.type) && !file.name.match(/\.(jpg|jpeg|png|pdf|ai|cdr|psd)$/i)) {
                alert('Format file tidak diizinkan!');
                input.value = '';
            }
        }
    }

    document.getElementById('formPesanan').addEventListener('submit', function() {
        var btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Mengirim...';
    });
</script>
<?= $this->endSection() ?>

