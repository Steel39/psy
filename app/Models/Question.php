<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['name', 'email', 'contact', 'question'];
    protected $casts = [
        'created_at' => 'datetime:Y-M-d D H:i:s',
    ];


}
