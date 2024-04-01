@extends('backend.layouts.master')
@section('title','E-SHOP || Golf Information Create')
@section('main-content')

<div class="card">
    <h5 class="card-header">Add Golf Information</h5>
    <div class="card-body">
      <form method="post" action="{{route('golfInformation.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Content <span class="text-danger">*</span></label>
          <textarea class="form-control" id="contentData" rows="6" cols="20"  name="content"></textarea>
          @error('content')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Image</label>
          <div class="input-group">
            <input class="form-control" id="image" type="file" name="image" >
          </div>
          @error('image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
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
      $('#contentData').summernote({
        placeholder: "Write short description.....",
        tabsize: 2,
        height: 150

      });
    });
</script>
@endpush