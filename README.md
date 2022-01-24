# CRUD STEPS

## Creazione Modello, Migrazione, Seeder, Controller (resource)

`php artisan make:model Models/Game -a`


## Compilare la migrazione

Pensa alla struttura della tabella!!

```php
// Metodo UP
   public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('cover')->default('https://picsum.photos/300/200');
            $table->longText('desc')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }

```

Migra il db

`php artisan migrate`

## Seeder

Seeder creato prima con -a sul modello, altrimenti `php artisan make:seeder GameSeeder`

Importa il modello nel Seeder

`use App\Models\Game;`

Importa faker

`use Faker\Generator as Faker;`

Dependency injection nel metodo run e ciclo for

```php

public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            # code...
        }
    }
```

Inserire i dati con faker

```php
#code ..
$game = new Game();
$game->title = $faker->sentence();
$game->cover = $faker->imageUrl(300, 200, 'Games');
$game->desc = $faker->paragraphs(10, true);
$game->is_available = $faker->boolean(80);
$game->save();
```

Aggiungi il seeder al DatabaseSeeder.php se vuoi migragrare e seedare tutto insieme

```php
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ComicSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(GameSeeder::class);
    }
}

```

Seeda il db

`php artisan db:seed --class=GameSeeder`

## Implementazione CRUD

- creazione delle 7 rotte restful
- creazione di un resource controller lato "Admin"
- creazione di un controller semplice lato "Guest"


### Controller lato Admin

Crea un controller da riga di comando usando `php artisan make:controller Admin/GameController -r`

Ricorda che il namespace deve essere Admin `namespace App\Http\Controllers\Admin;`

### Implementiamo metodo INDEX

Iniziamo a definire in web.php la prima rotta che useremo per mostrare tutte le risorse collegate ad un modello (Game).

```php
# R = READ
Route::get('admin/games', 'Admin\GameController@index')->name('admin.games.index');


```

Implementiamo metodo `@index` nel controller Admin\GameController.php

```php
 public function index()
  {
      $games = Game::orderBy('id', 'desc')->paginate(12);
      return view('admin.games.index', compact('games'));
  }

```

Il metodo reindirizza ad una view chiamata `index` che dobbiamo creare dentro `views/admin/games`

Crea la View e inserisci una tabella nel markup (usa il componente table di bootsrap per generare la tabella, poi con un ciclo foreach inserire i dati nella tabella.

### Implementiamo metodo CREATE

Creazione rotta per inserire nuova risorsa, in web.php aggiungiamo rotta `create`

```php
# R = READ
Route::get('admin/games', 'Admin\GameController@index')->name('admin.games.index');
Route::get('admin/games/create', 'Admin\GameController@create')->name('admin.games.create');
```

Restituire la view dal controller per mostrare un form che l'admin puo compilare per inserire un nuovo gioco nel database.

nel controller `Admin\GameController` implementa metodo `create`

```php
public function create()
{
    return view('admin.games.create');
}
```

Creazione view nella cartella `resources/views/admin/games/` che chiamiamo `create`.blade.php

```bash
touch create.blade.php 

```

__Form per inserire i dati__:

- ricorda il `@csrf` token
- l'azione nel form é `action="{{ route('admin.games.store') }}"`
- il metodo del form é POST
- non dimenticare l'attributo `name=` sugli input che combacia con nomi colonne tabella.

```html
<form action="{{ route('admin.games.store') }}" method="post">
    @csrf

    <!-- Campi del form qui  -->

</form>

```

### Implementiamo metodo STORE

Crea la rotta in web.php

```php
Route::post(
    'admin/games',
    'Admin\GameController@store'
)->name('admin.games.store');
```

Usiamo `ddd()` per visualizzare un dump a schermo della richiesta dentro il metodo `@store`

```php

 public function store(Request $request)
  {
      //
      ddd($request->all());
  }

```

Validiamo i dati, inserendo le regole di validazione. Sfruttiamo metodo `validate([])` della classe request
[Docs](https://laravel.com/docs/7.x/validation#validation-quickstart)

```php
$val_data = $request->validate([
    'title' => ['required', 'max:200'],
    'cover' => ['nullable', 'max:255'],
    'desc' => ['nullable'],
]);

```

Creaiamo il record nel db, sempre nem metodo `store()`

```php
// Salviamo il record nel database
Game::create($val_data);

```

NOTE: Ricorda di aggiungere le fillable properties nel modello `Add [title] to fillable property to allow mass assignment on [App\Models\Game].`

Aggiungi questa riga nel modello Game.php (se usi modello diverso i valori li devi cambiare!)

```php
protected $fillable = ['title', 'cover', 'desc'];
```

Reindirizza l'utente ad una pagina get `return redirect()->route('admin.games.index');`.

Questo é il metodo store completo:

```php
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

```

Ricorda di aggiungere gli errori di validazione nel form!
[documentazione](https://laravel.com/docs/7.x/validation#quick-displaying-the-validation-errors)

```html


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


```

Ricorda che puoi usare anche la direttiva blade @error, ad esempio

```html
<input id="title" type="text" class="@error('title') is-invalid @enderror">

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

```

Puoi anche conservare il testo inserito nel form qualora la validazione fallisse usando funzione `old()`
ad esempio:
`value="{{old('title')}}"`

### Implementazione metodo Edit

Creazione rotta per edit

```php

Route::get('admin/games/{game}/edit', 'Admin\GameController@edit')->name('admin.games.edit');

```

Creazione view edit con form per modificare una risorsa

__Form per modificare i dati__:

- ricorda il `@csrf` token
- l'azione nel form é `action="{{ route('admin.games.update', $game->id) }}"`
- il metodo del form non é POST ma put, usare direttiva @method('PUT');
- non dimenticare l'attributo `name=` sugli input che combacia con nomi colonne tabella.
- ricorda di popolare i campi del form con ad esempio `value="{{$game->title}}"`

```html
<form action="{{ route('admin.games.update', $game->id) }}" method="post">
    @csrf
    @method('PUT')
    <!-- Campi del form qui  -->

</form>

```

Crea metodo `edit()` nel controller per restituire la view

```php

  public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

```

### Implementazione metodo Update

Crea rotta per l'update

```php
Route::put('admin/games/{game}', 'Admin\GameController@update')->name('admin.games.update');

```

Creare metodo update nel controller

- valida i dati
- aggiorna la risorsa `$game->update($attributes)`
- return redirect

```php

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
```

### Implementazione metodo Destroy

Creazione rotta delete

```php
Route::delete('admin/games/{game}', 'Admin\GameController@destroy')->name('admin.games.destroy');
```

Creazione del form nella view index

```php
 <form action="{{route('admin.games.destroy', $game->id)}}" method="post">
    @csrf
    @method("DELETE")

    <button type="submit" class="btn btn-danger">Delete</button>
</form>

```



