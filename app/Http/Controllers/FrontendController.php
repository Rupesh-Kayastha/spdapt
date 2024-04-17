<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\Testimonial;
use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }
    public function home()
    {
        return view('frontend.index');
    }

    public function fairwayWood(){
        $products_lists = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(20)->get();
        return view('frontend.pages.fairway-wood')
            ->with('plist', $products_lists);
    }

    public function allCatagory(){
        $categorys = Category::where('status', 'active')->get();
        return view('frontend.pages.product')->with('categorys', $categorys);
    }

    public function productCategory($id){

        if(is_numeric($id))
        {
            $products_lists = Product::where('status', 'active')->where('cat_id', $id)->orderBy('id', 'DESC')->get();
        }
        else
        {
                $catg_slug = $id;
                $catg_id = Category::where('slug',$id)->value('id');
                $products_lists = Product::where('status', 'active')->where('cat_id', $catg_id)->orderBy('id', 'DESC')->get();
           
        }
        return view('frontend.pages.catagory-product')->with('plist', $products_lists);
    }
    
    public function testing(){
        return view('frontend.pages.testing');
    }
    

    public function golfBalls(){
        $golf_ball_list = Product::where('cat_id', '2')->where('status', 'active')->orderBy('id', 'DESC')->limit(20)->get();
        return view('frontend.pages.golf-ball')
            ->with('golf_list', $golf_ball_list);
    }

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function guarantee(){
        return view('frontend.pages.guarantee');
    }
    public function affiliates(){
        return view('frontend.pages.affiliates');
    }
    public function partners(){
        return view('frontend.pages.partners');
    }

    public function thankyou(){
        return view('frontend.pages.thankyou');
    }
    public function thanks(){
        return view('frontend.pages.thanks');
    }

    public function gallery(){
        return view('frontend.pages.gallery');
    }

    public function ourStory(){
        return view('frontend.pages.our-story');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function deliveryInformation(){
        return view('frontend.pages.delivery-information');
    }

    public function privacy(){
        return view('frontend.pages.privacy');
    }

    public function terms(){
        return view('frontend.pages.terms');
    }

    public function returns(){
        return view('frontend.pages.returns');
    }

    public function productDetail($slug){
        $product_detail = Product::getProductBySlug($slug);
        // dd($product_detail);
        return view('frontend.pages.product_detail')->with('product_detail', $product_detail);
    }

    public function productGrids(){
        $products = Product::query();
        if (!empty($_GET['category'])) {
            $slug = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
            $products->whereIn('cat_id', $cat_ids);
        }

        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id', $brand_ids);
        }

        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'title') {
                $products = $products->where('status', 'active')->orderBy('title', 'ASC');
            }

            if ($_GET['sortBy'] == 'price') {
                $products = $products->orderBy('price', 'ASC');
            }
        }

        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            $products->whereBetween('price', $price);
        }

        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        // Sort by number
        if (!empty($_GET['show'])) {
            $products = $products->where('status', 'active')->paginate($_GET['show']);
        } else {
            $products = $products->where('status', 'active')->paginate(9);
        }
        // Sort by name , price, category

        return view('frontend.pages.product-grids')->with('products', $products)->with('recent_products', $recent_products);
    }

    public function productLists(){
        $products = Product::query();
        if (!empty($_GET['category'])) {
            $slug = explode(',', $_GET['category']);
            // dd($slug);
            $cat_ids = Category::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id', $cat_ids)->paginate;
            // return $products;
        }

        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id', $brand_ids);
        }

        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'title') {
                $products = $products->where('status', 'active')->orderBy('title', 'ASC');
            }

            if ($_GET['sortBy'] == 'price') {
                $products = $products->orderBy('price', 'ASC');
            }
        }

        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            // return $price;

            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));

            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            $products->whereBetween('price', $price);
        }

        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        // Sort by number
        if (!empty($_GET['show'])) {
            $products = $products->where('status', 'active')->paginate($_GET['show']);
        } else {
            $products = $products->where('status', 'active')->paginate(6);
        }

        // Sort by name , price, category
        return view('frontend.pages.product-lists')->with('products', $products)->with('recent_products', $recent_products);
    }

    public function productFilter(Request $request)
    {
        $data = $request->all();
        // return $data;
        $showURL = "";
        if (!empty($data['show'])) {
            $showURL .= '&show=' . $data['show'];
        }

        $sortByURL = '';
        if (!empty($data['sortBy'])) {
            $sortByURL .= '&sortBy=' . $data['sortBy'];
        }

        $catURL = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catURL)) {
                    $catURL .= '&category=' . $category;
                } else {
                    $catURL .= ',' . $category;
                }
            }
        }

        $brandURL = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandURL)) {
                    $brandURL .= '&brand=' . $brand;
                } else {
                    $brandURL .= ',' . $brand;
                }
            }
        }
        // return $brandURL;

        $priceRangeURL = "";
        if (!empty($data['price_range'])) {
            $priceRangeURL .= '&price=' . $data['price_range'];
        }

        if (request()->is('e-shop.loc/product-grids')) {
            return redirect()->route('product-grids', $catURL . $brandURL . $priceRangeURL . $showURL . $sortByURL);
        } else {
            return redirect()->route('product-lists', $catURL . $brandURL . $priceRangeURL . $showURL . $sortByURL);
        }
    }

    public function productSearch(Request $request){
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        $products = Product::orwhere('title', 'like', '%' . $request->search . '%')
            ->orwhere('slug', 'like', '%' . $request->search . '%')
            ->orwhere('description', 'like', '%' . $request->search . '%')
            ->orwhere('summary', 'like', '%' . $request->search . '%')
            ->orwhere('price', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate('9');
        return view('frontend.pages.product-grids')->with('products', $products)->with('recent_products', $recent_products);
    }

    public function productBrand(Request $request){
        $products = Brand::getProductByBrand($request->slug);
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        if (request()->is('e-shop.loc/product-grids')) {
            return view('frontend.pages.product-grids')->with('products', $products->products)->with('recent_products', $recent_products);
        } else {
            return view('frontend.pages.product-lists')->with('products', $products->products)->with('recent_products', $recent_products);
        }
    }

    public function productCat(Request $request){
        $products = Category::getProductByCat($request->slug);
        // return $request->slug;
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        if (request()->is('e-shop.loc/product-grids')) {
            return view('frontend.pages.product-grids')->with('products', $products->products)->with('recent_products', $recent_products);
        } else {
            return view('frontend.pages.product-lists')->with('products', $products->products)->with('recent_products', $recent_products);
        }
    }

    public function productSubCat(Request $request){
        $products = Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products = Product::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        if (request()->is('e-shop.loc/product-grids')) {
            return view('frontend.pages.product-grids')->with('products', $products->sub_products)->with('recent_products', $recent_products);
        } else {
            return view('frontend.pages.product-lists')->with('products', $products->sub_products)->with('recent_products', $recent_products);
        }
    }

    public function blog(){
        $post = Post::query();
        if (!empty($_GET['category'])) {
            $slug = explode(',', $_GET['category']);
            // dd($slug);
            $cat_ids = PostCategory::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
            return $cat_ids;
            $post->whereIn('post_cat_id', $cat_ids);
            // return $post;
        }

        if (!empty($_GET['tag'])) {
            $slug = explode(',', $_GET['tag']);
            // dd($slug);
            $tag_ids = PostTag::select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
            // return $tag_ids;
            $post->where('post_tag_id', $tag_ids);
            // return $post;
        }

        if (!empty($_GET['show'])) {
            $post = $post->where('status', 'active')->orderBy('id', 'DESC')->paginate($_GET['show']);
        } else {
            $post = $post->where('status', 'active')->orderBy('id', 'DESC')->paginate(9);
        }
        // $post=Post::where('status','active')->paginate(8);
        $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts', $post)->with('recent_posts', $rcnt_post);
    }



    public function blogDetail($slug){
        $post = Post::getPostBySlug($slug);
        $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        // return $post;
        return view('frontend.pages.blog-detail')->with('post', $post)->with('recent_posts', $rcnt_post);
    }


    public function blogSearch(Request $request){
        $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        $posts = Post::orwhere('title', 'like', '%' . $request->search . '%')
            ->orwhere('quote', 'like', '%' . $request->search . '%')
            ->orwhere('summary', 'like', '%' . $request->search . '%')
            ->orwhere('description', 'like', '%' . $request->search . '%')
            ->orwhere('slug', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('frontend.pages.blog')->with('posts', $posts)->with('recent_posts', $rcnt_post);
    }


    public function blogCategory($id){
        $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        $posts = Post::where('status', 'active')->where('post_cat_id', $id)->orderBy('id', 'DESC')->paginate(20);
        return view('frontend.pages.blog')->with('posts', $posts)->with('recent_posts', $rcnt_post);
    }



    public function blogFilter(Request $request) {
        $data = $request->all();
        // return $data;
        $catURL = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catURL)) {
                    $catURL .= '&category=' . $category;
                } else {
                    $catURL .= ',' . $category;
                }
            }
        }

        $tagURL = "";
        if (!empty($data['tag'])) {
            foreach ($data['tag'] as $tag) {
                if (empty($tagURL)) {
                    $tagURL .= '&tag=' . $tag;
                } else {

                    $tagURL .= ',' . $tag;
                }
            }
        }
        // return $tagURL;
        // return $catURL;
        return redirect()->route('blog', $catURL . $tagURL);
    }



    public function blogByCategory(Request $request){
        $post = PostCategory::getBlogByCategory($request->slug);
        $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts', $post)->with('recent_posts', $rcnt_post);
    }



    public function blogByTag($slug){
        $rcnt_post = Post::where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();
        $posts = Post::orwhere('tags', 'like', '%' . $slug . '%')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('frontend.pages.blog')->with('posts', $posts)->with('recent_posts', $rcnt_post);
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }

    public function loginSubmit(Request $request){
        $data = $request->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 'active'])) {
            Session::put('user', $data['email']);

            $user_idData = session()->get('USER_TEMP_ID');

            request()->session()->flash('success', 'Successfully login');
            return redirect()->route('user');
        } else {
            request()->session()->flash('error', 'Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        //request()->session()->flash('success','Logout successfully');
        return redirect()->route('home');
    }

    public function register(){
        return view('frontend.pages.register');
    }

    public function referralcode(){
        return view('frontend.referralcode');
    }

    public function registerSubmit(Request $request){

        // return $request->all();
        $this->validate($request, [
            'name' => 'string|required|min:2',
            'email' => 'string|required|unique:users,email',
            'password' => 'required|min:6|confirmed',

        ]);
        $data = $request->all();
        $check = $this->create($data);
        Session::put('user', $data['email']);
        $datais = [
            'name' => $request->name,
            'to' => $request->email,
            'subject' => "Sign up successful. On " . date('Y-m-d H:i:sA') . " || SPDAPT"
        ];
        // Mail::send('mail.signup',$datais, function($messages) use ($datais){
        //     $messages->to($datais['to']);
        //     $messages->subject($datais['subject']);
        // });

        if ($check) {
            request()->session()->flash('success', 'Successfully registered');
            return redirect()->route('login.form');
        } else {
            request()->session()->flash('error', 'Please try again!');
            return back();
        }
    }

    public function registerReferralcode(Request $request){
        $this->validate($request, [
            'name' => 'string|required|min:2',
            'email' => 'string|required|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone_no' => 'required|min:10',
            'referralcode' => 'required',

        ]);
        $data = $request->all();
        // $check = $this->create($data);
        $check = "rupesh";
        Session::put('user', $data['email']);
        $datais = [
            'name' => $request->name,
            'to' => $request->email,
            'subject' => "Sign up successful. On " . date('Y-m-d H:i:sA') . " || SPDAPT"
        ];
        // Mail::send('mail.signup',$datais, function($messages) use ($datais){
        //     $messages->to($datais['to']);
        //     $messages->subject($datais['subject']);
        // });

        if ($check) {
            $level1Data = DB::table('users')->where('phone_no', $data['referralcode'])->first();
            $level2Data = Brand::where("userid", $level1Data->id)->first();
            $level3Data = Brand::where("userid", $level2Data->level2)->first();

            dd($level2Data);

            $brand = New Brand;
            $brand->userid = $check->id;
            $brand->level1 = $level1Data->id;
            $brand->level2 = $level2Data->level1;
            $brand->level3 = $level3Data->level2;
            $brandsave = $brand->save();

            if($brandsave){
                request()->session()->flash('success', 'Successfully registered');
                return redirect()->route('login.form');
            } else {
                request()->session()->flash('error', 'Please try again!');
                return back(); 
            }
        } else {
            request()->session()->flash('error', 'Please try again!');
            return back();
        }
    }

    public function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'password' => Hash::make($data['password']),
            'status' => 'active'
        ]);
    }

    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }



    public function subscribe(Request $request) {
        if (!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribePending($request->email);
            if (Newsletter::lastActionSucceeded()) {
                $settings = DB::table('settings')->get();
                $datais = [
                    'to' => $settings[0]->email,
                    'subject' => "Thank You for Subscribing to Newsletter .|| Morshgolf"
                ];
                Mail::send('mail.stayintouch',$datais, function($messages) use ($datais){
                    $messages->to($datais['to']);
                    $messages->subject($datais['subject']);
                });
                request()->session()->flash('success', 'Subscribed! Please check your email');
                return redirect()->route('home');
            } else {
                Newsletter::getLastError();
                return back()->with('error', 'Something went wrong! please try again');
            }
        } else {
            request()->session()->flash('error', 'Already Subscribed');
            return back();
        }
    }

    public function setCurrency(Request $request){
        Session::put('currency', $request->currency);
        return response()->json(['status'=>true,'msg'=>'','data'=>null]);
    }

    public function shop(){
        $shops = Product::where('status', 'active')->get();
        return view('frontend.pages.shop',compact('shops'));
    }

    public function cronjob_abondedcart_email()
    {
        $abondedcarts = Cart::join('users','users.id','=','carts.user_id')
                        ->select('user_id')
                        ->where('user_id','!=','1')
                        ->where(["order_id" => NULL, "user_type" => "reg"])
                        ->orderBy('users.id','asc')
                        ->get();

        //$abondedcarts =DB::table('carts')->where(["order_id" => NULL, "user_type" => "reg"])->orderBy('id','asc')->get();
        
        foreach($abondedcarts as $res_data)
        {

            $user_data = User::where('id',$res_data->user_id)->first();

            $buyer_email = $user_data->email;

            // $datais = [
            //     'to' => $buyer_email,
            //     'subject' => "Complete Checkout Process cart items || Morshgolf",
            //     'total_amount' => session('symbol') . "" . $order_data_mail->total_amount,
            //     'sub_total' => session('symbol') . "" . $order_data_mail->sub_total ?? 0,
            //     'coupon' => session('symbol') . "" . $order_data_mail->coupon ?? 0,
            //     'coupon_amnt' => $order_data_mail->coupon,
            //     'orderDetails' => $orderDetails,
            //     'email' => auth()->user()->email,
               
            // ];

            // Mail::send('mail.userabonded_cart',$datais, function($messages) use ($datais){
            //     $messages->to($datais['to']);
            //     $messages->subject($datais['subject']);
            // });

            echo $buyer_email;
        }

    }
}
