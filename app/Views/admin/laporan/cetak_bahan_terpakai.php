<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Bahan Terpakai</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI',Arial,sans-serif; font-size:12px; color:#333; padding:20px; }
        .header { text-align:center; border-bottom:2px solid #333; padding-bottom:10px; margin-bottom:15px; }
        .header h2 { font-size:16px; margin-bottom:3px; }
        .header .sub { font-size:11px; color:#555; }
        .periode { text-align:center; margin-bottom:12px; font-size:11px; color:#666; }
        table { width:100%; border-collapse:collapse; margin-top:8px; }
        th { background:#f0f0f0; border:1px solid #ccc; padding:6px 8px; font-size:11px; text-align:left; }
        td { border:1px solid #ccc; padding:5px 8px; font-size:11px; }
        .text-center { text-align:center; }
        .text-right { text-align:right; }
        tfoot td { font-weight:700; background:#f8f8f8; }
        .footer { text-align:center; margin-top:20px; font-size:10px; color:#888; }
        @media print { @page { margin:10mm; } }
    </style>
</head>
<body>
    <div class="header">
        <h2>Anugrah Jaya Digital Printing</h2>
        <div class="sub">Laporan Bahan Terpakai</div>
        <div class="sub">Periode: <?= date('d/m/Y', strtotime($dari)) ?> — <?= date('d/m/Y', strtotime($sampai)) ?></div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Nama Bahan</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Pesanan Online</th>
                <th class="text-center">Transaksi Cetak</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($bahan)): ?>
                <tr><td colspan="6" class="text-center" style="padding:12px;color:#999;">Tidak ada data</td></tr>
            <?php else: ?>
                <?php foreach ($bahan as $i => $b): ?>
                <tr>
                    <td class="text-center"><?= $i + 1 ?></td>
                    <td><?= esc($b['nama_bahan']) ?></td>
                    <td class="text-center"><?= esc($b['satuan']) ?></td>
                    <td class="text-center"><?= number_format($b['dari_pesanan']) ?></td>
                    <td class="text-center"><?= number_format($b['dari_transaksi']) ?></td>
                    <td class="text-center" style="font-weight:700;"><?= number_format($b['total']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">TOTAL</td>
                <td class="text-center"><?= number_format(array_sum(array_column($bahan, 'dari_pesanan'))) ?></td>
                <td class="text-center"><?= number_format(array_sum(array_column($bahan, 'dari_transaksi'))) ?></td>
                <td class="text-center"><?= number_format(array_sum(array_column($bahan, 'total'))) ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">Dicetak pada: <?= date('d/m/Y H:i') ?> — Anugrah Jaya Digital Printing</div>
    <script>window.onload = function(){ window.print(); }</script>
</body>
</html>
