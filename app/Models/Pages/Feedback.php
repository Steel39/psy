<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ['answer', 'image', 'url'];
}
