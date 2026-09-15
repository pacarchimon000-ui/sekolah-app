<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Siswa | Suara Sekolah</title>
    <style>
        :root {
            --bg: #0d1f24;
            --bg-soft: #173b3c;
            --panel: rgba(23, 59, 60, 0.82);
            --panel-strong: rgba(27, 71, 73, 0.95);
            --card: rgba(12, 31, 35, 0.85);
            --text: #edf7f2;
            --muted: #bfd6cf;
            --border: rgba(255,255,255,0.12);
            --primary: #5ccf9b;
            --primary-strong: #47b885;
            --danger: #f08383;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, #0b1e21 0%, #173b3b 50%, #1f2f32 100%);
        }

        .page-shell {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px 50px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 22px;
            background: rgba(20, 41, 43, 0.8);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.18);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text);
            text-decoration: none;
            font-weight: 700;
        }

        .brand-logo {
            width: 56px;
            height: 56px;
            object-fit: contain;
            border-radius: 14px;
        }

        .top-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .primary-btn, .ghost-btn, .danger-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border: 1px solid transparent;
            text-decoration: none;
            font-weight: 700;
            padding: 11px 16px;
            cursor: pointer;
        }

        .primary-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-strong) 100%);
            color: #0b1e21;
        }

        .ghost-btn {
            background: rgba(255,255,255,0.04);
            border-color: var(--border);
            color: var(--text);
        }

        .page-header {
            margin: 30px 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            flex-wrap: wrap;
        }

        .eyebrow {
            margin: 0 0 8px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-size: 0.74rem;
            color: var(--muted);
        }

        h1 {
            margin: 0;
            font-size: clamp(1.8rem, 2vw, 2.5rem);
        }

        .subtitle {
            margin-top: 8px;
            color: var(--muted);
        }

        .profile-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 2.3fr);
            gap: 22px;
            margin-top: 18px;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.16);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 20px 22px;
            border-bottom: 1px solid var(--border);
        }

        .panel-header h2 {
            margin: 0;
            font-size: 1.2rem;
        }

        .info-list {
            padding: 22px;
            display: grid;
            gap: 16px;
        }

        .info-item {
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
        }

        .label {
            display: block;
            color: var(--muted);
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 5px;
        }

        .value {
            font-size: 1rem;
            font-weight: 700;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            padding: 7px 10px;
            border-radius: 999px;
            font-size: 0.76rem;
            border: 1px solid rgba(92, 207, 155, 0.5);
            background: rgba(92, 207, 155, 0.14);
            color: #dffef0;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 760px;
        }

        th, td {
            padding: 16px 18px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
        }

        th {
            background: rgba(255,255,255,0.02);
            color: var(--muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.18);
            font-size: 0.76rem;
            background: rgba(255,255,255,0.04);
        }

        .badge.green { background: rgba(92,207,155,0.12); border-color: rgba(92,207,155,0.42); color: #dffef0; }
        .badge.yellow { background: rgba(255, 203, 107, 0.12); border-color: rgba(255, 203, 107, 0.4); color: #ffe7b3; }
        .badge.red { background: rgba(240, 131, 131, 0.12); border-color: rgba(240, 131, 131, 0.4); color: #ffd9d9; }

        .empty {
            padding: 24px 18px;
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 960px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .page-header, .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
<div class="page-shell">
    <nav class="topbar">
        <a href="{{ route('portal') }}" class="brand">
            <img src="{{ asset('logo-sekolah-transparent.png') }}" alt="Logo sekolah" class="brand-logo">
            <span>SMK Wahidin Kota Cirebon</span>
        </a>

        <div class="top-actions">
            <a href="{{ route('admin.students') }}" class="ghost-btn">Kembali ke daftar siswa</a>
            <a href="{{ route('dashboard') }}" class="primary-btn">Dashboard</a>
        </div>
    </nav>

    <div class="page-header">
        <div>
            <p class="eyebrow">Siswa Detail</p>
            <h1>{{ $student->name }}</h1>
            <p class="subtitle">Informasi akun siswa beserta riwayat laporan yang pernah dikirim.</p>
        </div>
    </div>

    <div class="profile-grid">
        <section class="panel">
            <div class="panel-header">
                <h2>Profil siswa</h2>
                <span class="pill">Aktif</span>
            </div>

            <div class="info-list">
                <div class="info-item">
                    <span class="label">Nama</span>
                    <div class="value">{{ $student->name }}</div>
                </div>
                <div class="info-item">
                    <span class="label">Nomor handphone</span>
                    <div class="value">{{ $student->phone_number }}</div>
                </div>
                <div class="info-item">
                    <span class="label">Email</span>
                    <div class="value">{{ $student->email }}</div>
                </div>
                <div class="info-item">
                    <span class="label">Tanggal daftar</span>
                    <div class="value">{{ $student->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-header">
                <h2>Riwayat laporan</h2>
                <span>{{ $reports->count() }} item</span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Ticket</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td><strong>{{ $report->ticket_number }}</strong></td>
                                <td>{{ $report->subject }}</td>
                                <td>{{ $report->category }}</td>
                                <td>
                                    @php
                                        $statusClass = match ($report->status) {
                                            'Diterima' => 'yellow',
                                            'Diproses' => 'yellow',
                                            'Selesai' => 'green',
                                            default => 'red',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $report->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty">Belum ada laporan yang dikirim siswa ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
</body>
</html>
