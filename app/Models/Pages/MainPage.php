<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class MainPage extends Model
{
    protected $table = 'main_page';
    protected $fillable = ['header', 'content', 'image'];
}
