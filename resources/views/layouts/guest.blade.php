<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{asset('assets/css/guest.css')}}">

</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Oxford Modern School & Collage</h1>
                <p class="login-subtitle">Sign in to your account</p>
            </div>

             {{ $slot }}


        </div>
    </div>

    <script src="{{asset("assets/js/guest.js")}}"></script>

</body>
</html>
