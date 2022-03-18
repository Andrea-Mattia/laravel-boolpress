<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        $this->performValidation($request);

        $data = $request->all();

        // gen slug
        $data['slug'] = Str::slug($data['title'], '-');
        
        // Gen excerpt
        $data['excerpt'] = Str::limit($data['content'], 50);

        // create and save record on db
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();

        // SALVA RELAZIONE CON TAGS IN TABELLA PIVOT
        if (array_key_exists('tags', $data)) {
            // post - tag
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        if (! $post) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        if (! $post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // VALIDATE
        $this->performUpdateValidation($request, $id);

        $data = $request->all();

        $post = Post::find($id);

        // gen slug
        if ($data['title'] != $post->title) {
            $data['slug'] = Str::slug($data['title'], '-');
        }
        
        // gen excerpt
        if ($data['content'] != $post->content) {
            $data['excerpt'] = Str::limit($data['content'], 50);
        }

        $post->update($data); // fillable

        // AGGIORNA RELATION TABELLA PIVOT

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // pulizioa orfani da tabella pivot
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }


    /**
     * UTILITIES
     */
    private function performValidation($request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ], [
            'required' => 'The :attribute is required!',
            'unique' => 'The :attribute is already in use, please change it!',
            'max' => 'Max :max characters allowed for the :attribute!'
        ]);
    }
    
    private function performUpdateValidation($request, $id)
    {
        $request->validate([
            'title' => [
                'required',
                Rule::unique('posts')->ignore($id),
                'max:255',
            ],
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ], [
            'required' => 'The :attribute is required!!',
            'unique' => 'The :attribute is already in use for another post.',
            'max' => 'Max :max characters allowed for the :attribute.'
        ]);
    }
}
