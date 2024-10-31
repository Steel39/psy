<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'description', 'content', 'is_published', 'image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
