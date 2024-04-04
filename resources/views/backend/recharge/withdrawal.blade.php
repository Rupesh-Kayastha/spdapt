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
            <h6 class="m-0 font-weight-bold text-primary float-left">Withdrawal Lists</h6>

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
