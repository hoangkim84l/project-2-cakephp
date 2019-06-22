<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $table = 'recruitments';
    protected $fillable = ['title_vn', 'title_en', 'title_cn', 'content_vn', 'content_en', 'content_cn'];
}
