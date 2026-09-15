<?php

namespace App\Http\Controllers;

use App\Mail\ReportStatusUpdatedMail;
use App\Mail\ReportSubmittedMail;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $ticket = null;

        if ($request->filled('ticket')) {
            $ticket = Report::where('ticket_number', strtoupper(trim($request->string('ticket'))))->first();
        }

        return view('welcome', compact('ticket'));
    }

    public function dashboard(Request $request)
    {
        $query = $this->buildReportQuery($request);
        $reports = $query->paginate(10)->appends($request->query());

        $statsQuery = $query->withoutEagerLoads();

        $stats = [
            'total' => $statsQuery->count(),
            'today' => (clone $statsQuery)->whereDate('created_at', today())->count(),
            'anonymous' => (clone $statsQuery)->where('is_anonymous', true)->count(),
            'resolved' => (clone $statsQuery)->where('status', 'Selesai')->count(),
        ];

        $summaryQuery = (clone $statsQuery)
            ->selectRaw("SUM(CASE WHEN type = 'aspirasi' THEN 1 ELSE 0 END) as aspirasi")
            ->selectRaw("SUM(CASE WHEN type = 'pengaduan' THEN 1 ELSE 0 END) as pengaduan")
            ->selectRaw("SUM(CASE WHEN type = 'lost_found' THEN 1 ELSE 0 END) as lost_found")
            ->first();

        $summary = [
            'aspirasi' => (int) ($summaryQuery->aspirasi ?? 0),
            'pengaduan' => (int) ($summaryQuery->pengaduan ?? 0),
            'lost_found' => (int) ($summaryQuery->lost_found ?? 0),
        ];

        $chartSeries = [
            ['label' => 'Aspirasi', 'value' => $summary['aspirasi'], 'color' => '#4ec28d'],
            ['label' => 'Pengaduan', 'value' => $summary['pengaduan'], 'color' => '#7dd3a7'],
            ['label' => 'Barang hilang', 'value' => $summary['lost_found'], 'color' => '#a9f0c9'],
        ];

        $maxChartValue = max(1, ...array_column($chartSeries, 'value'));

        foreach ($chartSeries as &$chartItem) {
            $chartItem['percent'] = round(($chartItem['value'] / $maxChartValue) * 100);
        }

        unset($chartItem);

        return view('dashboard', compact('reports', 'stats', 'summary', 'chartSeries'))
            ->with('search', $request->string('search')->value())
            ->with('statusFilter', $request->string('status')->value())
            ->with('sort', $request->string('sort')->value() ?: 'created_at')
            ->with('direction', $request->string('direction')->value() ?: 'desc');
    }

    public function export(Request $request)
    {
        $reports = (clone $this->buildReportQuery($request))->get();

        $filename = 'laporan-' . now()->format('YmdHis') . '.csv';

        return response()->streamDownload(function () use ($reports) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Ticket', 'Jenis', 'Kategori', 'Judul', 'Pelapor', 'Kontak', 'Status', 'Dibuat']);

            foreach ($reports as $report) {
                fputcsv($handle, [
                    $report->ticket_number,
                    ucfirst($report->type),
                    $report->category,
                    $report->subject,
                    $report->is_anonymous ? 'Anonim' : ($report->user?->name ?? 'Siswa'),
                    $report->user?->phone_number ?? '-',
                    $report->status,
                    $report->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function buildReportQuery(Request $request)
    {
        $query = Report::with('user');

        if ($request->filled('search')) {
            $search = trim($request->string('search'));

            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sort = $request->input('sort', 'created_at');
        $direction = strtolower($request->input('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        $allowedSorts = ['ticket_number', 'type', 'category', 'subject', 'status', 'created_at'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'created_at';
        }

        return $query->orderBy($sort, $direction);
    }

    public function studentDashboard()
    {
        $reports = Report::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        $stats = [
            'total' => $reports->count(),
            'today' => $reports->filter(fn ($report) => $report->created_at->isToday())->count(),
            'resolved' => $reports->where('status', 'Selesai')->count(),
            'open' => $reports->whereNotIn('status', ['Selesai'])->count(),
        ];

        return view('student-dashboard', [
            'reports' => $reports,
            'stats' => $stats,
            'user' => Auth::user(),
        ]);
    }

    public function show(Report $report)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('report-detail', compact('report'));
        }

        if ($user->role === 'student' && $report->user_id === $user->id) {
            return view('report-detail', compact('report'));
        }

        abort(403, 'Akses ditolak. Anda hanya dapat melihat laporan milik sendiri.');
    }

    public function edit(Report $report)
    {
        if (Auth::user()->role !== 'student' || $report->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda hanya dapat mengedit laporan milik sendiri.');
        }

        return view('report-edit', compact('report'));
    }

    public function update(Request $request, Report $report): RedirectResponse
    {
        if (Auth::user()->role !== 'student' || $report->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda hanya dapat mengedit laporan milik sendiri.');
        }

        $validated = $request->validate([
            'type' => ['required', 'in:aspirasi,pengaduan,lost_found'],
            'category' => ['required', 'string', 'max:80'],
            'subject' => ['required', 'string', 'max:160'],
            'description' => ['required', 'string', 'min:20', 'max:5000'],
            'is_anonymous' => ['nullable', 'boolean'],
            'attachment' => ['nullable', 'file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx'],
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment_path'] = $request->file('attachment')->store('report-attachments', 'public');
        }

        $validated['is_anonymous'] = $request->boolean('is_anonymous');

        $report->update($validated);

        return redirect()->route('student.dashboard')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Report $report): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:Diterima,Diproses,Selesai'],
        ]);

        $report->update([
            'status' => $request->status,
        ]);

        if ($report->user && $report->user->email) {
            Mail::to($report->user->email)->send(new ReportStatusUpdatedMail($report->fresh()));
        }

        return redirect()->route('dashboard')->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy(Report $report): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat menghapus laporan.');
        }

        $report->delete();

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dihapus.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:aspirasi,pengaduan,lost_found'],
            'category' => ['required', 'string', 'max:80'],
            'subject' => ['required', 'string', 'max:160'],
            'description' => ['required', 'string', 'min:20', 'max:5000'],
            'is_anonymous' => ['nullable', 'boolean'],
            'attachment' => ['nullable', 'file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx'],
        ]);

        $attachmentPath = $request->file('attachment')?->store('report-attachments', 'public');

        $report = Report::create([
            ...$validated,
            'ticket_number' => 'ASP-' . now()->format('ymd') . '-' . Str::upper(Str::random(5)),
            'is_anonymous' => $request->boolean('is_anonymous'),
            'status' => 'Diterima',
            'attachment_path' => $attachmentPath,
            'user_id' => Auth::check() ? Auth::id() : null,
        ]);

        if ($report->user && $report->user->email) {
            Mail::to($report->user->email)->send(new ReportSubmittedMail($report->fresh()));
        }

        $redirectRoute = Auth::check() ? 'student.dashboard' : 'portal';

        return redirect()->route($redirectRoute)->with('ticket_number', $report->ticket_number);
    }
}