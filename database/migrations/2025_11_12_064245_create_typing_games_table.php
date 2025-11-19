<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('typing_games', function (Blueprint $table) {
            $table->id();
            $table->text('sentence');
            $table->integer('number_of_words'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('typing_games');
    }
};
