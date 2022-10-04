<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
//        $posts = Post::all();
//        foreach ($posts as $post) {
//            dd($post);
//        }
        $posts = Post::where('is_published', 1)->get(); //коллецкия
        foreach ($posts as $post) {
            dump ($post -> title);
        }
    }

    public function create() {

        $postArr = [
          [
              'title' => 'title of post from phpstorm',
              'content' => 'some interesting content',
              'image' => 'image.png',
              'likes' => '20',
              'is_published' => '1',
          ],
            [
                'title' => 'another title of post from phpstorm',
                'content' => 'another some interesting content',
                'image' => 'another image.png',
                'likes' => '50',
                'is_published' => '1',
            ]
        ];
        foreach ($postArr as $item) {
            Post::create($item);
        }
        dd('created');
    }

    public function update() {
        $post = Post::find(1);
        $post->update(
            [
                'title' => 'updated',
                'content' => 'updated',
                'image' => 'updated',
                'likes' => '1000',
                'is_published' => '0'
            ]
        );
        dd('updated');
    }

    public function delete() {
        $post = Post::withTrashed()->find(2);
        //$post->restore(); // восстановить
        $post->delete(); // удалить
        dd('deleted');
    }
}
