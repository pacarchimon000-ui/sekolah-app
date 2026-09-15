<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Laporan | Suara Sekolah</title>
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
            padding: 32px 20px;
        }
        a { text-decoration: none; color: inherit; }
        button { font: inherit; }
        .shell {
            max-width: 980px;
            margin: 0 auto;
            padding: 28px;
            border-radius: 30px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19,37,31,0.82), rgba(13,21,20,0.92));
            box-shadow: var(--shadow);
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
        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            border-radius: 12px;
            border: 1px solid var(--line-strong);
            background: rgba(255,255,255,0.02);
            color: var(--text);
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .back-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(78,194,141,0.42);
            box-shadow: 0 10px 20px rgba(10, 22, 19, 0.18);
            filter: brightness(1.03);
        }
        h1 {
            margin: 0;
            font-size: clamp(2rem, 3vw, 2.8rem);
            letter-spacing: -0.06em;
        }
        .hero-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 24px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--line);
        }
        .eyebrow {
            margin: 0 0 10px;
            color: var(--green);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            background: rgba(78,194,141,0.12);
            border: 1px solid rgba(78,194,141,0.32);
            color: #aff0cc;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-top: 22px;
        }
        .info-card {
            position: relative;
            padding: 18px;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.02);
            transition: transform 0.2s ease, border-color 0.2s ease;
        }
        .info-card:hover {
            transform: translateY(-1px);
            border-color: rgba(78,194,141,0.28);
        }
        .label {
            display: block;
            color: var(--muted);
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 8px;
        }
        .value {
            font-size: 1.05rem;
            line-height: 1.6;
        }
        .description {
            margin-top: 22px;
            padding: 20px;
            border-radius: 24px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            line-height: 1.8;
            color: var(--text);
        }
        .attachment {
            margin-top: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            border-radius: 12px;
            background: linear-gradient(135deg, #58d19a 0%, #1c5b4d 100%);
            color: white;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 12px 24px rgba(28, 91, 77, 0.32);
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .attachment:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(28, 91, 77, 0.38);
            filter: brightness(1.03);
        }
        @media (max-width: 720px) {
            .meta-grid {
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
        @php
            $backRoute = Auth::user()->role === 'student' ? route('student.dashboard') : route('dashboard');
        @endphp

        <a href="{{ $backRoute }}" class="back-btn">Kembali ke dashboard</a>
    </div>

    <div class="hero-head">
        <div>
            <p class="eyebrow">detail laporan</p>
            <h1>Detail laporan</h1>
        </div>
        <span class="status-pill">{{ $report->status }}</span>
    </div>

    <div class="meta-grid">
        <div class="info-card">
            <span class="label">Ticket</span>
            <div class="value">{{ $report->ticket_number }}</div>
        </div>
        <div class="info-card">
            <span class="label">Status</span>
            <div class="value">{{ $report->status }}</div>
        </div>
        <div class="info-card">
            <span class="label">Jenis</span>
            <div class="value">{{ $report->type_label }}</div>
        </div>
        <div class="info-card">
            <span class="label">Kategori</span>
            <div class="value">{{ $report->category }}</div>
        </div>
        <div class="info-card">
            <span class="label">Pelapor</span>
            <div class="value">{{ $report->is_anonymous ? 'Anonim' : ($report->user?->name ?? 'Siswa') }}</div>
        </div>
        <div class="info-card">
            <span class="label">Kontak</span>
            <div class="value">{{ $report->user?->phone_number ?? '-' }}</div>
        </div>
    </div>

    <div class="info-card description">
        <span class="label">Judul</span>
        <div class="value" style="margin-bottom: 14px;">{{ $report->subject }}</div>
        <span class="label">Isi laporan</span>
        <div class="value">{{ $report->description }}</div>
    </div>

    @if ($report->attachment_path)
        <a href="{{ asset('storage/' . $report->attachment_path) }}" class="attachment" target="_blank" rel="noopener noreferrer">
            Lihat lampiran
        </a>
    @endif
</div>
</body>
</html>
