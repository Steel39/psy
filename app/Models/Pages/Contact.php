<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['connection', 'value', 'logo'];
}
