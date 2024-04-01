@extends('backend.layouts.master')
@section('main-content')

<div class="card">
  <h5 class="card-header">Edit About Us</h5>
  <div class="card-body">
    <form method="post" action="{{route('aboutus.update')}}" enctype="multipart/form-data">
      @csrf
      <div id="hiddenDiv">
        <div class="row">
          <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Heading1 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="head_line1" required="" value="{{$data->head_line1}}">
          </div>

          <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Heading2 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="head_line2" required="" value="{{$data->head_line2}}">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Heading Content1 <span class="text-danger">*</span></label>
            <textarea type="text" class="form-control" name="head_line_content1">{{$data->head_line_content1}}</textarea>
          </div>

          <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Heading Content1 <span class="text-danger">*</span></label>
            <textarea type="text" class="form-control" name="head_line_content2">{{$data->head_line_content2}}</textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Sub Heading Content <span class="text-danger">*</span></label>
            <textarea type="text" class="form-control" name="sub_head_line_content">{{$data->sub_head_line_content}}</textarea>
          </div>

          <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">content <span class="text-danger">*</span></label>
            <textarea type="text" class="form-control" id="contentData" name="content">{{$data->content}}</textarea>
          </div>
          <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Image1 <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image1">
            @if(!empty($data->image1))
            <img src="{{url('public/frontend/images/banner/'.$data->image1)}}" style="width:30%;">
            @endif
          </div>
          <div class="col-xl-6 col-md-6 mb-6">
            <label for="text" class="col-form-label">Image2 <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image2">
            @if(!empty($data->image1))
            <img src="{{url('public/frontend/images/banner/'.$data->image2)}}" style="width:30%;">
            @endif
          </div>
        </div>
      </div>
      <div class="form-group mb-3 mt-3">
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
  $(document).ready(function(){
    $('#checkbox').change(function(){
      if($(this).is(':checked')){
        $('#hiddenDiv').show();
      } else {
        $('#hiddenDiv').hide();
      }
    });
  });

  $(document).ready(function() {
    $('#contentData').summernote({
      placeholder: "Write content.....",
        tabsize: 2,
        height: 100
    });
  });
</script>
@endpush