@extends('backend.layouts.master')



@section('title','E-SHOP || Banner Create')



@section('main-content')



<div class="card">

    <h5 class="card-header">Add Banner</h5>

    <div class="card-body">

      <form method="post" action="{{route('banner.store')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">

          <label for="inputTitle" class="col-form-label">Main Heading <span class="text-danger">*</span></label>

        <input id="inputTitle" type="text" name="main_heading" placeholder="Enter title"  value="{{old('main_heading')}}" class="form-control">

        @error('title')

        <span class="text-danger">{{$message}}</span>

        @enderror

        </div>





        <div class="form-group">

          <label for="inputTitle" class="col-form-label">Sub Heading <span class="text-danger">*</span></label>

        <input id="inputTitle" type="text" name="sub_heading" placeholder="Enter title"  value="{{old('sub_heading')}}" class="form-control">

        @error('sub_heading')

        <span class="text-danger">{{$message}}</span>

        @enderror

        </div>

        <div class="form-group">
        <label for="inputTitle" class="col-form-label">Read More Text </label>
        <input id="inputTitle" type="text" name="readmore_text" placeholder="Enter Read More Text"  value="{{old('readmore_text')}}" class="form-control">
        @error('readmore_text')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
        <label for="inputTitle" class="col-form-label">Read More Link </label>
        <input id="inputTitle" type="text" name="link" placeholder="Enter title"  value="{{old('link')}}" class="form-control">
        @error('link')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>


        {{--  

        <div class="form-group">

          <label for="inputDesc" class="col-form-label">Description</label>

          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>

          @error('description')

          <span class="text-danger">{{$message}}</span>

          @enderror

        </div>

        --}}



        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Banner Image</label>
          <div class="input-group">
          <input  class="form-control" type="file" name="photo" >
        </div>
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

    $('#lfm').filemanager('image');



    $(document).ready(function() {

    $('#description').summernote({

      placeholder: "Write short description.....",

        tabsize: 2,

        height: 150

    });

    });

</script>

@endpush