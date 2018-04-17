<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('head-links')
  </head>
  <body>
    <div class="site-wrapper" id="site-wrapper">

      <main class="site-content" role="main">

        @yield('content')

      </main>

    </div>

    @stack('footer-scripts')
  </body>
</html>