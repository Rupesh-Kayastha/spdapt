<style>
  .attribute-btn {
    position: absolute;
    right: 20px;
    margin-bottom: 20px
  }

  .filter-option{
    height: 40px !important;
  }

  .dropdown-toggle{
    height: 40px !important;
  }

  .bootstrap-select{
    margin-top: 10px !important;
  }
</style>


@extends('backend.layouts.master')



@section('main-content')



<div class="card">

    <h5 class="card-header">Add Product</h5>

    <div class="card-body">

      <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">

      {{csrf_field()}}

      <div class="row">

        <div class="col-xl-6 col-md-6 mb-4">

          <label for="inputTitle" class="col-form-label">Product Title <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}"
            class="form-control">

          @error('title')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

          <label for="inputTitle" class="col-form-label">Product Sub Title </label>

          <input id="inputTitle" type="text" name="product_sub_title" placeholder="Enter product sub title"
            value="{{old('product_sub_title')}}" class="form-control">

          @error('product_sub_title')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

        <div class="col-xl-3 col-md-3 mb-4">

          <label for="inputTitle" class="col-form-label">Flex <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="flex" placeholder="Enter flex" value="{{old('no_of_product_sold')}}"
            class="form-control">

          @error('flex')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

      </div>





      <div class="row">

        <div class="col-xl-6 col-md-6 mb-4">

          <label for="inputTitle" class="col-form-label">Rating <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="rating" placeholder="Enter rating" value="{{old('rating')}}"
            class="form-control">

          @error('rating')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

        <div class="col-xl-6 col-md-6 mb-4">

          <label for="inputTitle" class="col-form-label">No of Product Sold <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="no_of_product_sold" placeholder="Enter no of product sold"
            value="{{old('no_of_product_sold')}}" class="form-control">

          @error('no_of_product_sold')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

      </div>





      <div class="row">

        <div class="col-xl-4 col-md-3 mb-4">

          <label for="inputTitle" class="col-form-label">Hand Orientation <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="hand_orientation" placeholder="Enter hand orientation"
            value="{{old('hand_orientation')}}" class="form-control">

          @error('hand_orientation')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

        <div class="col-xl-4 col-md-3 mb-4">

          <label for="inputTitle" class="col-form-label">Shaft Material <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="shaft_material" placeholder="Enter shaft material"
            value="{{old('shaft_material')}}" class="form-control">

          @error('shaft_material')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>



        <div class="col-xl-4 col-md-3 mb-4">
          <label for="inputTitle" class="col-form-label">Configuration <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="configuration" placeholder="Enter configuration"
            value="{{old('configuration')}}" class="form-control">
          @error('configuration')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>







      <div class="row">

        <div class="col-xl-3 col-md-3 mb-3">

          <label for="inputTitle" class="col-form-label">Volume <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="volume" placeholder="Enter volume" value="{{old('volume')}}"
            class="form-control">

          @error('volume')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

        <div class="col-xl-3 col-md-3 mb-3">

          <label for="inputTitle" class="col-form-label">Length <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="length" placeholder="Enter length" value="{{old('length')}}"
            class="form-control">

          @error('length')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

        <div class="col-xl-3 col-md-3 mb-3">

          <label for="inputTitle" class="col-form-label">Swing weight <span class="text-danger">*</span></label>

          <input id="inputTitle" type="text" name="swing_weight" placeholder="Enter flex"
            value="{{old('swing_weight')}}" class="form-control">

          @error('swing_weight')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>
        <div class="col-xl-3 col-md-3 mb-3">
          <label for="inputTitle" class="col-form-label">Shipping Price </label>
          <input id="inputTitle" type="text" name="shipping_price" placeholder="Enter shipping price"
            value="{{old('shipping_price')}}" class="form-control">
          @error('shipping_price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>




      </div>



      <div class="row">

        <div class="col-xl-6 col-md-6 mb-6 pt-2 pb-3">

          <label for="inputTitle" class="col-form-label" style="color:#4a6fdc;"><b>Is Featured / Top Offers</b> <span
              class="text-danger">*</span></label>

          <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes

        </div>

        <div class="col-xl-6 col-md-6 mb-6 pt-2 pb-3">

          <label for="inputTitle" class="col-form-label" style="color:#4a6fdc;"><b>Is Cross Sell Product</b> <span
              class="text-danger">*</span></label>

          <input type="checkbox" name='is_cross_sell' id='is_cross_sell' value='1' checked> Yes

        </div>

      </div>



      <div class="row">

        <div class="col-xl-3 col-md-3 mb-4">

          <label for="price" class="col-form-label">Price(USD) <span class="text-danger">*</span></label>

          <input inputmode="decimal" type="text" id="float-input" pattern="[0-9]*[.,]?[0-9]*" name="price"
            placeholder="Enter price" value="{{old('price')}}" class="form-control">

          @error('price')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

        <div class="col-xl-3 col-md-3 mb-4">

          <label for="discount" class="col-form-label">Discount(%)</label>

          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"
            value="{{old('discount')}}" class="form-control">

          @error('discount')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>



        <div class="col-xl-6 col-md-6 mb-6 form-input-sec">
          <button type="button" class="btn btn-primary attribute-btn" data-toggle="modal" data-target="#exampleModal">
            Add Flex Attribute
          </button>

          <label for="size">Flex Attribute</label>
          <select name="size[]" class="form-control selectpicker" multiple data-live-search="true"
            style="display: block;
              width: 100%;height:height: 41px !important; padding: 0.375rem 0.75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;

              color: #6e707e;background-color: #fff;background-clip: padding-box;border: 1px solid #d1d3e2;

              border-radius: 0.35rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;background-color: #dde2f1 !important;">
            <option value=" ">--Select any attribute--</option>
            @foreach($flex_attribute as $data)
            <option value="{{$data->flex_name}}">{{ $data->flex_name }}</option>
            @endforeach
          </select>
        </div>

        {{-- <div class="col-xl-6 col-md-6 mb-6 form-input-sec">
          <label for="size">Flex Attribute</label>
          <select name="size[]" class="form-control selectpicker" multiple data-live-search="true"
            style="display: block;
              width: 100%;height: calc(1.5em + 0.75rem + 2px);padding: 0.375rem 0.75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;

              color: #6e707e;background-color: #fff;background-clip: padding-box;border: 1px solid #d1d3e2;

              border-radius: 0.35rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;background-color: #dde2f1 !important;">
            <option value=" ">--Select any attribute--</option>
            <option value="Left Handed">Left Handed</option>
            <option value="Right Handed">Right Handed</option>
            <option value="Regular">Regular</option>
            <option value="Stiff">Stiff</option>
            <option value="XStiff">XStiff</option>
            <option value="X-Stiff Shaft">X-Stiff Shaft</option>
            <option value="RH REG">RH REG</option>
            <option value="RH STIFF">RH STIFF</option>
          </select>
        </div> --}}
      </div>


      <div class="row">
        <div class="col-xl-6 col-md-3 mb-4">
          <label for="stock">Stock Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity" value="{{old('stock')}}"
            class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-6 col-md-3 mb-4">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value=" ">--Select any value--</option>
            <option value="active" selected>Active</option>
            <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>


      <div class="form-group">
        <label for="cat_id">Category <span class="text-danger">*</span></label>
        <select name="cat_id" id="cat_id" class="form-control">
          <option value=" ">--Select any category--</option>
          @foreach($categories as $key=>$cat_data)
          <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
          @endforeach
        </select>
      </div>


      <div class="form-group d-none" id="child_cat_div">
        <label for="child_cat_id">Sub Category</label>
        <select name="child_cat_id" id="child_cat_id" class="form-control">
          <option value=" ">--Select any category--</option>
          {{-- @foreach($parent_cats as $key=>$parent_cat)

          <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>

          @endforeach --}}
        </select>
      </div>

      <div class="form-group">
        <label for="summary" class="col-form-label">About Description <span class="text-danger">*</span></label>
        <textarea class="form-control" id="about_description" name="summary">{{old('summary')}}</textarea>
        @error('summary')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="description" class="col-form-label">Know The Brand</label>
        <textarea class="form-control ckeditor" id="know_the_brand" name="description">{{old('description')}}</textarea>
        @error('description')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="description" class="col-form-label">Product Description</label>
        <textarea class="form-control" id="product_description"
          name="product_description">{{old('product_description')}}</textarea>
        @error('product_description')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="description" class="col-form-label">Technical Details</label>
        <textarea class="form-control ckeditor" id="technical_details"
          name="technical_details">{{old('technical_details')}}</textarea>
        @error('technical_details')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>


      {{-- {{$categories}} --}}





      {{-- <div class="form-group">

        <label for="brand_id">Brand</label>

        {{-- {{$brands}}



        <select name="brand_id" class="form-control">

          <option value="">--Select Brand--</option>

          @foreach($brands as $brand)

          <option value="{{$brand->id}}">{{$brand->title}}</option>

          @endforeach

        </select>

      </div> --}}



      {{-- <div class="form-group">

        <label for="condition">Condition<span class="text-danger">*</span></label>

        <select name="condition" class="form-control">

          <option value="">--Select Condition--</option>

          <option value="default">Default</option>

          <option value="new">New</option>

          <option value="hot">Hot</option>

        </select>

      </div> --}}
      <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span><br>
            <em class="text-danger">For multiple image upload choose image & press ctrl key for multiselect.
            </em></label>
          <input class="form-control" type="file" name="photo[]" multiple accept="image/png, image/gif, image/jpeg">
          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        {{-- <div class="col-xl-6 col-md-6 mb-4">

          <label for="inputPhoto" class="col-form-label">Thumbnail Photo <span class="text-danger">*</span></label>

          <div class="input-group">


            <input type="file" class="form-control" name="thumb_photo[]" multiple
              accept="image/png, image/gif, image/jpeg" value="{{old('thumb_photo')}}" />


          </div>

          <div id="holder" style="margin-top:15px;max-height:100px;"></div>

          @error('thumb_photo')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div> --}}
      </div>

      <div class="card" id="meta" style="cursor: grab;">
        <h5 class="card-header" style="padding: 8px 0px 8px 12px;font-size: 18px;">Add Seo Information</h5>
      </div>

      <div class="row meta_details" style="display:none;">
        <div class="col-xl-6 col-md-6 mb-4">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Meta Title <span class="text-danger">*</span></label>
            <input type="text" name="meta_title" class="form-control" value="{{old('meta_title')}}">
            @error('meta_title')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Meta Keyword <span class="text-danger">*</span></label>
            <input type="text" name="meta_keyword" class="form-control" value="{{old('meta_keyword')}}">
            @error('meta_keyword')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="col-xl-12 col-md-12 mb-12">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Meta Description <span class="text-danger">*</span></label>
            <textarea name="meta_description" class="form-control" rows="2"
              cols="20">{{old('meta_description')}}</textarea>
            @error('meta_description')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="col-xl-12 col-md-12 mb-12">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Extra Code <span class="text-danger">*</span></label>
            <textarea name="extra_code" class="form-control" rows="4" cols="20">{{old('extra_code')}}</textarea>
            @error('extra_code')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
      </div>
      <div class="form-group mt-xl-3">
        <button type="reset" class="btn btn-warning">Reset</button>
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
    </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Flex Attribute</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" action="{{route('flex_attribute.store')}}">
          {{csrf_field()}}
          <div class="form-group">
            <label for="inputTitle" class="col-form-label">Flex Name</label>
            <input id="inputTitle" type="text" name="flex_name" placeholder="Enter Flex Name"
              value="{{old('flex_name')}}" class="form-control">
            @error('flex_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          
          <div class="form-group mb-3">
            {{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-success" type="submit">Submit</button>
          </div>
        </form>

      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>


@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>






{{-- ckeditor code start here --}}

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })
  $(document).ready(function () {
    $('.ckeditor').ckeditor();
  });


  $(document).ready(function() {
    $('#about_description').summernote({
      placeholder: "Write about description.....",
        tabsize: 2,
        height: 100
    });
    $('#know_the_brand').summernote({
      placeholder: "Write product description.....",
        tabsize: 2,
        height: 100
    });
    $('#product_description').summernote({
      placeholder: "Write brand description.....",
        tabsize: 2,
        height: 150
    });
    $('#technical_details').summernote({
      placeholder: "Write brand description.....",
        tabsize: 2,
        height: 150
    });
  
    $("#meta").click(function(){
      $(".meta_details").slideDown();
    });
  });

</script>
@endpush