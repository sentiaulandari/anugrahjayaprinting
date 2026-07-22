<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Anugrah Jaya Digital Printing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            padding: 2rem 0;
        }
        .auth-card { border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .auth-brand { background: linear-gradient(135deg, #1a1a2e, #0f3460); border-radius: 16px 16px 0 0; padding: 1.5rem; text-align: center; color: #fff; }
        .form-control { border-radius: 8px; padding: 0.6rem 1rem; border-color: #dee2e6; }
        .form-control:focus { border-color: #1a1a2e; box-shadow: 0 0 0 0.2rem rgba(26,26,46,0.15); }
        .btn-register { background: linear-gradient(135deg, #1a1a2e, #0f3460); border: none; border-radius: 8px; padding: 0.7rem; font-weight: 600; }
        .input-group-text { border-radius: 8px 0 0 8px; background-color: #f8f9fa; border-color: #dee2e6; }
        .input-group .form-control { border-radius: 0 8px 8px 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card auth-card">
                <div class="auth-brand">
                    <i class="bi bi-printer-fill fs-2 text-warning mb-1 d-block"></i>
                    <h6 class="fw-bold mb-0">Daftar Akun Baru</h6>
                    <small class="text-white-50">Anugrah Jaya Digital Printing</small>
                </div>

                <div class="card-body p-4">

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger py-2 small">
                            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                <div><i class="bi bi-dot"></i><?= $err ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/register') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-badge text-muted"></i></span>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    placeholder="Nama lengkap Anda"
                                    value="<?= old('nama_lengkap') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" name="username" class="form-control"
                                    placeholder="Buat username unik"
                                    value="<?= old('username') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Alamat email aktif"
                                    value="<?= old('email') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">No. HP / WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone text-muted"></i></span>
                                <input type="text" name="no_hp" class="form-control"
                                    placeholder="Contoh: 08123456789"
                                    value="<?= old('no_hp') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock text-muted"></i></span>
                                <input type="password" name="password" id="passInput" class="form-control"
                                    placeholder="Minimal 6 karakter" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePass">
                                    <i class="bi bi-eye" id="eyePass"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill text-muted"></i></span>
                                <input type="password" name="konfirmasi" id="konfirmasiInput" class="form-control"
                                    placeholder="Ulangi password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleKonfirmasi">
                                    <i class="bi bi-eye" id="eyeKonfirmasi"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-register btn-primary w-100 text-white">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </button>
                    </form>

                    <hr class="my-3">
                    <p class="text-center small text-muted mb-0">
                        Sudah punya akun?
                        <a href="<?= base_url('auth/login') ?>" class="fw-semibold text-decoration-none">Login di sini</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleVis(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
    document.getElementById('togglePass').addEventListener('click', () => toggleVis('passInput', 'eyePass'));
    document.getElementById('toggleKonfirmasi').addEventListener('click', () => toggleVis('konfirmasiInput', 'eyeKonfirmasi'));
</script>
</body>
</html>
