<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin/partials._head')
    <title>@yield('title') | Bossgreen Admin</title>
  </head>
  <body class="app sidebar-mini">
    @include('admin/partials._nav')
    @include('admin/partials._sidebar')
  	@yield('content')
    @include('admin/partials._javascripts')
    @yield('js')
  </body>
  <style type="text/css">
    .app-header__logo {
      font-family: sans-serif;
      font-size: 22px;
    }
  </style>
 </html>