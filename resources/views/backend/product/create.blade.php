<style>
    .attribute-btn {
        position: absolute;
        right: 20px;
        margin-bottom: 20px
    }

    .filter-option {
        height: 40px !important;
    }

    .dropdown-toggle {
        height: 40px !important;
    }

    .bootstrap-select {
        margin-top: 10px !important;
    }
</style>


@extends('backend.layouts.master')



@section('main-content')
    <div class="card">

        <h5 class="card-header">Add Product</h5>

        <div class="card-body">

            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="row">

                    <div class="col-xl-6 col-md-6 mb-4">

                        <label for="inputTitle" class="col-form-label">Product Title <span
                                class="text-danger">*</span></label>

                        <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                            value="{{ old('title') }}" class="form-control">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                </div>
                <div class="row">

                    <div class="col-xl-3 col-md-12 mb-6">

                        <label for="inputTitle" class="col-form-label">Lock Day <span class="text-danger">*</span></label>

                        <input id="inputTitle" type="text" name="lock_days" placeholder="Enter lock day"
                            value="{{ old('lock_days') }}" class="form-control">

                        @error('lock_days')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="col-xl-3 col-md-12 mb-6">

                        <label for="price" class="col-form-label">Price(USD) <span class="text-danger">*</span></label>

                        <input inputmode="decimal" type="text" id="float-input" pattern="[0-9]*[.,]?[0-9]*"
                            name="price" placeholder="Enter price" value="{{ old('price') }}" class="form-control">

                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="col-xl-3 col-md-12 mb-6">

                        <label for="inputTitle" class="col-form-label">Owner<span class="text-danger">*</span></label>

                        <input id="inputTitle" type="text" name="owner" placeholder="Enter owner"
                            value="{{ old('owner') }}" class="form-control">

                        @error('owner')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                </div>

                <div class="col-xl-6 col-md-3 mb-4">
                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value=" ">--Select any value--</option>
                        <option value="0" selected>Active</option>
                        <option value="1">Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="description" class="col-form-label">Product Description</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span><br>
                            <em class="text-danger">For multiple image upload choose image & press ctrl key for multiselect.
                            </em></label>
                        <input class="form-control" type="file" name="photo[]" multiple
                            accept="image/png, image/gif, image/jpeg">
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-xl-3">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>






    {{-- ckeditor code start here --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            // alert(cat_id);
            if (cat_id != null) {
                // Ajax call
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: cat_id
                    },
                    type: "POST",
                    success: function(response) {
                        if (typeof(response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        // console.log(response);
                        var html_option = "<option value=''>----Select sub category----</option>"
                        if (response.status) {
                            var data = response.data;
                            // alert(data);
                            if (response.data) {
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data, function(id, title) {
                                    html_option += "<option value='" + id + "'>" + title +
                                        "</option>"
                                });
                            } else {}
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            } else {}
        })
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });


        $(document).ready(function() {
            $('#about_description').summernote({
                placeholder: "Write about description.....",
                tabsize: 2,
                height: 100
            });
            $('#know_the_brand').summernote({
                placeholder: "Write product description.....",
                tabsize: 2,
                height: 100
            });
            $('#product_description').summernote({
                placeholder: "Write brand description.....",
                tabsize: 2,
                height: 150
            });
            $('#technical_details').summernote({
                placeholder: "Write brand description.....",
                tabsize: 2,
                height: 150
            });

            $("#meta").click(function() {
                $(".meta_details").slideDown();
            });
        });
    </script>
@endpush
