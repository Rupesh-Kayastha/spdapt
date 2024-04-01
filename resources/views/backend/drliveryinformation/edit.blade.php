@extends('backend.layouts.master')
@section('title','E-SHOP || Banner Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Facilities</h5>
    <div class="card-body">
      <form method="post" action="{{route('drliveryinformation.update')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$drliveryinformation->id}}">
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Content <span class="text-danger">*</span></label>
          <textarea class="form-control" id="contentData" rows="6" cols="20"  name="content">{{$drliveryinformation->content}}</textarea>
          @error('main_heading')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Image <span class="text-danger">*</span></label>
          <div class="input-group">
            <input  class="form-control" type="file" name="image" >
          </div>
          <img src="{{url('public/frontend/images/banner/'.$drliveryinformation->image)}}" alt="Banner Image" width="200px" height="200px">
          @error('image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="1" {{(($drliveryinformation->status=='1') ? 'selected' : '')}}>Active</option>
            <option value="0" {{(($drliveryinformation->status=='0') ? 'selected' : '')}}>Inactive</option>
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

    $(document).ready(function() {
    $('#contentData').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush