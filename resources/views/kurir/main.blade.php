<!DOCTYPE html>
<html lang="en">
  <head>
    @include('kurir/partials._head')
    <title>@yield('title') | Bossgreen Kurir</title>
  </head>
  <body class="app sidebar-mini">
    @include('kurir/partials._nav')
    @include('kurir/partials._sidebar')
  	@yield('content')
    @include('kurir/partials._javascripts')
    @yield('js')
  </body>
  <style type="text/css">
    .app-header__logo {
      font-family: sans-serif;
      font-size: 22px;
    }
  </style>
 </html>