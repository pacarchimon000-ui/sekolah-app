<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone_number')) {
                $table->string('phone_number')->nullable()->unique()->after('email');
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('student')->after('phone_number');
            }
        });

        $existingUsers = DB::table('users')->get();

        foreach ($existingUsers as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'role' => $user->role ?? 'student',
                    'phone_number' => $user->phone_number ?? null,
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'phone_number')) {
                $table->dropColumn('phone_number');
            }

            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
