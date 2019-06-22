<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'infoes';
    protected $fillable = ['title_vn', 'title_en', 'title_cn', 'content_vn', 'content_en', 'content_cn'];
}
