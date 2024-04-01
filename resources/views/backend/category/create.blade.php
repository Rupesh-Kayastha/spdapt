@extends('backend.layouts.master')



@section('main-content')



<div class="card">

    <h5 class="card-header">Add Category</h5>

    <div class="card-body">

      <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control" required>
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary</label>
          <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Catagory Image <span class="text-danger">*</span></label>
          <input  type="file" name="photo" value="{{old('photo')}}" class="form-control" required>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
  $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
      tabsize: 2,
      height: 120
    });
  });
</script>



<script>

  $('#is_parent').change(function(){

    var is_checked=$('#is_parent').prop('checked');

    // alert(is_checked);

    if(is_checked){

      $('#parent_cat_div').addClass('d-none');

      $('#parent_cat_div').val('');

    }

    else{

      $('#parent_cat_div').removeClass('d-none');

    }

  })

</script>

@endpush