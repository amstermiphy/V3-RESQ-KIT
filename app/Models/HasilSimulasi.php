<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSimulasi extends Model
{
  use HasFactory;

  protected $fillable = [
    'siswa_id',
    'materi_id',
    'mode',
    'skor',
    'durasi',
    'jumlah_benar',
    'jumlah_salah',
    'status',
  ];

  public function siswa()
  {
    return $this->belongsTo(Siswa::class);
  }

  public function materi()
  {
    return $this->belongsTo(Materi::class);
  }
}
