<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replyes';
    protected $fillable = ['name', 'email', 'content'];
}
