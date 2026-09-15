<?php

namespace Tests\Feature;

use App\Mail\ReportStatusUpdatedMail;
use App\Mail\ReportSubmittedMail;
use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ReportMailTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_submission_sends_email_to_student(): void
    {
        Mail::fake();

        $student = User::factory()->create([
            'role' => 'student',
            'email' => 'student@example.com',
            'phone_number' => '081234567890',
        ]);

        $this->actingAs($student)->post('/laporan', [
            'type' => 'pengaduan',
            'category' => 'Kebersihan',
            'subject' => 'Tempat sampah penuh',
            'description' => 'Sampah menumpuk di depan kelas dan sulit dibersihkan.',
        ]);

        $this->assertDatabaseHas('reports', ['user_id' => $student->id]);

        Mail::assertSent(ReportSubmittedMail::class, function ($mail) use ($student) {
            return $mail->hasTo($student->email);
        });
    }

    public function test_status_update_sends_email_to_report_owner(): void
    {
        Mail::fake();

        $student = User::factory()->create([
            'role' => 'student',
            'email' => 'student@example.com',
            'phone_number' => '081234567890',
        ]);

        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'phone_number' => '081111111111',
        ]);

        $report = Report::create([
            'ticket_number' => 'ASP-260913-ABC12',
            'type' => 'pengaduan',
            'category' => 'Kebersihan',
            'subject' => 'Tempat sampah penuh',
            'description' => 'Sampah menumpuk di depan kelas dan sulit dibersihkan.',
            'status' => 'Diterima',
            'is_anonymous' => false,
            'user_id' => $student->id,
        ]);

        $this->actingAs($admin)->post('/reports/' . $report->id . '/status', [
            'status' => 'Selesai',
        ]);

        Mail::assertSent(ReportStatusUpdatedMail::class, function ($mail) use ($student) {
            return $mail->hasTo($student->email);
        });
    }
}
