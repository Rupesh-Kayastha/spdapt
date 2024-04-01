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
      <h6 class="m-0 font-weight-bold text-primary float-left">Abonded Carts Lists</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($abondedcarts)>0)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Photo</th>
              <th>Title</th>              
              <th>Quantity</th>
              <th>Price</th>
              <th>Name</th>
              <th>Email</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Photo</th>
              <th>Title</th>              
              <th>Quantity</th>
              <th>Price</th>
              <th>Name</th>
              <th>Email</th>
            </tr>
          </tfoot>
          <tbody>
            @php $slno=1;@endphp
            @foreach($abondedcarts as $abondedcart)
                @php
                  $product=DB::table('products')->where('id',$abondedcart->product_id)->first();
                  $user=DB::table('users')->where('id',$abondedcart->user_id)->first();
                @endphp
                <tr>               
                    <td>{{$slno}}</td>
                    <td>
                      @if($product->photo)
                        @php
                          $photo=explode(',',$product->photo);
                        @endphp                      
                          <img src="{{ url('/public/product/') }}/{{ $photo[0] }}" class="img-fluid zoom" style="max-width:80px" alt="{{$product->photo}}">
                      @else
                          <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                      @endif
                  </td>
                    <td>{{$product->title}}</td>
                      <sub>
                          {{$product->sub_cat_info->title ?? ''}}
                      </sub>
                    </td>
                    <td>{{$abondedcart->quantity}}</td>
                    <td>${{number_format($abondedcart->price,2)}}/-</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                @php $slno++;@endphp
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$abondedcarts->links()}}</span>
        @else
          <h6 class="text-center">No Abonded Carts found</h6>
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
        transform: scale(5);
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
      $('#product-dataTable').DataTable( {
        "order": [[0, "desc"]],
        "scrollX": false
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[10,11,12]
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
      // Call the dataTables jQuery plugin
  </script>
@endpush

