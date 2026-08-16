<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Anugrah Jaya Digital Printing' ?></title>
    <meta name="description" content="Jasa cetak digital berkualitas tinggi - Spanduk, Brosur, Banner, Kartu Nama dan lainnya.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/landing.css') ?>?v=<?= filemtime(ROOTPATH . 'public/assets/css/landing.css') ?>">
</head>
<body>

    <?= view('layouts/partials/landing_navbar') ?>

    <?= $this->renderSection('content') ?>

    <?= view('layouts/partials/landing_footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/landing.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
