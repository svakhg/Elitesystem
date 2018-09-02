<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css')}}" rel="stylesheet">
    {{-- <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet"> --}}

    {{-- Scripts --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <script src="{{ asset('js/sweetalert.min.js') }}"></script> --}}
    <!-- Main Js -->
    @if(!auth()->guest())
        <script src="{{ asset('js/main.js') }}"></script>
    @endif    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'EliteSystem') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    
                    <ul class="nav navbar-nav">
                        &nbsp;
                        @if(!auth()->guest())
                            @if(auth()->user()->is_superuser() || auth()->user()->is_recepsion())
                                <form method="POST" class="navbar-form navbar-left" action="{{ route('searchMember') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Kerko Antare">
                                    </div>
                                </form>
                            @endif
                        @endif
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                        @else

                            @if(auth()->user()->is_superuser())
                                <li><a href="{{ route('users.index') }}">Users</a></li>
                                <li><a href="{{ route('services.index') }}">Shërbimet</a></li>
                                <li><a href="{{ route('cycles.index') }}">Ciklet</a></li>
                                <li><a href="{{ route('packages.index') }}">Paketat</a></li>
                                <li><a href="{{ route('members.index') }}">Antarët</a></li>
                                <li><a href="{{ route('bar.index') }}">Bar</a></li>
                                <li><a href="{{ route('subscriptions.index') }}">Abonimet</a></li>
                                <li><a href="{{ route('installments.index') }}">Këstet</a></li>
                            @endif

                            @if(auth()->user()->is_recepsion())
                                <li><a href="{{ route('members.index') }}">Antarët</a></li>
                                <li><a href="{{ route('subscriptions.index') }}">Abonimet</a></li>
                                <li><a href="{{ route('installments.index') }}">Këstet</a></li>
                            @endif

                            @if(auth()->user()->is_bar())
                                {{-- <li><a href="{{ route('bar.index') }}">Bar</a></li> --}}
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ ucfirst(Auth::user()->first_name) }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Notifications -->
    @include('notifications.errors')
    @include('notifications.validation_errors')
    @include('notifications.success')

</body>
</html>
