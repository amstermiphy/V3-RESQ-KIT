<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsGuru
{
  public function handle(Request $request, Closure $next): Response
  {
    if (!Auth::check() || !in_array(Auth::user()->role, ['guru', 'admin'])) {
      return redirect('/login');
    }

    return $next($request);
  }
}
