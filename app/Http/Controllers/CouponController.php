<?php

namespace App\Http\Controllers;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $coupon=Coupon::orderBy('id','DESC')->paginate('10');
        return view('backend.coupon.index')->with('coupons',$coupon);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $getProduct = Product::orderBy('id','DESC')->where('status','active')->get();
        return view('backend.coupon.create')->with('product_list',$getProduct);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // return $request->all();
        $this->validate($request,[
            'code'  =>'string|required',
            'type'  =>'required|in:fixed,percent',
            'value' =>'required|numeric',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();

        $product_id = $request->input('product_id');

        if($product_id){
            $data['product_id'] = implode(',',$product_id);
        }
        else{
            $data['product_id'] = '';
        }

        $data['coupon_expiry_date']= date('Y-m-d', strtotime($request->input('coupon_expiry_date')));

        $status=Coupon::create($data);
        if($status){
            request()->session()->flash('success','Coupon Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $getProduct = Product::orderBy('id','DESC')->where('status','active')->get();
        $coupon=Coupon::find($id);
        if($coupon){
            return view('backend.coupon.edit')->with('coupon',$coupon)->with('product_list',$getProduct);
        }
        else{
            return view('backend.coupon.index')->with('error','Coupon not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $coupon=Coupon::find($id);
        $this->validate($request,[
            'code'=>'string|required',
            'type'=>'required|in:fixed,percent',
            'value'=>'required|numeric',
            'status'=>'required|in:active,inactive'
        ]);
        $data=$request->all();
        
        $status=$coupon->fill($data)->save();
        if($status){
            request()->session()->flash('success','Coupon Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('coupon.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $coupon=Coupon::find($id);
        if($coupon){
            $status=$coupon->delete();
            if($status){
                request()->session()->flash('success','Coupon successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('coupon.index');
        }
        else{
            request()->session()->flash('error','Coupon not found');
            return redirect()->back();
        }
    }

    public function couponStore(Request $request){
        $coupon=Coupon::where('code',$request->code)->first();
        if(!$coupon){
            request()->session()->flash('error','Invalid coupon code, Please try again');
            return back();
        }
        if($coupon){
            $total_price=Cart::where('user_id',auth()->user()->id)->where('order_id',null)->sum('price');

             $coupon_expire =  Coupon::where('coupon_expiry_date','<=',date('Y-m-d'))->count();
            
            if($coupon_expire==1) {
                if($coupon->type == 'fixed'){ 
                    $value = $coupon->value;
                } else {
                    $value = $coupon->discount($total_price);
                }
                session()->put('coupon',[
                    'id'=>$coupon->id,
                    'code'=>$coupon->code,
                    'coupon_type'=>$coupon->type,
                    'coupon_amount'=>$coupon->value,
                    'value'=>$value
                ]);
                request()->session()->flash('success','Coupon successfully applied');
                return redirect()->back();
            }
            else
            {
                request()->session()->flash('success','Invalid coupon code, Please try again');
                return redirect()->back();
            }
        }
    }

    public function couponDelete(Request $request){
       
            $request->session()->forget('coupon');
            request()->session()->flash('success','Coupon successfully deleted');
            return redirect('/cart');
        
    }   
}
