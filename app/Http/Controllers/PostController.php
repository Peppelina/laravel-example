<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        //$post = Post::find(2);
        //dd($post->category); // выводит категорию поста с id 2

        //$category = Category::find(1);
        //dd($category->posts); // выводит посты с категорией c id 1

        //$tag = Tag::find(1);
        //dd($tag->posts); // выводит посты с тэгом под id 1

        //$post = Post::find(2);
        //dd($post->tags); // выводит тэги, которые имеются у поста с id 2


        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    { //создание
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags); //привязываем тег к посту

//        foreach ($tags as $tag) {
//            PostTag::firstOrCreate(
//              [
//                  'tag_id' => $tag,
//                  'post_id' => $post->id,
//              ]
//            );
//        }
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
       //$category =  Category::where('categories.id', '=', $post->category_id)->first();
        $post->with('category:name')->get(); // связываем пост с именем катгеории

        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags); // удаляет теги, которые были до, и добавляет только которые пришли
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
