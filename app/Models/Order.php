<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id','order_number','product_id','sub_total','quantity','delivery_charge','status','total_amount','currency_total_amount','shipping_charge','first_name','last_name','country','post_code','address1','address2','city','phone','email','payment_method','payment_status','shipping_id','coupon','ship_to_different','first_name_shipping','last_name_shipping','email_shipping','phone_shipping','country_shipping','state_id','state_id_shipping','post_code_shipping','address1_shipping','address2_shipping','city_shipping','order_note'];

    public function cart_info(){
        return $this->hasMany('App\Models\Cart','order_id','id');
    }
    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }
    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
