<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Suara Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #0b1413;
            --bg-mid: #142823;
            --line: rgba(204, 216, 210, 0.15);
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
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .shell {
            width: min(100%, 1100px);
            border-radius: 28px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19,37,31,0.82), rgba(13,21,20,0.92));
            box-shadow: var(--shadow);
            padding: 36px;
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: -0.05em;
        }
        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #59d39a 0%, #1f6a57 100%);
            color: white;
        }
        .brand-dot { color: var(--green); }
        .eyebrow {
            margin: 0 0 12px;
            color: var(--green);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }
        h1 {
            margin: 0;
            font-size: clamp(2.4rem, 4vw, 4rem);
            line-height: 1;
            letter-spacing: -0.07em;
        }
        .subtitle {
            margin-top: 18px;
            color: var(--muted);
            line-height: 1.7;
            font-size: 1rem;
            max-width: 700px;
        }
        .choice-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
            margin-top: 32px;
        }
        .choice-card {
            border-radius: 24px;
            border: 1px solid rgba(78,194,141,0.18);
            background: linear-gradient(180deg, rgba(17,28,25,0.9), rgba(9,17,16,0.96));
            padding: 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 18px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.02);
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .choice-card:hover {
            transform: translateY(-2px);
            border-color: rgba(78,194,141,0.34);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.03), 0 18px 32px rgba(3, 12, 10, 0.28);
        }
        .choice-card h2 {
            margin: 0;
            font-size: 1.8rem;
            letter-spacing: -0.05em;
        }
        .choice-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }
        .choice-icon {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #58d19a 0%, #1c5b4d 100%);
            font-weight: 800;
            font-size: 1.1rem;
        }
        .choice-card a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
            color: var(--text);
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .choice-card a:hover {
            transform: translateY(-1px);
            border-color: rgba(78,194,141,0.38);
            box-shadow: 0 10px 20px rgba(10, 22, 19, 0.18);
            filter: brightness(1.03);
        }
        .choice-card a.primary {
            background: linear-gradient(135deg, #58d19a 0%, #1c5b4d 100%);
            border-color: transparent;
            box-shadow: 0 12px 24px rgba(28, 91, 77, 0.32);
        }
        @media (max-width: 860px) {
            .choice-grid {
                grid-template-columns: 1fr;
            }
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
<div class="shell">
    <div class="topbar">
        <a href="{{ route('portal') }}" class="brand">
            <img src="{{ asset('logo-sekolah-transparent.png') }}" alt="Logo sekolah" class="brand-logo" width="56" height="56" style="object-fit:contain; border-radius:14px; background:transparent; box-shadow:none; border:none;">
            <span>SMK Wahidin Kota Cirebon</span>
        </a>
    </div>

    <p class="eyebrow">portal akses</p>
    <h1>Silakan pilih jenis login Anda.</h1>
    <p class="subtitle">
        Halaman ini adalah pintu masuk utama aplikasi. Siswa dan admin sama-sama login menggunakan nomor handphone dan password untuk mengakses portal sesuai peran masing-masing.
    </p>

    <div class="choice-grid">
        <div class="choice-card">
            <div>
                <div class="choice-icon">S</div>
                <h2>Login Siswa</h2>
            </div>
            <p>Masuk dengan nomor handphone dan password untuk melihat status laporan, riwayat pengaduan, dan informasi penting dari sekolah.</p>
            <a href="{{ route('student.login') }}" class="primary">Masuk sebagai siswa</a>
            <a href="{{ route('student.register') }}">Daftar siswa</a>
        </div>

        <div class="choice-card">
            <div>
                <div class="choice-icon">A</div>
                <h2>Login Admin</h2>
            </div>
            <p>Masuk dengan nomor handphone dan password admin untuk mengelola laporan, memantau status, dan menghubungi pelapor melalui WhatsApp.</p>
            <a href="{{ route('admin.login') }}" class="primary">Masuk sebagai admin</a>
        </div>
    </div>
</div>
</body>
</html>
