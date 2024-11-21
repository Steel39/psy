<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'cervices';
    protected $fillable = ['name', 'description'];
}
