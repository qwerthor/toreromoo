<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emiten extends Model
{
    protected $table = 'emiten';
    protected $primaryKey = 'emiten_id';

    public function portfolio(){
        return $this->hasMany('App\Portfolio', 'emiten_id', 'emiten_id');
    }
}
