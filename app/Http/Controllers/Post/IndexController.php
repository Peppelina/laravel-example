<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class IndexController extends Controller
{
    public function __invoke()
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
}
