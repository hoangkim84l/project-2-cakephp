<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'category_news';
    protected $fillable = ['title_vn', 'title_en', 'title_cn'];
}
