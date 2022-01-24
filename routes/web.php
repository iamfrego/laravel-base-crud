<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');


/* COMICS ROUTES */
Route::get('/comics', 'ComicController@index')->name('comics');
Route::get('comics/{comic}', 'ComicController@show')->name('comic');


/* Dashboard */
Route::view('admin', 'admin.dashboard')->name('admin');

/* Posts */

// Mostra lista di risorse
Route::get('admin/posts', 'Admin\PostController@index')->name('admin.posts.index');
// Mostra form per creare nuova risorsa
Route::get('admin/posts/create', 'Admin\PostController@create')->name('admin.posts.create');
// Salvo nel database la risorsa
Route::post('admin/posts', 'Admin\PostController@store')->name('admin.posts.store');
// Mostra la singlola risorsa
Route::get('admin/posts/{post}', 'Admin\PostController@show')->name('admin.posts.show');
// Mostra un form per modificare la risorsa
Route::get('admin/posts/{post}/edit', 'Admin\PostController@edit')->name('admin.posts.edit');
// Aggiorniamo la risorda nel database
Route::put('admin/posts/{post}', 'Admin\PostController@update')->name('admin.posts.update');
// Cancello la risorsa
Route::delete('admin/posts/{post}', 'Admin\PostController@destroy')->name('admin.posts.destroy');

Route::resource('admin/movies', 'Admin\MovieController');


Route::get('/tv', function () {
    /* return view('movies'); */
    return 'Tv Page';
})->name('tv');


Route::get('/games', function () {
    /* return view('movies'); */
    return 'Games Page';
})->name('games');
Route::get('games/{game}', 'GameController@show');

/* Games Routes - Admin */
Route::get('admin/games', 'Admin\GameController@index')->name('admin.games.index');
Route::get('admin/games/create', 'Admin\GameController@create')->name('admin.games.create');
Route::post(
    'admin/games',
    'Admin\GameController@store'
)->name('admin.games.store');
Route::get('admin/games/{game}', 'Admin\GameController@show')->name('admin.games.show');
Route::get('admin/games/{game}/edit', 'Admin\GameController@edit')->name('admin.games.edit');
Route::put('admin/games/{game}', 'Admin\GameController@update')->name('admin.games.update');
Route::delete('admin/games/{game}', 'Admin\GameController@destroy')->name('admin.games.destroy');