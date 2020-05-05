<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';
    protected $primaryKey = 'portfolio_id';

    public function emiten(){
        return $this->belongsTo('App\Emiten', 'emiten_id', 'emiten_id');
    }
}
