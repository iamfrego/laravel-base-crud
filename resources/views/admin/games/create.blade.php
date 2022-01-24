@extends('layouts.admin')

@section('content')

@include('partials.errors')

<form action="{{ route('admin.games.store') }}" method="post">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Lorem ipsum" aria-describedby="titleHelper" value="{{old('title')}}">
        <small id="titleHelper" class="text-muted">Type a title max 200 characters</small>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="cover" class="form-label">Cover image link</label>
        <input type="text" name="cover" id="cover" class="form-control @error('cover') is-invalid @enderror" placeholder="https://yourimage_here.jpg" aria-describedby="coverHelper" value="{{old('cover')}}">
        <small id=" coverHelper" class="text-muted">Add a link to the cover image</small>
        @error('cover')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" rows="5">
        {{old('desc')}}
        </textarea>
        @error('desc')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary btn-block">Save</button>


</form>

@endsection
