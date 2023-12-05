<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answer_users', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id'); // id теста
            $table->integer('user_id'); // id пользователя
            $table->enum('status', ['passed', 'failed'])->default('failed');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_users');
    }
};
