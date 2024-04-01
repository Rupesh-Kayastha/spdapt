<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\Testimonial;
use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AbandonedCart extends Controller
{
    public function index(Request $request)
    {
        return "Hiiii";
    }
   
    
    public function sendMailAbandonedCart(Request $request)
    {
        //$avondedcarts = Cart::where(["order_id" => NULL, "user_type" => "reg"])->orderBy('id','DESC')->get();

        $avondedcarts = Cart::join('users','users.id','=','carts.user_id')                        
                        ->where('user_id','!=','1')
                        ->where(["order_id" => NULL, "user_type" => "reg"])
                        ->orderBy('users.id','asc')
                        ->get();

       // dd($avondedcarts);

       $user_id_arr=array();

       if(count($avondedcarts)>0)
       {

                foreach ($avondedcarts as $key => $value) 
                {
                    if(!in_array($value->user_id,$user_id_arr))
                    {
                        $user = User::find($value->user_id);

                        $datais = [
                            'to' => $user->email,
                            'subject' => "You miss your order process - MorshGolf",
                            'name' => $user->name,
                            'data' => $value,
                            'cart_user_id' => $value->user_id,
                        ];

                        Mail::send('mail.abandonedcart',$datais, function($messages) use ($datais){
                            $messages->to($datais['to']);
                            $messages->subject($datais['subject']);
                        });

                        $user_id_arr[]= $value->user_id;

                        //Golf Ball add only in case of AbandonedCart
                        $golf_ball_count = Cart::where('user_id',$value->user_id)
                                            ->where(["order_id" => NULL, "user_type" => "reg"])
                                            ->where('product_id','=','11')                                            
                                            ->count();

                        if($golf_ball_count==0)
                        {
                            $cross_sell_product = Product::where('id', '11')->first();

                            if($cross_sell_product->discount>0)
                            {
                               $product_final_price =  $cross_sell_product->price-($cross_sell_product->price/100)*$cross_sell_product->discount;
                            }
                            else
                            {
                                $product_final_price =  $cross_sell_product->price;
                            }

                            $cart                = new Cart;
                            $cart->user_id       = $value->user_id;
                            $cart->product_id    = 11;
                            $cart->price         = $product_final_price;
                            $cart->quantity      = 1;
                            $cart->user_type     = 'reg';
                            $cart->amount        = $product_final_price;
                            $cart->is_cross_sell ='1';
                            $cart->save();
                        }



                    }
                }

        }
            
        return redirect()->route('home');
    }


    
}
