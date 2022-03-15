@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        
        <div class="mb-5">
            <a class="btn btn-warning mb-2" 
                href="{{ route('admin.posts.edit', $post->id) }}">Edit posts</a>

            @if ($post->category)
                <h3>Category: {{ $post->category->name }}</h3>
            @else 
                <h3>Uncategorized</h3>
            @endif
        </div>

        <div class="mb-5">
            {{ $post->content }}
        </div>

        {{-- POST TAGS --}}
        @if (count($post->tags) > 0)
            <h4 class="mb-3">Tags</h4>
            <ul class="list-inline">
                @foreach ($post->tags as $tag)
                    <li class="list-inline-item alert alert-info">{{ $tag->name }}</li>
                @endforeach
            </ul>
        @endif

    </div>
@endsection