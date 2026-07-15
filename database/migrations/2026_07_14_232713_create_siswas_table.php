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
    Schema::create('siswas', function (Blueprint $table) {
      $table->id();

      $table->foreignId('kelas_id')
        ->constrained('kelas')
        ->cascadeOnDelete();

      $table->string('nama');

      $table->enum('jenis_kelamin', ['L', 'P'])
        ->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('siswas');
  }
};
