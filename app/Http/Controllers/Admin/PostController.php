<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(6);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate your DATA!!
        $validated_data = $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'nullable'
        ]);

        Post::create($validated_data);
        //ddd($validated_data);
        /*
        con i dati validati
        $post = new Post();
        $post->title = $validated_data['title'];
        $post->body = $validated_data['body'];
        $post->save();

        */
        //ddd($request->all());
        //ddd($request->title);
        // Senza validazione
        /* $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save(); */




        // POST / REDIRECT / GET
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validate your DATA!!
        $validated_data = $request->validate([
            'title' => [
                'required',
                Rule::unique('posts')->ignore($post->id),
            ],
            'body' => ['nullable']
        ]);
        //ddd($post, $request->all());
        $post->update($validated_data);

        return redirect()->route('admin.posts.index')->with('message', '🥳 Complimenti hai modificato il post');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', '😱 Hai rimosso un post per sempre!! Sei fregato!');;

    }

}
