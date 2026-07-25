<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pertahun <?= esc($tahun) ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 20px; }
        h2 { text-align: center; margin-bottom: 5px; }
        .subtitle { text-align: center; color: #666; margin-bottom: 20px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px 10px; text-align: left; }
        th { background: #1a1a2e; color: #fff; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; font-size: 11px; }
        @media print { body { padding: 0; } }
    </style>
</head>
<body>
    <h2>Anugrah Jaya Digital Printing</h2>
    <div class="subtitle">Laporan Pertahun Tahun <?= esc($tahun) ?><br>Cetak: <?= date('d F Y H:i') ?></div>

    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th class="text-end">Pendapatan</th>
                <th class="text-end">Pengeluaran</th>
                <th class="text-end">Laba Bersih</th>
                <th class="text-center">Pesanan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $namaBulan = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            ?>
            <?php for ($b = 1; $b <= 12; $b++): ?>
            <?php $laba = $pendapatanPerBulan[$b] - $pengeluaranPerBulan[$b]; ?>
            <tr>
                <td><?= $namaBulan[$b] ?></td>
                <td class="text-end">Rp <?= number_format($pendapatanPerBulan[$b], 0, ',', '.') ?></td>
                <td class="text-end">Rp <?= number_format($pengeluaranPerBulan[$b], 0, ',', '.') ?></td>
                <td class="text-end fw-bold">Rp <?= number_format($laba, 0, ',', '.') ?></td>
                <td class="text-center"><?= $pesananPerBulan[$b] ?></td>
            </tr>
            <?php endfor; ?>
        </tbody>
        <tfoot>
            <tr class="fw-bold">
                <td>TOTAL</td>
                <td class="text-end">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></td>
                <td class="text-end">Rp <?= number_format($totalPengeluaran, 0, ',', '.') ?></td>
                <td class="text-end">Rp <?= number_format($totalPendapatan - $totalPengeluaran, 0, ',', '.') ?></td>
                <td class="text-center"><?= $totalPesanan ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak pada <?= date('d F Y H:i') ?> WIB
    </div>

    <script>window.onload = function() { window.print(); }</script>
</body>
</html>
