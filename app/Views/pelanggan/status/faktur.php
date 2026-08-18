<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur - <?= esc($pesanan['no_pesanan']) ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 12px;
            color: #222;
            background: #f5f5f5;
        }
        .page {
            max-width: 80mm;
            margin: 20px auto;
            background: #fff;
            padding: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.12);
        }
        .header { text-align: center; padding-bottom: 10px; border-bottom: 2px dashed #333; margin-bottom: 10px; }
        .header h2 { font-size: 15px; font-weight: 800; letter-spacing: 0.02em; margin-bottom: 2px; }
        .header .sub { font-size: 10px; color: #666; line-height: 1.6; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 11px; }
        .info-row .label { color: #888; }
        .info-row .value { font-weight: 600; text-align: right; max-width: 55%; }
        .divider { border: none; border-top: 1px dashed #ccc; margin: 8px 0; }
        table { width: 100%; border-collapse: collapse; margin: 6px 0; font-size: 11px; }
        thead th { border-bottom: 1px solid #333; padding: 4px 2px; font-weight: 700; }
        tbody td { padding: 4px 2px; border-bottom: 1px dotted #e0e0e0; vertical-align: top; }
        tfoot td { border-top: 2px solid #333; padding: 5px 2px; font-weight: 700; font-size: 12px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge-lunas { display: inline-block; background: #1a7a3a; color: #fff; padding: 2px 7px; border-radius: 4px; font-size: 9px; font-weight: 700; letter-spacing: 0.05em; }
        .item-sub { font-size: 9px; color: #888; margin-top: 1px; }
        .footer { text-align: center; margin-top: 12px; font-size: 10px; color: #888; border-top: 2px dashed #333; padding-top: 10px; line-height: 1.8; }
        .btn-area { text-align: center; margin: 20px 0 10px; }
        .btn-print { display: inline-block; padding: 8px 24px; background: #1a1a2e; color: #fff; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; margin-right: 8px; }
        .btn-back  { display: inline-block; padding: 8px 20px; background: #f0f0f0; color: #333; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; }
        @media print {
            body { background: #fff; }
            .page { margin: 0; padding: 5mm; box-shadow: none; max-width: 80mm; }
            .btn-area { display: none; }
            @page { size: 80mm auto; margin: 0; }
        }
    </style>
</head>
<body>

<div class="page">

    <div class="header">
        <h2>Anugrah Jaya Digital Printing</h2>
        <div class="sub">Cetak Digital &amp; Percetakan<br>
        Telp: 0822 8790 0182 &nbsp;|&nbsp; Budi: 0352 8766 0078</div>
    </div>

    <div class="info-row">
        <span class="label">No. Pesanan</span>
        <span class="value"><?= esc($pesanan['no_pesanan']) ?></span>
    </div>
    <div class="info-row">
        <span class="label">Tanggal</span>
        <span class="value"><?= date('d/m/Y', strtotime($pesanan['tgl_pesanan'])) ?></span>
    </div>
    <?php if ($pesanan['tgl_selesai']): ?>
    <div class="info-row">
        <span class="label">Est. Selesai</span>
        <span class="value"><?= date('d/m/Y', strtotime($pesanan['tgl_selesai'])) ?></span>
    </div>
    <?php endif; ?>
    <div class="info-row">
        <span class="label">Konsumen</span>
        <span class="value"><?= esc($pesanan['nama_pelanggan'] ?? '-') ?></span>
    </div>
    <?php if (!empty($pesanan['no_hp'])): ?>
    <div class="info-row">
        <span class="label">No. HP</span>
        <span class="value"><?= esc($pesanan['no_hp']) ?></span>
    </div>
    <?php endif; ?>
    <?php if ($pembayaran): ?>
    <div class="info-row">
        <span class="label">Metode Bayar</span>
        <span class="value"><?= esc($pembayaran['metode_bayar']) ?></span>
    </div>
    <div class="info-row">
        <span class="label">Tgl Bayar</span>
        <span class="value"><?= date('d/m/Y', strtotime($pembayaran['tgl_pembayaran'])) ?></span>
    </div>
    <?php endif; ?>
    <div class="info-row">
        <span class="label">Status</span>
        <span class="value"><span class="badge-lunas">LUNAS</span></span>
    </div>

    <hr class="divider">

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
                    <?= esc($d['nama_layanan'] ?? $d['kode_layanan']) ?>
                    <?php if (!empty($d['ukuran'])): ?>
                        <div class="item-sub"><?= esc($d['ukuran']) ?><?= $d['desain_sendiri'] ? ' · DS' : '' ?></div>
                    <?php endif; ?>
                    <?php if (!empty($d['keterangan'])): ?>
                        <div class="item-sub"><?= esc($d['keterangan']) ?></div>
                    <?php endif; ?>
                </td>
                <td class="text-center"><?= $d['qty'] ?></td>
                <td class="text-right"><?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                <td class="text-right"><?= number_format($d['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">TOTAL</td>
                <td class="text-right">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <?php if (!empty($pesanan['catatan'])): ?>
    <div style="margin-top:6px;font-size:10px;">
        <span style="color:#888;">Catatan:</span> <?= esc($pesanan['catatan']) ?>
    </div>
    <?php endif; ?>

    <div class="footer">
        Terima kasih atas kepercayaan Anda 🙏<br>
        Simpan struk ini sebagai bukti pembayaran
    </div>

</div>

<div class="btn-area">
    <button class="btn-print" onclick="window.print()">
        🖨️ Cetak / Print
    </button>
    <a href="<?= base_url('pelanggan/status/detail/' . $pesanan['no_pesanan']) ?>" class="btn-back">
        ← Kembali
    </a>
</div>

<script>
    window.addEventListener('load', function() {
        window.print();
    });
    window.onafterprint = function() {
        window.location.href = '<?= base_url('pelanggan/status/detail/' . $pesanan['no_pesanan']) ?>';
    };
</script>

</body>
</html>
