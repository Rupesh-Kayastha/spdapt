@extends('backend.layouts.master')
@section('title', 'E-SHOP || Country Page')
@section('main-content')
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="row">
      <div class="col-md-12">
        @include('backend.layouts.notification')
      </div>
    </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Country List</h6>
      <a href="{{ route('country.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip"
        data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Shipping</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if (count($countries) > 0)
          <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Country Name</th>
                <th>Currency Symbol</th>
                <th>Currency</th>
                <th>Shipping Cost</th>
                <th>Fuel Surcharge</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.N.</th>
                <th>Country Name</th>
                <th>Currency Symbol</th>
                <th>Currency</th>
                <th>Shipping Cost</th>
                <th>Fuel Surcharge</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($countries as $cn)
                <tr>
                  <td>{{ $cn->id }}</td>
                  <td>{{ $cn->country_name }}</td>
                  <td>{{ $cn->currency_symbol }}</td>
                  <td>{{ $cn->currency }}</td>
                  <td>{{ $cn->shipping_charge }}</td>
                  <td>{{ $cn->fuel_surcharge }}</td>
                  <td>
                    @if ($cn->status == 'active')
                      <span class="badge badge-success">{{ $cn->status }}</span>
                    @else
                      <span class="badge badge-warning">{{ $cn->status }}</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('country.edit', $cn->id) }}" class="btn btn-primary btn-sm float-left mr-1"
                      style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                      data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('country.destroy', [$cn->id]) }}">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{ $cn->id }}
                        style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom"
                        title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div id="next-page-btn"></div>
        @else
          <h6 class="text-center">No countries found!!! Please create country</h6>
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
    }
    .zoom:hover {
      transform: scale(3.2);
    }
  </style>
@endpush
@push('scripts')
  <!-- Page level plugins -->
  <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <!-- Page level custom scripts -->
  <script>
    var dataTable = $('#banner-dataTable').DataTable({
      
      "columnDefs": [{
        "orderable": false,
      }],
      "pagingType": "full_numbers"
    });

    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('.dltBtn').click(function(e) {
        var form = $(this).closest('form');
        var dataID = $(this).data('id');
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
