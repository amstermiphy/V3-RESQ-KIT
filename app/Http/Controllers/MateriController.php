<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\ProgressMateri;
use Illuminate\Http\Request;

class MateriController extends Controller
{
  /**
   * Daftar materi
   */
  public function index()
  {
    if (!session()->has('siswa_id')) {
      return redirect('/identitas');
    }

    $materi = Materi::where('status', true)
      ->orderBy('id')
      ->get();

    return view('siswa.materi', compact('materi'));
  }

  /**
   * Detail materi berdasarkan slug
   */
  public function show($slug)
  {
    if (!session()->has('siswa_id')) {
      return redirect('/identitas');
    }

    $materi = Materi::where('slug', $slug)
      ->where('status', true)
      ->firstOrFail();

    $progress = ProgressMateri::where('siswa_id', session('siswa_id'))
      ->where('materi_id', $materi->id)
      ->first();

    return view("siswa.materi.$slug", compact('materi', 'progress'));
  }
}
