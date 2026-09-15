<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->index('ticket_number');
            $table->index('status');
            $table->index('created_at');
            $table->index('user_id');
            $table->index('type');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('phone_number');
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropIndex(['ticket_number']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['type']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['phone_number']);
            $table->dropIndex(['role']);
        });
    }
};
