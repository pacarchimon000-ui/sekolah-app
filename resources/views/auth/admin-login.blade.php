<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | Suara Sekolah</title>
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
            --danger: #ff8a80;
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
        .login-shell {
            width: min(100%, 980px);
            border-radius: 28px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19,37,31,0.82), rgba(13,21,20,0.92));
            box-shadow: var(--shadow);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .login-side {
            padding: 42px 36px;
            background: linear-gradient(135deg, rgba(19,38,33,0.95), rgba(23,39,38,0.86));
            border-right: 1px solid var(--line);
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: -0.05em;
            margin-bottom: 24px;
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
            font-size: clamp(2.2rem, 3vw, 3.4rem);
            line-height: 1;
            letter-spacing: -0.07em;
        }
        .welcome-copy {
            margin-top: 24px;
            color: var(--muted);
            line-height: 1.7;
            font-size: 0.96rem;
        }
        .check-list {
            display: grid;
            gap: 12px;
            margin-top: 28px;
        }
        .check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
        }
        .check-item::before {
            content: '✓';
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: rgba(78,194,141,0.12);
            border: 1px solid rgba(78,194,141,0.32);
            color: #aff0cc;
            font-weight: 800;
        }
        .login-form-wrap {
            padding: 42px 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 22px;
            border: 1px solid rgba(78,194,141,0.28);
            background: linear-gradient(180deg, rgba(17,28,25,0.92), rgba(9,17,16,0.96));
            padding: 28px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.03);
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .login-card:hover {
            border-color: rgba(78,194,141,0.46);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.04), 0 18px 32px rgba(3, 12, 10, 0.28);
        }
        .login-header {
            margin-bottom: 18px;
        }
        .login-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #d8f8e7;
            background: rgba(78,194,141,0.12);
            border: 1px solid rgba(78,194,141,0.24);
            margin-bottom: 12px;
        }
        .login-card h2 {
            margin: 0;
            font-size: 1.6rem;
            letter-spacing: -0.05em;
        }
        form {
            display: grid;
            gap: 18px;
        }
        label {
            display: grid;
            gap: 8px;
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 700;
        }
        input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: rgba(255,255,255,0.02);
            color: var(--text);
            padding: 12px 14px;
        }
        input:focus {
            outline: none;
            border-color: rgba(78,194,141,0.8);
            box-shadow: 0 0 0 4px rgba(78,194,141,0.12);
        }
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            color: var(--muted);
            font-size: 0.85rem;
        }
        .remember-row label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            margin: 0;
        }
        .remember-row input {
            width: 16px;
            height: 16px;
            accent-color: var(--green);
        }
        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #58d19a 0%, #1c5b4d 100%);
            color: white;
            font-weight: 800;
            box-shadow: 0 12px 24px rgba(28, 91, 77, 0.32);
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .primary-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(28, 91, 77, 0.38);
            filter: brightness(1.03);
        }
        .switch-link {
            margin-top: 14px;
            text-align: center;
            color: var(--muted);
            font-size: 0.85rem;
        }
        .switch-link a {
            color: var(--green);
            font-weight: 700;
            transition: color 0.2s ease, opacity 0.2s ease;
        }
        .switch-link a:hover {
            color: #a9f0c9;
        }
        .error-box {
            border-radius: 12px;
            border: 1px solid rgba(255,138,128,0.4);
            background: rgba(255,138,128,0.08);
            color: #ffd5d0;
            padding: 12px 14px;
            font-size: 0.85rem;
        }
        @media (max-width: 820px) {
            .login-shell {
                grid-template-columns: 1fr;
            }
            .login-side {
                border-right: none;
                border-bottom: 1px solid var(--line);
            }
        }
    </style>
</head>
<body>
<div class="login-shell">
    <div class="login-side">
        <a href="{{ route('portal') }}" class="brand">
            <img src="{{ asset('logo-sekolah-transparent.png') }}" alt="Logo sekolah" class="brand-logo" width="56" height="56" style="object-fit:contain; border-radius:14px; background:transparent; box-shadow:none; border:none;">
            <span>SMK Wahidin Kota Cirebon</span>
        </a>

        <p class="eyebrow">akses admin</p>
        <h1>Login sebagai admin.</h1>

        <p class="welcome-copy">
            Kelola laporan siswa, pantau status, dan respons cepat melalui komunikasi yang lebih terstruktur.
        </p>

        <div class="check-list">
            <div class="check-item">Pantau laporan secara real time</div>
            <div class="check-item">Kelola status dan update</div>
            <div class="check-item">Akses dashboard admin</div>
        </div>
    </div>

    <div class="login-form-wrap">
        <div class="login-card">
            <div class="login-header">
                <div class="login-pill">Portal admin</div>
                <h2>Login Admin</h2>
            </div>

            @if ($errors->any())
                <div class="error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <label>
                    Nomor handphone admin
                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="Contoh: 081234567890" required>
                </label>

                <label>
                    Password
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </label>

                <div class="remember-row">
                    <label>
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button class="primary-btn" type="submit">Masuk</button>
            </form>

            <div class="switch-link">
                Siswa login? <a href="{{ route('student.login') }}">Klik di sini</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
