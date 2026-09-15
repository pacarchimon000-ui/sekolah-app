<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginChoice()
    {
        return view('auth.login-choice');
    }

    public function showStudentRegister()
    {
        return view('auth.student-register');
    }

    public function showAdminRegister()
    {
        return view('auth.admin-register');
    }

    public function registerStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $this->buildPlaceholderEmail($validated['phone_number']),
            'phone_number' => $validated['phone_number'],
            'role' => 'student',
            'password' => $validated['password'],
        ]);

        return redirect()->route('student.login')->with('success', 'Akun siswa berhasil dibuat. Silakan login.');
    }

    public function registerAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $this->buildPlaceholderEmail($validated['phone_number']),
            'phone_number' => $validated['phone_number'],
            'role' => 'admin',
            'password' => $validated['password'],
        ]);

        return redirect()->route('admin.login')->with('success', 'Akun admin berhasil dibuat. Silakan login.');
    }

    public function showStudentManagement(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengelola data siswa.');
        }

        $search = trim((string) $request->input('search', ''));
        $sort = $request->input('sort', 'created_at');
        $direction = strtolower($request->input('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        $allowedSorts = ['name', 'phone_number', 'email', 'created_at'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'created_at';
        }

        $query = User::where('role', 'student');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $students = $query->orderBy($sort, $direction)->get();

        return view('admin-students', [
            'students' => $students,
            'search' => $search,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    public function storeStudentManagement(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat menambah data siswa.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $this->buildPlaceholderEmail($validated['phone_number']),
            'phone_number' => $validated['phone_number'],
            'role' => 'student',
            'password' => $validated['password'],
        ]);

        return redirect()->route('admin.students')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function updateStudentManagement(Request $request, User $student)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengelola data siswa.');
        }

        if ($student->role !== 'student') {
            abort(403, 'Akses ditolak. Hanya data siswa yang bisa diperbarui dari halaman ini.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:users,phone_number,' . $student->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $student->name = $validated['name'];
        $student->phone_number = $validated['phone_number'];

        if (!empty($validated['password'])) {
            $student->password = $validated['password'];
        }

        $student->save();

        return redirect()->route('admin.students')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroyStudentManagement(User $student)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat menghapus data siswa.');
        }

        if ($student->role !== 'student') {
            abort(403, 'Akses ditolak. Hanya data siswa yang bisa dihapus dari halaman ini.');
        }

        $student->delete();

        return redirect()->route('admin.students')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function showStudentDetail(User $student)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melihat detail siswa.');
        }

        if ($student->role !== 'student') {
            abort(403, 'Akses ditolak. Hanya data siswa yang bisa dilihat dari halaman ini.');
        }

        $reports = $student->reports()->orderByDesc('created_at')->get();

        return view('admin-student-detail', [
            'student' => $student,
            'reports' => $reports,
        ]);
    }

    public function showProfile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:users,phone_number,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->phone_number = $validated['phone_number'];

        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        $redirectRoute = $user->role === 'admin' ? 'dashboard' : 'student.dashboard';

        return redirect()->route($redirectRoute)->with('success', 'Profil berhasil diperbarui.');
    }

    public function showStudentLogin()
    {
        return view('auth.student-login');
    }

    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function loginStudent(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'phone_number' => $request->phone_number,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'phone_number' => 'Nomor handphone atau password salah.',
            ]);
        }

        $user = Auth::user();

        if ($user->role !== 'student') {
            Auth::logout();

            throw ValidationException::withMessages([
                'phone_number' => 'Akun ini tidak memiliki akses siswa.',
            ]);
        }

        return redirect()->intended(route('student.dashboard'));
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'phone_number' => $request->phone_number,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'phone_number' => 'Nomor handphone atau password salah.',
            ]);
        }

        $user = Auth::user();

        if ($user->role !== 'admin') {
            Auth::logout();

            throw ValidationException::withMessages([
                'phone_number' => 'Akun ini tidak memiliki akses admin.',
            ]);
        }

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('portal');
    }

    private function buildPlaceholderEmail(string $phoneNumber): string
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phoneNumber) ?? $phoneNumber;

        return strtolower($cleanPhone) . '@sekolah.local';
    }
}
