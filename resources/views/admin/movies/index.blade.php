@extends('layouts.admin')


@section('content')

<h1>Movies</h1>

<table class="table table-striped table-light">
    <thead>
        <tr>
            <th>ID</th>
            <th>Thumb</th>
            <th>Title</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movies as $movie)
        <tr>
            <td scope="row">{{$movie->id}}</td>
            <td><img width="100" src="{{$movie->thumb}}" alt="{{$movie->title}} thumb image"></td>
            <td>{{$movie->title}}</td>
            <td>{{$movie->year}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('movies.show', $movie->id)}}">
                    <i class="fas fa-eye fa-lg fa-fw"></i>
                </a>
                <a class="btn btn-secondary" href="{{route('movies.edit', $movie->id)}}">
                    <i class="fas fa-pencil-alt fa-lg fa-fw"></i>
                </a>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_movie_{{$movie->id}}">
                    <i class="fas fa-trash-alt fa-lg fa-fw"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="delete_movie_{{$movie->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_movie_{{$movie->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"> Deleting {{$movie->title}} </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Body
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <form action="{{route('movies.destroy', $movie->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>



            </td>
        </tr>
        @endforeach

    </tbody>
</table>

{{$movies->links()}}




@endsection
