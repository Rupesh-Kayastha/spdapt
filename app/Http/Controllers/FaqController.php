<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Str;
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $faq=Faq::orderBy('id','DESC')->paginate(10);
        return view('backend.faq.index')->with('faqs',$faq);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'string|required|max:550',
            'description'=>'string|nullable',
        ]);
        $data=$request->all();
   
       // $count=Banner::where('slug',$slug)->count();
        // if($count>0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // }
       // $data['slug']=$slug;
        // return $slug;
        $status=Faq::create($data);

        if($status){
            
            request()->session()->flash('success','FAQ successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding FAQ');
        }
        return redirect()->route('faq.index');
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
        $faq=Faq::findOrFail($id);
        return view('backend.faq.edit')->with('faq',$faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $faq=Faq::findOrFail($id);
        $this->validate($request,[
            'title'      =>'string|required|max:550',
            'description'=>'string|nullable',
            'status'     =>'required|in:active,inactive'
        ]);
        $data=$request->all();
        // $slug=Str::slug($request->title);
        // $count=Banner::where('slug',$slug)->count();
        // if($count>0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // }
        // $data['slug']=$slug;
        // return $slug;
        $status=$faq->fill($data)->save();
       
        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $faq=Faq::findOrFail($id);
        $status=$faq->delete();
        if($status){
            request()->session()->flash('success','FAQ successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting FAQ');
        }
        return redirect()->route('faq.index');
    }
}
