<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connector extends Model
{
    protected $table = 'connectors';
    protected $fillable = ['name', 'intro_vn', 'intro_en', 'intro_cn', 'phone', 'email', 'address', 'position'];
}
