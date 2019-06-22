<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsCategory extends Model
{
    protected $table = 'ads_categorys';
    protected $fillable = ['title_vn', 'title_en', 'title_cn'];
}
