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
        Schema::create('periode_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_periode')->constrained('periodes')->onDelete('cascade');
            $table->foreignId('id_obat')->constrained('obats')->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_obats');
    }
};
