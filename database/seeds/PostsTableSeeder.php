<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
            $new_post = new Post();

            $new_post->title = 'Post title ' . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = 'Description post ' . ($i + 1) . ': Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus ea, cupiditate facilis rem ducimus excepturi expedita maxime, ut inventore ab, animi sequi modi! Dolor, distinctio soluta alias eveniet assumenda id.';

            $new_post->save();
        }
    }
}
