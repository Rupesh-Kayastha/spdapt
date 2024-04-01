@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Edit Home Page Content</h5>
    <div class="card-body">
    <form method="post" action="{{route('homepageimage.update')}}">
        @csrf 
        {{-- @method('PATCH') --}}

        <div class="form-group">
        <div class="form-group mt-4">
          <div class="card">
            <h5 class="card-header">Home Page Content</h5>
          </div>
          <div class="row">
            <div class="col-xl-4 col-md-4 mb-2">
              <div class=" h-100">
              <label for="status" class="col-form-label">Main Heading <span class="text-danger">*</span></label>
              <input type="text" name="main_heading1" class="form-control" value="{{ $data->main_heading1 }}">
            
            </div>
          </div>

          <div class="col-xl-4 col-md-4 mb-2">
            <div class=" h-100">
            <label for="status" class="col-form-label">Sub Heading <span class="text-danger">*</span></label>
            <input type="text" name="sub_heading1" class="form-control" value="{{ $data->sub_heading1 }}">
           
          </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-2">
          <div class=" h-100">
          <label for="status" class="col-form-label">Sub Title <span class="text-danger">*</span></label>
          <input type="text" name="sub_title1" class="form-control" value="{{ $data->sub_title1 }}">
         
        </div>
      </div>

      
    </div>

      <div class="form-group mt-4">
        <div class="card">
          <h5 class="card-header">Add Home Page Seo Information</h5>
        </div>


        <div class="row">
          <div class="col-xl-6 col-md-6 mb-2">
            <div class=" h-100">
            <label for="status" class="col-form-label">Meta Title <span class="text-danger">*</span></label>
            <input type="text" name="meta_title" class="form-control" value="77777777777">
            
          </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-2">
          <div class=" h-100">
            <label for="status" class="col-form-label">Meta Keyword <span class="text-danger">*</span></label>
            <input type="text" name="meta_keyword" class="form-control" value="777777777777">
            @error('meta_keyword')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>

        <div class="col-xl-12 col-md-12 mb-2">
          <div class=" h-100 ">
            <label for="status" class="col-form-label">Meta Description <span class="text-danger">*</span></label>
            <textarea name="meta_description" class="form-control" rows="2" cols="20">77777777777</textarea>
            @error('meta_description')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>

        <div class="col-xl-12 col-md-12 mb-12">
          <div class=" h-100 py-2">
          <label for="status" class="col-form-label">Extra Code <span class="text-danger">*</span></label>
          <textarea name="extra_code" class="form-control" rows="4" cols="20">7777777777777</textarea>
          @error('extra_code')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>

    $('#lfm').filemanager('image');
    $('#lfm1').filemanager('image');
    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });


    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Write short Quote.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
</script>
@endpush