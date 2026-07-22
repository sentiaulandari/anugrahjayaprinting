<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> - Anugrah Jaya Digital Printing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/pelanggan.css') ?>">
</head>
<body>

    <?= view('layouts/partials/pelanggan_navbar') ?>

    <div class="pelanggan-wrapper">
        <div class="container py-4">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <?= view('layouts/partials/pelanggan_footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/pelanggan.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
