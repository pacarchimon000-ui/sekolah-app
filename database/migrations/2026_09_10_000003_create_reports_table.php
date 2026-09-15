<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->string('type');
            $table->string('category');
            $table->string('subject');
            $table->text('description');
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('Diterima');
            $table->string('attachment_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};