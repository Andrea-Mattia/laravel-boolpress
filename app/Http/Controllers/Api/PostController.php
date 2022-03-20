<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {

        // Get posts
        // $posts = Post::all();

        $posts = Post::paginate(2);

        return response()->json($posts);
    }

    public function show($slug) {

        // Get posts

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        // modifica path cover image de associata
        if ($post->cover) {
            $post->cover = url('storage/' . $post->cover);
        } else {
            $post->cover = url('img/no-image.png');
        }

        return response()->json($post);
    }
}
