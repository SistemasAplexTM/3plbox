<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Registro</title>

  <!-- Favicon-->
  <link rel="icon" href="{{ asset('images/cropped-favicon.png') }}" type="image/x-icon">

  <!-- login Css -->
  {{-- <link href="{{ asset('css/main.css') }}" rel="stylesheet"> --}}

</head>

<body class="theme-teal" style="background-color: white;">
  <div id="register">
    <register></register>
  </div>
  <script src="{{ asset('js/register.js') }}"></script>
</body>

</html>