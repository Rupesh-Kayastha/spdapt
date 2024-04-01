<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Helper;
use DB;

class CartController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        if (empty($request->slug)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }        
        $product = Product::where('slug', $request->slug)->first();
        // return $product;
        if (empty($product)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        if(!empty(auth()->user()->id)) { 
            $user_id = auth()->user()->id;
            $temp_id = '0';
            $user_type = 'reg';
        }
        else {
            $rand=rand(111111111,999999999);
            session()->put('USER_TEMP_ID',$rand);
            $user_id = '0';
            $temp_id = $rand;
            $user_type = 'non-reg';
        }
        return $user_id;

        $already_cart = Cart::where('user_id', $user_id)->where('order_id',null)->where('product_id', $product->id)->first();
        //get cross sell product
        $cross_sell_product = Product::where('is_cross_sell', '1')->where('status','active')->first();
        // return $already_cart;
        if($already_cart) {
            // dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $product->price+ $already_cart->amount;
            // return $already_cart->quantity;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $already_cart->save();
        }else{

            if($product->discount>0)
            {
               $product_final_price =  $product->price-($product->price/100)*$product->discount;
            }
            else
            {
                $product_final_price =  $product->price;
            }

            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = 1;
            $cart->temp_id = $temp_id;
            $cart->user_type = $user_type;
            $cart->amount=$product_final_price*$cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $cart->save();

            if($cross_sell_product) {
                if($cart->product_id != $cross_sell_product->id){
                    if($cross_sell_product) {
                        $cart = new Cart;
                        $cart->user_id = $user_id;
                        $cart->product_id = $cross_sell_product->id;
                        $cart->price = ($cross_sell_product->price-($cross_sell_product->price*$cross_sell_product->discount)/100);
                        $cart->quantity = 1;
                        $cart->temp_id = $temp_id;
                        $cart->user_type = $user_type;
                        $cart->amount=$cart->price*$cart->quantity;
                        $cart->is_cross_sell='1';
                        $cart->save();
                    }
                }
            }

            $wishlist=Wishlist::where('user_id',$user_id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success','Product successfully added to cart');
        //return back();  
        return redirect()->route('cart')->with('success','Product successfully added to cart'); 
    }  



    public function singleAddToCart(Request $request)
    {
        $request->validate([
            'slug'      =>  'required',
            'quant'      =>  'required',
        ]);

        // dd($request->all());
        //get cross sell product
        $cross_sell_product = Product::where('is_cross_sell', '1')->where('status','active')->first();
        $product = Product::where('slug', $request->slug)->first();
        if($product->stock <$request->quant[1]){
            return back()->with('error','Out of stock, You can add other products.');
        }
        if ( ($request->quant[1] < 1) || empty($product) ) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }    

        if(!empty(auth()->user()->id)) { 
            $user_id   = auth()->user()->id;
            $user_type = 'reg';
        }
        elseif(!session()->has('USER_TEMP_ID')) {
            
            $rand      =rand(1111,9999);
            session()->put('USER_TEMP_ID',$rand);
            $user_id   = $rand;
            $user_type = 'non-reg';
        } else {
            $rand      = session()->get('USER_TEMP_ID');
            $user_id   = $rand;
            $user_type = 'non-reg';
        }

        $already_cart = Cart::where('user_id', $user_id)->where('order_id',null)->where('product_id', $product->id)->first();
        // return $already_cart;
        if($already_cart) 
        {

            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            // $already_cart->price = ($product->price * $request->quant[1]) + $already_cart->price ;
            $already_cart->amount = ($product->price * $request->quant[1])+ $already_cart->amount;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $already_cart->save();
        }
        else
        {
            if($product->discount>0)
            {
               $product_final_price =  $product->price-($product->price/100)*$product->discount;
            }
            else
            {
                $product_final_price =  $product->price;
            }
            // dd($product->price-($product->price*$product->discount)/100);
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product->id;
            $cart->price = ($product->price-($product->price*$product->discount)/100);
            $cart->quantity = $request->quant[1];
            $cart->user_type = $user_type;
            $cart->amount=$product_final_price*$request->quant[1];
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            // return $cart;
            $cart->save();


            if($cross_sell_product)
            {
                if($cart->product_id != $cross_sell_product->id)
                {
                    if($cross_sell_product) {
                        $already_cart_cross_sell = Cart::where('user_id', $user_id)->where('order_id',null)->where('is_cross_sell', '1')->count();
                        if($already_cart_cross_sell==1){ } else {
                        
                            $cart                = new Cart;
                            $cart->user_id       = $user_id;
                            $cart->product_id    = $cross_sell_product->id;
                            $cart->price         = ($cross_sell_product->price-($cross_sell_product->price*$cross_sell_product->discount)/100);
                            $cart->quantity      = 1;
                            $cart->user_type     = $user_type;
                            //$cart->temp_id     = $temp_id;
                            $cart->user_type     = $user_type;
                            $cart->amount        = $cart->price*$cart->quantity;
                            $cart->is_cross_sell ='1';
                            $cart->save();
                        }
                    }
                } 
            }
        }

        if(!empty(auth()->user()->id)) {
            request()->session()->flash('success','Product successfully added to cart');
            return redirect()->route('cart')->with('success','Product successfully added to cart'); 
        } else {
            return redirect()->route('login.form');
        }
    } 

    

    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success','Cart successfully removed');
            return back();  
        }
        request()->session()->flash('error','Error please try again');
        return back();       
    }     



    public function cartUpdate(Request $request){
        // return $request->quant;
        // dd($request->all());
        if($request->quant){
            $error = array();
            $success = '';
            // return $request->quant;
            foreach ($request->quant as $k=>$quant) {
                // return $k;
                $id = $request->qty_id[$k];
                // return $id;
                $cart = Cart::find($id);
                // return $cart;
                if($quant > 0 && $cart) {
                    // return $quant;
                    if($cart->product->stock < $quant){
                        request()->session()->flash('error','Out of stock');
                        return back();
                    }

                    $cart->quantity = ($cart->product->stock > $quant) ? $quant  : $cart->product->stock;
                    // return $cart;

                
                    if ($cart->product->stock <=0) continue;
                    $after_price=($cart->product->price-($cart->product->price*$cart->product->discount)/100);
                    $cart->price = $after_price * $quant;
                    // return $cart->amount = $after_price * $quant;
                    $cart->save();
                    $success = 'Cart successfully updated!';
                }else{
                    $error[] = 'Cart Invalid!';
                }
            }

            return back()->with($error)->with('success', $success);
        }else{
            return back()->with('Cart Invalid!');
        }    
    }



    // public function addToCart(Request $request){

    //     // return $request->all();

    //     if(Auth::check()){

    //         $qty=$request->quantity;

    //         $this->product=$this->product->find($request->pro_id);

    //         if($this->product->stock < $qty){

    //             return response(['status'=>false,'msg'=>'Out of stock','data'=>null]);

    //         }

    //         if(!$this->product){

    //             return response(['status'=>false,'msg'=>'Product not found','data'=>null]);

    //         }

    //         // $session_id=session('cart')['session_id'];

    //         // if(empty($session_id)){

    //         //     $session_id=Str::random(30);

    //         //     // dd($session_id);

    //         //     session()->put('session_id',$session_id);

    //         // }

    //         $current_item=array(

    //             'user_id'=>auth()->user()->id,

    //             'id'=>$this->product->id,

    //             // 'session_id'=>$session_id,

    //             'title'=>$this->product->title,

    //             'summary'=>$this->product->summary,

    //             'link'=>route('product-detail',$this->product->slug),

    //             'price'=>$this->product->price,

    //             'photo'=>$this->product->photo,

    //         );

            

    //         $price=$this->product->price;

    //         if($this->product->discount){

    //             $price=($price-($price*$this->product->discount)/100);

    //         }

    //         $current_item['price']=$price;



    //         $cart=session('cart') ? session('cart') : null;



    //         if($cart){

    //             // if anyone alreay order products

    //             $index=null;

    //             foreach($cart as $key=>$value){

    //                 if($value['id']==$this->product->id){

    //                     $index=$key;

    //                 break;

    //                 }

    //             }

    //             if($index!==null){

    //                 $cart[$index]['quantity']=$qty;

    //                 $cart[$index]['amount']=ceil($qty*$price);

    //                 if($cart[$index]['quantity']<=0){

    //                     unset($cart[$index]);

    //                 }

    //             }

    //             else{

    //                 $current_item['quantity']=$qty;

    //                 $current_item['amount']=ceil($qty*$price);

    //                 $cart[]=$current_item;

    //             }

    //         }

    //         else{

    //             $current_item['quantity']=$qty;

    //             $current_item['amount']=ceil($qty*$price);

    //             $cart[]=$current_item;

    //         }



    //         session()->put('cart',$cart);

    //         return response(['status'=>true,'msg'=>'Cart successfully updated','data'=>$cart]);

    //     }

    //     else{

    //         return response(['status'=>false,'msg'=>'You need to login first','data'=>null]);

    //     }

    // }



    // public function removeCart(Request $request){

    //     $index=$request->index;

    //     // return $index;

    //     $cart=session('cart');

    //     unset($cart[$index]);

    //     session()->put('cart',$cart);

    //     return redirect()->back()->with('success','Successfully remove item');

    // }



    public function checkout(Request $request){

        // $cart=session('cart');

        // $cart_index=\Str::random(10);

        // $sub_total=0;

        // foreach($cart as $cart_item){

        //     $sub_total+=$cart_item['amount'];

        //     $data=array(

        //         'cart_id'=>$cart_index,

        //         'user_id'=>$request->user()->id,

        //         'product_id'=>$cart_item['id'],

        //         'quantity'=>$cart_item['quantity'],

        //         'amount'=>$cart_item['amount'],

        //         'status'=>'new',

        //         'price'=>$cart_item['price'],

        //     );



        //     $cart=new Cart();

        //     $cart->fill($data);

        //     $cart->save();

        // }

        return view('frontend.pages.checkout');

    }

    public function abondedcart(){
        $abondedcarts = Cart::where(["order_id" => NULL, "user_type" => "reg"])->orderBy('id','DESC')->paginate(10);
        return view('backend.abondedcart.index')->with('abondedcarts', $abondedcarts);
    }

   

}

