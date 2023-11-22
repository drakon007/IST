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
        Schema::create('answer_user', function (Blueprint $table) {
            $table->id();
            $table->integer('result_id')->default(null); // id результата
            $table->integer('test_id'); // id теста
            $table->integer('user_id'); // id пользователя
            $table->integer('attempts'); // попытки
            $table->integer('status_id'); // статус
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_user');
    }
};