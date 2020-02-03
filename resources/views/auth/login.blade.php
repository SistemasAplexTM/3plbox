<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Entrar - Rastreo</title>

    <!-- Favicon-->
    <link rel="icon" href="{{ asset('images/cropped-favicon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- login Css -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>

<body class="login-page theme-teal">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Rastreo</a>
            <small>Bienvenido!</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="msg">Ingresa tus datos</div>
                    <div class="input-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Correo" required
                                autofocus value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña"
                                required>
                        </div>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-block bg-teal waves-effect" type="submit"> Entrar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 p-t-5">
                            <a target="_blank" href="{{ route('rastreo') }}">
                                <i class="material-icons">location_on</i>
                                Rastreo
                            </a>
                        </div>
                        <div class="col-xs-6 p-t-5">
                            <a target="_blank" href="{{ route('registro') }}">
                                <i class="material-icons">person_add</i>
                                Registro
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberme">No cerrar sesión</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>