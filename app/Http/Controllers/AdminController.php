<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Productcont;
use App\Models\Homepagepopup;
use App\Models\Aboutus;
use App\Models\Ourstory;
use App\Models\Menu;
use App\Models\Golfinformation;
use App\Models\Drliveryinformation;
use App\Models\Whychoose;
use App\User;
use App\Rules\MatchOldPassword;
use Hash;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function index(){
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     $array[] = ['Name', 'Number'];
     foreach($data as $key => $value)
     {
       $array[++$key] = [$value->day_name, $value->count];
     }
    //  return $data;
     return view('backend.index')->with('users', json_encode($array));
    }

    public function profile(){
        $profile=Auth()->user();
        // return $profile;
        return view('backend.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id){
        // return $request->all();
        $user=User::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated your profile');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }
        return redirect()->back();
    }

    public function settings(){
        $data=Settings::first();
        return view('backend.setting')->with('data',$data);
    }

    public function homeheding(){
        $data=Settings::first();
        return view('backend.homepageheding')->with('data',$data);
    }

    public function morshinfo(){
        $data=Settings::first();
        return view('backend.morsh-info')->with('data',$data);
    }
    
    public function todaynesw(){
        $data=Settings::first();
        return view('backend.todaynesw')->with('data',$data);
    }

    public function video(){
        $data=Settings::first();
        return view('backend.video')->with('data',$data);
    }


    public function settingsUpdate(Request $request){        
        $data=$request->all();
        $settings=Settings::first();

        if($request->hasFile('home_banner1')) {
            $file = $request->file('home_banner1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner2')) {
            $file = $request->file('home_banner2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner3')) {
            $file = $request->file('home_banner3');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner3']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner4')) {
            $file = $request->file('home_banner4');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner4']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_page_heding_image')) {
            $file = $request->file('home_page_heding_image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_page_heding_image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Setting successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('settings');
    }

    public function settingsHomepageheding(Request $request){        
        $data=$request->all();
        $settings=Settings::first();

        if($request->hasFile('home_banner1')) {
            $file = $request->file('home_banner1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner2')) {
            $file = $request->file('home_banner2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner3')) {
            $file = $request->file('home_banner3');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner3']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner4')) {
            $file = $request->file('home_banner4');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner4']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_page_heding_image')) {
            $file = $request->file('home_page_heding_image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_page_heding_image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Setting successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('homeheding');
    }

    public function morshinfoUpdate(Request $request){        
        $data=$request->all();
        $settings=Settings::first();

        if($request->hasFile('home_banner1')) {
            $file = $request->file('home_banner1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner2')) {
            $file = $request->file('home_banner2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner3')) {
            $file = $request->file('home_banner3');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner3']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner4')) {
            $file = $request->file('home_banner4');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner4']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_page_heding_image')) {
            $file = $request->file('home_page_heding_image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_page_heding_image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Setting successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('morshinfo');
    }

    public function todayneswUpdate(Request $request){        
        $data=$request->all();
        $settings=Settings::first();

        if($request->hasFile('home_banner1')) {
            $file = $request->file('home_banner1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner2')) {
            $file = $request->file('home_banner2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner3')) {
            $file = $request->file('home_banner3');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner3']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner4')) {
            $file = $request->file('home_banner4');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner4']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_page_heding_image')) {
            $file = $request->file('home_page_heding_image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_page_heding_image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Setting successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('todaynesw');
    }

    public function videoUpdate(Request $request){        
        $data=$request->all();
        $settings=Settings::first();

        if($request->hasFile('home_banner1')) {
            $file = $request->file('home_banner1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner2')) {
            $file = $request->file('home_banner2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner3')) {
            $file = $request->file('home_banner3');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner3']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_banner4')) {
            $file = $request->file('home_banner4');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_banner4']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('home_page_heding_image')) {
            $file = $request->file('home_page_heding_image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homeimage-" . time() . "." . $file_extension;
            if($file->move('public/product/',$file_Newname)){
                $data['home_page_heding_image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Setting successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('video');
    }

    
    
    public function productcont(){
        $data=Productcont::first();
        return view('backend.productcont')->with('data',$data);
    }

    public function productcontUpdate(Request $request){
        // return $request->all();
        $this->validate($request,[
            'title1'=>'required|string',
            'content1'=>'required|string',
            'title2'=>'required|string',
            'content2'=>'required|string',
            'title3'=>'required|string',
            'content3'=>'required|string',
        ]);
        $data=$request->all();
        $settings=Productcont::first();
        // return $settings;
        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Text successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('productcont');
    }
    
    
    
    
    public function homepage_popup(){
        $data=Homepagepopup::first();
        return view('backend.homepage_popup')->with('data',$data);
    }

    public function homepage_popupUpdate(Request $request){
        $data=$request->all();
        $Homepagepopup=Homepagepopup::first();
        
        if ($request->has('popup_enable')) {
            $data['popup_enable'] = '1';
            $data['main_heading1'] = $request->input('main_heading1');
            $data['sub_heading1'] = $request->input('sub_heading1');
            $data['sub_title1'] = $request->input('sub_title1');
            $data['main_heading2'] = $request->input('main_heading2');
            $data['sub_heading2'] = $request->input('sub_heading2');
            $data['main_heading3'] = $request->input('main_heading3');
            
            if($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = $file->getClientOriginalName();
                $file_extension = $file->extension();
                $file_size = $file->getSize();
                $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
                if($file->move('public/frontend/images/banner/',$file_Newname)){
                    $data['photo1']= $file_Newname;
                } else {
                    throw new \Exception("Failed to upload document. Please try again after some time.");
                }
            }
            
            $status=$Homepagepopup->fill($data)->save();
            if($status){
                request()->session()->flash('success','Home Page pop up updated');
            }
            else{
                request()->session()->flash('error','Please try again');
            }
        } else {
            $data['popup_enable']   = '0';
    
            $status=$Homepagepopup->fill($data)->save();
            if($status){
                request()->session()->flash('success','Home Page pop up updated');
            }
            else{
                request()->session()->flash('error','Please try again');
            }
        }
        return redirect()->route('homepage_popup');
    }
    
    public function aboutus(){
        $data=Aboutus::first();
        return view('backend.aboutus.index')->with('data',$data);
    }

    public function aboutusUpdate(Request $request){
        $data=$request->all();
        $Homepagepopup=Aboutus::first();
        
        $data['head_line1'] = $request->input('head_line1');;
        $data['head_line2'] = $request->input('head_line2');
        $data['head_line_content1'] = $request->input('head_line_content1');
        $data['head_line_content2'] = $request->input('head_line_content2');
        $data['sub_head_line_content'] = $request->input('sub_head_line_content');
        $data['content'] = $request->input('content');
        
        if($request->hasFile('image1')) {
            $file = $request->file('image1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('image2')) {
            $file = $request->file('image2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        
        $status=$Homepagepopup->fill($data)->save();
        if($status){
            request()->session()->flash('success','Home Page about us updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('aboutus');
    }

    public function ourstory(){
        $data=Ourstory::first();
        return view('backend.ourstory.index')->with('data',$data);
    }

    public function ourstoryUpdate(Request $request){
        $data=$request->all();
        $Homepagepopup=Ourstory::first();
        
        $data['head_line1'] = $request->input('head_line1');;
        $data['head_line2'] = $request->input('head_line2');
        $data['head_line_content1'] = $request->input('head_line_content1');
        $data['head_line_content2'] = $request->input('head_line_content2');
        $data['sub_head_line_content'] = $request->input('sub_head_line_content');
        $data['content'] = $request->input('content');
        
        if($request->hasFile('image1')) {
            $file = $request->file('image1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('image2')) {
            $file = $request->file('image2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        
        $status=$Homepagepopup->fill($data)->save();
        if($status){
            request()->session()->flash('success','Home Page about us updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('ourstory');
    }
    

    public function changePassword(){
        return view('backend.layouts.changePassword');
    }
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->route('admin')->with('success','Password successfully changed');
    }

    // Pie chart
    public function userPieChart(Request $request){
        // dd($request->all());
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     $array[] = ['Name', 'Number'];
     foreach($data as $key => $value)
     {
       $array[++$key] = [$value->day_name, $value->count];
     }
    //  return $data;
     return view('backend.index')->with('course', json_encode($array));
    }

    public function menus(){
        $menus=Menu::where(['sub_menu' => 0])->orderBy('order_by','asc')->get();
        return view('backend.menus.index')->with('menus',$menus);
    }

    public function menuCreate(){
        $orderbyData=Menu::where(['sub_menu' => 0])->orderBy('order_by','asc')->get();
        return view('backend.menus.create')->with('orderbyData',$orderbyData);
    }

    public function menuStore(Request $request) {
        $orderBy = Menu::orderBy('order_by', 'desc')->first();
        $order = ($orderBy != null) ? $orderBy->order_by + 1 : 1;
    
        $data = $request->only(['name', 'url', 'sub_menu', 'status']);
        $data['order_by'] = $order;
    
        $status = Menu::create($data);
    
        if ($status) {
            \Log::info('Home Page menu created');
            $request->session()->flash('success', 'Home Page menu created');
        } else {
            \Log::error('Error creating Home Page menu');
            $request->session()->flash('error', 'Please try again');
        }
    
        return redirect()->route('menus');
    }

    public function menusEdit($id){
        $orderbyData=Menu::where(['sub_menu' => 0])->orderBy('order_by','asc')->get();
        $menu=Menu::find($id);
        return view('backend.menus.edit')->with('menu',$menu)->with('orderbyData',$orderbyData);
    }

    public function menusDelete($id){
        $menu=Menu::find($id);
        $status=$menu->delete();
        return redirect()->route('menus');
    }

    public function menusUpdate(Request $request){
        $data=$request->all();
        $Homepagepopup=Menu::where('id',$request->id)->first();

        if($request->input('sub_menu') == null){
            $orderBy = Menu::where(['sub_menu' => 0])->orderBy('order_by', 'desc')->first();

            $sub_menu = 0;
        } else {
            $orderBy = Menu::where(['sub_menu' => $request->input('sub_menu')])->orderBy('order_by', 'desc')->first();

            $sub_menu = $request->input('sub_menu');
        }

        $data['name'] = $request->input('name');
        $data['url'] = $request->input('url');
        $data['sub_menu'] = $sub_menu;
        $data['status'] = $request->input('status');
        
        $status=$Homepagepopup->fill($data)->save();
        if($status){
            request()->session()->flash('success','Home Page menu updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('menus');
    }

    public function menusDrackanddrop(Request $request){
        $menuOrderBy = 1;
        $submenuOrderBy = 1;
        foreach ($request->menus as $menu) {
            $update = Menu::where('id', $menu['id'])->first();
            $update->order_by = $menuOrderBy;
            $update->save();
            if(isset($menu['submenus']) && $menu['submenus'] != null){
                foreach ($menu['submenus'] as $submenu) {
                    $update = Menu::where('id', $submenu['id'])->first();
                    $update->sub_menu = $menu['id'];
                    $update->order_by = $submenuOrderBy;
                    $update->save();
                    $submenuOrderBy++;
                }
            }
            $menuOrderBy++;
            $submenuOrderBy = 1;
        }
        
        return redirect()->route('menus');
    }

    public function homepageGolfInformation(){
        $golfinformations = Golfinformation::get();
        return view('backend.golfInformation.index')->with('golfinformations',$golfinformations);
    }

    public function golfInformationCreate() {
        return view('backend.golfInformation.create');
    }

    public function golfInformationStore(Request $request) {
        $data=$request->all();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "banner-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        $status=Golfinformation::create($data);

        if($status){
            request()->session()->flash('success','Golf Information successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('homepage_golf_information');
    }

    public function golfInformationEdit($id) {
        $golfinformation = Golfinformation::find($id);
        return view('backend.golfInformation.edit')->with('golfinformation',$golfinformation);
    }

    public function golfInformationUpdate(Request $request) {
        $golfinformation = Golfinformation::find($request->id);
        $data=$request->all();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "banner-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        $status=$golfinformation->fill($data)->save();
        if($status){
            request()->session()->flash('success','Golf Information successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('homepage_golf_information');
    }

    public function golfInformationDelete($id){
        $golfinformation = Golfinformation::find($id);
        $status=$golfinformation->delete();
        if($status){
            request()->session()->flash('success','Banner successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('homepage_golf_information');
    }

    public function drliveryInformation(){
        $drliveryinformations = Drliveryinformation::get();
        return view('backend.drliveryinformation.index')->with('drliveryinformations',$drliveryinformations);
    }

    public function drliveryinformationEdit($id) {
        $drliveryinformation = Drliveryinformation::find($id);
        return view('backend.drliveryinformation.edit')->with('drliveryinformation',$drliveryinformation);
    }

    public function drliveryinformationUpdate(Request $request) {
        $drliveryinformation = Drliveryinformation::find($request->id);
        $data=$request->all();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "banner-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        $status=$drliveryinformation->fill($data)->save();
        if($status){
            request()->session()->flash('success','Drlivery information successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('drlivery_information');
    }

    public function whyChoose(){
        $whychooses = Whychoose::get();
        return view('backend.whychoose.index')->with('whychooses',$whychooses);
    }

    public function whychooseEdit($id) {
        $whychoose = Whychoose::find($id);
        return view('backend.whychoose.edit')->with('whychoose',$whychoose);
    }

    public function whychooseUpdate(Request $request) {
        $whychoose = Whychoose::find($request->id);
        $data=$request->all();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "banner-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        $status=$whychoose->fill($data)->save();
        if($status){
            request()->session()->flash('success','Why Choose successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('why_choose');
    }
}
