<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Brand;
use App\Models\FlexAttribute;
//use App\Models\Vendor;
//use App\Models\ProductVendor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(){   
        // get FAQ ;
        $faq=Faq::where('status','active')->orderBy('title','ASC')->get();
        $products = Product::getAllProduct();
        return view('backend.product.index')->with('products',$products)
        ->with('faq_lists ',$faq);
    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */
    public function create(){
        //$vendor = Vendor::get()->where('status','active');
        $brand = Brand::get()->where('status','active');
        $category = Category::where('status','active')->orderBy('id','DESC')->get();
        $flex_attribute = FlexAttribute::orderBy('id','DESC')->get();
        // return $flex_attribute;
        return view('backend.product.create',compact('flex_attribute'))->with('categories',$category)->with('brands',$brand);
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
            'rating'=>'required|numeric',
            'no_of_product_sold'=>'required|numeric',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'is_featured'=>'sometimes|in:1',
            'is_cross_sell'=>'sometimes|in:1',
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric',
            'size'=>'nullable',

            //'brand_id'=>'nullable|exists:brands,id',

            //'vendors.*' => 'exists:vendors,id',

            //'vendors' => 'required|array',

            //'condition'=>'required|in:default,new,hot',

            'stock'=>"required|numeric",
            'status'=>'required|in:active,inactive',
            'meta_title'=>'string|nullable',
            'meta_keyword'=>'string|nullable',
            'meta_description'=>'string|nullable',
            'photo' => 'required',
            'photo.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        $count = Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }

        $data['slug']=$slug;
        //$data['is_featured']=$request->input('is_featured',0);
        $size = $request->input('size');
        if($size){
            $data['size'] = implode(',',$size);
        }
        else{
            $data['size'] = '';
        }
        if($request->hasFile('photo')) {
            foreach($request->file('photo') as $file)
            {
                $fileName       = $file->getClientOriginalName();
                $file_extension = $file->extension();
                $file_Newname   = "product-".rand(10, 999).".".$file_extension;

                if($file->move('public/product/',$file_Newname)){
                    $img_lists[] = $file_Newname;
                } else {
                    request()->session()->flash('error','Failed to upload document. Please try again after some time.');
                }
            }
        $data['photo']= implode(", ",$img_lists);
        } else {
            request()->session()->flash('success','File not found');
        }
        //$data['photo']=json_encode($img_lists);

        

        $status = Product::create($data);
        //$status->vendors()->attach($data['vendors']);

        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
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

    public function edit($id){
        $brand=Brand::get();
        $product=Product::findOrFail($id);
        $category=Category::where('status','active')->get();
        $items=Product::where('id',$id)->get();
        $flex_attribute = FlexAttribute::orderBy('id','DESC')->get();
        // return $items;
        return view('backend.product.edit',compact('flex_attribute'))->with('product',$product)

                    ->with('brands',$brand)

                    ->with('categories',$category)->with('items',$items);
    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
    public function update(Request $request, $id){
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            //'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'is_cross_sell'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
           // 'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric',
        ]);

        $data=$request->all();
        $data['is_featured']=$request->input('is_featured',0);
        
        $data['is_cross_sell']=$request->input('is_cross_sell',0);
        
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }

        // if($request->hasFile('photo')) {
        //     $file = $request->file('photo');
        //     $fileName = $file->getClientOriginalName();
        //     $file_extension = $file->extension();
        //     $file_size = $file->getSize();
        //     $file_Newname = $fileName.rand(10, 100).".".$file_extension;
        //     if($file->move('public/product/',$file_Newname)){
        //     $data['photo'] = $file_Newname;
        //     } else {
        //     request()->session()->flash('error','Failed to upload document. Please try again after some time.');
        //     }
        // } else {
        //     request()->session()->flash('success','File not found');
        // }

        if($request->hasFile('photo')) {
            foreach($request->file('photo') as $file)
            {
                $fileName       = $file->getClientOriginalName();
                $file_extension = $file->extension();
                $file_Newname   = "product-".rand(10, 999).".".$file_extension;

                if($file->move('public/product/',$file_Newname)){
                    $img_lists[] = $file_Newname;
                } else {
                    request()->session()->flash('error','Failed to upload document. Please try again after some time.');
                }
            }
            $data['photo']= implode(",",$img_lists);
        } else {
            request()->session()->flash('success','File not found');
        }

        $data['summary'] = addslashes($request->input('summary'));
        // return $data;
        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id){
        $product=Product::findOrFail($id);
        $status=$product->delete();
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }

    public function removeImage(Request $request, $id) {
        $product = Product::findOrFail($id);
        $photo_lists = explode(',', $product->photo);

        $indexToRemove = $request->input('index');
        Storage::delete($photo_lists[$indexToRemove]);
        unset($photo_lists[$indexToRemove]);
        $product->photo = implode(',', array_values($photo_lists));
        $product->save();

        return response()->json(['success' => 'Image removed successfully']);
    }
}

