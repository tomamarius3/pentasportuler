@extends('index')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-8 offset-lg-2 col-sm-12 text-center">
            <h1>Tabela de scor pentru {{$league->name}}</h1>
        </div>
        <div class="col-lg-8 offset-lg-2 col-sm-12">
            <table class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="text-left col-lg-4">Nume</th>
                    <th class="col-lg-2">Meciuri jucate</th>
                    <th class="col-lg-2">Meciuri castigate</th>
                    <th class="col-lg-2">Seturi castigate</th>
                    <th class="col-lg-2">Puncte</th>
                </tr>
                </thead>
                <tbody>
                @foreach($league->getScoreboardPlayers() as $key => $player)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td class="text-left">{{$player->firstName}} {{$player->lastName}}</td>
                        <td>{{$player->playedMatches}}</td>
                        <td>{{$player->wonMatches}}</td>
                        <td>{{$player->wonSets ?? 0}}</td>
                        <td>{{$player->wonMatches * 3}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
