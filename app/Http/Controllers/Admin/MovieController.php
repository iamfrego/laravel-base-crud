<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::orderBy('id', 'desc')->paginate(8);
        //ddd($movies);
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ddd($request->all());

        // Validazione
        $validated_data = $request->validate([
            'title' => ['required', 'unique:movies', 'max:200'],
            "cover" => ['nullable'],
            "thumb" => ['nullable'],
            "description" => ['nullable']
        ]);
        // Salvataggio
        Movie::create($validated_data);
        // Redirect
        return redirect()->route('movies.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        ///ddd($request->all());

        // validazione
        $validated_data = $request->validate([
            'title' => [
                'required',
                Rule::unique('movies')->ignore($movie->id),
            ],
            'year' => ['nullable'],
            'cover' => ['nullable'],
            'thumb' => ['nullable'],
            'description' => ['nullable']
        ]);
        // aggiornamento dati
        $movie->update($validated_data);
        // redirect
        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {

        $movie->delete();
        return redirect()->route('movies.index');

    }
}
