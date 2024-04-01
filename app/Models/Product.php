<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Vendor;
class Product extends Model
{
    protected $fillable=['title','product_sub_title','rating','no_of_product_sold','hand_orientation','shaft_material','flex','configuration','volume','length','swing_weight','slug','summary','discount_update','discount_update_date','description','product_description','technical_details','cat_id','child_cat_id','price','brand_id','discount','status','photo','size','stock','is_featured','is_cross_sell','condition','meta_title','meta_keyword','meta_description','extra_code','shipping_price'];

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    
    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    
    public static function getAllProduct(){
        return Product::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->paginate(10);
    }

    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    
    public function getReview(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->where('status','active')->orderBy('id','DESC');
    }
    
    public static function getProductBySlug($slug){
        return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    }
    
    public static function countActiveProduct(){
        $data=Product::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class);
    }

}
