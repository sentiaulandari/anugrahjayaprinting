<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Pengelolaan Produk</h4>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small"><li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>            <li class="breadcrumb-item active">Produk</li></ol></nav>
    </div>
    <a href="<?= base_url('admin/layanan/create') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Produk
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-grid-3x3-gap me-2"></i>Daftar Produk</span>
        <span class="badge bg-primary"><?= count($layanan) ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tblLayanan">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Tipe Harga</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($layanan)): ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data produk</td></tr>
                    <?php else: ?>
                        <?php foreach ($layanan as $i => $l): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><span class="badge bg-light text-dark border"><?= $l['kode_layanan'] ?></span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if ($l['gambar']): ?>
                                        <img src="<?= base_url('uploads/layanan/' . $l['gambar']) ?>" width="36" height="36" class="rounded object-fit-cover" alt="">
                                    <?php else: ?>
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:36px;height:36px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    <span class="fw-semibold"><?= $l['nama_layanan'] ?></span>
                                </div>
                            </td>
                            <td><?= $l['nama_kategori'] ?? '-' ?></td>
                            <td>
                                <?php
                                $tipeLabels = ['per_meter' => 'Per Meter', 'per_lembar' => 'Per Lembar', 'per_pcs' => 'Per Pcs', 'per_set' => 'Per Set', 'per_huruf' => 'Per Huruf', 'per_buku' => 'Per Buku'];
                                $tipe = $l['tipe_harga'] ?? 'per_pcs';
                                ?>
                                <span class="badge bg-secondary" style="font-size:0.7rem;"><?= $tipeLabels[$tipe] ?? $tipe ?></span>
                            </td>
                            <td>
                                <?php if ($tipe === 'per_meter' && ($l['harga_per_meter'] ?? 0) > 0): ?>
                                    Rp <?= number_format($l['harga_per_meter'], 0, ',', '.') ?>/m²
                                <?php elseif (($l['harga_satuan'] ?? 0) > 0): ?>
                                    Rp <?= number_format($l['harga_satuan'], 0, ',', '.') ?>/<?= $tipe === 'per_lembar' ? 'lbr' : ($tipe === 'per_set' ? 'set' : ($tipe === 'per_buku' ? 'buku' : ($tipe === 'per_huruf' ? 'huruf' : 'pcs'))) ?>
                                <?php else: ?>
                                    <span class="text-muted">Rp 0</span>
                                <?php endif; ?>
                            </td>
                            <td><?= view('layouts/partials/badge_status', ['status' => $l['status']]) ?></td>
                            <td>
                                <a href="<?= base_url('admin/layanan/edit/' . $l['kode_layanan']) ?>" class="btn btn-sm btn-outline-warning py-1 px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('admin/layanan/delete/' . $l['kode_layanan']) ?>"
                                    class="btn btn-sm btn-outline-danger py-1 px-2 btn-hapus" title="Hapus"
                                    data-nama="<?= $l['nama_layanan'] ?>">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.querySelectorAll('.btn-hapus').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Hapus produk "' + this.dataset.nama + '"?')) {
                window.location.href = this.href;
            }
        });
    });
</script>
<?= $this->endSection() ?>
