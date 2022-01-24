@extends('layouts.app')


@section('content')

<div class="container">
    <img src="{{$game->cover}}" alt="">
    <h3>{{$game->title}}</h3>

    <div class="content">
        <p>
            {{$game->desc}}
        </p>
    </div>
</div>





@endsection
