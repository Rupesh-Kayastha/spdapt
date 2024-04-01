<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Brand;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $brand=Brand::orderBy('id','DESC')->paginate();
        return view('backend.brand.index')->with('brands',$brand);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'string|required',
            'logo'=>'required',
        ]);
        $data=$request->all();
        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "gallery-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/backend/gallery/',$file_Newname)){
                $data['logo']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        $status = Brand::create($data);
        if($status){
            request()->session()->flash('success','Brand successfully created');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('brand.index');
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
        $brand=Brand::find($id);
        if(!$brand){
            request()->session()->flash('error','Brand not found');
        }
        return view('backend.brand.edit')->with('brand',$brand);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $brand=Brand::find($id);
        $this->validate($request,[
            'title'=>'string|required',
            'photo'=>'string|nullable',
        ]);
        $data=$request->all();

        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "gallery-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/backend/gallery/',$file_Newname)){
                $data['logo']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
       
        $status=$brand->fill($data)->save();
        if($status){
            request()->session()->flash('success','Brand successfully updated');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $brand=Brand::find($id);
        if($brand){
            $status=$brand->delete();
            if($status){
                request()->session()->flash('success','Brand successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('brand.index');
        }
        else{
            request()->session()->flash('error','Brand not found');
            return redirect()->back();
        }
    }
}
