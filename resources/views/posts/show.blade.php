@extends('layouts.app')


@section('content')

<div class="container">
    <img src="{{$post->poster}}" alt="">
    <h3>{{$post->title}}</h3>

    <div class="content">
        <p>
            {{$post->body}}
        </p>
    </div>
</div>





@endsection
