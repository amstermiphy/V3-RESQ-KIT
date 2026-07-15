<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
  use HasFactory;

  protected $fillable = [
    'kelas_id',
    'nama',
    'jenis_kelamin',
  ];

  public function kelas()
  {
    return $this->belongsTo(Kelas::class);
  }

  public function progressMateris()
  {
    return $this->hasMany(ProgressMateri::class);
  }

  public function hasilSimulasis()
  {
    return $this->hasMany(HasilSimulasi::class);
  }
}
