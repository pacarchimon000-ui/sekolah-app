<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_can_filter_reports_by_keyword(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'phone_number' => '081111111111',
        ]);

        $matchingReport = Report::create([
            'ticket_number' => 'ASP-260913-ABC12',
            'type' => 'pengaduan',
            'category' => 'Kebersihan',
            'subject' => 'Lampu kelas rusak',
            'description' => 'Lampu di ruang kelas tidak menyala.',
            'status' => 'Diterima',
            'is_anonymous' => false,
            'user_id' => $admin->id,
        ]);

        Report::create([
            'ticket_number' => 'ASP-260913-ABC13',
            'type' => 'pengaduan',
            'category' => 'Kebersihan',
            'subject' => 'Tempat sampah penuh',
            'description' => 'Sampah menumpuk di depan kelas.',
            'status' => 'Diterima',
            'is_anonymous' => false,
            'user_id' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->get('/dashboard?search=lampu');

        $response->assertOk();
        $response->assertSee($matchingReport->subject);
        $response->assertDontSee('Tempat sampah penuh');
    }

    public function test_student_can_open_report_detail_page(): void
    {
        $student = User::factory()->create([
            'role' => 'student',
            'email' => 'student-detail@example.com',
            'phone_number' => '081234567891',
        ]);

        $report = Report::create([
            'ticket_number' => 'ASP-260913-ABC16',
            'type' => 'aspirasi',
            'category' => 'Fasilitas',
            'subject' => 'Kursi rusak',
            'description' => 'Kursi di perpustakaan rusak.',
            'status' => 'Diterima',
            'is_anonymous' => false,
            'user_id' => $student->id,
        ]);

        $response = $this->actingAs($student)->get('/reports/' . $report->id);

        $response->assertOk();
        $response->assertSee('Detail laporan');
    }

    public function test_admin_can_export_filtered_reports_to_csv(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin-export@example.com',
            'phone_number' => '081111111112',
        ]);

        Report::create([
            'ticket_number' => 'ASP-260913-ABC15',
            'type' => 'pengaduan',
            'category' => 'Kebersihan',
            'subject' => 'Lampu kelas rusak',
            'description' => 'Lampu di ruang kelas tidak menyala.',
            'status' => 'Diterima',
            'is_anonymous' => false,
            'user_id' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->get('/dashboard/export?search=lampu');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    }

    public function test_student_can_open_edit_report_page(): void
    {
        $student = User::factory()->create([
            'role' => 'student',
            'email' => 'student@example.com',
            'phone_number' => '081234567890',
        ]);

        $report = Report::create([
            'ticket_number' => 'ASP-260913-ABC14',
            'type' => 'aspirasi',
            'category' => 'Fasilitas',
            'subject' => 'Kursi rusak',
            'description' => 'Kursi di perpustakaan rusak.',
            'status' => 'Diterima',
            'is_anonymous' => false,
            'user_id' => $student->id,
        ]);

        $response = $this->actingAs($student)->get('/reports/' . $report->id . '/edit');

        $response->assertOk();
        $response->assertSee('Edit laporan');
    }
}
