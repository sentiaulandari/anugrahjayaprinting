<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - Anugrah Jaya Digital Printing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>?v=<?= filemtime(ROOTPATH . 'public/assets/css/admin.css') ?>">
</head>
<body>

<div class="wrapper d-flex">

    <?= view('layouts/partials/admin_sidebar') ?>

    <div class="main-content flex-grow-1">

        <?= view('layouts/partials/admin_navbar') ?>

        <div class="content-area p-4">
            <?= $this->renderSection('content') ?>
        </div>

        <?= view('layouts/partials/admin_footer') ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/admin.js') ?>"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
