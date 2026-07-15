<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressMateri extends Model
{
  use HasFactory;

  protected $fillable = [
    'siswa_id',
    'materi_id',
    'status',
    'nilai_quiz',
    'completed_at',
  ];

  protected $casts = [
    'completed_at' => 'datetime',
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
