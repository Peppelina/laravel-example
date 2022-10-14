<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke()
    {
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
}
