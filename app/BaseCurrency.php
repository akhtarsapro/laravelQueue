<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseCurrency extends Model
{
    protected $table = 'base_currencies';
    protected $fillable = ['name'];
}
