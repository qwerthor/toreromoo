<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaderGainLoss extends Model
{
    protected $table = 'leader_gain_loss';
    protected $primaryKey = 'leader_gain_loss_id';

    public $timestamps = false;

    public function emiten(){
        return $this->belongsTo('App\Emiten', 'emiten_id', 'emiten_id');
    }
}
