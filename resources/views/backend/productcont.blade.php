@extends('backend.layouts.master')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Setting</h5>
       @include('backend.layouts.notification')
    <div class="card-body">
    <form method="post" action="{{route('productcont.update')}}" >
        @csrf 
        {{-- @method('PATCH') --}}

        {{-- {{dd($data)}} --}}
        
      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Text1 <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="title1" required value="{{$data->title1}}">
          @error('title1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Content1 <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="content1" required value="{{$data->content1}}">
          @error('content1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>
      
      
      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Text2 <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="title2" required value="{{$data->title2}}">
          @error('title1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Content2 <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="content2" required value="{{$data->content2}}">
          @error('content2')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>
      
      
      
       <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Text3 <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="title3" required value="{{$data->title3}}">
          @error('title3')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Content3 <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="content3" required value="{{$data->content3}}">
          @error('content3')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>


      <div class="form-group mt-4">
        <div class="row">
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
    $('#home_banner1').filemanager('image');
    $('#home_banner2').filemanager('image');
    $('#home_banner3').filemanager('image');
    $('#home_banner4').filemanager('image');
    $('#home_page_heding_image').filemanager('image');
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