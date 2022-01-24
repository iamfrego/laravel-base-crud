@extends('layouts.admin')


@section('content')

    <div class="card mt-5">
        <div class="card-body">
            <h4 class="card-title">Welcome to the dashboard</h4>
            <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati alias saepe culpa
                possimus a asperiores illum facilis hic, fuga accusamus.</p>
        </div>
    </div>

    <div class="actions mt-5">
        <div class="row g-3">
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">Posts</h3>
                        <p class="card-text">Add a new Post</p>
                        <a class="btn btn-primary w-100" href="{{ route('admin.posts.create') }}" role="button">Add new
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">Games</h3>
                        <p class="card-text">Add new games</p>
                        <a class="btn btn-primary w-100" href="{{ route('admin.posts.create') }}" role="button">Add new
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">Movie</h3>
                        <p class="card-text">Add new Movie</p>
                        <a class="btn btn-primary w-100" href="{{ route('movies.create') }}" role="button">Add new
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
