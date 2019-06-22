<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreAddress extends Model
{
    protected $table = 'store_address';
    protected $fillable = ['phone', 'address', 'email'];
}
