<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ShowController extends BaseController
{
    public function __invoke(Post $post)
    {
        //$category =  Category::where('categories.id', '=', $post->category_id)->first();
        //$post->with('category:name')->get(); // связываем пост с именем категории
       // $post->with('tags')->get(); // связываем пост с тэгами

        return view('post.show', compact('post'));
    }
}
