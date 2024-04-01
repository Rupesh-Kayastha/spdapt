@extends('backend.layouts.master')
@section('title','E-SHOP || Banner Page')
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Home Page Facilities List</h6>
    </div>
    <div class="card-body">
      @include('backend.layouts.tablinks')
      <div class="table-responsive">
        @if(count($drliveryinformations)>0)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Content</th>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Content</th>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($drliveryinformations as $drliveryinformation)   
                <tr>
                    <td>{{$drliveryinformation->id}}</td>
                    <td>{!! (stripslashes($drliveryinformation->content)) !!}</td>
                    <td>
                        @if($drliveryinformation->image)
                            <img src="{{url('public/frontend/images/banner/'.$drliveryinformation->image)}}" class="img-fluid zoom" style="max-width:80px" alt="{{$drliveryinformation->image}}">
                        @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:80px" alt="avatar.png">
                        @endif
                    </td>
                    <td>
                        @if($drliveryinformation->status=='1')
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-warning">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('drliveryinformation.edit',$drliveryinformation->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No Drlivery Information found!!! Please create Drlivery Information</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(3.2);
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#banner-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
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