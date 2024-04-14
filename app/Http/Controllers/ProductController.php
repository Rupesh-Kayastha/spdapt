<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
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

     public function index()
    {   
        $products = Product::where('status', 'active')->orderBy('title', 'ASC')->paginate(10); // Assuming 10 products per page
        return view('backend.product.index', compact('products'));
    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */
    public function create(){
    
        // return $flex_attribute;
        return view('backend.product.create');
    }
    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'lock_days' => 'required',
            'owner' => 'required',
            'photo' => 'required|array',
            'photo.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);
        $imgLists = [];
        foreach ($request->file('photo') as $file) {
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->extension();
            $fileNewName = "product-" . rand(10, 999) . "." . $fileExtension;

            if ($file->move('public/product/', $fileNewName)) {
                $imgLists[] = $fileNewName;
            } else {
                return redirect()->back()->with('error', 'Failed to upload document. Please try again after some time.');
            }
        }

        try {
            $product = new Product();
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->lock_days = $request->lock_days;
            $product->owner = $request->owner;
            $product->status = $request->status;
            $product->photo = implode(", ", $imgLists);
            $product->save();
        
            return redirect()->route('product.index')->with('success', 'Product successfully added');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add product. Please try again later.');
        }
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
       $product=Product::findOrFail($id);
        return view('backend.product.edit',compact('product'));

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
        // Find the product by ID
        $product = Product::findOrFail($id);
    
        // Validate the request data
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'lock_days' => 'required',
            'owner' => 'required',
            'photo' => 'required|array',
            'photo.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);
    
        // Initialize an empty array to store image filenames
        $img_lists = [];
    
        // Process the 'is_featured' and 'is_cross_sell' fields if present in the request
        $data = $request->all();
    
        // Process the 'size' field
        $size = $request->input('size');
        $data['size'] = $size ? implode(',', $size) : '';
    
        // Check if there are uploaded files in the 'photo' field
        if ($request->hasFile('photo')) {
            // Process each uploaded file
            foreach ($request->file('photo') as $file) {
                // Generate a new filename for the image
                $fileName = $file->getClientOriginalName();
                $file_extension = $file->extension();
                $file_Newname = "product-" . rand(10, 999) . "." . $file_extension;
    
                // Move the uploaded file to the 'public/product/' directory
                if ($file->move('public/product/', $file_Newname)) {
                    // Store the filename in the array
                    $img_lists[] = $file_Newname;
                } else {
                    // Display an error message if file upload fails
                    request()->session()->flash('error', 'Failed to upload document. Please try again after some time.');
                }
            }
            // Update the 'photo' field with a comma-separated list of image filenames
            $data['photo'] = implode(",", $img_lists);
        } else {
            // Display a success message if no files are found
            request()->session()->flash('success', 'File not found');
        }
    
        // Attempt to update the product with the new data
        $status = $product->fill($data)->save();
    
        // Display success or error messages based on the update status
        if ($status) {
            request()->session()->flash('success', 'Product Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
    
        // Redirect back to the product index page
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

