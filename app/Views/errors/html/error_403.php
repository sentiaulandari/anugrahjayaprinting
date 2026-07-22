<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 900;
            background: linear-gradient(135deg, #6f42c1, #0dcaf0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            letter-spacing: -0.04em;
        }
        .error-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            text-align: center;
            max-width: 520px;
            width: 100%;
        }
        .error-icon {
            width: 80px;
            height: 80px;
            background: rgba(111,66,193,0.12);
            border: 1px solid rgba(111,66,193,0.25);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: #6f42c1;
        }
        .btn-login {
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            color: #ffc107;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
            color: #ffc107;
        }
        .btn-home {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: #1a1a2e;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255,193,7,0.4);
            color: #1a1a2e;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <div class="error-code">403</div>

        <h4 class="fw-bold text-white mt-3 mb-2">Akses Ditolak</h4>
        <p class="mb-4" style="color:rgba(255,255,255,0.55);font-size:0.9rem;line-height:1.7;">
            Anda tidak memiliki izin untuk mengakses halaman ini.
            Silakan login terlebih dahulu atau hubungi administrator.
        </p>

        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="<?= base_url('auth/login') ?>" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i>Login
            </a>
            <a href="<?= base_url('/') ?>" class="btn-home">
                <i class="bi bi-house-fill"></i>Beranda
            </a>
        </div>

        <div class="mt-4 pt-3" style="border-top:1px solid rgba(255,255,255,0.08);">
            <small style="color:rgba(255,255,255,0.3);">
                <i class="bi bi-printer-fill me-1" style="color:#ffc107;"></i>
                Anugrah Jaya Digital Printing
            </small>
        </div>
    </div>
</body>
</html>
