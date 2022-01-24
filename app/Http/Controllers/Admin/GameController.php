<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::orderBy('id', 'desc')->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //ddd($request->all());

        // Validiamo i dati
        $val_data = $request->validate([
            'title' => ['required', 'max:200'],
            'cover' => ['nullable', 'max:255'],
            'desc' => ['nullable'],

        ]);
        //ddd($val_data);

        // Salviamo il record nel database
        Game::create($val_data);

        // rendirizza l'utente ad una view di tipo get
        return redirect()->route('admin.games.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //ddd($request->all());

        // Validazione dati
        $valData = $request->validate(
            [
                "title" => ['required'],
                "cover" => ['required'],
                "desc" => ['nullable']
            ]
        );

        //ddd($valData);
        // update data
        $game->update($valData);
        // redirect
        return redirect()->route('admin.games.index')->with('message', "⚡ Hai modificato il Game $game->title");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        // delete the resource
        $game->delete();

        // redirect to a get route
        return redirect()->back()->with('message', "Game Deleted!");



    }
}
