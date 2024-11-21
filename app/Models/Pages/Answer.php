<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['question', 'answer'];
}
