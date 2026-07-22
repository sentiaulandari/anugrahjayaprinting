<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Terjadi Kesalahan</title>
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
            background: linear-gradient(135deg, #dc3545, #6f1020);
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
            background: rgba(220,53,69,0.12);
            border: 1px solid rgba(220,53,69,0.25);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: #dc3545;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(220,53,69,0.3); }
            50% { box-shadow: 0 0 0 10px rgba(220,53,69,0); }
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
        .btn-back {
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.15);
            padding: 0.75rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }
        .btn-back:hover {
            background: rgba(255,255,255,0.12);
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon">
            <i class="bi bi-bug-fill"></i>
        </div>

        <div class="error-code">500</div>

        <h4 class="fw-bold text-white mt-3 mb-2">Terjadi Kesalahan Server</h4>
        <p class="mb-4" style="color:rgba(255,255,255,0.55);font-size:0.9rem;line-height:1.7;">
            Maaf, terjadi kesalahan pada server kami. Tim teknis kami sedang menangani masalah ini.
            Silakan coba lagi beberapa saat kemudian.
        </p>

        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="javascript:history.back()" class="btn-back">
                <i class="bi bi-arrow-left"></i>Kembali
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
