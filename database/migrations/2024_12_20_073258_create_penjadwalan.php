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
        Schema::create('penjadwalan', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('keperluan');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('lab_id');
            $table->foreign('lab_id')->references('id')->on('laboratoria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjadwalan');
    }
};
