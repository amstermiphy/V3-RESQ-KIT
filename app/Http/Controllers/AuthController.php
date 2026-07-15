<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class AuthController extends Controller
{
  /**
   * Tampilkan halaman login
   */
  public function showLogin()
  {
    if (Auth::check()) {
      return redirect('/guru/dashboard');
    }

    return view('auth.login');
  }

  /**
   * Proses login guru
   */
  public function login(Request $request)
  {
    $request->validate([
      'email'    => 'required|email',
      'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return back()
        ->withErrors(['email' => 'Email atau kata sandi salah.'])
        ->onlyInput('email');
    }

    if ($user->role !== 'guru' && $user->role !== 'admin') {
      return back()
        ->withErrors(['email' => 'Akun ini tidak memiliki akses guru.'])
        ->onlyInput('email');
    }

    Auth::login($user, $request->boolean('remember'));

    $request->session()->regenerate();

    return redirect()->intended('/guru/dashboard');
  }

  /**
   * Tampilkan halaman registrasi guru
   */
  public function showRegister()
  {
    if (Auth::check()) {
      return redirect('/guru/dashboard');
    }

    return view('auth.register');
  }

  /**
   * Proses registrasi guru
   */
  public function register(Request $request)
  {
    $validated = $request->validate([
      'fullname' => 'required|string|max:255',
      'username' => 'required|string|max:255|unique:users,username',
      'email'    => 'required|email|max:255|unique:users,email',
      'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
      'fullname' => $validated['fullname'],
      'username' => $validated['username'],
      'email'    => $validated['email'],
      'password' => Hash::make($validated['password']),
      'role'     => 'guru',
    ]);

    Auth::login($user);

    $request->session()->regenerate();

    return redirect('/guru/dashboard');
  }

  /**
   * Logout guru
   */
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }
}
