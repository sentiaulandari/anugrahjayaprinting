<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Bahan</title>
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
        .badge-aman { background:#d1fae5; color:#065f46; padding:2px 8px; border-radius:10px; font-size:10px; }
        .badge-menipis { background:#fee2e2; color:#991b1b; padding:2px 8px; border-radius:10px; font-size:10px; }
        .footer { margin-top: 20px; text-align: right; font-size: 10px; color: #888; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="no-print" style="margin-bottom:15px;">
    <button onclick="window.print()" style="padding:6px 16px;background:#1a1a2e;color:#fff;border:none;border-radius:4px;cursor:pointer;">Cetak / Print</button>
    <button onclick="window.close()" style="padding:6px 16px;background:#6c757d;color:#fff;border:none;border-radius:4px;cursor:pointer;margin-left:8px;">Tutup</button>
</div>

<div class="header">
    <h2>ANUGRAH JAYA DIGITAL PRINTING</h2>
    <p>Laporan Stok Bahan/Material</p>
    <p>Per Tanggal: <?= date('d F Y') ?></p>
</div>

<div class="info-row">
    <span>Dicetak: <?= date('d F Y H:i') ?></span>
    <span>Total Data: <?= count($bahan) ?> bahan</span>
</div>

<table>
    <thead>
        <tr>
            <th width="30">No</th>
            <th>Nama Bahan</th>
            <th>Satuan</th>
            <th>Stok Tersedia</th>
            <th>Stok Minimum</th>
            <th>Kondisi</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($bahan)): ?>
            <tr><td colspan="7" style="text-align:center;color:#999;padding:15px;">Tidak ada data</td></tr>
        <?php else: ?>
            <?php foreach ($bahan as $i => $b): ?>
            <?php $menipis = $b['stok'] <= $b['stok_minimum']; ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $b['nama_bahan'] ?></td>
                <td><?= $b['satuan'] ?></td>
                <td style="font-weight:bold;color:<?= $menipis ? '#dc2626' : '#16a34a' ?>;"><?= $b['stok'] ?></td>
                <td><?= $b['stok_minimum'] ?></td>
                <td>
                    <?php if ($menipis): ?>
                        <span class="badge-menipis">Menipis</span>
                    <?php else: ?>
                        <span class="badge-aman">Aman</span>
                    <?php endif; ?>
                </td>
                <td><?= $b['keterangan'] ?? '-' ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<div class="footer">
    Sistem Informasi Anugrah Jaya Digital Printing &copy; <?= date('Y') ?>
</div>

</body>
</html>
