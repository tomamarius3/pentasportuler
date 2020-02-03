<html>
    <head>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('css/style.css')}}" rel="stylesheet"/>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{route('home')}}">Pentalog Tenis de masa</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @foreach($leagues as $league)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$league->name}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('league.scoreboard', ['league' => $league->id])}}">Scoreboard</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('league.matches', ['league' => $league->id])}}">Matches</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </header>
        <div class="container-fluid">
            @yield('content')
        </div>
        <script src="{{asset('js/jquery.min.js')}}" type="application/javascript"></script>
        <script src="{{asset('js/bootstrap.min.js')}}" type="application/javascript"></script>
        <script src="{{asset('js/script.js')}}" type="application/javascript"></script>
    </body>
</html>
