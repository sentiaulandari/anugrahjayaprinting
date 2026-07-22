<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show alert-auto-dismiss py-2 small" role="alert">
        <i class="bi bi-check-circle me-1"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show alert-auto-dismiss py-2 small" role="alert">
        <i class="bi bi-exclamation-circle me-1"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show py-2 small" role="alert">
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
        <?php foreach (session()->getFlashdata('errors') as $err): ?>
            <div><i class="bi bi-dot"></i><?= $err ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
