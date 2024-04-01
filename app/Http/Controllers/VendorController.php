<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Str;
class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::orderBy('id','DESC')->paginate(10);
        return view('backend.vendor.index')->with('vendors',$vendor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|max:50',
            'phone'=>'string|required',
            'contactAddress'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=Vendor::create($data);
        if($status){
            request()->session()->flash('success','Vendor successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding Vendor');
        }
        return redirect()->route('vendor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor=Vendor::findOrFail($id);
        return view('backend.vendor.edit')->with('vendor',$vendor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vednor=Vendor::findOrFail($id);
        $this->validate($request,[
            'name'=>'string|required|max:50',
            'phone'=>'string|required',
            'contactAddress'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=$vednor->fill($data)->save();
        if($status){
            request()->session()->flash('success','Vendor successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating vendor');
        }
        return redirect()->route('vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor=Vendor::findOrFail($id);
        $status=$vendor->delete();
        if($status){
            request()->session()->flash('success','Vendor successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting vendor');
        }
        return redirect()->route('vendor.index');
    }
}
