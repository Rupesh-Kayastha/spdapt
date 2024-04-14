@extends('backend.layouts.master')

@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Product </h5>
        <div class="card-body">
            <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label for="inputTitle" class="col-form-label">Product Title <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{ old('title', $product->title) }}" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <label for="inputLockDay" class="col-form-label">Lock Day <span class="text-danger">*</span></label>
                        <input id="inputLockDay" type="text" name="lock_days" placeholder="Enter lock day" value="{{ old('lock_days', $product->lock_days) }}" class="form-control">
                        @error('lock_days')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label for="inputPrice" class="col-form-label">Price (USD) <span class="text-danger">*</span></label>
                        <input id="inputPrice" inputmode="decimal" type="text" pattern="[0-9]*[.,]?[0-9]*" name="price" placeholder="Enter price" value="{{ old('price', $product->price) }}" class="form-control">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label for="inputOwner" class="col-form-label">Owner <span class="text-danger">*</span></label>
                        <input id="inputOwner" type="text" name="owner" placeholder="Enter owner" value="{{ old('owner', $product->owner) }}" class="form-control">
                        @error('owner')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-md-3 mb-4">
                        <label for="inputStatus" class="col-form-label">Status <span class="text-danger">*</span></label>
                        <select id="inputStatus" name="status" class="form-control">
                            <option value=" ">--Select any value--</option>
                            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Active</option>
                            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span><br></label>
                        <input id="inputPhoto" class="form-control" type="file" name="photo[]" multiple accept="image/png, image/gif, image/jpeg" value="{{ old('photo', $product->photo) }}">
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        
                        @php
                          $photo=explode(',',$product->photo);
                        @endphp
                        <img src="{{ url('/public/product/') }}/{{ $photo[0] }}" class="img-fluid zoom" style="max-width:80px" alt="{{$product->photo}}">
                      
                        @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-form-label">Product Description</label>
                    <textarea id="inputDescription" class="form-control" name="description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-xl-3">
                    <button type="button" class="btn btn-warning" onclick="window.history.back();">Back</button>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    {{-- ckeditor code start here --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    {{-- ckeditor code end here --}}
    <script>
        $(document).ready(function() {
            $('#inputDescription').summernote({
                placeholder: "Write product description.....",
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
