@extends('index')

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-2">
            <h2>Meciul #{{$match->id}} din etapa #{{$match->phase->number}} a ligii "{{$match->phase->league->name}}"</h2>
            <div class="row text-center">
                <div class="col-md-5">
                    {{$match->homePlayer->getFullName()}}
                </div>
                <div class="col-md-2">
                    {{$match->home_score}} - {{$match->away_score}}
                </div>
                <div class="col-md-5">
                    {{$match->awayPlayer->getFullName()}}
                </div>
            </div>
            <div>
                @php
                    $formClass = 'hidden';
                @endphp
                @foreach($errors->all() as $message)
                    @php
                        $formClass = '';
                    @endphp
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                @endforeach
                @if(session()->has('error'))
                    @php
                        $formClass = '';
                    @endphp
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('error')}}
                    </div>
                @endif
                @if(session()->has('success'))
                    @php
                        $formClass = '';
                    @endphp
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success')}}
                    </div>
                @endif
            </div>
            <div class="row {{!$formClass ? 'hidden' : ''}}">
                <div class="col-md-12 text-center">
                    <button class="btn btn-primary show-form">Modifica scor</button>
                </div>
            </div>

            {!! Form::open(['route' => ['matches.update', $match->id], 'method' => 'PUT', 'class' => $formClass]) !!}
                <div class="form-group">
                    <label for="home_score">Scor {{$match->homePlayer->getFullName()}}</label>
                    <input type="text" class="form-control" id="home_score" name="home_score" value="{{$match->home_score}}" />
                </div>
                <div class="form-group">
                    <label for="away_score">Scor {{$match->awayPlayer->getFullName()}}</label>
                    <input type="text" class="form-control" id="away_score" name="away_score" value="{{$match->away_score}}" />
                </div>
                <div class="form-group">
                    <label for="password">Parola</label>
                    <input type="password" class="form-control" id="password" name="password"/>
                </div>
                <button type="submit" class="btn btn-primary">Salveaza</button>
            {!! Form::close() !!}
        </div>
    </div>
@stop
