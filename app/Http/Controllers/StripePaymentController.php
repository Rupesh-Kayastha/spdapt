<?php
   
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;  
use Illuminate\Http\Request;
use Session;
use Stripe;
use DB;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\State;
use Illuminate\Support\Facades\Mail;


class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        $order_sql_id = Crypt::Decrypt($request->order_sql_id);
        $order_data = Order::select('*')->Where('id',$order_sql_id)->first();
        $order_id = $order_data['order_number'];
        return view('frontend.pages.stripe',['order_id'=>$order_id]);
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $order_id = $request->order_id;
        $email = auth()->user()->email;
        $user_id = auth()->user()->id;

        // currency_total_amount (this cullom remove from sum(total_amount))
        $ord_dtl = Order::where('order_number', $request->order_id)->sum('total_amount');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = \Stripe\Customer::create([
            'email' => $email,
            'source' => $request->stripeToken,
            'description' => 'Customer of Order ID #'.$order_id,
        ]);

        $get_product_stock = Cart::where('user_id',$user_id)->where('order_id',null)->get();
        $cart_prdo_price = 0;    
        foreach($get_product_stock as $res_cart_prod)
        {
            $cart_prdo_price = $cart_prdo_price + $res_cart_prod['amount'];
        }
        $currency_data = number_format($ord_dtl, 1);
        $checkout_amount =  $currency_data * 100;
        if(session('currency') != null) {
            $currency_session = session('currency');
        } else  {
            $currency_session = 'usd';
        }
        $response =  Stripe\Charge::create ([
            "amount" => $checkout_amount,
            "currency" => $currency_session,
            'customer' => $customer->id,
            "description" => 'Invoice of Order ID #'.$order_id 
        ]);

        $pg_json = str_replace('Stripe\Charge JSON: ','',$response);

        $stripe_data_arr = json_decode($pg_json, true);

        //print_r($stripe_data_arr);exit;

        if(isset($stripe_data_arr['status']))
        {
            if($stripe_data_arr['status']=='succeeded')
            {
                $payment_status =  $stripe_data_arr['status'];
                //------------Product Stock Updation cod start-----------//
                $cart_prod_id = array();
                $cart_prod_qnt = array();
                if(count($get_product_stock)>0)
                {
                    // Product stock deduct after successfully checkout 
                    foreach($get_product_stock as $res_cart)
                    {
                        $cart_prod_id[] = $res_cart->product_id;
                        $cart_prod_qnt[] = $res_cart->quantity;
                    }
                    if(count($cart_prod_id)>0)
                    {
                        foreach($cart_prod_id as $ky=>$val)
                        {
                            $prod_stock = Product::where('id',$val)->first();
                            $updated_stock =  $prod_stock->stock - $cart_prod_qnt[$ky];
                            $updated_prod_sold = $prod_stock->no_of_product_sold + $cart_prod_qnt[$ky];
        
                            Product::where('id',$val)->update(['stock'=>$updated_stock,'no_of_product_sold'=>$updated_prod_sold]);
                        }
                    }
                } 
                
                $order_id_arr = array('order_id'=>$order_id,'user_type'=>'reg');
                $cart_order_id_update = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->update($order_id_arr);
                $data_order= array('payment_status'=>'paid','pg_response'=>$response);
                $order_data_update = Order::where('user_id',auth()->user()->id)->where('order_number',$order_id)->update($data_order);
                $orderDetails = Cart::join('products', 'carts.product_id', '=', 'products.id')->where('user_id', auth()->user()->id)->where('order_id', $order_id)->get();
                //------------Product Stock Updation cod end-----------//

                $order_data_mail = Order::where('user_id', auth()->user()->id)->where('order_number', $order_id)->first();

                $country = DB::table('countries')->where('id', $order_data_mail->country)->first();
                $countryShipData = "";
                if($order_data_mail->ship_to_different == 1) {
                    $countryShip = DB::table('countries')->where('id', $order_data_mail->country_shipping)->first();
                    $countryShipData= $countryShip->country_name;
                }

                 // State Name fetch for send data to email 
                    //dd($order_data_mail);
                $shipping_state_id = $order_data_mail->state_id;
                $diff_addrs_shipping_state_id = $order_data_mail->state_id_shipping;

             
                if(is_numeric($shipping_state_id))
                {
                        $billing_state =  State::where('id',$shipping_state_id)->value('state_name');  
                }
                else
                {
                        $billing_state = trim($shipping_state_id); 
                }

                // Difference Address State
                if(is_numeric($diff_addrs_shipping_state_id))
                {
                        $billing_diff_addr_state =  State::where('id',$diff_addrs_shipping_state_id)->value('state_name'); 
                }else
                {
                        $billing_diff_addr_state = trim($diff_addrs_shipping_state_id); 
                }

                
        
                $datais = [
                    'to' => auth()->user()->email,
                    'subject' => "Thank You for your purchase of product. || Morshgolf",
                    'order_number' => $order_id,
                    'name' => $order_data_mail->first_name . " " . $order_data_mail->last_name,
                    'payment_method' => $order_data_mail->payment_method,
                    'total_amount' => session('symbol') . " " . $order_data_mail->total_amount,
                    'sub_total' => session('symbol') . " " . $order_data_mail->sub_total ?? 0,
                    'coupon' => session('symbol') . " " . $order_data_mail->coupon ?? 0,
                    'coupon_amnt' => $order_data_mail->coupon,
                    'shipping_charge' => session('symbol') . " " . $order_data_mail->shipping_charge ?? 0,
                    'date' => $order_data_mail->created_at,
                    'phone' => $order_data_mail->phone,
                    'orderDetails' => $orderDetails,
                    'email' => auth()->user()->email,
                    'country' => $country->country_name,
                    'state' => $billing_state, 
                    'pdf' => $order_data_mail->id,
                    'countryShip' => $countryShipData,
                    'billing' => $order_data_mail,
                ];

                
                Mail::send('mail.userorder',$datais, function($messages) use ($datais){
                    $messages->to($datais['to']);
                    $messages->subject($datais['subject']);
                });

                $datais = [
                    'to' => 'santanu.polosoftech@gmail.com', //info@morshgolf.com
                    'subject' => "New order we have received. || Morshgolf",
                    'order_number' => $order_id,
                    'name' => $order_data_mail->first_name . " " . $order_data_mail->last_name,
                    'payment_method' => $order_data_mail->payment_method,
                    'date' => $order_data_mail->created_at,
                    'phone' => $order_data_mail->phone,
                    'total_amount' => session('symbol') . "" . $order_data_mail->total_amount,
                    'sub_total' => session('symbol') . "" . $order_data_mail->sub_total ?? 0,
                    'coupon' => session('symbol') . "" . $order_data_mail->coupon ?? 0,
                    'coupon_amnt' => $order_data_mail->coupon,
                    'shipping_charge' => session('symbol') . "" . $order_data_mail->shipping_charge ?? 0,
                    'email' => auth()->user()->email,
                    'orderDetails' => $orderDetails,
                    'state' => $billing_state, 
                    'billing' => $order_data_mail,
                    'country' => $country->country_name,
                    'countryShip' => $countryShipData,
                ];

                Mail::send('mail.adminorderinfo',$datais, function($messages) use ($datais){
                    $messages->to($datais['to']);
                    $messages->subject($datais['subject']);
                });
        
                Session::flash('success', 'Payment successful!');
                
                session()->forget('cart');
                session()->forget('coupon');
                return redirect()->route('thankyou');

            }

        } // if payment success conditon end
        else
        {
            return redirect('/checkout')->with(['error'=>'Payment Failed. Please, try again']);
        }
        

       

        
    }
}