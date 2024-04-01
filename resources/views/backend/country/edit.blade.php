@extends('backend.layouts.master')
@section('title','E-SHOP || Country Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Country</h5>
    <div class="card-body">
      <form method="post" action="{{route('country.update',$country->id)}}">
        @csrf 
        @method('PATCH')

        <div class="row">
        <div class="col-xl-6 col-md-6 mb-6">
        <label for="inputTitle" class="col-form-label">Country Name <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="country_name" placeholder="Enter Country Name"  value="{{$country->country_name}}" class="form-control">
        @error('country_name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="col-xl-6 col-md-6 mb-6">
        <label for="inputTitle" class="col-form-label">Country Code <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="country_code" placeholder="Enter Country Name"  value="{{$country->country_code}}" class="form-control">
        @error('country_code')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        </div>




        <div class="row">
          <div class="col-xl-6 col-md-6 mb-6">
          <label for="inputTitle" class="col-form-label">Country Currency Symbol <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="currency_symbol" placeholder="Enter currency symbol"  value="{{$country->currency_symbol}}" class="form-control">
          @error('currency_symbol')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="col-xl-6 col-md-6 mb-6">
          <label for="inputTitle" class="col-form-label">Country Currency <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="currency" placeholder="Enter currency"  value="{{$country->currency}}" class="form-control">
          @error('currency')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          </div>




          <div class="row">
            <div class="col-xl-6 col-md-6 mb-6 mt-2 pb-2">
              <label for="inputTitle" class="col-form-label">Shipping Cost<span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="shipping_charge" placeholder="Enter Shipping Cost"  value="{{$country->shipping_charge}}" class="form-control">
              @error('shipping_charge')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="col-xl-6 col-md-6 mb-6 mt-2 pb-2">
              <label for="inputTitle" class="col-form-label">Fuel Surcharge  <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="fuel_surcharge" placeholder="Enter Fuel Surcharge"  value="{{$country->fuel_surcharge}}" class="form-control">
              @error('fuel_surcharge')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>

      
       
          @if(!empty($country->default_currency))
          <div class="row" style="display:none;">
            <div class="col-xl-6 col-md-6 mb-6 mt-3 pb-2">
              <label for="inputTitle" class="col-form-label"><b class="text-primary">Set as Country Currency</b> <span class="text-danger">*</span></label>
              <input id="inputTitle" type="radio" name="default_radio_val[]"  @if(@$country->default_currency=='country_currency') checked @endif  value="country_currency" >
              @error('shipping_charge')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-xl-6 col-md-6 mb-6 mt-3 pb-2">
              <label for="inputTitle" class="col-form-label"><b class="text-primary">Set as Default Currency</b> </label>
              <input id="inputTitle" type="radio" name="default_radio_val[]"   @if(@$country->default_currency=='default') checked @endif value="default" >
              @error('fuel_surcharge')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          @else
          <div class="row" style="display:none;">
            <div class="col-xl-6 col-md-6 mb-6 mt-3 pb-2">
              <label for="inputTitle" class="col-form-label"><b class="text-primary">Set as Country Currency</b> <span class="text-danger">*</span></label>
              <input id="inputTitle" type="radio" name="default_radio_val[]"  value="country_currency" >
              @error('shipping_charge')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-xl-6 col-md-6 mb-6 mt-3 pb-2">
              <label for="inputTitle" class="col-form-label"><b class="text-primary">Set as Default Currency</b> </label>
              <input id="inputTitle" type="radio" name="default_radio_val[]" checked  value="default" >
              @error('fuel_surcharge')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          @endif


          @if(!empty($country->default_currency_symbol) &&  !empty($country->default_currency))  
          <div class="row default_div">
            <div class="col-xl-6 col-md-6 mb-6">
              <label for="inputTitle" class="col-form-label">Default Currency Symbol <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="default_currency_symbol" placeholder="Enter currency symbol"  value="{{$country->default_currency_symbol}}" class="form-control">
              @error('default_currency_symbol')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-xl-6 col-md-6 mb-6">
              <label for="inputTitle" class="col-form-label">Default Currency <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="default_currency" placeholder="Enter currency"  value="{{$country->default_currency}}" class="form-control">
              @error('default_currency')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>


          @else
          <div class="row default_div" style="display:none">
            <div class="col-xl-6 col-md-6 mb-6">
              <label for="inputTitle" class="col-form-label">Default Currency Symbol <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="default_currency_symbol" placeholder="Enter currency symbol"  value="{{old('default_currency_symbol')}}" class="form-control">
              @error('default_currency_symbol')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-xl-6 col-md-6 mb-6">
              <label for="inputTitle" class="col-form-label">Default Currency <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="default_currency" placeholder="Enter currency"  value="{{old('default_currency')}}" class="form-control">
              @error('default_currency')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          @endif


        
       
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($country->status=='active') ? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($country->status=='inactive') ? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
          <a href="{{ route('country.index') }}" class="btn btn-warning">Cancel</a>

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

    $("input[name='default_radio_val']").on("click", function() {
        if($(this).val()=="default")
        {
          $(".default_div").show();
        }else{
          $(".default_div").hide();
        }
      });

    });
</script>
@endpush