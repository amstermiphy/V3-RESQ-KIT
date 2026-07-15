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

  <body class="bg-slate-50 text-slate-800 antialiased">

    @yield('content')

    @livewireScripts
  </body>

</html>
