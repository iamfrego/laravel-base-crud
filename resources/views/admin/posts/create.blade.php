@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Create a new Post</h1>

    @include('partials.errors')

    <form action="{{route('admin.posts.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Type your title here" aria-describedby="titleHelper" value="{{ old('title') }}">
            <small id="titleHelper" class="text-muted">Type a title for your post. max: 250</small>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="3">{{ old('body') }}</textarea>
            @error('body')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>

    </form>
</div>

@endsection
