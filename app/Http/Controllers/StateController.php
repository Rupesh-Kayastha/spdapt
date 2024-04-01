<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Str;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $state=State::orderBy('state_name','DESC')->paginate();
        // return $state;
        return view('backend.state.index')->with('state',$state);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $country_list=Country::orderBy('country_name','ASC')->get();
        return view('backend.state.create')->with('clist',$country_list);
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
            'state_name'=>'string|required',
            'country_id'=>'required|exists:countries,id',
            'status'    =>'required|in:active,inactive',
        ]);
        $data= $request->all();
 
        // return $data;   
        $status=State::create($data);
        if($status){
            request()->session()->flash('success','Country successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('state.index');


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
        return view('backend.state.edit')->with('country',$country);
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
            'shipping_charge'=>'string|nullable',
            'fuel_surcharge'=>'string|nullable',
            'status'=>'required|in:active,inactive',
        ]);

        $data= $request->all();
        // return $data;
        $status=$category->fill($data)->save();
        if($status){
            request()->session()->flash('success','Category successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $category=State::findOrFail($id);
        $child_cat_id=State::where('parent_id',$id)->pluck('id');
        // return $child_cat_id;
        $status=$category->delete();
        
        if($status){
            if(count($child_cat_id)>0){
                State::shiftChild($child_cat_id);
            }
            request()->session()->flash('success','State successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting state');
        }
        return redirect()->route('state.index');
    }

}
