<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur - <?= esc($transaksi['no_transaksi']) ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 12px; color: #333; padding: 20px; max-width: 80mm; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px dashed #333; padding-bottom: 8px; margin-bottom: 10px; }
        .header h2 { font-size: 16px; margin-bottom: 2px; }
        .header .sub { font-size: 10px; color: #666; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 3px; font-size: 11px; }
        .info-row .label { color: #666; }
        .info-row .value { font-weight: 600; }
        .divider { border-top: 1px dashed #ccc; margin: 8px 0; }
        table { width: 100%; border-collapse: collapse; margin: 8px 0; }
        th, td { padding: 3px 0; font-size: 11px; text-align: left; }
        th { border-bottom: 1px solid #333; font-weight: 700; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row { border-top: 2px solid #333; font-weight: 700; font-size: 13px; }
        .footer { text-align: center; margin-top: 10px; font-size: 10px; color: #666; border-top: 2px dashed #333; padding-top: 8px; }
        .badge-lunas { display: inline-block; background: #28a745; color: #fff; padding: 1px 6px; border-radius: 3px; font-size: 9px; font-weight: 700; }
        @media print {
            body { padding: 5mm; }
            @page { size: 80mm auto; margin: 0; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Anugrah Jaya Digital Printing</h2>
        <div class="sub">Cetak Digital & Percetakan</div>
        <div class="sub">Telp: 0822 8790 0182 | Budi: 0352 8766 0078</div>
    </div>

    <div class="info-row">
        <span class="label">No. Faktur</span>
        <span class="value"><?= $transaksi['no_transaksi'] ?></span>
    </div>
    <div class="info-row">
        <span class="label">Tanggal</span>
        <span class="value"><?= date('d/m/Y H:i', strtotime($transaksi['created_at'])) ?></span>
    </div>
    <div class="info-row">
        <span class="label">Pelanggan</span>
        <span class="value"><?= $transaksi['nama_pelanggan'] ?: 'Walk-in' ?></span>
    </div>
    <?php if ($transaksi['no_hp']): ?>
    <div class="info-row">
        <span class="label">No. HP</span>
        <span class="value"><?= $transaksi['no_hp'] ?></span>
    </div>
    <?php endif; ?>
    <div class="info-row">
        <span class="label">Bayar</span>
        <span class="value"><?= $transaksi['metode_bayar'] ?> <span class="badge-lunas">LUNAS</span></span>
    </div>

    <div class="divider"></div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Sub</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detail as $d): ?>
            <tr>
                <td>
                    <?= $d['nama_produk'] ?>
                    <?php if ($d['panjang'] && $d['lebar']): ?>
                        <br><span style="font-size:9px;color:#666;"><?= $d['panjang'] ?>m×<?= $d['lebar'] ?>m<?= $d['desain_sendiri'] ? ' (DS)' : '' ?></span>
                    <?php endif; ?>
                </td>
                <td class="text-center"><?= $d['qty'] ?></td>
                <td class="text-right"><?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                <td class="text-right"><?= number_format($d['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3">TOTAL</td>
                <td class="text-right">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Terima kasih atas kunjungan Anda<br>
        <strong>Anugrah Jaya Digital Printing</strong>
    </div>

    <script>window.onload = function() { window.print(); }</script>
</body>
</html>
