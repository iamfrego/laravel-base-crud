@extends('layouts.admin')


@section('content')
<div class="hero">
    <img src="{{$movie->thumb}}" alt="{{$movie->title}} cover image">
</div>
<h1>{{$movie->title}}</h1>
<h4>{{$movie->year}}</h4>

<div class="container">
    <p>
        {{$movie->description}}
    </p>
</div>

<div class="action">
    Edit - Delete
</div>



@endsection
