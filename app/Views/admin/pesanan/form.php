<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Buat Pesanan</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pesanan') ?>">Pesanan</a></li>
            <li class="breadcrumb-item active">Buat Baru</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pesanan') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<form action="<?= base_url('admin/pesanan/store') ?>" method="POST" id="formPesanan" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header"><i class="bi bi-person me-2"></i>Informasi Pesanan</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">No. Pesanan</label>
                            <input type="text" class="form-control bg-light fw-semibold" value="<?= $no_baru ?>" readonly>
                            <div class="form-text">Otomatis dibuat sistem</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Tanggal Pesanan</label>
                            <input type="text" class="form-control bg-light" value="<?= date('d F Y') ?>" readonly>
                            <div class="form-text">Otomatis hari ini</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Est. Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_selesai" class="form-control"
                                min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                                value="<?= old('tgl_selesai') ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold">Pelanggan <span class="text-danger">*</span></label>
                            <input type="hidden" name="id_pelanggan" id="inputIdPelanggan" value="<?= old('id_pelanggan') ?>" required>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" id="displayPelanggan" class="form-control"
                                    placeholder="Ketik nama, no HP, atau email untuk mencari..." readonly
                                    value="" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalCariPelanggan">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCariPelanggan">
                                    <i class="bi bi-search me-1"></i>Cari
                                </button>
                                <button type="button" class="btn btn-outline-danger" id="btnClearPelanggan" title="Hapus pilihan" style="display:none;">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="form-text">Klik tombol Cari atau ketik untuk mencari pelanggan</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="2"
                                placeholder="Catatan tambahan..."><?= old('catatan') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-list-ul me-2"></i>Item Layanan</span>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btnTambahItem">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body">
                    <div id="itemContainer">
                        <div class="item-row border rounded p-3 mb-2 bg-light" data-tipe="per_pcs">
                            <div class="row g-2 align-items-end">
                                <!-- Baris 1: Layanan + Qty + Harga + Subtotal + Hapus -->
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Layanan <span class="text-danger">*</span></label>
                                    <select name="kode_layanan[]" class="form-select form-select-sm layanan-select" required>
                                        <option value="">-- Pilih --</option>
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
                                                    — Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?>
                                                <?php endif; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-6 col-md-2 input-meter" style="display:none;">
                                    <label class="form-label small fw-semibold">P × L (m)</label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" name="panjang[]" class="form-control form-control-sm panjang-input" step="0.01" min="0" placeholder="P">
                                        <span class="input-group-text px-1">×</span>
                                        <input type="number" name="lebar[]" class="form-control form-control-sm lebar-input" step="0.01" min="0" placeholder="L">
                                    </div>
                                </div>
                                <div class="col-6 col-md-1">
                                    <label class="form-label small fw-semibold">Qty</label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" name="qty[]" class="form-control form-control-sm qty-input" value="1" min="1" required>
                                    </div>
                                    <small class="text-muted qty-label" style="font-size:10px;">pcs</small>
                                </div>
                                <div class="col-6 col-md-2">
                                    <label class="form-label small fw-semibold">Harga Satuan</label>
                                    <input type="text" class="form-control form-control-sm harga-display bg-white" readonly value="Rp 0">
                                </div>
                                <div class="col-6 col-md-2">
                                    <label class="form-label small fw-semibold">Subtotal</label>
                                    <input type="text" class="form-control form-control-sm subtotal-display bg-white fw-semibold text-primary" readonly value="Rp 0">
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-item w-100">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <!-- Baris 2: Upload Desain + Keterangan -->
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Upload Desain <span class="text-muted">(Opsional)</span></label>
                                    <input type="file" name="file_desain[]" class="form-control form-control-sm file-desain-input"
                                        accept=".jpg,.jpeg,.png,.pdf,.ai,.cdr,.psd" onchange="validasiFile(this)">
                                    <div class="form-text" style="font-size:10px;">JPG, PNG, PDF, AI, CDR, PSD — maks 10MB</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Keterangan</label>
                                    <input type="text" name="keterangan_detail[]" class="form-control form-control-sm"
                                        placeholder="Keterangan item (opsional)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <span class="small text-muted" id="jumlahItem">1 item</span>
                        <div>
                            <span class="fw-semibold">Total: </span>
                            <span class="fw-bold text-primary fs-5" id="grandTotal">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><i class="bi bi-receipt me-2"></i>Ringkasan</div>
                <div class="card-body small">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">No. Pesanan</span>
                        <span class="fw-semibold"><?= $no_baru ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tgl Pesanan</span>
                        <span><?= date('d/m/Y') ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status</span>
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold text-primary" id="ringkasanTotal">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100 mb-2" id="btnSubmit">
                        <i class="bi bi-save me-1"></i>Simpan Pesanan
                    </button>
                    <a href="<?= base_url('admin/pesanan') ?>" class="btn btn-outline-secondary w-100">Batal</a>
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
            return hargaSatuan * qty;
        }

        return hargaFix * qty;
    }

    function hitungTotal() {
        let total = 0;
        let count = 0;
        document.querySelectorAll('.item-row').forEach(function(row) {
            var sub = hitungSubtotal(row);
            var sel = row.querySelector('.layanan-select');
            var opt = sel.selectedOptions[0];
            var harga = 0;
            if (opt && opt.value) {
                var tipe = opt.dataset.tipe || 'per_pcs';
                if (tipe === 'per_meter') {
                    var p = parseFloat(row.querySelector('.panjang-input').value) || 0;
                    var l = parseFloat(row.querySelector('.lebar-input').value) || 0;
                    harga = p * l * (parseFloat(opt.dataset.hpm) || 0);
                } else {
                    harga = parseFloat(opt.dataset.harga) || 0;
                }
            }
            row.querySelector('.harga-display').value    = formatRp(harga);
            row.querySelector('.subtotal-display').value = formatRp(sub);
            total += sub;
            count++;
        });
        document.getElementById('grandTotal').textContent    = formatRp(total);
        document.getElementById('ringkasanTotal').textContent = formatRp(total);
        document.getElementById('jumlahItem').textContent    = count + ' item';
    }

    function updateTipeLayout(row) {
        var sel = row.querySelector('.layanan-select');
        var opt = sel.selectedOptions[0];
        var meterInputs = row.querySelectorAll('.input-meter');
        var qtyLabel    = row.querySelector('.qty-label');

        if (!opt || !opt.value) {
            meterInputs.forEach(function(el) { el.style.display = 'none'; });
            qtyLabel.textContent = 'pcs';
            return;
        }

        var tipe = opt.dataset.tipe || 'per_pcs';
        row.dataset.tipe = tipe;

        if (tipe === 'per_meter') {
            meterInputs.forEach(function(el) { el.style.display = ''; });
        } else {
            meterInputs.forEach(function(el) { el.style.display = 'none'; });
        }
        qtyLabel.textContent = getQtyLabel(tipe);
    }

    document.getElementById('itemContainer').addEventListener('change', function(e) {
        if (e.target.classList.contains('layanan-select')) {
            updateTipeLayout(e.target.closest('.item-row'));
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
        const template = document.querySelector('.item-row').cloneNode(true);
        template.querySelectorAll('input').forEach(function(i) {
            if (i.type === 'number') i.value = i.classList.contains('qty-input') ? 1 : '';
            else if (i.type === 'checkbox') i.checked = false;
            else if (i.type === 'file') i.value = '';
            else if (!i.classList.contains('subtotal-display') && !i.classList.contains('harga-display')) i.value = '';
        });

        var layananOpts = '<option value="">-- Pilih --</option>';
        layananData.forEach(function(l) {
            var unitLabel = l.tipe === 'per_meter' ? 'Rp ' + parseInt(l.hpm).toLocaleString('id-ID') + '/m²' :
                           'Rp ' + parseInt(l.harga).toLocaleString('id-ID') + '/' + getQtyLabel(l.tipe);
            layananOpts += '<option value="' + l.kode + '" data-harga="' + l.harga + '" data-hpm="' + l.hpm + '" data-diskon="' + l.diskon + '" data-tipe="' + l.tipe + '">' + l.nama + ' — ' + unitLabel + '</option>';
        });
        template.querySelector('.layanan-select').innerHTML = layananOpts;
        template.querySelector('.subtotal-display').value = 'Rp 0';
        template.querySelector('.harga-display').value    = 'Rp 0';

        // Sembunyikan input meter saat clone
        template.querySelectorAll('.input-meter').forEach(function(el) { el.style.display = 'none'; });
        template.querySelector('.qty-label').textContent = 'pcs';

        document.getElementById('itemContainer').appendChild(template);
        hitungTotal();
    });

    document.getElementById('itemContainer').addEventListener('click', function(e) {
        if (e.target.closest('.btn-hapus-item')) {
            const rows = document.querySelectorAll('.item-row');
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
            }
        }
    }

    document.getElementById('formPesanan').addEventListener('submit', function(e) {
        // Validasi pelanggan dipilih
        const idPelanggan = document.getElementById('inputIdPelanggan').value;
        if (!idPelanggan) {
            e.preventDefault();
            alert('Harap pilih pelanggan terlebih dahulu!');
            document.getElementById('modalCariPelanggan') && new bootstrap.Modal(document.getElementById('modalCariPelanggan')).show();
            return;
        }
        const btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...';
    });

    // Modal cari pelanggan
    var modalCariPelangganEl = document.getElementById('modalCariPelanggan');
    var modalSearchInput     = document.getElementById('modalSearchPelanggan');
    var modalHasil           = document.getElementById('modalHasilPelanggan');
    var displayPelanggan     = document.getElementById('displayPelanggan');
    var inputIdPelanggan     = document.getElementById('inputIdPelanggan');
    var btnClearPelanggan    = document.getElementById('btnClearPelanggan');
    var modalTimer;

    function renderTabelPelanggan(data) {
        if (!data.length) {
            return '<div class="text-center text-muted py-4">Pelanggan tidak ditemukan</div>';
        }
        var html = '<div class="table-responsive"><table class="table table-hover align-middle mb-0">';
        html += '<thead class="table-light"><tr><th>No</th><th>Nama</th><th>No. HP</th><th>Email</th><th width="80">Aksi</th></tr></thead><tbody>';
        data.forEach(function(p, i) {
            html += '<tr>';
            html += '<td>' + (i + 1) + '</td>';
            html += '<td class="fw-semibold">' + (p.nama_pelanggan || '-') + '</td>';
            html += '<td>' + (p.no_hp || '-') + '</td>';
            html += '<td>' + (p.email || '-') + '</td>';
            html += '<td><button type="button" class="btn btn-sm btn-primary btn-pilih-pelanggan" '
                    + 'data-id="' + p.id_pelanggan + '" '
                    + 'data-nama="' + (p.nama_pelanggan || '') + '" '
                    + 'data-hp="' + (p.no_hp || '') + '">'
                    + '<i class="bi bi-check-lg"></i></button></td>';
            html += '</tr>';
        });
        html += '</tbody></table></div>';
        return html;
    }

    function pilihPelanggan(id, nama, hp) {
        inputIdPelanggan.value  = id;
        displayPelanggan.value  = nama + (hp ? ' (' + hp + ')' : '');
        btnClearPelanggan.style.display = '';
        bootstrap.Modal.getInstance(document.getElementById('modalCariPelanggan')).hide();
    }

    btnClearPelanggan.addEventListener('click', function() {
        inputIdPelanggan.value  = '';
        displayPelanggan.value  = '';
        btnClearPelanggan.style.display = 'none';
    });

    modalHasil.addEventListener('click', function(e) {
        var btn = e.target.closest('.btn-pilih-pelanggan');
        if (btn) pilihPelanggan(btn.dataset.id, btn.dataset.nama, btn.dataset.hp);
    });

    modalSearchInput.addEventListener('input', function() {
        var q = this.value.trim();
        clearTimeout(modalTimer);
        if (q.length < 2) {
            modalHasil.innerHTML = '<div class="text-center text-muted py-4">Ketik minimal 2 karakter untuk mencari</div>';
            return;
        }
        modalHasil.innerHTML = '<div class="text-center py-3"><span class="spinner-border spinner-border-sm me-1"></span>Mencari...</div>';
        modalTimer = setTimeout(function() {
            fetch('<?= base_url('admin/pelanggan/search') ?>?q=' + encodeURIComponent(q))
                .then(function(r) { return r.json(); })
                .then(function(data) { modalHasil.innerHTML = renderTabelPelanggan(data); });
        }, 300);
    });

    document.getElementById('modalCariPelanggan').addEventListener('shown.bs.modal', function() {
        modalSearchInput.focus();
        // Load semua pelanggan saat pertama dibuka
        modalHasil.innerHTML = '<div class="text-center py-3"><span class="spinner-border spinner-border-sm me-1"></span>Memuat data konsumen...</div>';
        fetch('<?= base_url('admin/pelanggan/search') ?>?q= ')
            .then(function(r) { return r.json(); })
            .then(function(data) { modalHasil.innerHTML = renderTabelPelanggan(data); });
    });
    document.getElementById('modalCariPelanggan').addEventListener('hidden.bs.modal', function() {
        modalSearchInput.value = '';
    });
</script>

<!-- Modal Cari Pelanggan -->
<div class="modal fade" id="modalCariPelanggan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title"><i class="bi bi-person-search me-1"></i>Cari Pelanggan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="modalSearchPelanggan" class="form-control" placeholder="Ketik nama, no HP, atau email...">
                </div>
                <div id="modalHasilPelanggan" style="max-height:400px;overflow-y:auto;">
                    <div class="text-center text-muted py-4">Ketik minimal 2 karakter untuk mencari</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
