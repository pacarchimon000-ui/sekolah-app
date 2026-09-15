<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Siswa | Suara Sekolah</title>
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
            --primary-soft: rgba(92, 207, 155, 0.2);
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
            background: transparent;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .primary-btn, .ghost-btn, .danger-btn, .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border: 1px solid transparent;
            text-decoration: none;
            font-weight: 700;
            transition: 0.2s ease;
            cursor: pointer;
        }

        .primary-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-strong) 100%);
            color: #0b1e21;
            padding: 12px 18px;
        }

        .ghost-btn {
            background: rgba(255,255,255,0.04);
            border-color: var(--border);
            color: var(--text);
            padding: 11px 16px;
        }

        .action-btn {
            background: rgba(92, 207, 155, 0.14);
            border-color: rgba(92, 207, 155, 0.4);
            color: var(--text);
            padding: 8px 12px;
            font-size: 0.82rem;
        }

        .danger-btn {
            background: rgba(240, 131, 131, 0.12);
            border-color: rgba(240, 131, 131, 0.45);
            color: #ffd8d8;
            padding: 8px 12px;
            font-size: 0.82rem;
        }

        .page-header {
            margin: 30px 0 18px;
            display: flex;
            justify-content: space-between;
            align-items: end;
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
            max-width: 760px;
        }

        .alert {
            background: rgba(92, 207, 155, 0.14);
            border: 1px solid rgba(92, 207, 155, 0.35);
            color: var(--text);
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 22px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: linear-gradient(145deg, rgba(30, 70, 72, 0.88), rgba(17, 42, 45, 0.88));
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 18px 35px rgba(0,0,0,0.16);
        }

        .stat-label {
            display: block;
            color: var(--muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .stat-value {
            display: block;
            font-size: clamp(1.5rem, 2vw, 2.1rem);
            font-weight: 800;
            margin-top: 10px;
            color: var(--text);
        }

        .stat-note {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            font-size: 0.8rem;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 22px;
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
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        td {
            color: var(--text);
        }

        .student-name {
            font-weight: 700;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.78rem;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.04);
        }

        .status-active {
            background: rgba(92, 207, 155, 0.14);
            border-color: rgba(92, 207, 155, 0.4);
            color: #d9fff0;
        }

        .empty {
            padding: 24px 18px;
            color: var(--muted);
            text-align: center;
        }

        .action-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(7, 17, 19, 0.64);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 50;
        }

        .modal-backdrop.show {
            display: flex;
        }

        .modal {
            width: min(600px, 100%);
            background: var(--panel-strong);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 22px;
            border-bottom: 1px solid var(--border);
        }

        .modal-header h3 {
            margin: 0;
            font-size: 1.15rem;
        }

        .close-btn {
            background: transparent;
            border: none;
            color: var(--text);
            font-size: 1.6rem;
            cursor: pointer;
        }

        .modal-body {
            padding: 22px;
        }

        .field-grid {
            display: grid;
            gap: 16px;
        }

        .field-grid.two-col {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        label {
            display: block;
            color: var(--muted);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: rgba(255,255,255,0.02);
            color: var(--text);
            margin-top: 6px;
        }

        input::placeholder {
            color: rgba(237,247,242,0.55);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 0 22px 22px;
        }

        @media (max-width: 760px) {
            .field-grid.two-col {
                grid-template-columns: 1fr;
            }

            .topbar, .page-header {
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
            <a href="{{ route('dashboard') }}" class="ghost-btn">Dashboard</a>
            <a href="{{ route('profile') }}" class="ghost-btn">Profil</a>
        </div>
    </nav>

    <div class="page-header">
        <div>
            <p class="eyebrow">admin panel</p>
            <h1>Kelola siswa</h1>
            <p class="subtitle">Lihat daftar siswa, perbarui data akun, dan pastikan nomor handphone serta profil siswa selalu terbaru.</p>
        </div>
        <div class="top-actions">
            <button type="button" class="primary-btn" data-open-modal="student-create-modal">Tambah siswa</button>
            <a href="{{ route('dashboard') }}" class="ghost-btn">Kembali ke dashboard</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <section class="stats-grid">
        <article class="stat-card">
            <span class="stat-label">Total siswa</span>
            <span class="stat-value">{{ $students->count() }}</span>
            <span class="stat-note">Seluruh siswa aktif di sistem</span>
        </article>

        <article class="stat-card">
            <span class="stat-label">Status aktif</span>
            <span class="stat-value">{{ $students->count() }}</span>
            <span class="stat-note">Semua siswa saat ini aktif</span>
        </article>

        <article class="stat-card">
            <span class="stat-label">Nomor HP terisi</span>
            <span class="stat-value">{{ $students->whereNotNull('phone_number')->count() }}</span>
            <span class="stat-note">Data kontak siswa yang lengkap</span>
        </article>
    </section>

    <section class="panel">
        <div class="panel-header">
            <h2>Daftar siswa</h2>
            <span>{{ $students->count() }} siswa terdaftar</span>
        </div>

        <div style="padding: 18px 22px 0;">
            <form method="GET" action="{{ route('admin.students') }}" style="display:flex; gap:12px; flex-wrap:wrap;">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama, email, atau nomor HP" style="flex:1; min-width:220px;">
                <button type="submit" class="primary-btn">Cari</button>
                @if (!empty($search))
                    <a href="{{ route('admin.students') }}" class="ghost-btn">Reset</a>
                @endif
            </form>

            <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top: 12px;">
                <a href="{{ route('admin.students', ['search' => $search, 'sort' => 'name', 'direction' => ($sort === 'name' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="ghost-btn">Urut nama</a>
                <a href="{{ route('admin.students', ['search' => $search, 'sort' => 'phone_number', 'direction' => ($sort === 'phone_number' && $direction === 'asc') ? 'desc' : 'asc']) }}" class="ghost-btn">Urut nomor HP</a>
                <a href="{{ route('admin.students', ['search' => $search, 'sort' => 'created_at', 'direction' => 'desc']) }}" class="ghost-btn">Terbaru</a>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td class="student-name">{{ $student->name }}</td>
                            <td>{{ $student->phone_number }}</td>
                            <td>{{ $student->email }}</td>
                            <td><span class="pill status-active">Aktif</span></td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.students.detail', $student) }}" class="action-btn">Detail</a>
                                    <button type="button" class="action-btn" data-open-modal="student-modal-{{ $student->id }}">Edit</button>
                                    <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Hapus siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="danger-btn">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<div class="modal-backdrop" id="student-create-modal">
    <div class="modal">
        <div class="modal-header">
            <h3>Tambah siswa baru</h3>
            <button type="button" class="close-btn" data-close-modal="student-create-modal">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.students.store') }}">
            @csrf

            <div class="modal-body">
                <div class="field-grid two-col">
                    <div>
                        <label for="create-name">Nama</label>
                        <input id="create-name" type="text" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div>
                        <label for="create-phone">Nomor handphone</label>
                        <input id="create-phone" type="text" name="phone_number" value="{{ old('phone_number') }}" required>
                    </div>
                </div>

                <div class="field-grid two-col" style="margin-top: 16px;">
                    <div>
                        <label for="create-password">Password</label>
                        <input id="create-password" type="password" name="password" required>
                    </div>

                    <div>
                        <label for="create-password-confirmation">Konfirmasi password</label>
                        <input id="create-password-confirmation" type="password" name="password_confirmation" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="ghost-btn" data-close-modal="student-create-modal">Batal</button>
                <button type="submit" class="primary-btn">Simpan</button>
            </div>
        </form>
    </div>
</div>

@foreach ($students as $student)
    <div class="modal-backdrop" id="student-modal-{{ $student->id }}">
        <div class="modal">
            <div class="modal-header">
                <h3>Edit data siswa</h3>
                <button type="button" class="close-btn" data-close-modal="student-modal-{{ $student->id }}">&times;</button>
            </div>

            <form method="POST" action="{{ route('admin.students.update', $student) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="field-grid two-col">
                        <div>
                            <label for="name-{{ $student->id }}">Nama</label>
                            <input id="name-{{ $student->id }}" type="text" name="name" value="{{ old('name', $student->name) }}" required>
                        </div>

                        <div>
                            <label for="phone-{{ $student->id }}">Nomor handphone</label>
                            <input id="phone-{{ $student->id }}" type="text" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" required>
                        </div>
                    </div>

                    <div class="field-grid two-col" style="margin-top: 16px;">
                        <div>
                            <label for="password-{{ $student->id }}">Password baru</label>
                            <input id="password-{{ $student->id }}" type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti">
                        </div>

                        <div>
                            <label for="password-confirmation-{{ $student->id }}">Konfirmasi password</label>
                            <input id="password-confirmation-{{ $student->id }}" type="password" name="password_confirmation" placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="ghost-btn" data-close-modal="student-modal-{{ $student->id }}">Batal</button>
                    <button type="submit" class="primary-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endforeach

<script>
    document.querySelectorAll('[data-open-modal]').forEach((button) => {
        button.addEventListener('click', () => {
            const target = document.getElementById(button.dataset.openModal);
            if (target) target.classList.add('show');
        });
    });

    document.querySelectorAll('[data-close-modal]').forEach((button) => {
        button.addEventListener('click', () => {
            const target = document.getElementById(button.dataset.closeModal);
            if (target) target.classList.remove('show');
        });
    });
</script>
</body>
</html>
