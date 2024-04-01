<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $countries=Country::orderBy('id','DESC')->get();
        // return $country;
        return view('backend.country.index')->with('countries',$countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // return $request->all();
        $this->validate($request,[
            'country_name'=>'string|required',
            'country_code'=>'string|required',
            'currency_symbol'=>'string|required',
            'currency'=>'string|required',
            'shipping_charge'=>'string|nullable',
            'fuel_surcharge'=>'string|nullable',
            'status'=>'required|in:active,inactive',
        ]);
        
        $data= $request->all();
        
        $data['default_currency']=$data['default_radio_val'][0];
        
         // return $data;   
        $status=Country::create($data);
        if($status){
            request()->session()->flash('success','Country successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('country.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $country=Country::findOrFail($id);
        return view('backend.country.edit')->with('country',$country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // return $request->all();
        $category=Country::findOrFail($id);

        $this->validate($request,[
            'country_name'=>'string|required',
            'country_code'=>'string|required',
            'currency_symbol'=>'string|required',
            'currency'=>'string|required',
            'shipping_charge'=>'string|nullable',
            'fuel_surcharge'=>'string|nullable',
            'status'=>'required|in:active,inactive',
        ]);

        $data= $request->all();

        // if($data['default_radio_val'] == 'country_currency'){
        //     $data['default_currency_symbol']=" ";
        //     $data['default_currencys']      =" ";
        // }
        
         $data['default_currency']=$data['default_radio_val'][0];
        // return $data;
        $status=$category->fill($data)->save();
        if($status){
            request()->session()->flash('success','Category successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $category=Country::findOrFail($id);
        $child_cat_id=Country::where('parent_id',$id)->pluck('id');
        // return $child_cat_id;
        $status=$category->delete();
        
        if($status){
            if(count($child_cat_id)>0){
                Country::shiftChild($child_cat_id);
            }
            request()->session()->flash('success','Country successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting country');
        }
        return redirect()->route('country.index');
    }

    public function showStateCountryWise(Request $request){
        $state_list =  State::where('country_id',$request->id)->pluck('state_name','id');
        if(count($state_list)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$state_list]);
        }
    }
    public function getShippingDetails(Request $request){
        return $request;
    }


    //shipping calculation countrywise
    public function shippingStore(Request $request){
        
        $country=Country::where('id',$request->shipping_country)->first();
        
        if(!$country){
            request()->session()->flash('error','Invalid shipping details, Please try again');
            return back();
        }
        if($country){

            $data = array([
                'id'=>$country->id,
                'country_code'         =>$country->country_code,
                'shipping_country_name'=>$country->country_name,
                'currency_symbol'      =>$country->currency_symbol,
                'currency'             =>$country->currency,
                'shipping_charge'      =>$country->shipping_charge,
                'fuel_surcharge'       =>$country->fuel_surcharge
            ]);
            return response()->json($data);
        }
    }
    

}
