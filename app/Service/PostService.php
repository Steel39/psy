<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{

    public function storePost($data)
    {
        if (isset($data['tag_ids'])) {
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
        }
        if (isset($data['image'])) {
            $data['image'] = Storage::disk('public')->put('posts', $data['image']);
        }
        $post = Post::firstOrCreate($data);
        $post->tags()->attach($tagIds);
    }
}
