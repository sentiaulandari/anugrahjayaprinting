<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 15px; }
        .header h2 { margin: 0; font-size: 16px; }
        .header p { margin: 2px 0; font-size: 11px; color: #555; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #1a1a2e; color: #fff; padding: 6px 8px; text-align: left; font-size: 11px; }
        td { padding: 5px 8px; border-bottom: 1px solid #eee; font-size: 11px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .tfoot-row td { background-color: #f0f0f0; font-weight: bold; border-top: 2px solid #333; }
        .footer { margin-top: 20px; text-align: right; font-size: 10px; color: #888; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="no-print" style="margin-bottom:15px;">
    <button onclick="window.print()" style="padding:6px 16px;background:#1a1a2e;color:#fff;border:none;border-radius:4px;cursor:pointer;">
        Cetak / Print
    </button>
    <button onclick="window.close()" style="padding:6px 16px;background:#6c757d;color:#fff;border:none;border-radius:4px;cursor:pointer;margin-left:8px;">
        Tutup
    </button>
</div>

<div class="header">
    <h2>ANUGRAH JAYA DIGITAL PRINTING</h2>
    <p>Laporan Data Pesanan</p>
    <p>Periode: <?= date('d F Y', strtotime($dari)) ?> s/d <?= date('d F Y', strtotime($sampai)) ?></p>
</div>

<div class="info-row">
    <span>Dicetak: <?= date('d F Y H:i') ?></span>
    <span>Total Data: <?= count($pesanan) ?> pesanan</span>
</div>

<table>
    <thead>
        <tr>
            <th width="30">No</th>
            <th>No Pesanan</th>
            <th>Pelanggan</th>
            <th>Tgl Pesanan</th>
            <th>Est. Selesai</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($pesanan)): ?>
            <tr><td colspan="8" style="text-align:center;color:#999;padding:15px;">Tidak ada data</td></tr>
        <?php else: ?>
            <?php $grandTotal = 0; ?>
            <?php foreach ($pesanan as $i => $p): ?>
            <?php $grandTotal += $p['total_harga']; ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $p['no_pesanan'] ?></td>
                <td><?= $p['nama_pelanggan'] ?? '-' ?></td>
                <td><?= date('d/m/Y', strtotime($p['tgl_pesanan'])) ?></td>
                <td><?= $p['tgl_selesai'] ? date('d/m/Y', strtotime($p['tgl_selesai'])) : '-' ?></td>
                <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                <td><?= ucfirst($p['status_pesanan']) ?></td>
                <td><?= ucfirst($p['status_bayar']) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="tfoot-row">
                <td colspan="5" style="text-align:right;">Total Keseluruhan</td>
                <td>Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
                <td colspan="2"></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="footer">
    Sistem Informasi Anugrah Jaya Digital Printing &copy; <?= date('Y') ?>
</div>

</body>
</html>
