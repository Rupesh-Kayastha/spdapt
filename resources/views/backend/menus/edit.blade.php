@extends('backend.layouts.master')

@section('main-content')

<div class="card">
  <div class="row">
    <div class="col-md-12">
      @include('backend.layouts.notification')
    </div>
  </div>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Edit Menu</h6>
    <a href="{{route('menus.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Menu"><i class="fas fa-plus"></i> Add Menu</a>
  </div>
  <div class="card-body">
    <form method="post" action="{{route('menus.update',$menu->id)}}">
      @csrf 
      <input type="hidden" name="id" value="{{ $menu->id }}">
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Menu Name <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="name" placeholder="Enter Coupon Code"  value="{{$menu->name}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Menu URL <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="url" placeholder="Enter Coupon Code"  value="{{$menu->url}}" class="form-control">
        @error('url')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Sub Menu <span class="text-danger">*</span></label>
        <select name="sub_menu" class="form-control">
          <option value="">Select Sub Menu</option>
          @foreach ($orderbyData as $orderby)
            <option value="{{ $orderby->id }}" {{(($menu->sub_menu == $orderby->id) ? 'selected' : '')}}>{{ $orderby->name }}</option>
          @endforeach
        </select>
        @error('sub_menu')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
          <label for="type" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="1" {{(($menu->status=='1') ? 'selected' : '')}}>Active</option>
              <option value="0" {{(($menu->status=='0') ? 'selected' : '')}}>Inactive</option>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endpush