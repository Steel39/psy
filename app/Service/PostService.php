<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{

    public function storePost($data): void
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

    public function updatePost($data, $id)
    {
        if (isset($data['tag_ids'])) {
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
        }
        if (isset($data['image'])) {
            $data['image'] = Storage::disk('public')->put('posts', $data['image']);
        }
        
        $id->update($data);
        if (isset($tagIds)) {
            $id->tags()->sync($tagIds);
        }
    }
}
