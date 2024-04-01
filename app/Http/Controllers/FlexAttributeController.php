<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlexAttribute;

class FlexAttributeController extends Controller
{
    public function index(){   
        // get FAQ ;
        $flex_attribute=FlexAttribute::orderBy('id','ASC')->paginate(10);
        return view('backend.flex_attribute.index',compact('flex_attribute'));
    }
    public function store(Request $request) {
        // return $request;
        $data = $this->validate($request, [
            'flex_name' => 'required',
        ]);

        $data['flex_name'] = $request->flex_name;
        // $data['status'] = $request->status;

        $store = (new FlexAttribute())->storeData($data);
        return redirect()->back()->with('message', 'Data Created Successfully');
    }

    public function edit($id){
        $flex_attribute=FlexAttribute::findOrFail($id);
        return view('backend.flex_attribute.edit',compact('flex_attribute'));
    }

    public function update(Request $request, $id) {
        $banner = (new FlexAttribute())->getDataById($id);
        $data = $this->validate($request, [
            'flex_name' => 'required',
        ]);

        $data['flex_name'] = $request->flex_name;
        // $data['status'] = $request->status;

        $update = (new FlexAttribute())->updateData($data, $id);

        return redirect()->route('flex_attribute.index')->with('message', 'Data Updated');
    }

    public function destroy($id){
        $flex_attribute=FlexAttribute::findOrFail($id);
        $status=$flex_attribute->delete();
        if($status){
            request()->session()->flash('success','Flex Attribute successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting Flex Attribute');
        }
        return redirect()->route('flex_attribute.index');
    }
}
