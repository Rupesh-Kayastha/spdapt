<style>
  .btn-sec i {
    color: red;
    font-size: 15px;
    position: relative;
    left: -1px;
    top: -7px;
  }

  .attribute-btn {
    position: absolute;
    right: 20px;
    margin-bottom: 20px
  }

  .filter-option {
    height: 40px !important;
  }

  .dropdown-toggle {
    height: 40px !important;
  }

  .bootstrap-select {
    margin-top: 10px !important;
  }
</style>

@extends('backend.layouts.master')
@section('main-content')
<div class="card">
  <h5 class="card-header">Edit Product <a style="float:right;" target="_blank" href="{{url('/')}}/shop/{{$product->slug}}">Visit Product Page<i class="fas fa-link" style="width:20px"></i></a></h5> 
  <div class="card-body">
    <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
          <label for="inputTitle" class="col-form-label">Product Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$product->title}}"
            class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <label for="inputTitle" class="col-form-label">Product Sub Title </label>
          <input id="inputTitle" type="text" name="product_sub_title" placeholder="Enter sub title"
            value="{{$product->product_sub_title}}" class="form-control">
          @error('product_sub_title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-3 col-md-3 mb-4">
          <label for="inputTitle" class="col-form-label">Flex <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="flex" placeholder="Enter flex" value="{{$product->flex}}"
            class="form-control">
          @error('flex')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
          <label for="inputTitle" class="col-form-label">Rating <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="rating" placeholder="Enter rating" value="{{$product->rating}}"
            class="form-control">
          @error('rating')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
          <label for="inputTitle" class="col-form-label">No of Product Sold <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="no_of_product_sold" placeholder="Enter no of product sold"
            value="{{$product->no_of_product_sold}}" class="form-control">
          @error('no_of_product_sold')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>


      <div class="row">
        <div class="col-xl-4 col-md-3 mb-4">
          <label for="inputTitle" class="col-form-label">Hand Orientation <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="hand_orientation" placeholder="Enter hand orientation"
            value="{{$product->hand_orientation}}" class="form-control">
          @error('hand_orientation')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-4 col-md-3 mb-4">
          <label for="inputTitle" class="col-form-label">Shaft Material <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="shaft_material" placeholder="Enter shaft material"
            value="{{$product->shaft_material}}" class="form-control">
          @error('shaft_material')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-4 col-md-3 mb-4">
          <label for="inputTitle" class="col-form-label">Configuration <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="configuration" placeholder="Enter configuration"
            value="{{$product->configuration}}" class="form-control">
          @error('configuration')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-xl-3 col-md-3 mb-3">
          <label for="inputTitle" class="col-form-label">Volume <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="volume" placeholder="Enter volume" value="{{$product->volume}}"
            class="form-control">
          @error('volume')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-3 col-md-3 mb-3">
          <label for="inputTitle" class="col-form-label">Length <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="length" placeholder="Enter length" value="{{$product->length}}"
            class="form-control">
          @error('length')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-3 col-md-3 mb-3">
          <label for="inputTitle" class="col-form-label">Swing weight <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="swing_weight" placeholder="Enter flex"
            value="{{$product->swing_weight}}" class="form-control">
          @error('swing_weight')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-3 col-md-3 mb-3">
          <label for="inputTitle" class="col-form-label">Shipping Price </label>
          <input id="inputTitle" type="text" name="shipping_price" placeholder="Enter shipping price"
            value="{{$product->shipping_price}}" class="form-control">
          @error('shipping_price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6 pt-2 pb-3">
          <label for="inputTitle" class="col-form-label" style="color:#4a6fdc;"><b>Is Featured / Top Offers</b> <span
              class="text-danger">*</span></label>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' {{(($product->is_featured) ? 'checked' :
          '')}}> Yes
        </div>


        <div class="col-xl-6 col-md-6 mb-6 pt-2 pb-3">
          <label for="inputTitle" class="col-form-label" style="color:#4a6fdc;"><b>Is Cross Sell Product</b> <span
              class="text-danger">*</span></label>
          <input type="checkbox" name='is_cross_sell' id='is_cross_sell' value='1' {{(($product->is_cross_sell) ?
          'checked' : '')}}> Yes
        </div>
      </div>



      <div class="row">
        <div class="col-xl-3 col-md-3 mb-4">
          <label for="price" class="col-form-label">Price(USD) <span class="text-danger">*</span></label>
          <input inputmode="decimal" id="float-input" pattern="[0-9]*[.,]?[0-9]*" type="text" name="price"
            placeholder="Enter price" value="{{$product->price}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-3 col-md-3 mb-4">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"
            value="{{$product->discount}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-6 col-md-6 mb-6 form-input-sec">

          <button type="button" class="btn btn-primary attribute-btn" data-toggle="modal" data-target="#exampleModal">
            Add Flex Attribute
          </button>

          <label for="size">Flex Attribute</label>
          <select name="size[]" class="form-control selectpicker" multiple data-live-search="true">
            <option value=" ">--Select any attribute--</option>

            

            @foreach($flex_attribute as $data)
            
            <option value="{{ $data->flex_name}}" <?=isset($product->size) && in_array($data->flex_name,
              explode(",", $product->size)) ? 'selected="selected"' : "" ?> >{{
              $data->flex_name}}</option>
            @endforeach

            {{-- @foreach($items as $item)
            @php $data=explode(',',$item->size); @endphp
            <option value="Left Handed" @if( in_array( "Left Handed" ,$data ) ) selected @endif>Left Handed</option>
            <option value="Right Handed" @if( in_array( "Right Handed" ,$data ) ) selected @endif>Right Handed</option>
            <option value="Regular" @if( in_array( "Regular" ,$data ) ) selected @endif>Regular</option>
            <option value="Stiff" @if( in_array( "Stiff" ,$data ) ) selected @endif>Stiff</option>
            <option value="XStiff" @if( in_array( "Xstiff" ,$data ) ) selected @endif>XStiff </option>
            <option value="X-Stiff Shaft" @if( in_array( "X-Stiff Shaft" ,$data ) ) selected @endif>X-Stiff Shaft
            </option>
            <option value="RH REG" @if( in_array( "RH REG" ,$data ) ) selected @endif>RH REG</option>
            <option value="RH STIFF" @if( in_array( "RH STIFF" ,$data ) ) selected @endif>RH STIFF</option>
            @endforeach --}}
          </select>
        </div>
      </div>


      <div class="row">
        <div class="col-xl-6 col-md-3 mb-4">
          <label for="stock">Stock Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"
            value="{{$product->stock}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-6 col-md-3 mb-4">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>


      <div class="form-group">
        <label for="cat_id">Category <span class="text-danger">*</span></label>
        <select name="cat_id" id="cat_id" class="form-control">
          <option value="">--Select any category--</option>
          @foreach($categories as $key=>$cat_data)
          <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' :
            '')}}>{{$cat_data->title}}</option>
          @endforeach
        </select>
      </div>
      @php
      $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
      // dd($sub_cat_info);
      @endphp

      {{-- {{$product->child_cat_id}} --}}
      <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
        <label for="child_cat_id">Sub Category</label>
        <select name="child_cat_id" id="child_cat_id" class="form-control">
          <option value="">--Select any sub category--</option>
        </select>
      </div>


      <div class="form-group">
        <label for="summary" class="col-form-label">About Description <span class="text-danger">*</span></label>
        <textarea class="form-control" id="about_description"
          name="summary">{!! stripslashes($product->summary) !!}</textarea>
        @error('summary')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="description" class="col-form-label">Know The Brand</label>
        <textarea class="form-control" id="know_the_brand" name="description">
            {!! stripslashes($product->description) !!}</textarea>
        @error('description')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="description" class="col-form-label">Product Description</label>
        <textarea class="form-control" id="product_description" name="product_description">
            {!! stripslashes($product->product_description) !!}</textarea>
        @error('product_description')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>


      <div class="form-group">
        <label for="description" class="col-form-label">Technical Details</label>
        <textarea class="form-control" id="technical_details" name="technical_details">
            {!! $product->technical_details !!}</textarea>
        @error('technical_details')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      {{-- <div class="form-group">

        <label for="brand_id">Brand</label>

        <select name="brand_id" class="form-control">

          <option value="">--Select Brand--</option>

          @foreach($brands as $brand)

          <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}
          </option>

          @endforeach

        </select>

      </div> --}}



      {{-- <div class="form-group">

        <label for="condition">Condition</label>

        <select name="condition" class="form-control">

          <option value="">--Select Condition--</option>

          <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Default</option>

          <option value="new" {{(($product->condition=='new')? 'selected':'')}}>New</option>

          <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Hot</option>

        </select>

      </div> --}}

      <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span>
            <br>
            <em class="text-danger">For multiple image upload choose image & press ctrl key for multiselect.
            </em></label>
          <input class="form-control" type="file" name="photo[]" multiple accept="image/png, image/gif, image/jpeg">
          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror

          @if($product->photo)
          @php
          $photo_lists = explode(',',$product->photo);
          @endphp

          <div class="btn-sec d-flex" style="gap: 8px">
            @foreach($photo_lists as $index => $list_pp)
            <div class="image-container" style="display: flex;">
              <img src="{{ url('/public/product/') }}/{{ $list_pp }}" class="img-fluid zoom" style="max-width:80px"
                alt="{{$product->photo}}">
              <i class="fa fa-times remove-image" aria-hidden="true" data-index="{{ $index }}"></i>
            </div>
            @endforeach
          </div>
          @endif
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

      <div class="row meta_details" @if(isset($product->meta_title) && $product->meta_title!="") style="display:block;"
        @else style="display:none;" @endif >
        <div class="col-xl-6 col-md-6 mb-4">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Meta Title <span class="text-danger">*</span></label>
            <input type="text" name="meta_title" class="form-control" value="{{$product->meta_title}}">
            @error('meta_title')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Meta Keyword <span class="text-danger">*</span></label>
            <input type="text" name="meta_keyword" class="form-control" value="{{$product->meta_keyword}}">
            @error('meta_keyword')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>

        <div class="col-xl-12 col-md-12 mb-12">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Meta Description <span class="text-danger">*</span></label>
            <textarea name="meta_description" class="form-control" rows="2"
              cols="20">{{$product->meta_description}}</textarea>
            @error('meta_description')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>


        <div class="col-xl-12 col-md-12 mb-12">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Extra Code <span class="text-danger">*</span></label>
            <textarea name="extra_code" class="form-control" rows="4" cols="20">{{$product->extra_code}}</textarea>
            @error('extra_code')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
      </div>

      <div class="form-group mt-xl-3">
        <a href="{{ url('admin/product') }}" class="btn btn-primary">Cancel</a>
        <button class="btn btn-success" type="submit">Update</button>
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

          {{-- <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
            @error('status')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div> --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
{{-- ckeditor code start here --}}

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

{{-- ckeditor code end here --}}
<script>
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

  $(document).on('click', '.remove-image', function(){
    var index = $(this).data('index');
    $.ajax({
      url: '{{ route("product.removeImage", ["id" => $product->id]) }}',
      method: 'DELETE',
      data: {
        index: index,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        $('.image-container').eq(index).remove();
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  });

  // $(document).ready(function() {
  //   var button = $(".dropdown-toggle.btn-light");
  //   button.css({
  //     "height": "40px",
  //   });
  // });
</script>



<script>
  var  child_cat_id='{{$product->child_cat_id}}';

  $('#cat_id').change(function(){
      var cat_id=$(this).val();
      if(cat_id !=null){
          // ajax call
          $.ajax({
              url:"/admin/category/"+cat_id+"/child",
              type:"POST",
              data:{
                  _token:"{{csrf_token()}}"
              },

              success:function(response){
                  if(typeof(response)!='object'){
                      response=$.parseJSON(response);
                  }
                  var html_option="<option value=''>--Select any one--</option>";
                  if(response.status){
                      var data=response.data;
                      if(response.data){
                          $('#child_cat_div').removeClass('d-none');
                          $.each(data,function(id,title){
                              html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                          });
                      }
                      else{
                          console.log('no response data');
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
  });

  if(child_cat_id!=null){
      $('#cat_id').change();
  }

</script>
@endpush