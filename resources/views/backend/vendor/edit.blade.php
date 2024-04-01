@extends('backend.layouts.master')
@section('title','E-SHOP || Vendor Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Vendor</h5>
    <div class="card-body">
      <form method="post" action="{{route('vendor.update',$vendor->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
        <input id="inputName" type="text" name="name" placeholder="Enter name"  value="{{$vendor->name}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputPhone" class="col-form-label">Phone <span class="text-danger">*</span></label>
        <input id="inputPhone" type="text" name="phone" placeholder="Enter phone"  value="{{$vendor->phone}}" class="form-control">
        @error('phone')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputAddr" class="col-form-label">Contact Address <span class="text-danger">*</span></label>
          <textarea id="inputAddr" name="contactAddress" placeholder="Enter Address" value="{{$vendor->contactAddress}}" class="form-control"></textarea>

        @error('contactAddress')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($vendor->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($vendor->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
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