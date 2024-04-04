<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Country;
use App\User;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;
use Illuminate\Support\Facades\Crypt;
use DB;



class OrderController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(){
        $orders=Order::with('product')->orderBy('id','DESC')->paginate(10);
        return view('backend.order.index')->with('orders',$orders);
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create(){

        //

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request){
       
        $this->validate($request,[
            'first_name'=>'string|required|min:2',
            'last_name' =>'string|required|min:2',
            'address1'  =>'string|required',
            'address2'  =>'string|nullable',
            'coupon'    =>'nullable|numeric',
            'phone'     =>'numeric|required|min:10',
            'post_code' =>'string|nullable',
            'email'     =>'required|email',
            'terms_and_condition'  =>'string|required'
        ]);
        
        $cart_data_count = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->count();
        if($cart_data_count==0){
            request()->session()->flash('error','Cart is Empty !');
            return back();
        }

        $prod_in_cart = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->get();
        $prod_in_cart_arr=array();
        foreach($prod_in_cart as $res_cart_prod)
        {
            $prod_in_cart_arr[] = $res_cart_prod['product_id'];
        }
        if(count($prod_in_cart_arr)>0)
        {
            $prod_in_cart_str = implode(',',$prod_in_cart_arr);
        }
        else
        {
            $prod_in_cart_str=null;
        }
        
        $order=new Order();
        $order_data=$request->all();
       
        $order_data['order_number']='ORD-'.strtoupper(Str::random(10));
        $order_data['product_id'] =  $prod_in_cart_str;
        $order_data['user_id']=$request->user()->id;
        $order_data['shipping_id']=$request->shipping;
        $shipping=Country::where('id',$request->country)->first();
        $order_data['sub_total']=Helper::totalCartPrice()+Helper::ProductShippingFees();
        $order_data['quantity']=Helper::cartCount();
        $order_data['coupon']=Helper::cartCount();

        // State id or name fetch

  
        if($request->state_id_shipping == null){
            $order_data['state_id_shipping'] = $request->state_text_shipping;
        }
        if($request->shipping_product == 11) {
            $shipping = 00.00;
            $order_data['shipping_charge']=$shipping;
        } else {
            $order_data['shipping_charge']=$shipping->shipping_charge;
        }

        $order_data['shipping_charge']= $order_data['shipping_charge'] + Helper::ProductShippingFees();
        
        if(session('coupon')){
            $order_data['coupon']=session('coupon')['value'];
        } else {
            $order_data['coupon']=0;
        }

        // if(session('coupon'))
        // {
        //     if($request->shipping_product == 11) {
        //         $order_data['total_amount']=Helper::totalCartPrice() - session('coupon')['value'];
        //     } else {
        //         $order_data['total_amount']=Helper::totalCartPrice() + $shipping->shipping_charge - session('coupon')['value'];
        //     }            
        // }
        // else
        // {
        //     if($request->shipping_product == 11) {
        //         $order_data['total_amount']=Helper::totalCartPrice();
        //     } else {
        //         $order_data['total_amount']=Helper::totalCartPrice() + $shipping->shipping_charge;
        //     }
            
        // }



        //$order_data['total_amount']=$order_data['total_amount'] + Helper::ProductShippingFees();

        $order_data['total_amount'] = $order_data['currency_total_amount'];
       
        $order_data['status']="new";
        if(request('payment_method')=='paypal'){
            $order_data['payment_method']='paypal';
            $order_data['payment_status']='unpaid';
        }else{
            $order_data['payment_method']='stripe';
            $order_data['payment_status']='unpaid';
        }

        $billing_state = null;

        if($request->state_id!=null)
        {
            $billing_state = $request->state_id;
        }
        else if($request->state_etxt_id!=null)
        {
            $billing_state = $request->state_etxt_id;
        }

       $order_data['state_id'] = $billing_state;

        $different_ship_state = null;

        if($request->state_id_shipping!=null)
        {
            $different_ship_state = $request->state_id_shipping;
        }
        else if($request->state_text_shipping!=null)
        {
            $different_ship_state = $request->state_text_shipping;
        }

        $order_data['state_id_shipping'] =   $different_ship_state;   
  
       // dd($order_data);
        $order->fill($order_data);
        $status=$order->save();
        if($order)
        $users=User::where('role','admin')->first();
        $details=[
            'title'=>'New order created',
            'actionURL'=>route('order.show',$order->id),
            'fas'=>'fa-file-alt'
        ];
        Notification::send($users, new StatusNotification($details));
        if(request('payment_method')=='paypal'){
            return redirect()->action('PaypalController@payment',['order_sql_id'=>$order->id]);
            // return redirect()->route('payment')->with(['order_sql_id'=>$order->id]);
        }elseif(request('payment_method')=='stripe'){
            //return redirect()->route('stripeform')->with(['order_sql_id'=>$order->id]);
            $enc_order_sqlid = Crypt::encrypt($order->id);
            return redirect()->action('StripePaymentController@stripe',['order_sql_id'=> $enc_order_sqlid]);
        }
        else{
            session()->forget('cart');
            session()->forget('coupon');
        }
        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);

        request()->session()->flash('success','Your product successfully placed in order');
        return redirect()->route('home');
    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)
    {
        $order=Order::find($id);
        $ordered_prods=DB::table('products')->join('carts','products.id', '=', 'carts.product_id')->select('*')->where('order_id','=',$order->order_number)->get();
        return view('backend.order.show')->with(['ordered_prods'=>$ordered_prods, 'order' => $order]);
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id){

        $order=Order::find($id);

        return view('backend.order.edit')->with('order',$order);

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id){

        $order=Order::find($id);

        $this->validate($request,[

            'status'=>'required|in:new,process,delivered,cancel'

        ]);

        $data=$request->all();

        // return $request->status;

        if($request->status=='delivered'){

            foreach($order->cart as $cart){

                $product=$cart->product;

                // return $product;

                $product->stock -=$cart->quantity;

                $product->save();

            }

        }

        $status=$order->fill($data)->save();

        if($status){

            request()->session()->flash('success','Successfully updated order');

        }

        else{

            request()->session()->flash('error','Error while updating order');

        }

        return redirect()->route('order.index');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id){

        $order=Order::find($id);

        if($order){

            $status=$order->delete();

            if($status){

                request()->session()->flash('success','Order Successfully deleted');

            }

            else{

                request()->session()->flash('error','Order can not deleted');

            }

            return redirect()->route('order.index');

        }

        else{

            request()->session()->flash('error','Order can not found');

            return redirect()->back();

        }

    }



    public function orderTrack(){

        return view('frontend.pages.order-track');

    }



    public function productTrackOrder(Request $request){

        // return $request->all();

        $order=Order::where('user_id',auth()->user()->id)->where('order_number',$request->order_number)->first();

        if($order){

            if($order->status=="new"){

            request()->session()->flash('success','Your order has been placed. please wait.');

            return redirect()->route('home');



            }

            elseif($order->status=="process"){

                request()->session()->flash('success','Your order is under processing please wait.');

                return redirect()->route('home');

    

            }

            elseif($order->status=="delivered"){

                request()->session()->flash('success','Your order is successfully delivered.');

                return redirect()->route('home');

    

            }

            else{

                request()->session()->flash('error','Your order canceled. please try again');

                return redirect()->route('home');

    

            }

        }

        else{

            request()->session()->flash('error','Invalid order numer please try again');

            return back();

        }

    }



    // PDF generate

    public function pdf($id)
    {
        $order=Order::getAllOrder($id);
        $file_name=$order->order_number.'-'.$order->first_name.'.pdf';
        $pdf=PDF::loadview('backend.order.pdf',compact('order'));
        return $pdf->download($file_name);
    }

    public function pdfPackingSlip($id)
    {
        $order=Order::getAllOrder($id);
        $file_name=$order->order_number.'-'.$order->first_name.'-packing-slip.pdf';
        $pdf=PDF::loadview('backend.order.pdfPackingSlip',compact('order'));
        return $pdf->download($file_name);
    }

    // Income chart

    public function incomeChart(Request $request){

        $year=\Carbon\Carbon::now()->year;

        // dd($year);

        $items=Order::with(['cart_info'])->whereYear('created_at',$year)->where('status','delivered')->get()

            ->groupBy(function($d){

                return \Carbon\Carbon::parse($d->created_at)->format('m');

            });

            // dd($items);

        $result=[];

        foreach($items as $month=>$item_collections){

            foreach($item_collections as $item){

                $amount=$item->cart_info->sum('amount');

                // dd($amount);

                $m=intval($month);

                // return $m;

                isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;

            }

        }

        $data=[];

        for($i=1; $i <=12; $i++){

            $monthName=date('F', mktime(0,0,0,$i,1));

            $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;

        }

        return $data;

    }

}

