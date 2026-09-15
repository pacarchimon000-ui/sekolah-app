<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suara Sekolah | Portal Aspirasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
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
            --steel: #d9dfde;
            --shadow: 0 28px 70px rgba(6, 14, 12, 0.5);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            background: radial-gradient(circle at top left, rgba(78,194,141,0.16), transparent 32%),
                        linear-gradient(135deg, #0b1413 0%, #111d1a 35%, #202d2d 100%);
            color: var(--text);
            font-family: 'Manrope', sans-serif;
        }
        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }
        .page-shell {
            max-width: 1280px;
            margin: 0 auto;
            padding: 28px 24px 48px;
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 12px 18px;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: rgba(10, 19, 17, 0.32);
            backdrop-filter: blur(14px);
            box-shadow: var(--shadow);
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            letter-spacing: -0.05em;
            font-size: 1.05rem;
        }
        .brand-mark {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #59d39a 0%, #1f6a57 100%);
            color: white;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.24);
        }
        .brand-dot { color: var(--green); }
        .nav-links { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .nav-links a {
            padding: 10px 14px;
            border-radius: 999px;
            color: var(--muted);
            transition: all 0.2s ease;
        }
        .nav-links a:hover { background: rgba(255,255,255,0.02); color: var(--text); }
        .nav-button,
        .primary-button,
        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 20px;
            border-radius: 12px;
            border: 1px solid transparent;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .nav-button:hover,
        .primary-button:hover,
        .secondary-button:hover {
            box-shadow: 0 16px 28px rgba(28, 91, 77, 0.28);
        }
        .nav-button,
        .primary-button {
            background: linear-gradient(135deg, #58d19a 0%, #1c5b4d 100%);
            color: white;
            box-shadow: 0 12px 24px rgba(28, 91, 77, 0.32);
        }
        .secondary-button {
            background: rgba(255,255,255,0.02);
            border-color: var(--line-strong);
            color: var(--text);
        }
        .page-content { display: grid; gap: 28px; margin-top: 28px; }
        .hero {
            position: relative;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 24px;
            align-items: center;
            padding: 28px;
            border-radius: 30px;
            background: linear-gradient(135deg, rgba(19, 38, 33, 0.96), rgba(23, 39, 38, 0.86));
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: -20% auto auto -10%;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(78,194,141,0.18), transparent 62%);
            pointer-events: none;
        }
        .hero-copy { display: grid; gap: 20px; }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--green);
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }
        .eyebrow.light { color: var(--steel); }
        .pulse {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 0 0 rgba(78,194,141,0.6);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(78,194,141,0.6); }
            70% { box-shadow: 0 0 0 14px rgba(78,194,141,0); }
            100% { box-shadow: 0 0 0 0 rgba(78,194,141,0); }
        }
        h1 {
            margin: 0;
            font-size: clamp(2.8rem, 4vw, 5rem);
            line-height: 0.96;
            letter-spacing: -0.08em;
        }
        h1 span { color: var(--green); }
        .hero-text, .section-heading p, .stat-card p, .process-card p, .option-card p, .site-footer span:last-child {
            color: var(--muted);
            margin: 0;
            line-height: 1.7;
        }
        .school-tagline {
            margin: -8px 0 0;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid rgba(78,194,141,0.28);
            background: rgba(78,194,141,0.08);
            color: #d9f8ea;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            width: fit-content;
        }
        .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }
        .hero-meta {
            display: grid;
            grid-template-columns: repeat(3, minmax(120px, 1fr));
            gap: 16px;
            margin-top: 8px;
        }
        .hero-meta div {
            padding: 18px 16px;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
        }
        .hero-meta strong { display: block; font-size: 1.2rem; letter-spacing: -0.04em; }
        .hero-meta span { color: var(--muted); font-size: 0.8rem; }
        .hero-visual {
            position: relative;
            min-height: 430px;
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.01));
            border: 1px solid var(--line);
            display: grid;
            place-items: center;
            overflow: hidden;
        }
        .orb { position: absolute; border-radius: 50%; filter: blur(10px); }
        .orb-one {
            width: 280px; height: 280px;
            background: radial-gradient(circle, rgba(78,194,141,0.5) 0%, rgba(78,194,141,0.18) 42%, transparent 68%);
            top: 36px; left: 48px;
        }
        .orb-two {
            width: 230px; height: 230px;
            background: radial-gradient(circle, rgba(177,188,186,0.4) 0%, rgba(177,188,186,0.12) 45%, transparent 70%);
            bottom: 24px; right: 32px;
        }
        .visual-card {
            position: relative;
            z-index: 1;
            width: min(76%, 340px);
            padding: 26px 22px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(19, 41, 35, 0.88), rgba(12, 22, 19, 0.92));
            border: 1px solid var(--line-strong);
            box-shadow: var(--shadow);
        }
        .mini-tag {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(78,194,141,0.12);
            border: 1px solid rgba(78,194,141,0.32);
            color: #aff0cc;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .visual-card h3 { margin: 18px 0 20px; font-size: clamp(1.5rem, 2vw, 2rem); line-height: 1.1; letter-spacing: -0.06em; }
        .signal-bars { display: flex; align-items: end; gap: 7px; height: 54px; }
        .signal-bars span {
            display: block; width: 12px; border-radius: 999px 999px 0 0;
            background: linear-gradient(180deg, #7fdfb0, #245b4e);
        }
        .signal-bars span:nth-child(1) { height: 32%; }
        .signal-bars span:nth-child(2) { height: 52%; }
        .signal-bars span:nth-child(3) { height: 74%; }
        .signal-bars span:nth-child(4) { height: 100%; }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }
        .stat-card {
            padding: 22px 18px;
            border-radius: 22px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(21,34,29,0.84), rgba(13,19,18,0.92));
            box-shadow: var(--shadow);
        }
        .stat-number {
            display: inline-flex;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            color: var(--green);
            text-transform: uppercase;
        }
        .stat-card h3 { margin: 14px 0 8px; font-size: 1.15rem; }
        .report-section, .process-section {
            padding: 28px;
            border-radius: 28px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19,37,31,0.82), rgba(13,21,20,0.92));
            box-shadow: var(--shadow);
        }
        .section-heading { display: grid; gap: 12px; margin-bottom: 24px; }
        .section-heading h2 {
            margin: 0;
            font-size: clamp(2rem, 2vw, 2.8rem);
            letter-spacing: -0.06em;
        }
        .report-layout {
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.5fr);
            gap: 22px;
            align-items: start;
        }
        .report-options { display: grid; gap: 14px; }
        .option-card {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 16px;
            padding: 18px;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
            transition: border-color 0.2s ease, transform 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }
        .option-card.active {
            border-color: rgba(78,194,141,0.52);
            background: rgba(78,194,141,0.08);
            box-shadow: inset 0 0 0 1px rgba(78,194,141,0.32);
        }
        .option-card:hover { transform: translateY(-1px); }
        .option-icon {
            width: 42px; height: 42px; display: grid; place-items: center;
            border-radius: 12px; background: linear-gradient(135deg, #58d19a, #245b4e); color: white; font-weight: 800;
        }
        .option-icon.alert { background: linear-gradient(135deg, #d0d7d5, #4d5b57); }
        .option-icon.search { background: linear-gradient(135deg, #8cb8cb, #285e6a); }
        .option-card h3 { margin: 0; font-size: 1rem; }
        .option-card p { margin-top: 4px; font-size: 0.85rem; }
        .arrow { color: var(--green); font-size: 1.2rem; }
        .form-panel {
            border-radius: 24px;
            border: 1px solid var(--line-strong);
            background: rgba(11, 20, 19, 0.72);
            padding: 22px;
        }
        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 18px;
        }
        .panel-header h3 { margin: 4px 0 0; font-size: clamp(1.5rem, 1.5vw, 2rem); letter-spacing: -0.05em; }
        .step-badge {
            display: inline-flex; height: 34px; align-items: center; padding: 0 10px;
            border-radius: 999px; border: 1px solid var(--line-strong); background: rgba(255,255,255,0.02);
            color: var(--steel); font-size: 0.78rem; font-weight: 700;
        }
        .form-panel form { display: grid; gap: 18px; }
        .field-grid { display: grid; gap: 18px; }
        .two-col { grid-template-columns: repeat(2, minmax(0, 1fr)); }
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
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: rgba(78,194,141,0.8);
            box-shadow: 0 0 0 4px rgba(78,194,141,0.12);
        }
        textarea { resize: vertical; min-height: 140px; }
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            padding-top: 6px;
        }
        .checkbox-row {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.92rem;
            color: var(--text);
        }
        .checkbox-row input { width: 16px; height: 16px; accent-color: var(--green); }
        .submit-button { min-width: 180px; }
        .process-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }
        .process-card {
            padding: 22px 18px;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
        }
        .process-step {
            display: inline-flex;
            width: 42px; height: 42px; border-radius: 12px; align-items: center; justify-content: center;
            background: rgba(78,194,141,0.12); color: #aff0cc; font-weight: 800;
        }
        .process-card h3 { margin: 16px 0 8px; font-size: 1.2rem; }
        .success-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 22px;
            padding: 16px 18px;
            border-radius: 18px;
            border: 1px solid rgba(78,194,141,0.35);
            background: rgba(78,194,141,0.08);
            color: #dffbf0;
        }
        .success-banner strong { font-size: 0.96rem; }
        .success-banner b { color: white; }
        .site-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 28px;
            padding: 20px 10px 0;
            border-top: 1px solid var(--line);
            color: var(--muted);
        }
        @media (max-width: 980px) {
            .hero, .report-layout, .stats-grid, .process-grid { grid-template-columns: 1fr; }
            .topbar { flex-direction: column; align-items: flex-start; }
            .nav-links { width: 100%; }
            .nav-links a { flex: 1; text-align: center; }
        }
        @media (max-width: 640px) {
            .page-shell { padding-left: 16px; padding-right: 16px; }
            .hero, .report-section, .process-section { padding: 20px 18px; }
            .two-col, .hero-meta { grid-template-columns: 1fr; }
            .hero-actions, .form-footer { flex-direction: column; align-items: stretch; }
            .primary-button, .secondary-button, .submit-button { width: 100%; }
            .nav-links { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .nav-links .nav-button { grid-column: span 2; }
        }
    </style>
</head>
<body>
<div class="page-shell">
    <nav class="topbar">
        <a href="{{ route('portal') }}" class="brand">
            <img src="{{ asset('logo-sekolah-transparent.png') }}" alt="Logo sekolah" class="brand-logo" width="56" height="56" style="object-fit:contain; border-radius:14px; background:transparent; box-shadow:none; border:none;">
            <span>SMK Wahidin Kota Cirebon</span>
        </a>

        <div class="nav-links">
            <a href="#fitur">Fitur</a>
            <a href="#cara-kerja">Cara kerja</a>
            <a href="#bantuan">Bantuan</a>
            <a href="{{ route('student.login') }}">Login siswa</a>
            <a href="{{ route('admin.login') }}">Login admin</a>
            <a href="#kirim" class="nav-button">Kirim laporan</a>
        </div>
    </nav>

    @if (session('ticket_number'))
        <div class="success-banner">
            <strong>Laporan berhasil diterima.</strong>
            <span>Nomor tiket kamu: <b>{{ session('ticket_number') }}</b></span>
        </div>
    @endif

    <main class="page-content">
        <section class="hero">
            <div class="hero-copy">
                <p class="eyebrow"><span class="pulse"></span> ruang aman untuk bersuara</p>
                <h1>Perubahan besar dimulai dari <span>satu suara.</span></h1>
                <p class="school-tagline">Membangun sekolah yang lebih aman, rapi, dan peduli.</p>
                <p class="hero-text">
                    Sampaikan aspirasi, laporkan kejadian, dan bantu sekolah menciptakan lingkungan yang lebih aman,
                    rapi, dan nyaman. Setiap laporan ditangani dengan penuh perhatian dan kerahasiaan.
                </p>

                <div class="hero-actions">
                    <a href="#kirim" class="primary-button">Sampaikan suara</a>
                    <a href="#cara-kerja" class="secondary-button">Lihat alurnya</a>
                </div>

                <div class="hero-meta">
                    <div>
                        <strong>1.2k+</strong>
                        <span>Laporan terdengar</span>
                    </div>
                    <div>
                        <strong>98%</strong>
                        <span>Respon cepat</span>
                    </div>
                    <div>
                        <strong>24/7</strong>
                        <span>Monitoring</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual" aria-hidden="true">
                <div class="orb orb-one"></div>
                <div class="orb orb-two"></div>
                <div class="visual-card">
                    <span class="mini-tag">Anonim</span>
                    <h3>Suara sekolah lebih rapi, lebih cepat.</h3>
                    <div class="signal-bars">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="stats-grid" id="fitur">
            <article class="stat-card">
                <span class="stat-number">01</span>
                <h3>Privasi terjaga</h3>
                <p>Identitas tetap aman, terutama untuk laporan sensitif.</p>
            </article>
            <article class="stat-card">
                <span class="stat-number">02</span>
                <h3>Nomor tiket</h3>
                <p>Setiap laporan memiliki kode unik untuk pantau prosesnya.</p>
            </article>
            <article class="stat-card">
                <span class="stat-number">03</span>
                <h3>Tim responsif</h3>
                <p>Masukan kamu diteruskan ke pihak yang tepat dan terverifikasi.</p>
            </article>
            <article class="stat-card">
                <span class="stat-number">04</span>
                <h3>Solusi nyata</h3>
                <p>Hasil tindak lanjut bisa langsung dibaca dan dipantau.</p>
            </article>
        </section>

        <section class="report-section" id="kirim">
            <div class="section-heading">
                <p class="eyebrow">mulai dari sini</p>
                <h2>Apa yang ingin kamu sampaikan?</h2>
                <p>Pilih jenis laporan, isi detail dengan jelas, dan tim kami akan menindaklanjutinya dengan cepat.</p>
            </div>

            <div class="report-layout">
                <div class="report-options">
                    <div class="option-card active">
                        <span class="option-icon">✦</span>
                        <div>
                            <h3>Aspirasi & saran</h3>
                            <p>Ide untuk membuat sekolah lebih baik.</p>
                        </div>
                        <span class="arrow">↗</span>
                    </div>
                    <div class="option-card">
                        <span class="option-icon alert">!</span>
                        <div>
                            <h3>Pengaduan aman</h3>
                            <p>Laporkan pelanggaran atau hal yang mengganggu.</p>
                        </div>
                        <span class="arrow">↗</span>
                    </div>
                    <div class="option-card">
                        <span class="option-icon search">⌕</span>
                        <div>
                            <h3>Barang hilang & temuan</h3>
                            <p>Bantu barang kembali ke pemiliknya.</p>
                        </div>
                        <span class="arrow">↗</span>
                    </div>
                </div>

                <div class="form-panel">
                    <div class="panel-header">
                        <div>
                            <p class="eyebrow light">formulir laporan</p>
                            <h3>Ceritakan selengkapnya</h3>
                        </div>
                        <span class="step-badge">01 / 02</span>
                    </div>

                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
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

                        <label class="file-field">
                            Lampiran
                            <input type="file" name="attachment" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                        </label>

                        <div class="form-footer">
                            <label class="checkbox-row">
                                <input type="checkbox" name="is_anonymous" value="1">
                                <span>Kirim sebagai anonim</span>
                            </label>

                            <button type="submit" class="primary-button submit-button">
                                Kirim laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="process-section" id="cara-kerja">
            <div class="section-heading left">
                <p class="eyebrow">jelas sejak awal</p>
                <h2>Dari laporan menjadi aksi.</h2>
            </div>

            <div class="process-grid">
                <article class="process-card">
                    <span class="process-step">01</span>
                    <h3>Diterima</h3>
                    <p>Laporan masuk dan otomatis mendapat nomor tiket unik.</p>
                </article>
                <article class="process-card">
                    <span class="process-step">02</span>
                    <h3>Ditinjau</h3>
                    <p>Tim berwenang memeriksa detail dan menentukan langkah lanjutan.</p>
                </article>
                <article class="process-card">
                    <span class="process-step">03</span>
                    <h3>Ditindaklanjuti</h3>
                    <p>Kamu akan mendapat kabar saat ada perkembangan terbaru.</p>
                </article>
            </div>
        </section>
    </main>

    <footer class="site-footer" id="bantuan">
        <span>suara<span class="brand-dot">.</span>sekolah</span>
        <span>Portal Aspirasi & Pengaduan Sekolah</span>
        <span>Butuh bantuan? Hubungi BK atau Tata Usaha</span>
    </footer>
</div>

<script>
    const optionCards = document.querySelectorAll('.option-card');
    const typeSelect = document.querySelector('select[name="type"]');

    optionCards.forEach((card) => {
        card.addEventListener('click', () => {
            optionCards.forEach((item) => item.classList.remove('active'));
            card.classList.add('active');

            if (typeSelect) {
                const optionMap = {
                    0: 'aspirasi',
                    1: 'pengaduan',
                    2: 'lost_found'
                };

                typeSelect.value = optionMap[Array.from(optionCards).indexOf(card)] ?? 'aspirasi';
            }
        });
    });
</script>
</body>
</html>
