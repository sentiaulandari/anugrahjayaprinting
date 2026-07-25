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

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('admin/pembelian/store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Supplier <span class="text-danger">*</span></label>
                    <select name="id_supplier" class="form-select" required>
                        <option value="">-- Pilih Supplier --</option>
                        <?php foreach ($supplier as $s): ?>
                            <option value="<?= $s['id_supplier'] ?>"><?= esc($s['nama_supplier']) ?> (<?= esc($s['nama_produk'] ?? '') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Bahan / Material <span class="text-danger">*</span></label>
                    <select name="id_bahan" class="form-select" required id="selectBahan">
                        <option value="">-- Pilih Bahan --</option>
                        <?php foreach ($bahan as $b): ?>
                            <option value="<?= $b['id_bahan'] ?>" data-stok="<?= $b['stok'] ?>" data-satuan="<?= $b['satuan'] ?>" data-harga="<?= $b['harga'] ?? 0 ?>">
                                <?= esc($b['nama_bahan']) ?> (Stok: <?= $b['stok'] ?> <?= esc($b['satuan']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold small">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah" class="form-control" min="1" required id="inputJumlah">
                    <small class="text-muted">Stok saat ini: <span id="stokInfo">-</span></small>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold small">Harga per Satuan (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_satuan" class="form-control" min="0" step="100" required id="inputHargaSatuan" value="0">
                    <div class="form-text">Harga per unit bahan ini</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold small">Harga Total (Rp)</label>
                    <input type="number" name="harga_total" class="form-control bg-light" readonly id="inputHargaTotal" value="0">
                    <div class="form-text">Otomatis: Jumlah × Harga Satuan</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold small">Tanggal Pembelian <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_pembelian" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold small">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan tambahan..."></textarea>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-sm" style="background:#1a1a2e;color:#fff;">
                    <i class="bi bi-check-lg me-1"></i>Simpan
                </button>
                <a href="<?= base_url('admin/pembelian') ?>" class="btn btn-sm btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('selectBahan').addEventListener('change', function() {
    var selected = this.options[this.selectedIndex];
    var stok = selected.getAttribute('data-stok');
    var satuan = selected.getAttribute('data-satuan');
    var harga = selected.getAttribute('data-harga');
    document.getElementById('stokInfo').textContent = stok ? stok + ' ' + satuan : '-';
    if (harga && harga > 0) {
        document.getElementById('inputHargaSatuan').value = harga;
    }
    hitungTotal();
});

function hitungTotal() {
    var jumlah = parseInt(document.getElementById('inputJumlah').value) || 0;
    var hargaSatuan = parseFloat(document.getElementById('inputHargaSatuan').value) || 0;
    document.getElementById('inputHargaTotal').value = jumlah * hargaSatuan;
}

document.getElementById('inputJumlah').addEventListener('input', hitungTotal);
document.getElementById('inputHargaSatuan').addEventListener('input', hitungTotal);
</script>
<?= $this->endSection() ?>
