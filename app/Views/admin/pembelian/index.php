<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="page-title mb-0">Pengelolaan Pembelian</h4>
        <small class="text-muted">Catat pembelian bahan/material dari supplier</small>
    </div>
    <a href="<?= base_url('admin/pembelian/create') ?>" class="btn btn-sm" style="background:#1a1a2e;color:#fff;">
        <i class="bi bi-plus-lg me-1"></i>Tambah Pembelian
    </a>
</div>

<?= view('layouts/partials/alert') ?>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Jumlah Item</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pembelian)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox fs-2 text-muted d-block mb-2"></i>
                                <span class="text-muted small">Belum ada data pembelian</span>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pembelian as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="fw-semibold" style="font-size:0.85rem;"><?= esc($p['no_faktur'] ?? '-') ?></td>
                            <td style="font-size:0.82rem;"><?= date('d/m/Y', strtotime($p['tgl_pembelian'])) ?></td>
                            <td class="fw-semibold" style="font-size:0.85rem;"><?= esc($p['nama_supplier'] ?? '-') ?></td>
                            <td style="font-size:0.85rem;"><?= $p['total_item'] ?? 0 ?> item</td>
                            <td style="font-size:0.85rem;font-weight:600;">Rp <?= number_format($p['total_harga'] ?? 0, 0, ',', '.') ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?= base_url('admin/pembelian/show/' . $p['id_pembelian']) ?>"
                                        class="btn btn-sm btn-info text-white" style="font-size:0.75rem;">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= base_url('admin/pembelian/delete/' . $p['id_pembelian']) ?>"
                                        class="btn btn-sm btn-danger" style="font-size:0.75rem;"
                                        onclick="return confirm('Yakin hapus pembelian ini? Stok bahan akan dikurangi.')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
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
