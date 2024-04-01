@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Shipping</h5>
    <div class="card-body">
      <form method="post" action="{{route('shipping.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Select Continent <span class="text-danger">*</span></label>
          <select name="contient_id" class="form-control" id="contient_id" onchange="view_country()">
            <option value="">---</option>
            @foreach($contient_list as $cont_list)
            <option value="{{ $cont_list->id }}">{{ $cont_list->continent_name }}</option>
            @endforeach
          </select>
        
        @error('contient_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
        <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
        @error('price')
        <span class="text-danger">{{$message}}</span>
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
<script>
  function view_country() {
    var contient_id = document.getElementById("contient_id").value;
    let formdata = {
                'contient_id': contient_id,
                '_token': `{{ csrf_token() }}`
            };
            $.ajax({
                url: `{{ route('country_view_contient_wise') }}`,
                type: "POST",
                dataType: "json",
                data: formdata,
                beforeSend: function() {
                    // $(`#loader2`).html(`<i class="fas fa-spinner fa-spin" style=" font-size: x-large; "></i>`);
                },
                success: function(data) {
                    console.clear();
                     console.log(data);
                    if (data.status) {
                      console.log(data);
                    } else {
                        alert(data.massage);
                        console.error(data);
                    }
                }
            })
  }
  </script>
@endpush
