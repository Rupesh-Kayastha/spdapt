@extends('backend.layouts.master')
@section('main-content')

<div class="card">
  <h5 class="card-header">General Setting</h5>
  @include('backend.layouts.notification')
  <div class="card-body">
    <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="inputPhoto" class="col-form-label">Logo <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-btn">
              <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
              </a>
            </span>
            <input id="thumbnail1" class="form-control" type="file" name="logo" value="{{$data->logo}}">
          </div>
          <br>
          <img src="{{ url('/public/product/') }}/{{$data->logo}}" height="100" width="100" style="background: #141414;">
          <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
          @error('logo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="inputPhoto" class="col-form-label">Free Shipping Image <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-btn">
              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
              </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$data->photo}}">
          </div>
          <br>
          <img src="{{$data->photo}}" style="width:15%">
          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="address" class="col-form-label">Store Address Line <span class="text-danger">*</span></label>
          <textarea class="form-control" name="address" rows="5" required>{{$data->address}}</textarea>
          @error('address')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="address" class="col-form-label">Copy Right Text <span class="text-danger">*</span></label>
          <textarea class="form-control" rows="5" name="location_map" required>{{$data->location_map}}</textarea>
          @error('location_map')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" required value="{{$data->email}}">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-6 col-md-6 mb-6">
          <label for="phone" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="phone" required value="{{$data->phone}}">
          @error('phone')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-12 mb-12">
          <label for="email" class="col-form-label">Contact Us Map Location <span class="text-danger">*</span></label>
          <textarea class="form-control" name="contactus_map_location"
            rows="14">{{$data->contactus_map_location}}</textarea>
          @error('contactus_map_location')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="col-xl-6 col-md-12 mb-12">
          <label for="email" class="col-form-label">&nbsp; <span class="text-danger">*</span></label>
          <?php echo $data->contactus_map_location; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="email" class="col-form-label">NewsLetter Heading <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="newletter_heading" required
            value="{{$data->newletter_heading}}">
          @error('newletter_heading')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-xl-6 col-md-6 mb-6">
          <label for="phone" class="col-form-label">NewsLetter Sub Heading <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="newsletter_subheading" required
            value="{{$data->newsletter_subheading}}">
          @error('newsletter_subheading')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
      </div>
      <br>

      <div class="form-group">
        <div class="card">
          <h5 class="card-header">Add Shipping Information</h5>
        </div>

        <div class="form-group">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Free Shipping Amount <span class="text-danger">*</span></label>
            <input type="text" name="free_shipping_cost" class="form-control" value="{{ $data->free_shipping_cost }}">

            @error('free_shipping_cost')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>

        <div class="card">
          <h5 class="card-header">Add Checkout Note Text</h5>
        </div>

        <div class="form-group">
          <div class=" h-100 py-2">
            <label for="status" class="col-form-label">Checkout Order Note <span class="text-danger">*</span></label>
            <input type="text" name="checkout_note_text" class="form-control" value="{{ $data->checkout_note_text }}">

            @error('checkout_note_text')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>

        <div class="form-group mt-4">
          <div class="card">
            <h5 class="card-header">Add Social Information</h5>
          </div>

          <div class="row">
            <div class="col-xl-3 col-md-3 mb-2">
              <div class=" h-100">
                <label for="status" class="col-form-label">Facebook URL <span class="text-danger">*</span></label>
                <input type="text" name="facebook_url" class="form-control" value="{{ $data->facebook_url }}">
                @error('facebook_url')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-2">
              <div class=" h-100">
                <label for="status" class="col-form-label">Instagram URL <span class="text-danger">*</span></label>
                <input type="text" name="instagram_url" class="form-control" value="{{ $data->instagram_url }}">
                @error('instagram_url')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-2">
              <div class=" h-100">
                <label for="status" class="col-form-label">Twitter URL <span class="text-danger">*</span></label>
                <input type="text" name="twitter_url" class="form-control" value="{{ $data->twitter_url }}">
                @error('twitter_url')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-2">
              <div class=" h-100">
                <label for="status" class="col-form-label">Youtube URL<span class="text-danger">*</span></label>
                <input type="text" name="youtube_url" class="form-control" value="{{ $data->youtube_url }}">
                @error('youtube_url')
                <span class="text-danger">{{$message}}</span>
                @enderror
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
                  <input type="text" name="meta_title" class="form-control" value="{{ $data->meta_title }}">
                  @error('meta_title')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-md-6 mb-2">
                <div class=" h-100">
                  <label for="status" class="col-form-label">Meta Keyword <span class="text-danger">*</span></label>
                  <input type="text" name="meta_keyword" class="form-control" value="{{ $data->meta_keyword }}">
                  @error('meta_keyword')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-12 col-md-12 mb-2">
                <div class=" h-100 ">
                  <label for="status" class="col-form-label">Meta Description <span class="text-danger">*</span></label>
                  <textarea name="meta_description" class="form-control" rows="2"
                    cols="20">{{ $data->meta_description }}</textarea>
                  @error('meta_description')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-12 col-md-12 mb-12">
                <div class=" h-100 py-2">
                  <label for="status" class="col-form-label">Home Page About Us <span class="text-danger">*</span></label>
                  <textarea name="home_page_about_us" class="form-control" rows="2" cols="20">{{ $data->home_page_about_us }}</textarea>
                  @error('extra_code')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-12 col-md-12 mb-12">
                <div class=" h-100 py-2">
                  <label for="status" class="col-form-label">Extra Code <span class="text-danger">*</span></label>
                  <textarea name="extra_code" class="form-control" rows="4" cols="20">{{ $data->extra_code }}</textarea>
                  @error('extra_code')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="form-group mt-4">
            <div class="card">
              <h5 class="card-header">Delivery Information</h5>
            </div>

            <div class="row">
              <div class="col-xl-12 col-md-12 mb-12">
                <div class=" h-100 py-2">
                  <label for="summary" class="col-form-label">Delivery Information <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="delivery_information" rows="6" cols="20"  name="delivery_information">{{$data->delivery_information}}</textarea>
                  @error('delivery_information')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="form-group mt-4">
            <div class="card">
              <h5 class="card-header">Privacy Policy Information</h5>
            </div>
            <div class="row">
              <div class="col-xl-12 col-md-12 mb-12">
                <div class=" h-100 py-2">
                  <label for="summary" class="col-form-label">Privacy Policy <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="privacy_policy" rows="6" cols="20"  name="privacy_policy">{{$data->privacy_policy}}</textarea>
                  @error('privacy_policy')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="form-group mt-4">
            <div class="card">
              <h5 class="card-header">Terms and Conditions Information</h5>
            </div>
            <div class="row">
              <div class="col-xl-12 col-md-12 mb-12">
                <div class=" h-100 py-2">
                  <label for="summary" class="col-form-label">Terms and Conditions <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="terms_and_conditions" rows="6" cols="20"  name="terms_and_conditions">{{$data->terms_and_conditions}}</textarea>
                  @error('terms_and_conditions')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="form-group mt-4">
            <div class="row">
              <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update</button>
              </div>
            </div>
          </div>
        </div>
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