<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title_vn', 'title_en', 'title_cn', 'content_vn', 'content_en', 'content_cn', 'typeId'];
}
