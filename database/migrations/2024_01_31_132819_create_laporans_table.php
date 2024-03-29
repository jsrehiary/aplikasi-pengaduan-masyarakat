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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('id_laporan')->unique();
            $table->foreignId('category_id')->constrained('categories', 'id');
            $table->string('nama_laporan');
            $table->text('detail');
            $table->text('alamat');
            $table->string('foto');

            $table->char('status', 1)->nullable();
            $table->string('umpan_balik')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
