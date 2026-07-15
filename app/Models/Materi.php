<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
  use HasFactory;

  protected $fillable = [
    'judul',
    'slug',
    'deskripsi',
    'icon',
    'warna',
    'status',
  ];

  public function progressMateris()
  {
    return $this->hasMany(ProgressMateri::class);
  }

  public function hasilSimulasis()
  {
    return $this->hasMany(HasilSimulasi::class);
  }
}
