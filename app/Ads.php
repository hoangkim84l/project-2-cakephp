<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'ads';
    protected $fillable = ['title_vn', 'title_en', 'title_cn', 'price', 'content_vn', 'content_en', 'content_cn', 'address', 'typeId'];
}
