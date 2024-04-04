@extends('backend.layouts.master')
@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Recharge Lists</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- @if (count($products) > 0) --}}
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>User Name</th>
                            <th>Mobile Number</th>
                            <th>pay id</th>
                            <th>Withdrawal Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N.</th>
                            <th>User Name</th>
                            <th>Mobile Number</th>
                            <th>pay id</th>
                            <th>Withdrawal Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($transactions as $key => $transaction)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $transaction->user_info->name }}</td>
                                <td>{{ $transaction->user_info->phone_no }}</td>
                                <td>{{ $transaction->payment_id }}</td>
                                <td>{{number_format($transaction->amount,2)}}</td>
                                <td>
                                    @if ($transaction->status == 0)
                                        <span class="badge badge-warning">Active</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($transaction->status == 0)
                                        <form action="{{ route('transactions.approve', $transaction->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('transactions.reject', $transaction->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    @else
                                        <!-- Show some message or disable buttons if already approved -->
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    {{-- <tbody>
                            @foreach ($products as $product)
                                @php
                                    $sub_cat_info = DB::table('categories')
                                        ->select('title')
                                        ->where('id', $product->child_cat_id)
                                        ->get();
                                    dd($sub_cat_info);
                                    $brands = DB::table('brands')
                                        ->select('title')
                                        ->where('id', $product->brand_id)
                                        ->get();
                                    $vendorNames = $product->vendors()->pluck('name');
                                    $vname=collect($vendorNames)->all();
                                    $vname = implode(",",$vname);
                                @endphp
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if ($product->photo)
                                            @php
                                                $photo = explode(',', $product->photo);
                                                //echo '<pre>';
                                                //print_r($photo);
                                            @endphp



                                            <img src="{{ url('/public/product/') }}/{{ $photo[0] }}"
                                                class="img-fluid zoom" style="max-width:80px" alt="{{ $product->photo }}">
                                        @else
                                            <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                                style="max-width:80px" alt="avatar.png">
                                        @endif
                                    </td>
                                    <td><a href="{{ url('/') }}/shop/{{ $product->slug }}"
                                            target="_blank">{{ $product->title }}</a></td>
                                    <sub>
                                        {{ $product->sub_cat_info->title ?? '' }}
                                    </sub>
                                    </td>
                                    <td>{{ $product->is_featured == 1 ? 'Yes' : 'No' }}</td>
                                    <td>${{ number_format($product->price, 2) }}/-</td>
                                    <td>{{$product->discount}}% OFF</td>
                                    <td>{{ $product->size }}</td>
                                    <td>{{ isset(($product->brand->title)) ? ucfirst($product->brand->title) : " " }}</td>
                                    <td>
                                        @if ($product->stock > 0)
                                            <span class="badge badge-primary">{{ $product->stock }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->status == 'active')
                                            <span class="badge badge-success">{{ $product->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $product->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/') }}/shop/{{ $product->slug }}" title="view"
                                            target="_blank"><i class="fas fa-eye" style="width:20px"></i></a>

                                        <a href="{{ route('product.edit', $product->id) }}" title="edit"
                                            data-placement="bottom"><i style="width:20px" class="fas fa-edit"></i></a>

                                        <form method="POST" id="delete_form"
                                            action="{{ route('product.destroy', [$product->id]) }}"
                                            onsubmit="confirm_to_delete()">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{ $product->id }}
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                </table>
                {{-- <span style="float:right">{{ $products->links() }}</span>
                @else
                    <h6 class="text-center">No Products found!!! Please create Product</h6>
                @endif --}}
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }

        .zoom {
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(5);
        }
    </style>
@endpush
{{-- @push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#product-dataTable').DataTable({
            "order": [
                [0, "desc"]
            ],
            "scrollX": false "columnDefs": [{
                "orderable": false,
                "targets": [10, 11, 12]
            }]
        });
        // Sweet alert
        function deleteData(id) {}
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
        // Call the dataTables jQuery plugin
    </script>
    <script>
        function confirm_to_delete() {
            var conf = confirm("Are You sure to delete product");
            if (conf) {
                $('#delete_form').submit();
            }
        }
    </script>
@endpush --}}
