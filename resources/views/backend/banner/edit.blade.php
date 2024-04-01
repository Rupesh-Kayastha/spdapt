@extends('backend.layouts.master')
@section('title','E-SHOP || Banner Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Banner</h5>
    <div class="card-body">
      <form method="post" action="{{route('banner.update',$banner->id)}}" enctype="multipart/form-data">
        @csrf 
        @method('PATCH')

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Main Heading <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="main_heading" placeholder="Enter title"  value="{{$banner->main_heading}}" class="form-control">
        @error('main_heading')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>


        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Sub Heading <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="sub_heading" placeholder="Enter title"  value="{{$banner->sub_heading}}" class="form-control">
        @error('sub_heading')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Read More Text  <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="readmore_text" placeholder="Enter Read More Text"  value="{{$banner->readmore_text}}" class="form-control">
        @error('readmore_text')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Read More Link  <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="link" placeholder="Enter title"  value="{{$banner->link}}" class="form-control">
        @error('link')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        {{--  
        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$banner->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        --}}

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
        
        <div class="input-group">
          <input  class="form-control" type="file" name="photo" >
        </div>
        <img src="{{url('public/frontend/images/banner/'.$banner->photo)}}" alt="Banner Image" width="200px" height="200px">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($banner->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($banner->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
            <a href="{{ route('banner.index') }}" class="btn btn-warning">Cancel</a>
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
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