<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable=['user_id','amount','payon','payment_id','status','type','purpose','date'];

    public function user_info(){
        return $this->hasOne('App\User','id','user_id');
    }
}
