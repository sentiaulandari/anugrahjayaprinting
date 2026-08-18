<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Tambah Transaksi Cetak</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/transaksi-cetak') ?>">Transaksi Cetak</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/transaksi-cetak') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<form action="<?= base_url('admin/transaksi-cetak/store') ?>" method="POST" id="formTransaksi">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header"><i class="bi bi-person me-2"></i>Informasi Transaksi</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">No. Transaksi</label>
                            <input type="text" class="form-control bg-light fw-semibold" value="<?= $no_baru ?>" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Tanggal</label>
                            <input type="date" name="tgl_transaksi" class="form-control" value="<?= $tgl_hari ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">Konsumen</label>
                            <div class="input-group">
                                <input type="text" id="displayTextKonsumen" class="form-control bg-light" value="" placeholder="Belum dipilih" readonly>
                                <input type="hidden" name="nama_pelanggan" id="inputNamaKonsumen">
                                <input type="hidden" name="id_pelanggan" id="inputIdKonsumen">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCariKonsumen" title="Cari Konsumen">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">No. HP</label>
                            <input type="text" name="no_hp" id="inputNoHp" class="form-control" placeholder="08xx" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Metode Bayar <span class="text-danger">*</span></label>
                            <select name="metode_bayar" class="form-select" required>
                                <option value="Tunai">Tunai</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Transfer BCA">Transfer BCA</option>
                                <option value="Transfer Mandiri">Transfer Mandiri</option>
                                <option value="DANA">DANA</option>
                                <option value="OVO">OVO</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <label class="form-label small fw-semibold">Catatan</label>
                            <input type="text" name="catatan" class="form-control" placeholder="Catatan transaksi...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-list-ul me-2"></i>Item Produk</span>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btnTambahItem">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body">
                    <div id="itemContainer">
                        <div class="item-row border rounded p-3 mb-2 bg-light">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Produk</label>
                                    <select name="kode_layanan[]" class="form-select form-select-sm layanan-select">
                                        <option value="">-- Pilih --</option>
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
                                <div class="col-md-1">
                                    <label class="form-label small fw-semibold">Qty</label>
                                    <input type="number" name="qty[]" class="form-control form-control-sm qty-input" value="1" min="1">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label small fw-semibold">P (m)</label>
                                    <input type="number" name="panjang[]" class="form-control form-control-sm panjang-input" step="0.01" min="0" placeholder="0">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label small fw-semibold">L (m)</label>
                                    <input type="number" name="lebar[]" class="form-control form-control-sm lebar-input" step="0.01" min="0" placeholder="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Desain Sendiri</label>
                                    <div class="form-check form-switch mt-1">
                                        <input type="checkbox" name="desain_sendiri[]" class="form-check-input desain-input" value="1">
                                        <label class="form-check-label small text-muted">Diskon</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Subtotal</label>
                                    <input type="text" class="form-control form-control-sm subtotal-display bg-white fw-semibold text-primary" readonly value="Rp 0">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-item w-100 mt-3"><i class="bi bi-trash"></i></button>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="keterangan_detail[]" class="form-control form-control-sm" placeholder="Keterangan (opsional)">
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
                        <span class="text-muted">No. Transaksi</span>
                        <span class="fw-semibold"><?= $no_baru ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tanggal</span>
                        <span><?= date('d/m/Y') ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status</span>
                        <span class="badge bg-success">Lunas (Offline)</span>
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
                        <i class="bi bi-save me-1"></i>Simpan Transaksi
                    </button>
                    <a href="<?= base_url('admin/transaksi-cetak') ?>" class="btn btn-outline-secondary w-100">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="modalCariKonsumen" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title"><i class="bi bi-search me-1"></i>Cari Konsumen</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="p-3 border-bottom bg-light">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-person-search"></i></span>
                        <input type="text" id="modalInputSearch" class="form-control" placeholder="Ketik nama, no HP, atau email...">
                        <button type="button" class="btn btn-outline-secondary" id="btnResetSearch" title="Reset pencarian">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div class="small text-muted mt-1 ps-1" id="infoJumlahKonsumen"></div>
                </div>
                <div id="modalHasilKonsumen" style="max-height:400px;overflow-y:auto;">
                    <div class="text-center py-4">
                        <span class="spinner-border spinner-border-sm text-primary me-2"></span>Memuat data konsumen...
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 justify-content-between">
                <small class="text-muted">Klik <strong>Pilih</strong> untuk memilih konsumen</small>
                <button type="button" class="btn btn-sm btn-outline-danger" id="btnClearKonsumen">
                    <i class="bi bi-x-lg me-1"></i>Hapus Pilihan
                </button>
            </div>
        </div>
    </div>
</div>

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
        var harga = panjang * lebar * hpm;
        if (desain && harga > 0) harga = Math.max(0, harga - diskon);
        if (harga <= 0) harga = hargaFix;
        return harga * qty;
    }

    function hitungTotal() {
        var total = 0, count = 0;
        document.querySelectorAll('.item-row').forEach(function(row) {
            var sub = hitungSubtotal(row);
            row.querySelector('.subtotal-display').value = formatRp(sub);
            total += sub;
            count++;
        });
        document.getElementById('grandTotal').textContent = formatRp(total);
        document.getElementById('ringkasanTotal').textContent = formatRp(total);
        document.getElementById('jumlahItem').textContent = count + ' item';
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
        template.querySelector('.layanan-select').innerHTML = '<option value="">-- Pilih --</option>' + layananOptions;
        template.querySelector('.subtotal-display').value = 'Rp 0';
        document.getElementById('itemContainer').appendChild(template);
        hitungTotal();
    });

    document.getElementById('itemContainer').addEventListener('click', function(e) {
        if (e.target.closest('.btn-hapus-item')) {
            var rows = document.querySelectorAll('.item-row');
            if (rows.length > 1) { e.target.closest('.item-row').remove(); hitungTotal(); }
        }
    });

    document.getElementById('formTransaksi').addEventListener('submit', function() {
        var btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...';
    });

    var modalSearchInput  = document.getElementById('modalInputSearch');
    var modalHasil        = document.getElementById('modalHasilKonsumen');
    var displayText       = document.getElementById('displayTextKonsumen');
    var hiddenNama        = document.getElementById('inputNamaKonsumen');
    var hiddenId          = document.getElementById('inputIdKonsumen');
    var inputNoHp         = document.getElementById('inputNoHp');
    var infoJumlah        = document.getElementById('infoJumlahKonsumen');
    var modalTimer;

    function renderTabelKonsumen(data) {
        if (data.length === 0) {
            return '<div class="text-center text-muted py-4"><i class="bi bi-person-x fs-3 d-block mb-2"></i>Konsumen tidak ditemukan</div>';
        }
        infoJumlah.textContent = 'Menampilkan ' + data.length + ' konsumen';
        var html = '<table class="table table-hover table-sm align-middle mb-0">';
        html += '<thead class="table-light sticky-top"><tr>';
        html += '<th class="ps-3" style="width:40px;">No</th>';
        html += '<th>Nama Konsumen</th>';
        html += '<th>No. HP</th>';
        html += '<th class="d-none d-md-table-cell">Email</th>';
        html += '<th style="width:80px;" class="text-center">Aksi</th>';
        html += '</tr></thead><tbody>';
        data.forEach(function(p, i) {
            var nama = p.nama_pelanggan || '-';
            var hp   = p.no_hp || '-';
            var email = p.email || '-';
            var isSelected = hiddenId.value == p.id_pelanggan;
            html += '<tr class="' + (isSelected ? 'table-primary' : '') + '">';
            html += '<td class="ps-3 text-muted small">' + (i + 1) + '</td>';
            html += '<td><span class="fw-semibold">' + nama + '</span></td>';
            html += '<td class="small">' + hp + '</td>';
            html += '<td class="small d-none d-md-table-cell text-muted">' + email + '</td>';
            html += '<td class="text-center">';
            if (isSelected) {
                html += '<span class="badge bg-success"><i class="bi bi-check2 me-1"></i>Dipilih</span>';
            } else {
                html += '<button type="button" class="btn btn-sm btn-primary btn-pilih-konsumen px-2 py-1" ';
                html += 'data-nama="' + nama + '" data-id="' + p.id_pelanggan + '" data-hp="' + (p.no_hp || '') + '">';
                html += '<i class="bi bi-check-lg me-1"></i>Pilih</button>';
            }
            html += '</td></tr>';
        });
        html += '</tbody></table>';
        return html;
    }

    function fetchKonsumen(q) {
        modalHasil.innerHTML = '<div class="text-center py-3"><span class="spinner-border spinner-border-sm text-primary me-2"></span>Mencari...</div>';
        infoJumlah.textContent = '';
        fetch('<?= base_url('admin/pelanggan/search') ?>?q=' + encodeURIComponent(q))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                modalHasil.innerHTML = renderTabelKonsumen(data);
            })
            .catch(function() {
                modalHasil.innerHTML = '<div class="text-center text-danger py-3"><i class="bi bi-exclamation-triangle me-1"></i>Gagal memuat data</div>';
            });
    }

    function pilihKonsumen(nama, id, hp) {
        displayText.value = nama;
        hiddenNama.value  = nama;
        hiddenId.value    = id;
        inputNoHp.value   = hp;
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalCariKonsumen'));
        modal.hide();
        modalSearchInput.value = '';
    }

    // Load data saat modal dibuka
    document.getElementById('modalCariKonsumen').addEventListener('show.bs.modal', function() {
        modalSearchInput.value = '';
        infoJumlah.textContent = '';
        fetchKonsumen('');
    });
    // Fokus ke input setelah modal terbuka
    document.getElementById('modalCariKonsumen').addEventListener('shown.bs.modal', function() {
        modalSearchInput.focus();
    });

    // Pencarian dengan debounce
    modalSearchInput.addEventListener('input', function() {
        var q = this.value.trim();
        clearTimeout(modalTimer);
        modalTimer = setTimeout(function() {
            fetchKonsumen(q);
        }, 300);
    });

    // Tombol X reset input dan reload semua
    document.getElementById('btnResetSearch').addEventListener('click', function() {
        modalSearchInput.value = '';
        infoJumlah.textContent = '';
        fetchKonsumen('');
        modalSearchInput.focus();
    });

    // Event delegation klik Pilih
    modalHasil.addEventListener('click', function(e) {
        var btn = e.target.closest('.btn-pilih-konsumen');
        if (btn) {
            pilihKonsumen(btn.dataset.nama, btn.dataset.id, btn.dataset.hp);
        }
    });

    // Tombol Hapus Pilihan
    document.getElementById('btnClearKonsumen').addEventListener('click', function() {
        displayText.value = '';
        hiddenNama.value  = '';
        hiddenId.value    = '';
        inputNoHp.value   = '';
        // refresh tabel agar badge "Dipilih" hilang
        fetchKonsumen(modalSearchInput.value.trim());
    });
    });

</script>
<?= $this->endSection() ?>
