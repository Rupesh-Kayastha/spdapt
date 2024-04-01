@extends('backend.layouts.master')
@section('main-content')

<div class="card">
  <h5 class="card-header">Edit Home Page Morsh Info Setting</h5>
  @include('backend.layouts.notification')
  <div class="card-body">
    @include('backend.layouts.tablinks')
    <form method="post" action="{{route('morshinfo.update')}}" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="inputPhoto" class="col-form-label">Home Page Image1 <span class="text-danger">*</span></label>
          <div class="input-group">
            <input id="thumbnail19" class="form-control" type="file" name="home_banner1">
          </div>
          <br>
          <img src="{{ url('/public/product/') }}/{{$data->home_banner1}}" style="width:32%;">
          <div id="holder11" style="margin-top:15px;max-height:100px;"></div>
          <textarea name="home_banner1_content1" class="form-control" rows="2" cols="20">{{$data->home_banner1_content1}}</textarea>
          @error('home_banner1')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="inputPhoto" class="col-form-label">Home Page Image2 <span class="text-danger">*</span></label>
          <div class="input-group">
            <input class="form-control" type="file" name="home_banner2">
          </div>
          <br>
          <img src="{{ url('/public/product/') }}/{{$data->home_banner2}}" style="width:32%;">
          <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
          <textarea name="home_banner2_content2" class="form-control" rows="2" cols="20">{{$data->home_banner2_content2}}</textarea>
          @error('home_banner2')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="inputPhoto" class="col-form-label">Home Page Image3 <span class="text-danger">*</span></label>
          <div class="input-group">

            <input class="form-control" type="file" name="home_banner3">
          </div>
          <br>
          <img src="{{ url('/public/product/') }}/{{$data->home_banner3}}" style="width:32%;">
          <div id="holder3" style="margin-top:15px;max-height:100px;"></div>
          <textarea name="home_banner3_content3" class="form-control" rows="2" cols="20">{{$data->home_banner3_content3}}</textarea>
          @error('home_banner3')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="inputPhoto" class="col-form-label">Home Page Image4 <span class="text-danger">*</span></label>
          <div class="input-group">
            <input class="form-control" type="file" name="home_banner4">
          </div>
          <br>
          <img src="{{ url('/public/product/') }}/{{$data->home_banner4}}" style="width:32%;">
          <div id="holder4" style="margin-top:15px;max-height:100px;"></div>
          <textarea name="home_banner4_content4" class="form-control" rows="2" cols="20">{{$data->home_banner4_content4}}</textarea>
          @error('home_banner4')
          <span class="text-danger">{{$message}}</span>
          @enderror
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