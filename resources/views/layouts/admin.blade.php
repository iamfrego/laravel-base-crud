<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DC Admin- @yield('page-title', 'comics website')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <script src="{{asset('js/app.js')}}" defer></script>
</head>

<body class="d-flex">
    <div class="sidenav d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
            </svg>
            <span class="fs-4"><img src="{{ asset('img/dc-logo.png') }}" alt=""></span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">

            <li>
                <a href="{{route('admin')}}" class="nav-link text-white">
                    <i class="fas fa-tachometer-alt fa-lg fa-fw"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{route('admin.posts.index')}}" class="nav-link text-white">
                    <i class="fas fa-thumbtack fa-lg fa-fw"></i>
                    Posts
                </a>
            </li>
            <li>
                <a href="{{route('admin.games.index')}}" class="nav-link text-white">
                    <i class="fas fa-gamepad fa-lg fa-fw"></i>
                    Games
                </a>
            </li>
            <li>
                <a href="{{route('movies.index')}}" class="nav-link text-white">
                    <i class="fas fa-ticket-alt fa-lg fa-fw"></i>
                    Movies
                </a>
            </li>

        </ul>
        <hr>

    </div>

    <div class="content container overflow-hidden">
        @yield('content')
    </div>


</body>

</html>
