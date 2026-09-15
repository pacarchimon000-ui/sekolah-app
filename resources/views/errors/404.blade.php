<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Tidak Ditemukan | SMK Wahidin Kota Cirebon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #0b1413;
            --bg-mid: #142823;
            --line: rgba(204, 216, 210, 0.15);
            --line-strong: rgba(204, 216, 210, 0.24);
            --text: #edf5ef;
            --muted: #aab8b3;
            --green: #4ec28d;
            --green-strong: #1f6a57;
            --shadow: 0 28px 70px rgba(6, 14, 12, 0.5);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            background: radial-gradient(circle at top left, rgba(78,194,141,0.18), transparent 30%), linear-gradient(135deg, #0b1413 0%, #111d1a 35%, #202d2d 100%);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
        }
        .page-shell {
            width: min(100%, 980px);
            border-radius: 28px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19,37,31,0.82), rgba(13,21,20,0.92));
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 22px;
            border-bottom: 1px solid var(--line);
            background: rgba(10, 19, 17, 0.32);
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: -0.05em;
            text-decoration: none;
            color: var(--text);
        }
        .brand-logo {
            width: 46px;
            height: 46px;
            object-fit: contain;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.04);
            box-shadow: 0 8px 18px rgba(0,0,0,0.18);
        }
        .brand-dot { color: var(--green); }
        .content {
            padding: 48px 30px;
            display: grid;
            gap: 22px;
            justify-items: center;
            text-align: center;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 16px;
            border-radius: 999px;
            background: rgba(78,194,141,0.12);
            border: 1px solid rgba(78,194,141,0.3);
            color: #dff9eb;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        h1 {
            margin: 0;
            font-size: clamp(2rem, 5vw, 4rem);
            letter-spacing: -0.08em;
        }
        p {
            margin: 0;
            color: var(--muted);
            line-height: 1.8;
            font-size: 1rem;
            max-width: 640px;
        }
        .actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .primary-btn,
        .secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 20px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .primary-btn {
            background: linear-gradient(135deg, #58d19a 0%, #1c5b4d 100%);
            color: white;
            box-shadow: 0 12px 24px rgba(28, 91, 77, 0.32);
        }
        .secondary-btn {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--line-strong);
            color: var(--text);
        }
        .primary-btn:hover,
        .secondary-btn:hover {
            transform: translateY(-1px);
        }
        @media (max-width: 640px) {
            .topbar { justify-content: center; }
            .content { padding: 32px 18px; }
            .actions { width: 100%; }
            .actions a { flex: 1 1 100%; }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        <div class="topbar">
            <a href="{{ route('portal') }}" class="brand">
                <img src="{{ asset('logo-sekolah-transparent.png') }}" alt="Logo sekolah" class="brand-logo" width="56" height="56" style="object-fit:contain; border-radius:14px; background:transparent; box-shadow:none; border:none;">
                <span>SMK Wahidin Kota Cirebon</span>
            </a>
        </div>

        <div class="content">
            <div class="badge">404</div>
            <h1>Halaman tidak ditemukan</h1>
            <p>
                Maaf, halaman yang Anda coba buka tidak tersedia atau telah dipindahkan.
                Silakan kembali ke halaman utama atau lanjutkan ke portal akses.
            </p>

            <div class="actions">
                <a href="{{ route('portal') }}" class="primary-btn">Kembali ke portal</a>
                <a href="{{ route('student.login') }}" class="secondary-btn">Login siswa</a>
            </div>
        </div>
    </div>
</body>
</html>
