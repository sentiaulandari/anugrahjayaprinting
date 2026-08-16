<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0"><?= $title ?></h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pembelian') ?>">Pembelian</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol></nav>
    </div>
    <a href="<?= base_url('admin/pembelian') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<form action="<?= base_url('admin/pembelian/store') ?>" method="POST" id="formPembelian">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div class="col-lg-8">

            <div class="card mb-3">
                <div class="card-header"><i class="bi bi-info-circle me-2"></i>Informasi Pembelian</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">No. Faktur</label>
                            <input type="text" class="form-control bg-light fw-semibold" value="<?= $no_faktur ?>" readonly>
                            <div class="form-text">Otomatis dibuat sistem</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Supplier <span class="text-danger">*</span></label>
                            <select name="id_supplier" class="form-select" required>
                                <option value="">-- Pilih Supplier --</option>
                                <?php foreach ($supplier as $s): ?>
                                    <option value="<?= $s['id_supplier'] ?>"><?= esc($s['nama_supplier']) ?> (<?= esc($s['nama_produk'] ?? '') ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Tanggal Pembelian <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_pembelian" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan tambahan..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-list-ul me-2"></i>Item Pembelian</span>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="btnTambahItem">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body">
                    <div id="itemContainer">
                        <div class="item-row border rounded p-3 mb-2 bg-light">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Bahan / Material <span class="text-danger">*</span></label>
                                    <select name="id_bahan[]" class="form-select form-select-sm bahan-select" required>
                                        <option value="">-- Pilih Bahan --</option>
                                        <?php foreach ($bahan as $b): ?>
                                            <option value="<?= $b['id_bahan'] ?>"
                                                data-stok="<?= $b['stok'] ?>"
                                                data-satuan="<?= $b['satuan'] ?>"
                                                data-harga="<?= $b['harga'] ?? 0 ?>">
                                                <?= esc($b['nama_bahan']) ?> (Stok: <?= $b['stok'] ?> <?= esc($b['satuan']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" name="jumlah[]" class="form-control form-control-sm jumlah-input" min="1" value="1" required>
                                    <small class="text-muted stok-info">Stok: -</small>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Harga/Satuan (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" name="harga_satuan_beli[]" class="form-control form-control-sm harga-input" min="0" step="100" value="0" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Subtotal</label>
                                    <input type="text" class="form-control form-control-sm subtotal-display bg-white fw-semibold text-primary" readonly value="Rp 0">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-item w-100 mt-4">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <span class="small text-muted" id="jumlahItem">1 item</span>
                        <div>
                            <span class="fw-semibold">Grand Total: </span>
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
                        <span class="text-muted">No. Faktur</span>
                        <span class="fw-semibold font-monospace"><?= $no_faktur ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tgl Beli</span>
                        <span><?= date('d/m/Y') ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Grand Total</span>
                        <span class="fw-bold text-primary" id="ringkasanTotal">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <button type="submit" class="btn btn-sm w-100 mb-2" style="background:#1a1a2e;color:#fff;" id="btnSubmit">
                        <i class="bi bi-check-lg me-1"></i>Simpan Pembelian
                    </button>
                    <a href="<?= base_url('admin/pembelian') ?>" class="btn btn-outline-secondary w-100">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function formatRp(n) {
        return 'Rp ' + parseInt(n || 0).toLocaleString('id-ID');
    }

    function hitungSubtotal(row) {
        var jumlah = parseInt(row.querySelector('.jumlah-input').value) || 0;
        var harga  = parseFloat(row.querySelector('.harga-input').value) || 0;
        return jumlah * harga;
    }

    function hitungTotal() {
        var total = 0;
        var count = 0;
        document.querySelectorAll('.item-row').forEach(function(row) {
            var sub = hitungSubtotal(row);
            row.querySelector('.subtotal-display').value = formatRp(sub);
            total += sub;
            count++;
        });
        document.getElementById('grandTotal').textContent    = formatRp(total);
        document.getElementById('ringkasanTotal').textContent = formatRp(total);
        document.getElementById('jumlahItem').textContent    = count + ' item';
    }

    document.getElementById('itemContainer').addEventListener('change', function(e) {
        if (e.target.classList.contains('bahan-select')) {
            var row = e.target.closest('.item-row');
            var opt = e.target.selectedOptions[0];
            if (opt && opt.dataset.harga > 0) {
                row.querySelector('.harga-input').value = opt.dataset.harga;
            }
            var stokInfo = row.querySelector('.stok-info');
            if (opt && opt.dataset.stok !== undefined) {
                stokInfo.textContent = 'Stok: ' + opt.dataset.stok + ' ' + (opt.dataset.satuan || '');
            } else {
                stokInfo.textContent = 'Stok: -';
            }
            hitungTotal();
        }
    });

    document.getElementById('itemContainer').addEventListener('input', function(e) {
        if (e.target.classList.contains('jumlah-input') || e.target.classList.contains('harga-input')) {
            hitungTotal();
        }
    });

    document.getElementById('btnTambahItem').addEventListener('click', function() {
        var template = document.querySelector('.item-row').cloneNode(true);
        template.querySelectorAll('input').forEach(function(i) {
            if (i.type === 'number') {
                i.value = i.classList.contains('jumlah-input') ? 1 : '0';
            } else {
                i.value = '';
            }
        });
        var selects = template.querySelectorAll('select');
        selects.forEach(function(s) {
            s.selectedIndex = 0;
        });
        template.querySelector('.stok-info').textContent = 'Stok: -';
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

    document.getElementById('formPembelian').addEventListener('submit', function() {
        var btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...';
    });
</script>
<?= $this->endSection() ?>
