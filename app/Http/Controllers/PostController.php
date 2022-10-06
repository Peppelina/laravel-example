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

    public function firstOrCreate() {
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

    public function updateOrCreate() {
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
