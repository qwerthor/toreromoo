<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kv extends Model
{
    //
    protected $table = 'kv';
    protected $primaryKey = 'key';
    public $timestamps = false;
}
