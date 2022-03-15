@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                deleted succesfully!
            </div>
        @endif

        <h1>Our Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create new post</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Tags</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>@if($post->category) {{ $post->category->name }} @else Uncategorized @endif</td>
                        <td>
                            @if (count($post->tags) > 0)
                                <ul class="list-unstyled">
                                    @foreach ($post->tags as $tag)
                                        <li>{{ $tag->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                No Tags
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" 
                                href="{{ route('admin.posts.show', $post->id) }}">SHOW</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" 
                                href="{{ route('admin.posts.edit', $post->id) }}">EDIT</a>
                        </td>
                        <td>
                            <form class="delete-post-form" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input class="btn btn-danger" type="submit" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            {{-- POSTS BY CATEGORY --}}
            <div class="col">
                <h2>Posts by Category</h2>
                @foreach ($categories as $category)
                    <h3 class="mt-4">{{ $category->name }}</h3>
                    <ul>
                        @forelse ($category->posts as $post)
                            <li>
                                <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                            </li>
                        @empty
                            <li>
                                No posts for this category. <a href="{{ route('admin.posts.create') }}">Create a new post</a>
                            </li>
                        @endforelse
                    </ul>
                @endforeach
            </div>
            {{-- POSTS BY TAGS --}}
            <div class="col">
                <h2>Posts by Tags</h2>
                @foreach ($tags as $tag)
                    <h3 class="mt-4">{{ $tag->name }}</h3>
                    <ul>
                        @forelse ($tag->posts as $post)
                            <li>
                                <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                            </li>
                        @empty
                            <li>
                                No posts for this tag. <a href="{{ route('admin.posts.create') }}">Create a new post</a>
                            </li>
                        @endforelse
                    </ul>
                @endforeach
            </div>
        </div>

    </div>
@endsection