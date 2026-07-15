<!DOCTYPE html>
<html lang="id">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'RESQ-KIT')</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
  </head>

  <body class="bg-slate-50">

    <div class="flex min-h-screen">

      @include('partials.sidebar')

      <div class="flex-1">

        @include('partials.navbar')

        <main class="p-8">

          @yield('content')

        </main>

      </div>

    </div>

    @livewireScripts

    @stack('scripts')

  </body>

</html>
