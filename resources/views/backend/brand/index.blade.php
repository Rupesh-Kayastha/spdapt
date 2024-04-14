@extends('backend.layouts.master')
@section('title', 'E-SHOP || Gallery Page')
@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Level List</h6>
            {{-- <a href="{{route('brand.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Gallery</a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($brands) > 0)
                    <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>User</th>
                                <th>Level1</th>
                                <th>Level2</th>
                                <th>Level3</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.N.</th>
                                <th>User</th>
                                <th>Level1</th>
                                <th>Level2</th>
                                <th>Level3</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php $sl = 1; @endphp
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $sl }}</td>
                                    @php 
                                        $dataUser = Helper::userData($brand->userid);
                                        $dataLevel1 = Helper::userData($brand->level1);
                                        $dataLevel2 = Helper::userData($brand->level2);
                                        $dataLevel3 = Helper::userData($brand->level3);
                                    @endphp
                                    <td>{{ $brand->userid != 0 ? $dataUser->name ." (". $dataUser->phone_no .")" : "" }}</td>
                                    <td>{{ $brand->level1 != 0 ? $dataLevel1->name ." (". $dataLevel1->phone_no .")" : "" }}</td>
                                    <td>{{ $brand->level2 != 0 ? $dataLevel2->name ." (". $dataLevel2->phone_no .")" : "" }}</td>
                                    <td>{{ $brand->level3 != 0 ? $dataLevel3->name ." (". $dataLevel3->phone_no .")" : "" }}</td>
                                </tr>
                                @php $sl++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h6 class="text-center">No Level found!!! Please create Level</h6>
                @endif
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
            transform: scale(3.2);
        }
    </style>
@endpush

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#banner-dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [3, 4]
            }]
        });

        // Sweet alert

        function deleteData(id) {

        }
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
    </script>
@endpush
