<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $banner=Banner::orderBy('id','DESC')->paginate(10);
        return view('backend.banner.index')->with('banners',$banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.banner.create');
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
            'main_heading'=>'string|required|max:250',
            'sub_heading'=>'string|required|max:250',
            'description'=>'string|nullable',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->title);
       // $count=Banner::where('slug',$slug)->count();
        // if($count>0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // }
       // $data['slug']=$slug;
        // return $slug;
        
        
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "banner-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                //$documentname = $file_Newname;
                $data['photo']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        
        $status=Banner::create($data);

        if($status){
            request()->session()->flash('success','Banner successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('banner.index');
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
        $banner=Banner::findOrFail($id);
        return view('backend.banner.edit')->with('banner',$banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $banner=Banner::findOrFail($id);
        $this->validate($request,[
            'main_heading'=>'string|required|max:250',
            'sub_heading'=>'string|required|max:250',
            'description'=>'string|nullable',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        // $slug=Str::slug($request->title);
        // $count=Banner::where('slug',$slug)->count();
        // if($count>0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // }
        // $data['slug']=$slug;
        // return $slug;
        
       
        
        
        
         // Check if a new photo has been uploaded
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "banner-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                //$documentname = $file_Newname;
                $banner['photo']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        
        $banner['main_heading']  = $request->main_heading;
        $banner['sub_heading']   = $request->sub_heading;
        $banner['readmore_text']   = $request->readmore_text;
        $banner['link']          = $request->link;
        $banner['status']        = $request->status;
        
        $status=$banner->save();
        
        if($status){

           return redirect()->route('banner.index');
            
        }
        else{
            request()->session()->flash('error','Error occurred while updating banner');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $banner=Banner::findOrFail($id);
        $status=$banner->delete();
        if($status){
            request()->session()->flash('success','Banner successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
