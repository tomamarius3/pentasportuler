@extends('index')

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h1>Etapele pentru {{$league->name}}</h1>
        </div>
    </div>
    @foreach($league->phases as $phase)
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h3>Etapa nr. {{$phase->number}} din data: {{$phase->date->format('d.m.Y')}}</h3>
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Acasa</th>
                            <th colspan="3"></th>
                            <th>Deplasare</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($phase->matches as $match)
                        <tr>
                            <td>
                                <a href="{{route('matches.edit', ['match' => $match])}}">
                                    {{$match->id}}
                                </a>
                            </td>
                            <td>{{$match->homePlayer->getFullName()}}</td>
                            <td>{{$match->home_score}}</td>
                            <td>-</td>
                            <td>{{$match->away_score}}</td>
                            <td>{{$match->awayPlayer->getFullName()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@stop
