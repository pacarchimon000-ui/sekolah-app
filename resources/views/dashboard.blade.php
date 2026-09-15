<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Suara Sekolah</title>
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

        .admin-hero {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
            padding: 28px;
            border-radius: 28px;
            border: 1px solid var(--line);
            background: linear-gradient(135deg, rgba(19,38,33,0.98), rgba(23,39,38,0.88));
            box-shadow: var(--shadow);
        }

        .hero-copy {
            display: grid;
            gap: 14px;
        }

        .eyebrow {
            margin: 0;
            color: var(--green);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .hero-copy h2 {
            margin: 0;
            font-size: clamp(2rem, 2.5vw, 3rem);
            letter-spacing: -0.06em;
            line-height: 1.05;
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

        .hero-copy p {
            margin: 0;
            color: var(--muted);
            line-height: 1.8;
            font-size: 0.98rem;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 4px;
        }

        .hero-actions .primary-btn,
        .hero-actions .ghost-btn {
            min-height: 46px;
            padding: 0 20px;
        }

        .hero-summary {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .summary-card {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
        }

        .summary-card strong {
            display: block;
            font-size: 1.4rem;
            margin-top: 6px;
        }

        .summary-card span {
            color: var(--muted);
            font-size: 0.85rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .chart-panel {
            padding: 24px;
        }

        .chart-grid {
            display: grid;
            gap: 18px;
            margin-top: 20px;
        }

        .chart-item {
            display: grid;
            gap: 8px;
        }

        .chart-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            color: var(--muted);
            font-size: 0.82rem;
            font-weight: 700;
        }

        .chart-meta strong {
            color: var(--text);
            font-size: 1rem;
        }

        .bar-track {
            width: 100%;
            height: 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--line);
            overflow: hidden;
        }

        .bar-fill {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #58d19a 0%, #1c5b4d 100%);
            box-shadow: 0 0 22px rgba(78, 194, 141, 0.25);
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

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }

        th, td {
            text-align: left;
            padding: 14px 10px;
            border-bottom: 1px solid var(--line);
            vertical-align: top;
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

        .badge.green {
            background: rgba(78,194,141,0.12);
            border-color: rgba(78,194,141,0.3);
            color: #aff0cc;
        }

        .badge.yellow {
            background: rgba(255, 217, 128, 0.12);
            border-color: rgba(255, 217, 128, 0.3);
            color: #f8ddb0;
        }

        .badge.red {
            background: rgba(255, 138, 128, 0.12);
            border-color: rgba(255, 138, 128, 0.32);
            color: #ffb0a9;
        }

        .wa-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 30px;
            padding: 0 10px;
            border-radius: 999px;
            background: rgba(78,194,141,0.12);
            border: 1px solid rgba(78,194,141,0.32);
            color: #aff0cc;
            font-size: 0.72rem;
            font-weight: 700;
            text-decoration: none;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-link,
        .danger-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 30px;
            padding: 0 10px;
            border-radius: 10px;
            font-size: 0.72rem;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid var(--line-strong);
            background: rgba(255,255,255,0.02);
            color: var(--text);
            cursor: pointer;
        }

        .danger-btn {
            background: rgba(255, 138, 128, 0.12);
            border-color: rgba(255, 138, 128, 0.32);
            color: #ffb0a9;
        }

        .status-form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        .status-form select {
            min-width: 128px;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: rgba(255,255,255,0.02);
            color: var(--text);
            padding: 7px 10px;
            color-scheme: dark;
        }

        .status-form option,
        select option {
            background-color: #12231d;
            color: var(--text);
        }

        .status-form button {
            border: 1px solid rgba(78,194,141,0.32);
            border-radius: 10px;
            background: rgba(78,194,141,0.12);
            color: #aff0cc;
            padding: 7px 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .activity-panel {
            margin-bottom: 18px;
        }

        .activity-list {
            display: grid;
            gap: 12px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
            transition: border-color 0.2s ease, background 0.2s ease;
        }

        .activity-item:hover {
            border-color: rgba(78,194,141,0.28);
            background: rgba(255,255,255,0.03);
        }

        .activity-meta {
            display: grid;
            gap: 2px;
        }

        .activity-meta strong {
            font-size: 0.88rem;
            letter-spacing: -0.02em;
        }

        .activity-meta small {
            color: var(--muted);
            font-size: 0.75rem;
        }

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

        .footer-note {
            margin-top: 18px;
            color: var(--muted);
            font-size: 0.85rem;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
            align-items: center;
        }

        .toolbar input,
        .toolbar select {
            min-height: 42px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.02);
            color: var(--text);
            padding: 0 12px;
        }

        .toolbar input {
            flex: 1 1 220px;
        }

        .toolbar select {
            min-width: 170px;
        }

        .toolbar .primary-btn {
            min-height: 42px;
        }

        .export-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 16px;
            border-radius: 12px;
            border: 1px solid rgba(78,194,141,0.32);
            background: rgba(78,194,141,0.12);
            color: #aff0cc;
            font-weight: 700;
            text-decoration: none;
        }

        .sort-link {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 800;
        }

        .sort-link.active {
            color: var(--green);
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
            <img src="{{ asset('logo-sekolah-transparent.png') }}" alt="Logo SMK Wahidin" style="width: 40px; height: 40px; object-fit: contain;">
            <span>SMK Wahidin Kota Cirebon</span>
        </a>

        <div class="top-actions">
            <a href="{{ route('profile') }}" class="ghost-btn">Profil</a>
            <a href="{{ route('admin.students') }}" class="ghost-btn">Kelola siswa</a>
            <a href="#reports" class="primary-btn">Kelola laporan</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="ghost-btn" style="border-color: rgba(255, 138, 128, 0.32); color: #ffb0a9;">Logout</button>
            </form>
        </div>
    </nav>

    <main class="page-content">
        <section class="admin-hero">
            <div class="hero-copy">
                <p class="eyebrow">dashboard admin</p>
                <h2>Kelola laporan sekolah dengan lebih cepat</h2>
                <div class="hero-badges">
                    <span>Monitoring</span>
                    <span>Manajemen</span>
                    <span>WhatsApp</span>
                </div>
                <p>
                    Pantau semua laporan masuk, ubah status secara cepat, dan tetap terhubung dengan siswa lewat kontak yang tersedia.
                    Gunakan dashboard ini sebagai pusat pengelolaan aspirasi, pengaduan, dan laporan penting sekolah.
                </p>

                <div class="hero-actions">
                    <a href="#reports" class="primary-btn">Lihat laporan</a>
                    <a href="#reports" class="ghost-btn">Cari data</a>
                </div>
            </div>

            <div class="hero-summary">
                <div class="summary-card">
                    <span>Total masuk</span>
                    <strong>{{ $stats['total'] }}</strong>
                </div>
                <div class="summary-card">
                    <span>Hari ini</span>
                    <strong>{{ $stats['today'] }}</strong>
                </div>
                <div class="summary-card">
                    <span>Diproses</span>
                    <strong>{{ $stats['resolved'] }}</strong>
                </div>
                <div class="summary-card">
                    <span>Anonim</span>
                    <strong>{{ $stats['anonymous'] }}</strong>
                </div>
            </div>
        </section>

        <section class="stats-grid">
            <article class="stat-card">
                <span class="stat-label">Total laporan</span>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <small>Semua laporan masuk</small>
            </article>
            <article class="stat-card">
                <span class="stat-label">Hari ini</span>
                <div class="stat-value">{{ $stats['today'] }}</div>
                <small>Data yang diterima hari ini</small>
            </article>
            <article class="stat-card">
                <span class="stat-label">Anonim</span>
                <div class="stat-value">{{ $stats['anonymous'] }}</div>
                <small>Laporan yang dikirim tanpa identitas</small>
            </article>
            <article class="stat-card">
                <span class="stat-label">Selesai</span>
                <div class="stat-value">{{ $stats['resolved'] }}</div>
                <small>Laporan yang sudah ditindaklanjuti</small>
            </article>
        </section>

        <section class="panel chart-panel">
            <div class="panel-header">
                <h2>Statistik laporan</h2>
                <span>{{ $stats['total'] }} total data</span>
            </div>

            <div class="chart-grid">
                @foreach ($chartSeries as $chartItem)
                    <div class="chart-item">
                        <div class="chart-meta">
                            <span>{{ $chartItem['label'] }}</span>
                            <strong>{{ $chartItem['value'] }}</strong>
                        </div>
                        <div class="bar-track">
                            <span class="bar-fill" style="width: {{ $chartItem['percent'] }}%; background: linear-gradient(90deg, {{ $chartItem['color'] }} 0%, {{ $chartItem['color'] }}cc 100%);"></span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="layout-grid">
            <div class="panel" id="reports">
                <div class="panel-header">
                    <h2>Daftar laporan</h2>
                    <span>{{ $reports->count() }} item</span>
                </div>

                <form method="GET" action="{{ route('dashboard') }}" class="toolbar">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari ticket, judul, kategori...">
                    <select name="status">
                        <option value="" {{ empty($statusFilter) ? 'selected' : '' }}>Semua status</option>
                        <option value="Diterima" {{ ($statusFilter ?? '') === 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Diproses" {{ ($statusFilter ?? '') === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ ($statusFilter ?? '') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" class="primary-btn">Cari</button>
                    <a href="{{ route('dashboard.export', request()->query()) }}" class="export-link">Export CSV</a>
                </form>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('dashboard', array_merge(request()->query(), ['sort' => 'ticket_number', 'direction' => ($sort === 'ticket_number' && $direction === 'asc') ? 'desc' : 'asc'])) }}" class="sort-link {{ $sort === 'ticket_number' ? 'active' : '' }}">
                                        Ticket
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('dashboard', array_merge(request()->query(), ['sort' => 'type', 'direction' => ($sort === 'type' && $direction === 'asc') ? 'desc' : 'asc'])) }}" class="sort-link {{ $sort === 'type' ? 'active' : '' }}">
                                        Jenis
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('dashboard', array_merge(request()->query(), ['sort' => 'category', 'direction' => ($sort === 'category' && $direction === 'asc') ? 'desc' : 'asc'])) }}" class="sort-link {{ $sort === 'category' ? 'active' : '' }}">
                                        Kategori
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('dashboard', array_merge(request()->query(), ['sort' => 'subject', 'direction' => ($sort === 'subject' && $direction === 'asc') ? 'desc' : 'asc'])) }}" class="sort-link {{ $sort === 'subject' ? 'active' : '' }}">
                                        Judul
                                    </a>
                                </th>
                                <th>Pelapor</th>
                                <th>Kontak</th>
                                <th>
                                    <a href="{{ route('dashboard', array_merge(request()->query(), ['sort' => 'status', 'direction' => ($sort === 'status' && $direction === 'asc') ? 'desc' : 'asc'])) }}" class="sort-link {{ $sort === 'status' ? 'active' : '' }}">
                                        Status
                                    </a>
                                </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr>
                                    <td><strong>{{ $report->ticket_number }}</strong></td>
                                    <td>{{ $report->type_label }}</td>
                                    <td>{{ $report->category }}</td>
                                    <td>{{ $report->subject }}</td>
                                    <td>{{ $report->is_anonymous ? 'Anonim' : ($report->user?->name ?? 'Siswa') }}</td>
                                    <td>
                                        @php
                                            $waUrl = $report->user && $report->user->phone_number
                                                ? 'https://wa.me/' . preg_replace('/^0/', '62', $report->user->phone_number)
                                                : null;
                                        @endphp

                                        @if ($waUrl)
                                            <a href="{{ $waUrl }}" class="wa-btn" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                                        @else
                                            <span class="badge red">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form class="status-form" method="POST" action="{{ route('reports.status.update', $report) }}">
                                            @csrf
                                            @php
                                                $statusClass = match($report->status) {
                                                    'Diterima' => 'yellow',
                                                    'Diproses' => 'yellow',
                                                    'Selesai' => 'green',
                                                    default => 'red',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $report->status }}</span>
                                            <select name="status" aria-label="Ubah status laporan {{ $report->ticket_number }}">
                                                <option value="Diterima" {{ $report->status === 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="Diproses" {{ $report->status === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="Selesai" {{ $report->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                            <button type="submit">Simpan</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="action-group">
                                            <a href="{{ route('reports.show', $report) }}" class="action-link">Detail</a>
                                            <form method="POST" action="{{ route('reports.destroy', $report) }}" onsubmit="return confirm('Hapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="danger-btn">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="footer-note">Belum ada laporan yang masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <aside class="panel">
                <div class="panel-header activity-panel">
                    <h2>Aktivitas terbaru</h2>
                </div>

                <div class="activity-list">
                    @foreach ($reports->take(5) as $report)
                        <div class="activity-item">
                            <div class="activity-meta">
                                <strong>{{ $report->ticket_number }}</strong>
                                <small>{{ $report->subject }}</small>
                            </div>
                            <span class="badge {{ $report->status === 'Selesai' ? 'green' : ($report->status === 'Diproses' ? 'yellow' : 'red') }}">{{ $report->status }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="panel-header" style="margin-top: 22px; margin-bottom: 14px;">
                    <h2>Ringkasan</h2>
                </div>

                <div class="summary-list">
                    <div class="summary-item">
                        <div>
                            <span>Aspirasi</span>
                            <strong>{{ $summary['aspirasi'] }}</strong>
                        </div>
                        <span class="count-pill">{{ $summary['aspirasi'] }}</span>
                    </div>
                    <div class="summary-item">
                        <div>
                            <span>Pengaduan</span>
                            <strong>{{ $summary['pengaduan'] }}</strong>
                        </div>
                        <span class="count-pill">{{ $summary['pengaduan'] }}</span>
                    </div>
                    <div class="summary-item">
                        <div>
                            <span>Barang hilang</span>
                            <strong>{{ $summary['lost_found'] }}</strong>
                        </div>
                        <span class="count-pill">{{ $summary['lost_found'] }}</span>
                    </div>
                </div>

                <div class="footer-note">Dashboard ini menampilkan ringkasan laporan yang masuk dari portal sekolah.</div>
            </aside>
        </section>
    </main>
</div>
</body>
</html>
