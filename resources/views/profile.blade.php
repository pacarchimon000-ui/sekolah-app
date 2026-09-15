<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil | Suara Sekolah</title>
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
            display: grid;
            place-items: center;
            padding: 24px;
        }
        a { text-decoration: none; color: inherit; }
        button, input { font: inherit; }
        .shell {
            width: min(100%, 980px);
            border-radius: 30px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19,37,31,0.82), rgba(13,21,20,0.92));
            box-shadow: var(--shadow);
            padding: 32px;
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: -0.05em;
        }
        .brand-mark {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #59d39a 0%, #1f6a57 100%);
            color: white;
        }
        .brand-dot { color: var(--green); }
        h1 {
            margin: 0 0 24px;
            letter-spacing: -0.06em;
            font-size: clamp(2rem, 3vw, 2.8rem);
        }
        form {
            display: grid;
            gap: 18px;
        }
        .two-col {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }
        .card {
            padding: 22px;
            border-radius: 24px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.02);
        }
        label {
            display: grid;
            gap: 8px;
            color: var(--muted);
            font-weight: 700;
            font-size: 0.82rem;
        }
        input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: rgba(255,255,255,0.02);
            color: var(--text);
            padding: 12px 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .profile-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }
        .profile-pill {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 0 12px;
            border-radius: 999px;
            border: 1px solid rgba(78,194,141,0.28);
            background: rgba(78,194,141,0.12);
            color: #d8f8e7;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        input:focus {
            outline: none;
            border-color: rgba(78,194,141,0.8);
            box-shadow: 0 0 0 4px rgba(78,194,141,0.12);
        }
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .primary-btn, .ghost-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            border-radius: 12px;
            padding: 0 18px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .primary-btn {
            background: linear-gradient(135deg, #58d19a 0%, #1c5b4d 100%);
            color: white;
            box-shadow: 0 12px 24px rgba(28, 91, 77, 0.32);
        }
        .primary-btn:hover,
        .ghost-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(78,194,141,0.42);
            box-shadow: 0 10px 20px rgba(10, 22, 19, 0.18);
            filter: brightness(1.03);
        }
        .ghost-btn {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--line);
            color: var(--text);
            text-decoration: none;
        }
        .error-box {
            border-radius: 12px;
            border: 1px solid rgba(255,138,128,0.4);
            background: rgba(255,138,128,0.08);
            color: #ffd5d0;
            padding: 12px 14px;
            font-size: 0.85rem;
        }
        @media (max-width: 760px) {
            .two-col {
                grid-template-columns: 1fr;
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
            <a href="{{ $user->role === 'admin' ? route('dashboard') : route('student.dashboard') }}" class="ghost-btn">Kembali</a>
        </div>

        <h1>Profil</h1>

        @if ($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="card">
            <div class="profile-meta">
                <span class="profile-pill">Role: {{ ucfirst($user->role) }}</span>
                <span class="profile-pill">Status akun: aktif</span>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="two-col">
                <label>
                    Nama lengkap
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </label>

                <label>
                    Nomor handphone
                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
                </label>
            </div>

            <div class="two-col">
                <label>
                    Password baru
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                </label>

                <label>
                    Konfirmasi password
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru">
                </label>
            </div>

                <div class="actions">
                    <span style="color: var(--muted); font-size: 0.85rem;">Perbarui data akun Anda sesuai kebutuhan.</span>
                    <button type="submit" class="primary-btn">Simpan profil</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
