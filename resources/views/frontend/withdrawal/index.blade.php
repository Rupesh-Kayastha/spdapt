@extends('user.layouts.master')
@section('title', 'SPDAPT || recharges Page')
@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Withdrawal Lists</h6>
            <a href="{{route('user.withdrawal.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Withdrawal</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($withdwawals) > 0)
                <table class="table table-bordered" id="recharge-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Payon</th>
                            <th>Payment Id</th>
                            <th>Payment Type</th>
                            <th>Purpose</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                 
                    <tbody>
                        @php $serialNumber = 1 @endphp
                        @foreach ($withdwawals as $withdwawal)
                            <tr>
                                <td>{{ $serialNumber++ }}</td>
                                <td>{{ $withdwawal->user_info['name'] }}</td>
                                <td>{{ number_format($withdwawal->amount,2) }}</td>
                                <td>{{ $withdwawal->payon }}</td>
                                <td>{{ $withdwawal->user_info['name'] }}</td>
                                <td>{{ $withdwawal->type }}</td>
                                <td>{{ $withdwawal->purpose }}</td>
                                <td>{{ $withdwawal->date->format('M d D, Y g: i a') }}</td>
                                <td>
                                    @if ($withdwawal->status == 0)
                                        <span class="badge badge-info">Pending</span>
                                    @elseif ($withdwawal->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @elseif ($withdwawal->status == 2)
                                        <span class="badge badge-danger">Reject</span>
                                    @else
                                        <span class="badge badge-secondary">Unknown</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <span style="float:right">{{ $withdwawals->links() }}</span> 
                @else
                  <h6 class="text-center">No post comments found!!!</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
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
        $('#recharge-dataTable').DataTable( {
        "order": [[0, "desc"]],
        "scrollX": false,
        "columnDefs":[
            {
                "orderable":false,
                "targets":[6]
            }
        ]
      });
      // Sweet alert
      function deleteData(id){
      }
    </script>
@endpush
