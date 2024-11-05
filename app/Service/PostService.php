<?php

namespace App\Service;


use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function __construct(
        private readonly Tag      $tag,
        private readonly Post     $post,
        private readonly Category $category
    )
    {

    }

    public function storePost($data)
    {
        if (isset($data['tag_ids'])) {
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
        }
        if (isset($data['image'])) {
            $data['image'] = Storage::disk('public')->put('posts', $data['image']);
        }
        $this->post::firstOrCreate($data);
        $this->post->tags()->attach($tagIds);
    }
}
