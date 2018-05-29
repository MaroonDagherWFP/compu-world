<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .activity-td:hover {cursor: pointer;}
    </style>
</head>
<body class="h-100">
    <div id="app" class="h-100">
        <nav class="navbar navbar-expand-md navbar-light navbar-compuworld">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{ \URL::to('shared') }}">Shared Files</a></li>
                        <li><a class="nav-link" href="{{ \URL::to('unshared') }}">Un-shared Files</a></li>
                        <li><a class="nav-link" href="{{ \URL::to('owned') }}">Owned Files</a></li>
                        <li><a class="nav-link" href="{{ \URL::to('unowned') }}">Not Owned Files</a></li>
                        <li><a class="nav-link" href="{{ \URL::to('duplicates') }}">Find Duplicate Files</a></li>
                        {{-- <li><a class="nav-link" href="{{ \URL::to('search') }}">Find By Date Range</a></li> --}}
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 full-height">
            <div class="container">
                <form class="row" method="get" action="search">
                    {{ csrf_field() }}
                    <div class="col-6" class="form-group">
                        <label for="start-date">Start Date</label>
                        <input type="text" class="form-control" id="start-date" name="start_date" placeholder="31-01-2018">
                    </div>
                    <div class="col-6" class="form-group">
                        <label for="end-date">End Date</label>
                        <input type="text" class="form-control" id="end-date" name="end_date" placeholder="31-12-2018">
                    </div>
                    <div class="col-12" class="form-group" class="align-self-center">
                        <div class="d-flex justify-content-center align-items-center flex-wrap" style="height: 100px;">
                            <button type="submit" class="btn btn-primary btn-lg">Find</button>
                        </div>
                    </div>
                </form>
            </div>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> 
</body>
</html>
