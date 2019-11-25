<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Enter OTP</div>

                        <div class="card-body">
                            @if($errors->count() > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif

                            @if(session()->has('message'))
                                <div class="alert alert-info">
                                    {{ session()->get('message') }}
                                </div>
                            @endif

                            <form action="{{ route('verify.post') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="otp">Your OTP</label>
                                    <input type="text" name="OTP" id="otp" class="form-control" required
                                           value="{{ $otp }}">
                                </div>
                                <input type="submit" value="Verify" class="btn btn-info float-right">
                            </form>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('verify.resend') }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-sm btn-dark mr-4" value="Resent OTP via">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="via" id="sms" value="sms">
                                    <label class="form-check-label" for="sms">SMS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="via" id="email" value="email"
                                           checked>
                                    <label class="form-check-label" for="email">Email</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>

