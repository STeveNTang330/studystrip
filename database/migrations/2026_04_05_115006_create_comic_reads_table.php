<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comic_reads', function (Blueprint $table) {
            $table->id();
            // Mencatat ID Siswa
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Mencatat ID Komik
            $table->foreignId('comic_id')->constrained('comics')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comic_reads');
    }
};