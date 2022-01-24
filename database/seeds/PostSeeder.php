<?php

use Faker\Generator as Faker;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->title = $faker->sentence();
            $post->poster = $faker->imageUrl(600, 400, 'posts');
            $post->body = $faker->paragraphs(10, true);
            $post->save();
        }
    }
}
