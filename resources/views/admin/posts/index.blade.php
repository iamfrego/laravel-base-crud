@extends('layouts.admin')


@section('content')

<div class="heading d-flex justify-content-between align-items-center pt-5">
    <h1>DC - Posts</h1>
    <a class="btn btn-primary" href="{{route('admin.posts.create')}}" role="button">Create</a>
</div>


@include('partials.session_message')

<div>

    <table class="table table-striped table-light">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Create At</th>
                <th>Updated At</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td scope="row">{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td>
                    <a class="btn btn-primary" title="View post" href="{{route('admin.posts.show', $post->id)}}"><i class="fas fa-eye"></i> </a>

                    <a class="btn btn-secondary" href="{{route('admin.posts.edit', $post->id)}}"> <i class="fas fa-pencil-alt"></i> </a>


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$post->id}}">
                        <i class="fas fa-trash"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="delete{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Post {{$post->title}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        ⚡ Attenzione questa operazione non puo essere annullata!
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
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

    {{$posts->links()}}
</div>

@endsection
