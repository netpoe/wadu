<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,700" rel="stylesheet">

    @stack('head-links')
  </head>
  <body>
    <div class="site-wrapper" id="site-wrapper">

      <header class="header">
        <div class="container">
          <div class="row">
            <div class="col header-left">
              @stack('header-left')
            </div>
            <div class="col header-right">
              @stack('header-right')
            </div>
          </div>
        </div>
      </header>

      <main class="site-content" role="main">

        @yield('content')

      </main>

    </div>

    @stack('footer-scripts')
  </body>
</html>
