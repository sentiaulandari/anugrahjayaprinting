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

<form action="<?= base_url('admin/pesanan/store') ?>" method="POST" id="formPesanan">
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
                            <select name="id_pelanggan" class="form-select" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php foreach ($pelanggan as $p): ?>
                                    <option value="<?= $p['id_pelanggan'] ?>" <?= old('id_pelanggan') == $p['id_pelanggan'] ? 'selected' : '' ?>>
                                        <?= $p['nama_pelanggan'] ?> <?= $p['no_hp'] ? '(' . $p['no_hp'] . ')' : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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
                        <div class="item-row border rounded p-3 mb-2 bg-light">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Layanan</label>
                                    <select name="kode_layanan[]" class="form-select form-select-sm layanan-select" required>
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($layanan as $l): ?>
                                            <option value="<?= $l['kode_layanan'] ?>" data-harga="<?= $l['harga_satuan'] ?>">
                                                <?= $l['nama_layanan'] ?> — Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Qty</label>
                                    <input type="number" name="qty[]" class="form-control form-control-sm qty-input" value="1" min="1" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Harga</label>
                                    <input type="text" class="form-control form-control-sm harga-display bg-white" readonly value="Rp 0">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label small fw-semibold">Subtotal</label>
                                    <input type="text" class="form-control form-control-sm subtotal-display bg-white fw-semibold text-primary" readonly value="Rp 0">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label small fw-semibold">Ukuran</label>
                                    <input type="text" name="ukuran[]" class="form-control form-control-sm" placeholder="3x1m">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-item w-100 mt-4">
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
    const layananOptions = `<?php foreach ($layanan as $l): ?><option value="<?= $l['kode_layanan'] ?>" data-harga="<?= $l['harga_satuan'] ?>"><?= $l['nama_layanan'] ?> — Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?></option><?php endforeach; ?>`;

    function formatRp(n) {
        return 'Rp ' + parseInt(n || 0).toLocaleString('id-ID');
    }

    function hitungTotal() {
        let total = 0;
        let count = 0;

        document.querySelectorAll('.item-row').forEach(function(row) {
            const sel   = row.querySelector('.layanan-select');
            const qty   = parseInt(row.querySelector('.qty-input').value) || 0;
            const harga = sel.selectedOptions[0] ? parseFloat(sel.selectedOptions[0].dataset.harga) || 0 : 0;
            const sub   = qty * harga;

            row.querySelector('.harga-display').value    = formatRp(harga);
            row.querySelector('.subtotal-display').value = formatRp(sub);
            total += sub;
            count++;
        });

        document.getElementById('grandTotal').textContent    = formatRp(total);
        document.getElementById('ringkasanTotal').textContent = formatRp(total);
        document.getElementById('jumlahItem').textContent    = count + ' item';
    }

    document.getElementById('itemContainer').addEventListener('change', hitungTotal);
    document.getElementById('itemContainer').addEventListener('input', hitungTotal);

    document.getElementById('btnTambahItem').addEventListener('click', function() {
        const template = document.querySelector('.item-row').cloneNode(true);
        template.querySelectorAll('input').forEach(function(i) {
            if (i.type === 'number') i.value = 1;
            else if (!i.classList.contains('subtotal-display') && !i.classList.contains('harga-display')) i.value = '';
        });
        template.querySelector('.layanan-select').innerHTML = '<option value="">-- Pilih --</option>' + layananOptions;
        template.querySelector('.subtotal-display').value = 'Rp 0';
        template.querySelector('.harga-display').value    = 'Rp 0';
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

    document.getElementById('formPesanan').addEventListener('submit', function() {
        const btn = document.getElementById('btnSubmit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...';
    });
</script>
<?= $this->endSection() ?>
