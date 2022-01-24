@extends('layouts.admin')


@section('content')

<h1>Create a new Movie</h1>

@include('partials.errors')
<form action="{{route('movies.store')}}" method="post">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="lorem ipsum movie" aria-describedby="titleHelper" maxlength="200" value="{{old('title')}}" required>
        <small id="titleHelper" class="text-muted">Add a title for your movie max 200 caratteri</small>

        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="cover" class="form-label">Cover</label>
        <input type="text" name="cover" id="cover" class="form-control @error('cover') is-invalid @enderror" placeholder="https://" aria-describedby="coverHelper" maxlength="255" value="{{old('cover')}}">
        <small id="coverHelper" class="text-muted">Add a cover image for your movie max 255 caratteri</small>

        @error('cover')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" min="1900" max="2099" step="1" name="year" id="year" class="form-control" placeholder="2000" aria-describedby="yearHelper" value="{{old('year')}}">
        <small id="yearHelper" class="text-muted">Type the movie year</small>
    </div>
    <div class="mb-3">
        <label for="thumb" class="form-label">thumb</label>
        <input type="text" name="thumb" id="thumb" class="form-control @error('thumb') is-invalid @enderror" placeholder="https://" aria-describedby="thumbHelper" maxlength="255" value="{{old('thumb')}}">
        <small id="thumbHelper" class="text-muted">Add a thumnail image for your movie max 255 caratteri</small>

        @error('thumb')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="10">
        {{old('description')}}
        </textarea>

        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Send</button>

</form>

@endsection
