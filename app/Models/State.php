<?php

namespace App\Models;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable=['state_name','country_id','status'];

    // public static function getProductByBrand($id){
    //     return Product::where('brand_id',$id)->paginate(10);
    // }
    public function products(){
        return $this->hasMany('App\Models\Product','brand_id','id')->where('status','active');
    }
    public static function getProductByBrand($slug){
        // dd($slug);
        return Brand::with('products')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public static function showStateCountryWiseID($id){
        return State::where('country_id',$id)->orderBy('id','ASC')->pluck('state_name','id');
    }
}
