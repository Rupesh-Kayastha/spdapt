<?php
namespace App\Http\Controllers;

use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
use App\Models\Cart;
use App\Models\Product;
use DB;
use App\Models\Order;
use App\Models\State;
use Illuminate\Support\Facades\Mail;

class PaypalController extends Controller
{
    public function payment(Request $request)
    {
        $order_sql_id = $request->order_sql_id;
        // $order_sql_id = session()->get('order_sql_id');
        $order_data = Order::select('*')->Where('id', $order_sql_id)->first();
        
        //$cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->where('is_cross_sell', '<>', '1')->get()->toArray();

        $cart = Order::where('user_id', auth()->user()->id)->where('id', $order_sql_id)->get()->toArray();
        
        $data = [];
       

        $data['items'] = array_map(function ($item) use ($cart) {
            //$name = Order::where('id', $item['id'])->pluck('order_number');
            return [
                'name' => 'Morshgolf Product Checkout of Order #'.$item['order_number'].'',
                'price' => number_format($item['total_amount'], 2, '.', ''),
                'desc' => 'Thank you for using paypal',
                'qty' => 1
            ];
        }, $cart);
        
        // $data['items'] = array_map(function ($item) use ($cart) {
        //             $name = Product::where('id', $item['product_id'])->pluck('title');
        //             return [
        //                 'name' => $name,
        //                 'price' => number_format($item['price'], 2, '.', ''),
        //                 'desc' => 'Thank you for using paypal',
        //                 'qty' => 1
        //             ];
        //         }, $cart);

        $data['invoice_id'] = $order_sql_id;
        $data['invoice_description'] = "Order #{$order_data['order_number']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        //$total = 0;
        // foreach ($data['items'] as $item) {
        //     $total += $item['price'] * $item['qty'];
        // }

         //$data['total'] = number_format($total, 2, '.', '');
        $data['total'] = number_format($order_data->total_amount, 2, '.', '');
        
        // $data['total'] = number_format($order_data->sub_total, 2, '.', '');
        // if (session('coupon')) {
        //     $data['shipping_discount'] = session('coupon')['value'];
        // }
        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data, true);
        //  return $data;
        if ($response['paypal_link'] == null) {
            return redirect()->back()->with(['error' => 'paypal link no set']);
        }
        return redirect()->away($response['paypal_link']);
    }



    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function cancel()
    {
        return redirect('/checkout')->with('error', $response['message'] ?? 'Your PayPal Transaction has been Canceled');
    }



    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        if(isset($response['DESC']))
        {
        $desc_arr = explode(' ', $response['DESC']);

        $order_no = trim(str_replace('#', '', $desc_arr[1]));
        }
        else
        {
            $desc_arr = explode(' ', $response['L_PAYMENTREQUEST_0_NAME0']);
            $order_no = trim(str_replace('#', '', $desc_arr[5]));

        }
        $get_product_stock = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();

        $cart_prod_id = array();
        $cart_prod_qnt = array();

        if (count($get_product_stock) > 0) {
            foreach ($get_product_stock as $res_cart) {
                $cart_prod_id[] = $res_cart->product_id;
                $cart_prod_qnt[] = $res_cart->quantity;
            }

            if (count($cart_prod_id) > 0) {
                foreach ($cart_prod_id as $ky => $val) {
                    $prod_stock = Product::where('id', $val)->first();
                    $updated_stock = $prod_stock->stock - $cart_prod_qnt[$ky];
                    $updated_prod_sold = $prod_stock->no_of_product_sold + $cart_prod_qnt[$ky];

                    Product::where('id', $val)->update(['stock' => $updated_stock, 'no_of_product_sold' => $updated_prod_sold]);
                }
            }
        }


        $order_id = $order_no;
        $order_id_arr = array('order_id' => $order_id, 'user_type' => 'reg');

        $cart_order_id_update = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update($order_id_arr);

        $data_order = array('payment_status' => 'paid', 'pg_response' => $response);

        $order_data_update = Order::where('user_id', auth()->user()->id)->where('order_number', $order_id)->update($data_order);

        $order_data_mail = Order::where('user_id', auth()->user()->id)->where('order_number', $order_id)->first();
        $orderDetails = Cart::join('products', 'carts.product_id', '=', 'products.id')->where('user_id', auth()->user()->id)->where('order_id', $order_id)->get();

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
            'name' => $order_data_mail->first_name . "" . $order_data_mail->last_name,
            'payment_method' => $order_data_mail->payment_method,
            'total_amount' => session('symbol') . "" . $order_data_mail->total_amount,
            'sub_total' => session('symbol') . "" . $order_data_mail->sub_total ?? 0,
            'coupon' => session('symbol') . "" . $order_data_mail->coupon ?? 0,
            'coupon_amnt' => $order_data_mail->coupon,
            'shipping_charge' => session('symbol') . "" . $order_data_mail->shipping_charge ?? 0,
            'date' => $order_data_mail->created_at,
            'phone' => $order_data_mail->phone,
            'orderDetails' => $orderDetails,
            'email' => auth()->user()->email,
            'country' => $country->country_name,
            'state' => $billing_state,
            'diff_add_state' => $billing_diff_addr_state, 
            'pdf' => $order_data_mail->id,
            'countryShip' => $countryShipData,
            'billing' => $order_data_mail,
            'order_note' => $order_data_mail->order_note,
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
            'billing' => $order_data_mail,
            'country' => $country->country_name,
            'state' => $billing_state,
            'diff_add_state' => $billing_diff_addr_state,
            'countryShip' => $countryShipData,
            'order_note' => $order_data_mail->order_note,
        ];

        Mail::send('mail.adminorderinfo',$datais, function($messages) use ($datais){
            $messages->to($datais['to']);
            $messages->subject($datais['subject']);
        });


        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            request()->session()->flash('success', 'You successfully pay from Paypal! Thank You');
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->route('thankyou');
        }

        request()->session()->flash('error', 'Something went wrong please try again!!!');
        return redirect()->back();

    }

}

