<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('typing_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('time_seconds');
            $table->integer('accuracy');
            $table->integer('wpm');
            $table->integer('incorrect_words')->default(0);
            $table->integer('incorrect_letters')->default(0);
            $table->string('difficulty')->default('easy');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('typing_results');
    }
};
