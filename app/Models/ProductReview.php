<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable=['user_id','product_id','reviewer_name','reviewer_email','reviewer_webisite','rate','review','status'];

    public function user_info(){
        return $this->hasOne('App\User','id','user_id');
    }

    public static function getAllReview(){
        return ProductReview::orderBy('id', 'DESC')->get();
    }
    public static function getAllUserReview(){
        return ProductReview::where('user_id',auth()->user()->id)->with('user_info')->paginate(10);
    }

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }

}
