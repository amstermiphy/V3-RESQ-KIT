<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class LandingController extends Controller
{
  /**
   * Landing page
   */
  public function index()
  {
    return view('landing.index');
  }

  /**
   * Form identitas siswa
   */
  public function identitas()
  {
    $kelas = Kelas::orderBy('nama_kelas')->get();

    return view('landing.identitas', compact('kelas'));
  }
}
