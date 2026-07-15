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
    Schema::create('hasil_simulasis', function (Blueprint $table) {

      $table->id();

      $table->foreignId('siswa_id')
        ->constrained('siswas')
        ->cascadeOnDelete();

      $table->foreignId('materi_id')
        ->constrained('materis')
        ->cascadeOnDelete();

      $table->enum('mode', [
        'digital',
        'arduino'
      ]);

      $table->unsignedTinyInteger('skor')->default(0);
      $table->unsignedInteger('durasi')->default(0);
      $table->unsignedTinyInteger('jumlah_benar')->default(0);
      $table->unsignedTinyInteger('jumlah_salah')->default(0);
      $table->enum('status', [
        'belum',
        'proses',
        'selesai',
        'gagal'
      ])->default('belum');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('hasil_simulasis');
  }
};
