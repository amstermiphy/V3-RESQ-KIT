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
    Schema::create('progress_materis', function (Blueprint $table) {

      $table->id();

      $table->foreignId('siswa_id')
        ->constrained('siswas')
        ->cascadeOnDelete();

      $table->foreignId('materi_id')
        ->constrained('materis')
        ->cascadeOnDelete();

      $table->enum('status', [
        'belum',
        'proses',
        'selesai'
      ])->default('belum');

      $table->unsignedTinyInteger('nilai_quiz')
        ->default(0);

      $table->timestamp('completed_at')
        ->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('progress_materis');
  }
};
