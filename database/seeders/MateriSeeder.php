<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
  public function run(): void
  {
    Materi::create([
      'judul'     => 'Gempa Bumi',
      'slug'      => 'gempa',
      'deskripsi' => 'Belajar mengenal gempa bumi bersama Aksa dan Reka.',
      'icon'      => '🌍',
      'warna'     => '#F97316', // orange-500, sesuai tema halaman gempa
      'status'    => true,
    ]);

    Materi::create([
      'judul'     => 'Banjir',
      'slug'      => 'banjir',
      'deskripsi' => 'Belajar mengenal banjir bersama Aksa dan Reka.',
      'icon'      => '🌊',
      'warna'     => '#3B82F6', // blue-500, sesuai tema halaman banjir
      'status'    => true,
    ]);
  }
}
