<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Siswa | Suara Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #0b1413;
            --bg-mid: #142823;
            --bg-panel: rgba(18, 34, 29, 0.82);
            --line: rgba(204, 216, 210, 0.15);
            --line-strong: rgba(204, 216, 210, 0.24);
            --text: #edf5ef;
            --muted: #aab8b3;
            --green: #4ec28d;
            --green-strong: #1f6a57;
            --steel: #d9dfde;
            --shadow: 0 28px 70px rgba(6, 14, 12, 0.5);
            --danger: #ff8a80;
            --warning: #ffd980;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(78,194,141,0.18), transparent 30%),
                linear-gradient(135deg, #0b1413 0%, #111d1a 35%, #202d2d 100%);
            color: var(--text);
            font-family: 'Manrope', sans-serif;
        }
        a { text-decoration: none; color: inherit; }
        button, input, select, textarea { font: inherit; }
        button { cursor: pointer; }

        .dashboard-shell {
            max-width: 1380px;
            margin: 0 auto;
            padding: 30px 24px 48px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 22px;
            border-radius: 22px;
            border: 1px solid var(--line);
            background: rgba(10, 19, 17, 0.32);
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
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

        .top-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .ghost-btn, .primary-btn {
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
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .ghost-btn:hover, .primary-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(78,194,141,0.42);
            box-shadow: 0 10px 20px rgba(10, 22, 19, 0.18);
            filter: brightness(1.03);
        }

        .primary-btn {
            background: linear-gradient(135deg, #58d19a 0%, #1c5b4d 100%);
            border-color: transparent;
            box-shadow: 0 12px 24px rgba(28, 91, 77, 0.32);
        }

        .page-content {
            display: grid;
            gap: 26px;
            margin-top: 28px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .stat-card {
            position: relative;
            padding: 22px 18px;
            border-radius: 22px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(21,34,29,0.84), rgba(13,19,18,0.92));
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card::before {
            content: "";
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #58d19a, rgba(88,209,154,0.15));
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: rgba(78,194,141,0.36);
        }

        .stat-label {
            color: var(--green);
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 800;
        }

        .stat-value {
            margin-top: 16px;
            font-size: clamp(1.8rem, 2vw, 2.5rem);
            font-weight: 800;
            letter-spacing: -0.06em;
        }

        .stat-card small {
            color: var(--muted);
            display: block;
            margin-top: 8px;
        }

        .layout-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 22px;
            align-items: start;
        }

        .panel {
            padding: 22px;
            border-radius: 24px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19,37,31,0.82), rgba(13,21,20,0.92));
            box-shadow: var(--shadow);
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .panel:hover {
            border-color: rgba(78,194,141,0.34);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .report-panel-box {
            padding: 22px;
            border-radius: 24px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19,37,31,0.82), rgba(13,21,20,0.92));
            box-shadow: var(--shadow);
        }

        .panel-header h2 {
            margin: 0;
            font-size: clamp(1.4rem, 1.8vw, 2rem);
            letter-spacing: -0.05em;
        }

        .panel-header span {
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 700;
        }

        .panel-subtitle {
            margin: -8px 0 18px;
            color: var(--muted);
            line-height: 1.7;
            font-size: 0.94rem;
        }

        .table-wrap {
            overflow-x: auto;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid var(--line);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
            background: rgba(255,255,255,0.01);
        }

        th, td {
            text-align: left;
            padding: 14px 10px;
            border-bottom: 1px solid var(--line);
            vertical-align: top;
        }

        thead th {
            background: rgba(255,255,255,0.02);
        }

        th {
            color: var(--muted);
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 800;
        }

        td {
            color: var(--text);
            font-size: 0.92rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--line-strong);
            font-size: 0.72rem;
            font-weight: 700;
        }

        .badge.green { background: rgba(78,194,141,0.12); border-color: rgba(78,194,141,0.3); color: #aff0cc; }
        .badge.yellow { background: rgba(255, 217, 128, 0.12); border-color: rgba(255, 217, 128, 0.3); color: #f8ddb0; }
        .badge.red { background: rgba(255, 138, 128, 0.12); border-color: rgba(255, 138, 128, 0.32); color: #ffb0a9; }

        .summary-list {
            display: grid;
            gap: 14px;
        }

        .summary-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
        }

        .summary-item strong {
            display: block;
            font-size: 1.05rem;
        }

        .summary-item span {
            color: var(--muted);
            font-size: 0.85rem;
        }

        .count-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: rgba(78,194,141,0.1);
            border: 1px solid rgba(78,194,141,0.26);
            color: #aff0cc;
            font-weight: 800;
        }

        .success-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 24px;
            padding: 16px 18px;
            border-radius: 18px;
            border: 1px solid rgba(78,194,141,0.35);
            background: rgba(78,194,141,0.08);
            color: #dffbf0;
        }

        .welcome-panel {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 20px;
            padding: 30px;
            border-radius: 30px;
            border: 1px solid var(--line);
            background: linear-gradient(135deg, rgba(19,38,33,0.99), rgba(23,39,38,0.9));
            box-shadow: var(--shadow);
        }

        .hero-side-panel {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            align-content: center;
        }

        .hero-side-card {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(23,46,39,0.92), rgba(13,22,20,0.96));
            min-height: 138px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-side-card.full {
            grid-column: span 2;
            min-height: 170px;
            background: linear-gradient(135deg, rgba(77, 193, 141, 0.18), rgba(30, 82, 68, 0.4));
        }

        .side-label {
            color: var(--green);
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .side-value {
            margin-top: 10px;
            font-size: clamp(1.8rem, 2vw, 2.5rem);
            font-weight: 800;
            letter-spacing: -0.05em;
        }

        .side-note {
            margin-top: 8px;
            color: var(--muted);
            font-size: 0.82rem;
            line-height: 1.5;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: var(--green);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .hero-title-wrap {
            display: grid;
            gap: 14px;
        }

        .welcome-copy h2 {
            margin: 0;
            font-size: clamp(2.2rem, 3vw, 3.6rem);
            letter-spacing: -0.06em;
            line-height: 1.02;
        }

        .hero-badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .hero-badges span {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 0 10px;
            border-radius: 999px;
            border: 1px solid rgba(78,194,141,0.32);
            background: rgba(78,194,141,0.08);
            color: #d8fbe6;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .welcome-copy p {
            margin: 16px 0 0;
            color: var(--muted);
            line-height: 1.8;
            font-size: 0.98rem;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .hero-actions .primary-btn,
        .hero-actions .ghost-btn {
            min-height: 46px;
            padding: 0 20px;
        }

        .welcome-features {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .mini-card {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
        }

        .mini-card strong {
            display: block;
            font-size: 1.1rem;
            margin-bottom: 6px;
        }

        .mini-card span {
            color: var(--muted);
            font-size: 0.86rem;
            line-height: 1.5;
        }

        .success-banner strong {
            font-size: 0.96rem;
        }

        .success-banner b {
            color: white;
        }

        .info-panel {
            margin-top: 24px;
        }

        .feature-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 24px;
        }

        .feature-item {
            padding: 20px;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(20,42,35,0.84), rgba(13,20,19,0.92));
            box-shadow: var(--shadow);
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .feature-item:hover {
            transform: translateY(-2px);
            border-color: rgba(78,194,141,0.34);
        }

        .feature-item .feature-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #59d39a 0%, #1f6a57 100%);
            color: white;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .feature-item h3 {
            margin: 0 0 8px;
            font-size: 1.05rem;
            letter-spacing: -0.03em;
        }

        .feature-item p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 0.9rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 18px;
        }

        .info-card {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
        }

        .info-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 10px;
            background: rgba(78,194,141,0.12);
            border: 1px solid rgba(78,194,141,0.3);
            color: #aff0cc;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .info-card h3 {
            margin: 0 0 8px;
            font-size: 1.05rem;
            letter-spacing: -0.03em;
        }

        .info-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 0.9rem;
        }

        .checklist-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-top: 24px;
        }

        .checklist {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
        }

        .checklist h3 {
            margin: 0 0 12px;
            font-size: 1rem;
        }

        .checklist ul {
            margin: 0;
            padding-left: 18px;
            color: var(--muted);
            line-height: 1.8;
        }

        .report-panel {
            margin-top: 24px;
            padding: 24px;
            border-radius: 26px;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .report-panel:hover {
            border-color: rgba(78,194,141,0.34);
        }

        .report-form {
            display: grid;
            gap: 18px;
        }

        .field-grid {
            display: grid;
            gap: 18px;
        }

        .two-col {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        label {
            display: grid;
            gap: 8px;
            color: var(--muted);
            font-size: 0.78rem;
            font-weight: 600;
        }

        input, select, textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: rgba(255,255,255,0.02);
            color: var(--text);
            padding: 12px 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        select {
            color-scheme: dark;
        }

        option {
            background-color: #12231d;
            color: var(--text);
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: rgba(78,194,141,0.8);
            box-shadow: 0 0 0 4px rgba(78,194,141,0.12);
        }

        textarea {
            resize: vertical;
            min-height: 140px;
        }

        .checkbox-row {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
            font-size: 0.92rem;
        }

        .checkbox-row input {
            width: 16px;
            height: 16px;
            accent-color: var(--green);
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .submit-button {
            min-width: 180px;
            min-height: 46px;
            border-radius: 14px;
        }

        .footer-note {
            margin-top: 18px;
            color: var(--muted);
            font-size: 0.85rem;
        }

        @media (max-width: 980px) {
            .stats-grid,
            .layout-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-actions {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="dashboard-shell">
    <nav class="topbar">
        <a href="{{ route('portal') }}" class="brand">
            <img src="{{ asset('logo-sekolah-transparent.png') }}" alt="Logo sekolah" class="brand-logo" width="56" height="56" style="object-fit:contain; border-radius:14px; background:transparent; box-shadow:none; border:none;">
            <span>SMK Wahidin Kota Cirebon</span>
        </a>

        <div class="top-actions">
            <a href="{{ route('profile') }}" class="ghost-btn">Profil</a>
            <a href="#reports" class="primary-btn">Lihat laporan</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="ghost-btn">Logout</button>
            </form>
        </div>
    </nav>

    <main class="page-content">
        <section class="welcome-panel">
            <div class="welcome-copy">
                <p class="eyebrow">portal siswa</p>
                <div class="hero-title-wrap">
                    <h2>Selamat datang, {{ $user->name ?? 'Siswa' }}</h2>
                    <div class="hero-badges">
                        <span>Portal Aspirasi</span>
                        <span>Pengaduan</span>
                        <span>Monitoring</span>
                    </div>
                </div>
                <p>
                    Di sini Anda dapat mengirim aspirasi, menyampaikan pengaduan, dan memantau perkembangan laporan Anda secara cepat.
                    Gunakan form di bawah untuk membuat laporan baru, lalu cek riwayat dan statusnya kapan saja.
                </p>

                <div class="hero-actions">
                    <a href="#reports" class="primary-btn">Buat laporan</a>
                    <a href="#reports" class="ghost-btn">Lihat riwayat</a>
                </div>
            </div>

            <div class="hero-side-panel">
                <div class="hero-side-card full">
                    <span class="side-label">Laporan saya</span>
                    <div class="side-value">{{ $stats['total'] }}</div>
                    <div class="side-note">Total laporan yang sudah Anda kirim</div>
                </div>
                <div class="hero-side-card">
                    <span class="side-label">Diproses</span>
                    <div class="side-value">{{ $stats['open'] }}</div>
                    <div class="side-note">Masih dalam penanganan</div>
                </div>
                <div class="hero-side-card">
                    <span class="side-label">Selesai</span>
                    <div class="side-value">{{ $stats['resolved'] }}</div>
                    <div class="side-note">Sudah ditindaklanjuti</div>
                </div>
            </div>
        </section>

        @if (session('ticket_number'))
            <div class="success-banner">
                <strong>Laporan berhasil diterima.</strong>
                <span>Nomor tiket kamu: <b>{{ session('ticket_number') }}</b></span>
            </div>
        @endif

        <section class="feature-strip">
            <article class="feature-item">
                <div class="feature-badge">A</div>
                <h3>Aspirasi</h3>
                <p>Sampaikan ide, masukan, dan saran untuk perbaikan sekolah secara cepat, aman, dan terstruktur.</p>
            </article>
            <article class="feature-item">
                <div class="feature-badge">P</div>
                <h3>Pengaduan</h3>
                <p>Laporkan masalah yang sedang terjadi agar pihak sekolah dapat segera menindaklanjuti dan membantu.</p>
            </article>
            <article class="feature-item">
                <div class="feature-badge">S</div>
                <h3>Status</h3>
                <p>Lacak perkembangan setiap laporan Anda mulai dari diterima, diproses, hingga selesai dengan mudah.</p>
            </article>
        </section>

        <section class="panel info-panel">
            <div class="panel-header">
                <h2>Panduan cepat dashboard siswa</h2>
            </div>

            <div class="info-grid">
                <article class="info-card">
                    <span class="info-tag">1</span>
                    <h3>Siapkan laporan dengan jelas</h3>
                    <p>Jelaskan masalah atau aspirasi Anda dengan judul yang ringkas, lokasi yang tepat, dan detail yang cukup agar petugas sekolah mudah memahami kebutuhan Anda.</p>
                </article>
                <article class="info-card">
                    <span class="info-tag">2</span>
                    <h3>Gunakan form laporan dengan benar</h3>
                    <p>Pilih jenis laporan, kategori, lalu tulis isi laporan secara lengkap. Jika ada bukti seperti foto atau dokumen, Anda bisa menambahkannya sebagai lampiran.</p>
                </article>
                <article class="info-card">
                    <span class="info-tag">3</span>
                    <h3>Pantau perkembangan laporan</h3>
                    <p>Setiap laporan yang Anda kirim akan tersimpan di riwayat. Anda dapat melihat statusnya mulai dari diterima, diproses, hingga selesai.</p>
                </article>
            </div>

            <div class="checklist-grid">
                <div class="checklist">
                    <h3>Yang sebaiknya ditulis</h3>
                    <ul>
                        <li>Judul laporan yang spesifik dan mudah dipahami.</li>
                        <li>Deskripsi kejadian lengkap, termasuk waktu dan lokasi.</li>
                        <li>Informasi penting seperti nama ruang, fasilitas, atau pihak yang terlibat.</li>
                        <li>Foto atau dokumen pendukung bila diperlukan.</li>
                    </ul>
                </div>

                <div class="checklist">
                    <h3>Arti status laporan</h3>
                    <ul>
                        <li><strong>Diterima</strong> — laporan sudah masuk ke sistem dan menunggu penanganan.</li>
                        <li><strong>Diproses</strong> — laporan sedang ditinjau atau ditangani oleh pihak sekolah.</li>
                        <li><strong>Selesai</strong> — laporan sudah ditangani dan dapat ditutup.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="panel report-panel">
            <div class="panel-header">
                <h2>Buat laporan baru</h2>
            </div>
            <p class="panel-subtitle">
                Isi formulir di bawah ini untuk mengirim aspirasi, pengaduan, atau laporan barang hilang secara cepat dan terstruktur.
            </p>

            <form class="report-form" action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="field-grid two-col">
                    <label>
                        Jenis laporan
                        <select name="type" required>
                            <option value="aspirasi">Aspirasi & saran</option>
                            <option value="pengaduan">Pengaduan aman</option>
                            <option value="lost_found">Barang hilang & temuan</option>
                        </select>
                    </label>

                    <label>
                        Kategori
                        <select name="category" required>
                            <option value="Fasilitas">Fasilitas sekolah</option>
                            <option value="Kurikulum">Kurikulum & pembelajaran</option>
                            <option value="Kedisiplinan">Kedisiplinan & keamanan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </label>
                </div>

                <label>
                    Judul laporan
                    <input type="text" name="subject" placeholder="Contoh: Lampu di ruang kelas 9A perlu diperbaiki" required>
                </label>

                <label>
                    Detail laporan
                    <textarea name="description" rows="5" placeholder="Jelaskan situasi, lokasi, dan waktu kejadian secara jelas." required></textarea>
                </label>

                <label>
                    Lampiran
                    <input type="file" name="attachment" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                </label>

                <div class="form-footer">
                    <label class="checkbox-row">
                        <input type="checkbox" name="is_anonymous" value="1">
                        <span>Kirim sebagai anonim</span>
                    </label>

                    <button type="submit" class="primary-btn submit-button">Kirim laporan</button>
                </div>
            </form>
        </section>

        <section class="layout-grid">
            <div class="report-panel-box" id="reports">
                <div class="panel-header">
                    <h2>Riwayat laporan saya</h2>
                    <span>{{ $reports->count() }} item</span>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Ticket</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr>
                                    <td><strong>{{ $report->ticket_number }}</strong></td>
                                    <td>{{ $report->type_label }}</td>
                                    <td>{{ $report->category }}</td>
                                    <td>{{ $report->subject }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($report->status) {
                                                'Diterima' => 'yellow',
                                                'Diproses' => 'yellow',
                                                'Selesai' => 'green',
                                                default => 'red',
                                            };
                                        @endphp
                                        <div style="display:flex; flex-wrap:wrap; gap:8px; align-items:center;">
                                            <span class="badge {{ $statusClass }}">{{ $report->status }}</span>
                                            <a href="{{ route('reports.show', $report) }}" class="ghost-btn" style="min-height:30px; padding:0 10px; border-radius:10px; font-size:0.72rem;">Detail</a>
                                            <a href="{{ route('reports.edit', $report) }}" class="ghost-btn" style="min-height:30px; padding:0 10px; border-radius:10px; font-size:0.72rem;">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="footer-note">Belum ada laporan yang kamu kirim.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <aside class="panel">
                <div class="panel-header">
                    <h2>Profil siswa</h2>
                </div>

                <div class="summary-list">
                    <div class="summary-item">
                        <div>
                            <span>Nama</span>
                            <strong>{{ $user->name ?? 'Siswa' }}</strong>
                        </div>
                        <span class="count-pill">✓</span>
                    </div>
                    <div class="summary-item">
                        <div>
                            <span>Nomor HP</span>
                            <strong>{{ $user->phone_number ?? '-' }}</strong>
                        </div>
                        <span class="count-pill">📱</span>
                    </div>
                    <div class="summary-item">
                        <div>
                            <span>Status</span>
                            <strong>Aktif</strong>
                        </div>
                        <span class="count-pill">●</span>
                    </div>
                </div>

                <div class="footer-note">Dashboard ini menampilkan laporan yang telah kamu kirim dan status terkini setiap laporan.</div>
            </aside>
        </section>
    </main>
</div>
</body>
</html>
