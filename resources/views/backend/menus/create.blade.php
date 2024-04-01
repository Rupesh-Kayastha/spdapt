@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Menu</h5>
    <div class="card-body">
      <form method="post" action="{{route('menu.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Menu Name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" value="{{old('name')}}" placeholder="Enter menu name" class="form-control">
          @error('name')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Menu URL<span class="text-danger">*</span></label>
            <input id="inputTitle" type="text" name="url" placeholder="Enter menu URL" value="{{old('url')}}" class="form-control">
            @error('url')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Sub Menu <span class="text-danger">*</span></label>
          <select name="sub_menu" class="form-control">
            <option value="0">Select Sub Menu</option>
            @foreach ($orderbyData as $orderby)
              <option value="{{ $orderby->id }}">{{ $orderby->name }}</option>
            @endforeach
          </select>
          @error('sub_menu')
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>



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