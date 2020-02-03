@extends('index')

@section('content')
    <div class="row text-center">
        <div class="col-lg-8 offset-2">
            <h1>Campionatul de tenis de masa Pentalog</h1>
        </div>
        <div class="divider"></div>
        <div class="col-lg-8 offset-2">
            @foreach($leagues as $key => $league)
                {{$key ? " | " : ""}}
                <a href="{{route('league.scoreboard', ['league' => $league])}}">{{$league->name}}</a>
            @endforeach
        </div>
    </div>
@stop

