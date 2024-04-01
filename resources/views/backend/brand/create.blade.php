@extends('backend.layouts.master')

@section('title','E-SHOP || Brand Create')

@section('main-content')



<div class="card">
  <h5 class="card-header">Add Gallery</h5>
  <div class="card-body">
    <form method="post" action="{{route('brand.store')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}"
          class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Gallery</label>
        <div class="input-group">
            <input class="form-control" type="file" name="logo">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
        @error('logo')
        <span class="text-danger">{{ $message }}</span>
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
  <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
  <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
@endpush