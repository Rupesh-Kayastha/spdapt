@extends('backend.layouts.master')



@section('main-content')
  <div class="card">
    <h5 class="card-header">Edit Category

    <a style="float:right;" target="_blank" href="{{url('/')}}/product-category/{{$category->slug}}"><i class="fas fa-link"></i>View Products in Category</a>
    </h5>
    <div class="card-body">
      <form method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{ $category->title }}"
            class="form-control">
          @error('title')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="summary" class="col-form-label">Summary</label>
          <textarea class="form-control" id="summary" name="summary">{{ $category->summary }}</textarea>
          @error('summary')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Catagory Image <span class="text-danger">*</span></label>
          <input type="file" name="photo" value="{{ old('photo') }}" class="form-control">
          @error('photo')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <img src="{{ asset('frontend/images/banner/' . $category->photo) }}" class="img-fluid zoom"
          style="max-width:120px" alt="{{ $category->photo }}">
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
          @error('status')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
      

      @if(count($products)>0)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Photo</th>
              <th>Title</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Photo</th>
              <th>Title</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody> 
            @foreach($products as $product)
              @php
                $category = DB::table('categories')->select('title')->where('id',$product->cat_id)->get();
                $brands=DB::table('brands')->select('title')->where('id',$product->brand_id)->get();
              @endphp
              <tr>               
                  <td>{{$product->id}}</td>
                  <td>
                    @if($product->photo)
                      @php
                        $photo=explode(',',$product->photo);
                      @endphp
                      <img src="{{ url('/public/product/') }}/{{ $photo[0] }}" class="img-fluid zoom" style="max-width:80px" alt="{{$product->photo}}">
                    @else
                      <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                    @endif
                  </td>
                  <td>{{$product->title}}</td>
                  <td>${{number_format($product->price,2)}}/-</td>
                  <td>
                    @if($product->stock>0)
                    <span class="badge badge-primary">{{$product->stock}}</span>
                    @else
                    <span class="badge badge-danger">{{$product->stock}}</span>
                    @endif
                  </td>
                  <td>
                      @if($product->status=='active')
                          <span class="badge badge-success">{{$product->status}}</span>
                      @else
                          <span class="badge badge-warning">{{$product->status}}</span>
                      @endif
                  </td>
                  <td>
                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <h6 class="text-center">No Products found!!! Please create Product</h6>
      @endif
    </div>
  </div>
@endsection



@push('styles')
  <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
  <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

  <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>

  <script>
    $('#lfm').filemanager('image');



    $(document).ready(function() {

      $('#summary').summernote({

        placeholder: "Write short description.....",

        tabsize: 2,

        height: 150

      });

    });
  </script>

  <script>
    $('#is_parent').change(function() {

      var is_checked = $('#is_parent').prop('checked');

      // alert(is_checked);

      if (is_checked) {

        $('#parent_cat_div').addClass('d-none');

        $('#parent_cat_div').val('');

      } else {

        $('#parent_cat_div').removeClass('d-none');

      }

    })
  </script>
@endpush
