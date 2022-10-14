@extends('layouts.main')
@section('content')
    <div>
        <div>
            {{ $post->id }}. {{ $post->title }}
        </div>
        <div>
            Контент:
            {{ $post->content }}
        </div>
        @if ($post->category)
            <div>
                Категория:
                {{ $post->category->name }}
            </div>
        @endif
        @if ($post->tags)
            <div>
                Теги:
                @foreach($post->tags as $tag)
                    {{ $tag->title }}
                @endforeach
            </div>
        @endif
        <div>
            <a href="{{ route('post.edit', $post->id) }} " class="btn btn-primary mb-3">Edit</a>
        </div>
        <div>
            <form action="{{ route('post.delete', $post->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger mb-3">Delete</button>
            </form>
        </div>
        <div>
            <a href="{{ route('post.index') }} " class="btn btn-primary">Back</a>
        </div>

    </div>
@endsection
