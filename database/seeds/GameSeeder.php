<?php

use App\Models\Game;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            # code...

            $game = new Game();
            $game->title = $faker->sentence();
            $game->cover = $faker->imageUrl(300, 200, 'Games');
            $game->desc = $faker->paragraphs(10, true);
            $game->is_available = $faker->boolean(80);
            $game->save();
        }
    }
}
