@extends('backend.layouts.master')
@section('main-content')

<div class="card">
  <h5 class="card-header">Edit Home Page Video Setting</h5>
  @include('backend.layouts.notification')
  <div class="card-body">
    @include('backend.layouts.tablinks')
    <form method="post" action="{{route('video.update')}}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="short_des" class="col-form-label">Home Page Video1 <span class="text-danger">*</span></label>
          <textarea class="form-control" rows="5" name="short_des">{{$data->short_des}}</textarea>
          @error('short_des')
          <span class="text-danger">{{$message}}</span>
          @enderror
          <br>
          <iframe src="{{$data->short_des}}" width="566px"></iframe>
        </div>
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="description" class="col-form-label">Home Page Video2 <span class="text-danger">*</span></label>
          <textarea class="form-control" rows="5" name="long_des">{{$data->long_des}}</textarea>
          @error('long_des')
          <span class="text-danger">{{$message}}</span>
          @enderror
          <br>
          <iframe src="{{$data->long_des}}" width="566px"></iframe>
        </div>
      </div>
      <div class="form-group mb-3 p-1">
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
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  </script>
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

  $(document).ready(function() {
    $('#terms_and_conditions').summernote({
      placeholder: "Write Terms and Conditions Quote.....",
      tabsize: 2,
      height: 100
    });
  });
  
  $(document).ready(function() {
    $('#privacy_policy').summernote({
      placeholder: "Write Privacy Policy Quote.....",
      tabsize: 2,
      height: 100
    });
  });

  $(document).ready(function() {
    $('#delivery_information').summernote({
      placeholder: "Write Delivery Information Quote.....",
      tabsize: 2,
      height: 100
    });
  });

  $(document).ready(function() {
    $('#home_page_heding').summernote({
      placeholder: "Write Home Page Heding Information Quote.....",
      tabsize: 2,
      height: 100
    });
  });

  $(document).ready(function() {
    $('#todayNesw').summernote({
      placeholder: "Write Today Nesw Quote.....",
      tabsize: 2,
      height: 100
    });
  });
</script>
@endpush