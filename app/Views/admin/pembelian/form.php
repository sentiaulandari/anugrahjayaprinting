<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Tambah Pembelian</h4>
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

<div class="card" style="max-width:680px;">
    <div class="card-header"><i class="bi bi-bag-plus me-2"></i>Form Pembelian Bahan</div>
    <div class="card-body">
        <form action="<?= base_url('admin/pembelian/store') ?>" method="POST" id="formPembelian">
            <?= csrf_field() ?>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">No. Pembelian</label>
                    <input type="text" class="form-control bg-light fw-semibold" value="<?= $no_baru ?>" readonly>
                    <div class="form-text">Otomatis dari sistem</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Tanggal Pembelian <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_pembelian" class="form-control"
                        value="<?= old('tgl_pembelian', $tgl_hari) ?>" required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Supplier</label>
                    <select name="id_supplier" class="form-select">
                        <option value="">-- Pilih Supplier (Opsional) --</option>
                        <?php foreach ($supplier as $s): ?>
                            <option value="<?= $s['id_supplier'] ?>" <?= old('id_supplier') == $s['id_supplier'] ? 'selected' : '' ?>>
                                <?= $s['nama_supplier'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Bahan / Material <span class="text-danger">*</span></label>
                    <select name="id_bahan" class="form-select" id="selectBahan" required>
                        <option value="">-- Pilih Bahan --</option>
                        <?php foreach ($bahan as $b): ?>
                            <option value="<?= $b['id_bahan'] ?>"
                                data-satuan="<?= $b['satuan'] ?>"
                                data-stok="<?= $b['stok'] ?>"
                                <?= old('id_bahan') == $b['id_bahan'] ? 'selected' : '' ?>>
                                <?= $b['nama_bahan'] ?> (stok: <?= $b['stok'] ?> <?= $b['satuan'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div id="infoBahan" class="alert py-2 small mb-3 d-none" style="background:rgba(13,110,253,0.06);border:1px solid rgba(13,110,253,0.15);">
                <i class="bi bi-info-circle me-1 text-primary"></i>
                Stok saat ini: <strong id="stokSaatIni">-</strong> <span id="satuanBahan"></span>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah" id="inputJumlah" class="form-control"
                        value="<?= old('jumlah', 1) ?>" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_satuan" id="inputHarga" class="form-control"
                        value="<?= old('harga_satuan', 0) ?>" min="0" step="100" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Total Harga</label>
                    <input type="text" id="totalHarga" class="form-control bg-light fw-bold text-primary" readonly value="Rp 0">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold small">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2"
                    placeholder="Keterangan pembelian..."><?= old('keterangan') ?></textarea>
            </div>

            <div class="alert alert-info py-2 small mb-4">
                <i class="bi bi-arrow-up-circle me-1"></i>
                Stok bahan akan <strong>otomatis bertambah</strong> sesuai jumlah yang dibeli setelah disimpan.
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i>Simpan Pembelian
                </button>
                <a href="<?= base_url('admin/pembelian') ?>" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    function hitungTotal() {
        const jumlah = parseInt(document.getElementById('inputJumlah').value) || 0;
        const harga  = parseFloat(document.getElementById('inputHarga').value) || 0;
        const total  = jumlah * harga;
        document.getElementById('totalHarga').value = 'Rp ' + total.toLocaleString('id-ID');
    }

    document.getElementById('inputJumlah').addEventListener('input', hitungTotal);
    document.getElementById('inputHarga').addEventListener('input', hitungTotal);

    document.getElementById('selectBahan').addEventListener('change', function() {
        const opt = this.selectedOptions[0];
        if (opt && opt.dataset.stok !== undefined) {
            document.getElementById('stokSaatIni').textContent = opt.dataset.stok;
            document.getElementById('satuanBahan').textContent  = opt.dataset.satuan;
            document.getElementById('infoBahan').classList.remove('d-none');
        } else {
            document.getElementById('infoBahan').classList.add('d-none');
        }
    });
</script>
<?= $this->endSection() ?>
