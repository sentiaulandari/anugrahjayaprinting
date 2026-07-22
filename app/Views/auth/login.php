<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Anugrah Jaya Digital Printing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f0f2f8;
        }

        .left-panel {
            width: 45%;
            background: linear-gradient(160deg, #0f0f23 0%, #1a1a2e 45%, #0f3460 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(255,193,7,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -100px; left: -60px;
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(15,52,96,0.5) 0%, transparent 70%);
            pointer-events: none;
        }

        .brand-logo-wrap {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border-radius: 22px;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.2rem;
            color: #1a1a2e;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 30px rgba(255,193,7,0.35);
            position: relative; z-index: 1;
        }

        .brand-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.03em;
            text-align: center;
            position: relative; z-index: 1;
        }

        .brand-subtitle {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.5);
            text-align: center;
            margin-top: 0.4rem;
            position: relative; z-index: 1;
        }

        .brand-divider {
            width: 40px; height: 3px;
            background: linear-gradient(90deg, #ffc107, #ff9800);
            border-radius: 3px;
            margin: 1.5rem auto;
            position: relative; z-index: 1;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            position: relative; z-index: 1;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            margin-bottom: 0.8rem;
        }

        .feature-list li i {
            color: #ffc107;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .right-panel {
            width: 55%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: #f0f2f8;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-header h2 {
            font-size: 1.7rem;
            font-weight: 800;
            color: #1a1a2e;
            letter-spacing: -0.02em;
        }

        .login-header p {
            color: #6b7280;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            letter-spacing: 0.01em;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1rem;
            pointer-events: none;
            z-index: 2;
        }

        .form-control {
            padding: 0.7rem 1rem 0.7rem 2.8rem;
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            font-size: 0.9rem;
            background: #fff;
            transition: all 0.25s;
        }

        .form-control:focus {
            border-color: #1a1a2e;
            box-shadow: 0 0 0 3px rgba(26,26,46,0.08);
            outline: none;
        }

        .toggle-pass {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            padding: 4px;
            line-height: 1;
            z-index: 2;
        }

        .toggle-pass:hover { color: #1a1a2e; }

        .btn-masuk {
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.02em;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 4px 16px rgba(26,26,46,0.25);
        }

        .btn-masuk:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(26,26,46,0.35);
            color: #ffc107;
        }

        .divider-text {
            text-align: center;
            position: relative;
            color: #9ca3af;
            font-size: 0.8rem;
            margin: 1.25rem 0;
        }

        .divider-text::before,
        .divider-text::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 38%;
            height: 1px;
            background: #e5e7eb;
        }

        .divider-text::before { left: 0; }
        .divider-text::after  { right: 0; }

        .link-daftar {
            text-align: center;
            font-size: 0.85rem;
            color: #6b7280;
        }

        .link-daftar a {
            color: #0f3460;
            font-weight: 700;
            text-decoration: none;
        }

        .link-daftar a:hover { text-decoration: underline; }

        .back-link {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #9ca3af;
            font-size: 0.82rem;
            text-decoration: none;
            justify-content: center;
            margin-top: 1rem;
            transition: color 0.2s;
        }

        .back-link:hover { color: #1a1a2e; }

        .alert {
            border-radius: 10px;
            font-size: 0.85rem;
            padding: 0.6rem 0.9rem;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel {
                width: 100%;
                padding: 2rem 1.5rem;
                min-height: auto;
            }
            .feature-list { display: none; }
            .right-panel { width: 100%; }
        }
    </style>
</head>
<body>

    <div class="left-panel">
        <div class="brand-logo-wrap">
            <i class="bi bi-printer-fill"></i>
        </div>
        <div class="brand-title">Anugrah Jaya</div>
        <div class="brand-subtitle">Digital Printing</div>
        <div class="brand-divider"></div>
        <ul class="feature-list">
            <li><i class="bi bi-check-circle-fill"></i> Pemesanan cetak online mudah &amp; cepat</li>
            <li><i class="bi bi-check-circle-fill"></i> Pantau status pesanan real-time</li>
            <li><i class="bi bi-check-circle-fill"></i> 22+ jenis layanan cetak tersedia</li>
            <li><i class="bi bi-check-circle-fill"></i> Konfirmasi pembayaran otomatis</li>
            <li><i class="bi bi-check-circle-fill"></i> Retur &amp; revisi hasil cetak terjamin</li>
        </ul>
    </div>

    <div class="right-panel">
        <div class="login-box">

            <div class="login-header">
                <h2>Selamat Datang 👋</h2>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger mb-3">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <div><i class="bi bi-dot"></i><?= $err ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/login') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-wrap">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" name="username" class="form-control"
                            placeholder="Masukkan username Anda"
                            value="<?= old('username') ?>" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" name="password" id="passInput" class="form-control"
                            placeholder="Masukkan password Anda" required>
                        <button class="toggle-pass" type="button" id="togglePass">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-masuk">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>

            <div class="divider-text">atau</div>

            <div class="link-daftar">
                Belum punya akun?
                <a href="<?= base_url('auth/register') ?>">Daftar Sekarang</a>
            </div>

            <a href="<?= base_url('/') ?>" class="back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('togglePass').addEventListener('click', function() {
        const input = document.getElementById('passInput');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
</script>
</body>
</html>
