@extends('layouts.app')


@section('content')



<div class="container">
    <h1>{{$post->title}}</h1>
    <div>
        <p class="lead">
            {{ $post->body }}
        </p>

    </div>
</div>




@endsection
