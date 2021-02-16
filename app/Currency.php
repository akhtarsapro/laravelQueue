<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;
    protected $table = 'currency';
    protected $fillable = ['name','rate','base_id'];
    public function baseCurrency(){
        return $this->belongsTo('App\BaseCurrency','base_id','id');
    }
}
