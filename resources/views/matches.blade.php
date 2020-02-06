@extends('index')

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2 col-sm-12 text-center">
            <h1>Etapele pentru {{$league->name}}</h1>
        </div>
    </div>
    @foreach($league->phases as $phase)
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <h3>Etapa nr. {{$phase->number}}</h3>
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>Acasa</th>
                            <th colspan="3"></th>
                            <th>Deplasare</th>
                            <th>ID</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($phase->matches->shuffle($phase->number) as $match)
                        <tr>
                            <td>{{$match->homePlayer->getFullName()}}</td>
                            <td>{{$match->home_score}}</td>
                            <td>-</td>
                            <td>{{$match->away_score}}</td>
                            <td>{{$match->awayPlayer->getFullName()}}</td>
                            <td>
                                <button class="btn-sm btn-primary" onclick="window.location.href='{{route('matches.edit', ['match' => $match])}}'">
                                    View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@stop
