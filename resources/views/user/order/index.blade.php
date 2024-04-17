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
            <h6 class="m-0 font-weight-bold text-primary float-left">Oder Lists</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($orders) > 0)
                <table class="table table-bordered" id="recharge-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                 
                    <tbody>
                        @php $serialNumber = 1 @endphp
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $serialNumber++ }}</td>
                                <td>{{ $order->order_number  }}</td>
                                <td>{{ $order->user_info->name }}</td>
                                <td>{{ $order->product->title }}</td>
                                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                <td>{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if ($order->status == 'new')
                                        <span class="badge badge-primary">{{ $order->status }}</span>
                                    @elseif($order->status == 'process')
                                        <span class="badge badge-warning">{{ $order->status }}</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge badge-success">{{ $order->status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $order->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <span style="float:right">{{ $orders->links() }}</span> 
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

