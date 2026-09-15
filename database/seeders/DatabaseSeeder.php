<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $demoStudents = [
            [
                'email' => 'test@example.com',
                'name' => 'Test User',
                'role' => 'student',
                'phone_number' => '081234567890',
                'password' => bcrypt('password'),
            ],
            [
                'email' => 'siswa1@sekolah.test',
                'name' => 'Aisyah Nabila',
                'role' => 'student',
                'phone_number' => '081234567891',
                'password' => bcrypt('siswa123'),
            ],
            [
                'email' => 'siswa2@sekolah.test',
                'name' => 'Bagas Pratama',
                'role' => 'student',
                'phone_number' => '081234567892',
                'password' => bcrypt('siswa123'),
            ],
            [
                'email' => 'siswa3@sekolah.test',
                'name' => 'Citra Dewi',
                'role' => 'student',
                'phone_number' => '081234567893',
                'password' => bcrypt('siswa123'),
            ],
        ];

        $demoAdmins = [
            [
                'email' => 'admin@sekolah.test',
                'name' => 'Admin Sekolah',
                'role' => 'admin',
                'phone_number' => '081000000000',
                'password' => bcrypt('admin123'),
            ],
            [
                'email' => 'wakasek@sekolah.test',
                'name' => 'Wakil Kepala Sekolah',
                'role' => 'admin',
                'phone_number' => '081000000001',
                'password' => bcrypt('admin123'),
            ],
            [
                'email' => 'bk@sekolah.test',
                'name' => 'BK Sekolah',
                'role' => 'admin',
                'phone_number' => '081000000002',
                'password' => bcrypt('admin123'),
            ],
        ];

        foreach (array_merge($demoStudents, $demoAdmins) as $account) {
            User::query()->firstOrCreate(
                ['email' => $account['email']],
                $account
            );
        }

        $userByEmail = [];
        foreach (User::all() as $user) {
            $userByEmail[$user->email] = $user;
        }

        $sampleReports = [
            [
                'ticket_number' => 'ASP-260913-001',
                'type' => 'aspirasi',
                'category' => 'Fasilitas',
                'subject' => 'Lampu kelas perlu diperbaiki',
                'description' => 'Lampu di ruang kelas 7A sering mati saat siang hari. Kondisi ini membatasi proses belajar dan membuat siswa kurang nyaman.',
                'status' => 'Diterima',
                'is_anonymous' => false,
                'user_email' => 'test@example.com',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'ticket_number' => 'ASP-260913-002',
                'type' => 'pengaduan',
                'category' => 'Kedisiplinan',
                'subject' => 'Area parkir sekolah terlalu sempit',
                'description' => 'Beberapa peserta didik kesulitan saat memasukkan kendaraan karena ruang parkir terlalu sempit dan sering terjadi kemacetan.',
                'status' => 'Diproses',
                'is_anonymous' => true,
                'user_email' => 'siswa1@sekolah.test',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(2),
            ],
            [
                'ticket_number' => 'ASP-260913-003',
                'type' => 'lost_found',
                'category' => 'Lainnya',
                'subject' => 'Temuan dompet di perpustakaan',
                'description' => 'Terdapat dompet berwarna hitam yang ditemukan di dekat rak buku perpustakaan. Mohon ditindaklanjuti untuk proses klaim.',
                'status' => 'Selesai',
                'is_anonymous' => false,
                'user_email' => 'siswa2@sekolah.test',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subHours(6),
            ],
            [
                'ticket_number' => 'ASP-260913-004',
                'type' => 'aspirasi',
                'category' => 'Kurikulum',
                'subject' => 'Tambah sesi konseling siswa',
                'description' => 'Siswa membutuhkan sesi konseling tambahan terutama menjelang ujian agar dapat lebih siap dan mendapatkan dukungan emosional.',
                'status' => 'Diproses',
                'is_anonymous' => false,
                'user_email' => 'siswa3@sekolah.test',
                'created_at' => now()->subHours(18),
                'updated_at' => now()->subHours(18),
            ],
            [
                'ticket_number' => 'ASP-260913-005',
                'type' => 'pengaduan',
                'category' => 'Kedisiplinan',
                'subject' => 'Kebersihan kantin perlu diperhatikan',
                'description' => 'Beberapa area kantin masih kurang bersih dan terdapat sampah yang menumpuk pada siang hari. Mohon ada pengawasan rutin.',
                'status' => 'Diterima',
                'is_anonymous' => false,
                'user_email' => 'siswa1@sekolah.test',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
            [
                'ticket_number' => 'ASP-260913-006',
                'type' => 'aspirasi',
                'category' => 'Fasilitas',
                'subject' => 'Kipas angin di laboratorium rusak',
                'description' => 'Kipas angin di laboratorium komputer tidak berfungsi optimal dan membuat suasana kerja terasa panas pada saat praktik.',
                'status' => 'Diterima',
                'is_anonymous' => false,
                'user_email' => 'siswa2@sekolah.test',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(6),
            ],
            [
                'ticket_number' => 'ASP-260913-007',
                'type' => 'pengaduan',
                'category' => 'Lainnya',
                'subject' => 'Masalah akses internet hotspot',
                'description' => 'Sinyal hotspot sekolah sering putus pada jam tertentu, sehingga menghambat kegiatan pembelajaran digital.',
                'status' => 'Selesai',
                'is_anonymous' => true,
                'user_email' => 'siswa3@sekolah.test',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subHours(10),
            ],
        ];

        foreach ($sampleReports as $sampleReport) {
            $reportData = $sampleReport;
            $user = $userByEmail[$reportData['user_email']] ?? null;

            unset($reportData['user_email']);

            if ($user) {
                $reportData['user_id'] = $user->id;
            }

            Report::query()->firstOrCreate(
                ['ticket_number' => $reportData['ticket_number']],
                $reportData
            );
        }
    }
}
