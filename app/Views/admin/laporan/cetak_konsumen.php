<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Konsumen</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI',Arial,sans-serif; font-size:12px; color:#333; padding:20px; }
        .header { text-align:center; border-bottom:2px solid #333; padding-bottom:10px; margin-bottom:15px; }
        .header h2 { font-size:16px; margin-bottom:3px; }
        .header .sub { font-size:11px; color:#555; }
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
        <div class="sub">Laporan Konsumen</div>
        <div class="sub">Dicetak: <?= date('d/m/Y H:i') ?></div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Nama Konsumen</th>
                <th>No. HP</th>
                <th>Email</th>
                <th class="text-center">Total Pesanan</th>
                <th class="text-center">Selesai</th>
                <th class="text-right">Total Nilai</th>
                <th>Terakhir Pesan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pelanggan as $i => $p): ?>
            <tr>
                <td class="text-center"><?= $i + 1 ?></td>
                <td><?= esc($p['nama_pelanggan']) ?></td>
                <td><?= esc($p['no_hp'] ?? '-') ?></td>
                <td><?= esc($p['email'] ?? '-') ?></td>
                <td class="text-center"><?= $p['total_pesanan'] ?></td>
                <td class="text-center"><?= $p['pesanan_selesai'] ?></td>
                <td class="text-right">Rp <?= number_format($p['total_nilai'], 0, ',', '.') ?></td>
                <td><?= $p['terakhir_pesan'] ? date('d/m/Y', strtotime($p['terakhir_pesan'])) : '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">TOTAL</td>
                <td class="text-center"><?= array_sum(array_column($pelanggan, 'total_pesanan')) ?></td>
                <td class="text-center"><?= array_sum(array_column($pelanggan, 'pesanan_selesai')) ?></td>
                <td class="text-right">Rp <?= number_format(array_sum(array_column($pelanggan, 'total_nilai')), 0, ',', '.') ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">Dicetak pada: <?= date('d/m/Y H:i') ?> — Anugrah Jaya Digital Printing</div>
    <script>window.onload = function(){ window.print(); }</script>
</body>
</html>
