<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        /*$category = Category::find(1);
        //$posts = Post::where('is_published', 1)->get();
        $posts = $category->posts;*/ //выводит посты опредленной категории

        $post = Post::find(2);
        dd($post->category); // выводит категорию поста


        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    { //создание
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);

        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        //$post = Post::findOrFail($id);
        //dd($post->title);
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');

    }

    public function restore()
    {
        $post = Post::withTrashed()->find(3);
        $post->restore(); // восстановить
        return redirect()->route('post.index');
    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        //$post->restore(); // восстановить
        $post->delete(); // удалить
        dd('deleted');
    }

    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some image.png',
            'likes' => '5000',
            'is_published' => '1',
        ];

        $post = Post::firstOrCreate(
            [
                'title' => ' some title of post from phpstorm'
            ],
            [
                'title' => ' some title of post from phpstorm',
                'content' => 'some content',
                'image' => 'some image.png',
                'likes' => '5000',
                'is_published' => '1',
            ]
        );
        dd($post->content);
        dd('fifnshed');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => ' updateOrCreate some post',
            'content' => 'updateOrCreate some content',
            'image' => 'updateOrCreate some image.png',
            'likes' => '50',
            'is_published' => '1',
        ];

        $post = Post::updateOrCreate(
            ['title' => 'Not updateOrCreate some post'],
            [
                'title' => 'Not updateOrCreate some post',
                'content' => 'Not updateOrCreate some content',
                'image' => 'Not updateOrCreate some image.png',
                'likes' => '50',
                'is_published' => '1',
            ]
        );
        dd($post->content);
    }

}
