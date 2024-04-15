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

    public static function countRecharge(){
        $data=Transaction::where(["type" => 'CR', 'status' => "1"])->sum("amount");
        if($data){
            return $data;
        }
        return 0;
    }

    public static function countWithdrawal(){
        $data=Transaction::where(["type" => 'DR', 'status' => "1"])->sum("amount");
        if($data){
            return $data;
        }
        return 0;
    }

    public static function countIncome(){
        $data=Transaction::where(["type" => 'IC', 'status' => "1"])->sum("amount");
        if($data){
            return $data;
        }
        return 0;
    }
}
