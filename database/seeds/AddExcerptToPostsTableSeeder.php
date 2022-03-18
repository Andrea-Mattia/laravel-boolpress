<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Str;

class AddExcerptToPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $post['excerpt'] = Str::limit($post['content'], 50);
            
            $post->save();
        }
    }
}
