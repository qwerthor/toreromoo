<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emiten extends Model
{
    protected $table = 'emiten';
    protected $primaryKey = 'emiten_id';
    protected $fillable = ['code'];
    public $timestamps = false;


    public function portfolio(){
        return $this->hasMany('App\Portfolio', 'emiten_id', 'emiten_id');
    }
}
