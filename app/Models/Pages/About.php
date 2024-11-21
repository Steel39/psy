<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    protected $fillable = ['content', 'image'];
}
