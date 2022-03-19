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
        // $posts = Post::all();

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);
    }
}
