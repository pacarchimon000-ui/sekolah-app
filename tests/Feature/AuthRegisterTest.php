<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_registration_page_is_available(): void
    {
        $response = $this->get('/register/siswa');

        $response->assertStatus(200);
    }

    public function test_admin_registration_page_is_available(): void
    {
        $response = $this->get('/register/admin');

        $response->assertStatus(200);
    }

    public function test_registration_pages_do_not_require_email(): void
    {
        $studentResponse = $this->get('/register/siswa');
        $adminResponse = $this->get('/register/admin');

        $studentResponse->assertDontSee('name="email"');
        $adminResponse->assertDontSee('name="email"');
    }

    public function test_profile_page_is_available_and_can_update_profile_data(): void
    {
        $user = User::factory()->create([
            'role' => 'student',
            'phone_number' => '081234567890',
        ]);

        $profileResponse = $this->actingAs($user)->get('/profile');

        $profileResponse->assertOk();
        $profileResponse->assertSee('Profil');

        $updateResponse = $this->actingAs($user)->put('/profile', [
            'name' => 'Siswa Baru',
            'phone_number' => '081234567891',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $updateResponse->assertRedirect(route('student.dashboard'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Siswa Baru',
            'phone_number' => '081234567891',
        ]);
    }

    public function test_report_type_label_returns_human_readable_name(): void
    {
        $report = new Report([
            'type' => 'lost_found',
        ]);

        $this->assertSame('Barang hilang & temuan', $report->type_label);
    }

    public function test_admin_can_open_student_management_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'phone_number' => '081300000010',
        ]);

        $response = $this->actingAs($admin)->get('/admin/siswa');

        $response->assertOk();
        $response->assertSee('Kelola siswa');
    }

    public function test_admin_can_update_student_data_from_management_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'phone_number' => '081300000011',
        ]);

        $student = User::factory()->create([
            'role' => 'student',
            'phone_number' => '081300000012',
        ]);

        $response = $this->actingAs($admin)->put('/admin/siswa/' . $student->id, [
            'name' => 'Siswa Diperbarui',
            'phone_number' => '081300000013',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('admin.students'));

        $this->assertDatabaseHas('users', [
            'id' => $student->id,
            'name' => 'Siswa Diperbarui',
            'phone_number' => '081300000013',
        ]);
    }

    public function test_admin_can_create_student_from_management_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'phone_number' => '081300000014',
        ]);

        $response = $this->actingAs($admin)->post('/admin/siswa', [
            'name' => 'Siswa Baru',
            'phone_number' => '081300000015',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('admin.students'));

        $this->assertDatabaseHas('users', [
            'name' => 'Siswa Baru',
            'phone_number' => '081300000015',
            'role' => 'student',
        ]);
    }

    public function test_admin_can_delete_student_from_management_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'phone_number' => '081300000016',
        ]);

        $student = User::factory()->create([
            'role' => 'student',
            'phone_number' => '081300000017',
        ]);

        $response = $this->actingAs($admin)->delete('/admin/siswa/' . $student->id);

        $response->assertRedirect(route('admin.students'));
        $this->assertDatabaseMissing('users', [
            'id' => $student->id,
        ]);
    }

    public function test_admin_can_search_student_from_management_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'phone_number' => '081300000018',
        ]);

        User::factory()->create([
            'role' => 'student',
            'name' => 'Aisyah Nabila',
            'phone_number' => '081300000019',
        ]);

        User::factory()->create([
            'role' => 'student',
            'name' => 'Bagas Pratama',
            'phone_number' => '081300000020',
        ]);

        $response = $this->actingAs($admin)->get('/admin/siswa?search=aisyah');

        $response->assertOk();
        $response->assertSee('Aisyah Nabila');
        $response->assertDontSee('Bagas Pratama');
    }

    public function test_admin_can_sort_students_by_name_from_management_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'phone_number' => '081300000021',
        ]);

        User::factory()->create([
            'role' => 'student',
            'name' => 'Zaki Rahman',
            'phone_number' => '081300000022',
        ]);

        User::factory()->create([
            'role' => 'student',
            'name' => 'Aisyah Nabila',
            'phone_number' => '081300000023',
        ]);

        $response = $this->actingAs($admin)->get('/admin/siswa?sort=name&direction=asc');

        $response->assertOk();
        $response->assertSeeInOrder(['Aisyah Nabila', 'Zaki Rahman']);
    }

    public function test_admin_can_view_student_detail_page_with_reports(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'phone_number' => '081300000024',
        ]);

        $student = User::factory()->create([
            'role' => 'student',
            'name' => 'Siswa Detail',
            'phone_number' => '081300000025',
        ]);

        $report = \App\Models\Report::create([
            'ticket_number' => 'ASP-260913-099',
            'type' => 'aspirasi',
            'category' => 'Fasilitas',
            'subject' => 'Laporan siswa detail',
            'description' => 'Deskripsi laporan siswa detail agar data laporan dapat tampil di halaman detail siswa.',
            'status' => 'Diterima',
            'is_anonymous' => false,
            'user_id' => $student->id,
        ]);

        $response = $this->actingAs($admin)->get('/admin/siswa/' . $student->id);

        $response->assertOk();
        $response->assertSee('Siswa Detail');
        $response->assertSee('Laporan siswa detail');
        $response->assertSee($report->ticket_number);
    }

    public function test_student_can_register_then_login_with_phone_number(): void
    {
        $registerResponse = $this->post('/register/siswa', [
            'name' => 'Siswa Demo',
            'phone_number' => '081300000001',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $registerResponse->assertRedirect(route('student.login'));

        $loginResponse = $this->post('/login/siswa', [
            'phone_number' => '081300000001',
            'password' => 'password123',
        ]);

        $loginResponse->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticated();
    }
}
