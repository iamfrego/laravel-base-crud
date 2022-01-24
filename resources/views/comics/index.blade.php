@extends('layouts.app')

@section('content')
<div class="comics_page">

    <div class="jumbotron"></div>


    <div class="comics bg_dark">
        <div class="container">


            @foreach($comics as $comic)


            @include('partials.comic')

            @endforeach
        </div>
    </div>

</div>
@endsection
