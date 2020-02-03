<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <link rel="icon" href="{{ asset('img/logo_impocargo_mundo.png') }}" type="image/x-icon">

  <!-- Scripts -->
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
    type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
    rel="stylesheet" />

  <!-- Styles -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('css/all-themes.min.css') }}" rel="stylesheet">

</head>

<body class="theme-teal">
  @include('layouts.preloader')
  @include('layouts.navbar')
  <section>
    @include('layouts.sidebar')
    @include('layouts.sidebar_right')
  </section>
  <section class="content">
    <div class="container-fluid">
      @yield('content')
    </div>
  </section>

  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
  </script>
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>

</html>