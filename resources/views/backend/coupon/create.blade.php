@extends('backend.layouts.master')

@section('main-content')
  <div class="card">
    <h5 class="card-header">Add Coupon</h5>
    <div class="card-body">
      <form method="post" action="{{ route('coupon.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Coupon Code <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="code" placeholder="Enter Coupon Code" value="{{ old('code') }}"
            class="form-control">
          @error('code')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="type" class="col-form-label">Type <span class="text-danger">*</span></label>
          <select name="type" class="form-control">
            <option value="fixed">Fixed</option>
            <option value="percent">Percent</option>
          </select>
          @error('type')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Value <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="value" placeholder="Enter Coupon value"
            value="{{ old('value') }}" class="form-control">
          @error('value')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Coupon Expiry Date <span class="text-danger">*</span></label>
          <input id="inputTitle" type="date" name="coupon_expiry_date" placeholder="Enter Coupon Expiry Date"
            value="{{ old('coupon_expiry_date') }}" class="form-control">
          @error('coupon_expiry_date')
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
            <span class="text-danger">{{ $message }}</span>
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
  <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
  <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
  <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
