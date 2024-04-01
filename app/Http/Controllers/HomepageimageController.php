<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepageimage;
use Illuminate\Support\Str;
class HomepageimageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cont=Homepageimage::orderBy('id','DESC')->first();
        return view('backend.homepageimage')->with('data',$cont);
    }

    public function update(Request $request, $id)
    {
        return $id;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Homepageimage::findOrFail($id);
        $status=$banner->delete();
        if($status){
            request()->session()->flash('success','Content successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
