<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('kelas')->insert([

      [
        'nama_kelas' => '4A',
        'tahun_ajaran' => '2026/2027',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'nama_kelas' => '4B',
        'tahun_ajaran' => '2026/2027',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'nama_kelas' => '5A',
        'tahun_ajaran' => '2026/2027',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'nama_kelas' => '5B',
        'tahun_ajaran' => '2026/2027',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'nama_kelas' => '6A',
        'tahun_ajaran' => '2026/2027',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      [
        'nama_kelas' => '6B',
        'tahun_ajaran' => '2026/2027',
        'created_at' => now(),
        'updated_at' => now(),
      ],

    ]);
  }
}
