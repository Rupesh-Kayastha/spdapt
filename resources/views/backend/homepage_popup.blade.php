@extends('backend.layouts.master')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Home Page Pop Up</h5>
    <div class="card-body">
      @include('backend.layouts.tablinks')
    <form method="post" action="{{route('homepage_popup.update')}}" enctype="multipart/form-data">

        @csrf 

        {{-- @method('PATCH') --}}

        {{-- {{dd($data)}} --}}

        <div class="row">
          <div class="col-xl-6 col-md-6 mb-6 pt-2 pb-3">
            <label for="inputTitle" class="col-form-label" style="color:#4a6fdc;"><b>Enable Home Page</b> <span class="text-danger">*</span></label>
            <input type="checkbox" id="checkbox" name="popup_enable" @php if($data->popup_enable=='1') { echo 'checked';} @endphp  value="1"> Yes      
          </div>
        </div>
        
        
        <div id="hiddenDiv">
        <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Heading <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="main_heading1" required="" value="{{$data->main_heading1}}">
        </div>

        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Sub Heading <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="sub_heading1" required="" value="{{$data->sub_heading1}}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Content1 <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="sub_title1"  value="{{$data->sub_title1}}">
        </div>

        <div class="col-xl-6 col-md-6 mb-6">
          <label for="text" class="col-form-label">Content2 <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="main_heading2"  value="{{$data->main_heading2}}">
        </div>
      </div>
      
      <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Content3 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="sub_heading2"  value="{{$data->sub_heading2}}">
        </div>

        <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Book Now Link <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="main_heading3"  value="{{$data->main_heading3}}">
        </div>
        <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Photo <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="photo"  >
            @if(!empty($data->photo1)) 
                <img src="{{url('public/frontend/images/banner/'.$data->photo1)}}" style="width:30%;">
            @endif
        </div>
      </div>
        </div>
        
        <div class="form-group mb-3 mt-3">
            <button class="btn btn-success" type="submit">Update</button>
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
 <script>
    $(document).ready(function(){
        // When the checkbox state changes
        $('#checkbox').change(function(){
            // If the checkbox is checked, show the div; otherwise, hide it
            if($(this).is(':checked')){
                $('#hiddenDiv').show();
            } else {
                $('#hiddenDiv').hide();
            }
        });
    });
</script>
@endpush