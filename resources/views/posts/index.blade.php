@extends('layouts.app')


@section('content')

<div class="jumbotron p-5 bg-light">
    <div class="container">
        <h1 class="display-3">Blog</h1>
        <p class="lead">welcome to DC comics blog</p>

    </div>
</div>
<!-- /.jumbotron -->

<section class="posts container">
    <div class="row">

        @forelse($posts as $post)

        <div class="col-4">
            <div class="card">
                <div class="card-img">
                    <img src="{{$post->poster}}" alt="">
                </div>
                <div class="card-body">
                    <h3>{{$post->title}}</h3>
                    <a href="{{route('single-post', $post->id)}}">Read more..</a>
                </div>
            </div>
        </div>

        @empty

        <p>Nothing to show</p>

        @endforelse

    </div>


    <div class="my-4 d-flex justify-content-center">
        {{$posts->links()}}
    </div>

</section>
<!-- /.posts -->

@endsection
