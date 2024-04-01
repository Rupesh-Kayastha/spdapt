@extends('user.layouts.master')
@section('main-content')
<div class="container-fluid"> @include('user.layouts.notification')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order Lists</h1>
    </div>
    @if(count($orders)>0)
    <div class="user-product-list-sec"> 
        <!-- Order -->
        <div class="user-product-list"> @foreach($orders as $order)

            @php
              $product_id = $order->product_id;
              $product_id_arr = explode(',',$product_id);
              $ordered_prod=DB::table('products')->join('carts','products.id', '=', 'carts.product_id')->select('*')->whereIn('products.id',$product_id_arr)->where('order_id','=',$order->order_number)->get();
            @endphp

            <div class="user-product-box">
                <div class="user-product-top">
                    <div class="sl-no"><span>S.N.</span> {{$order->id}}</div>
                    <div class="sl-no"><span>Order No.</span> {{$order->order_number}}</div>
                </div>
                <div class="user-product-body">
                     <div class="p-list-name"><span>Order Date : </span> {{date('Y-m-d', strtotime($order->created_at))}}</div>
                    <div class="p-list-name"><span>Name : </span> {{$order->first_name}} {{$order->last_name}}</div>
                    <div class="p-list-name"><span>Email : </span> {{$order->email}}</div>
                    <div class="p-list-name"><span>Quantity : </span> {{$order->quantity}}</div>

                     <!--Product info display start-->

                     {{-- cart product listing start here --}}	
							@foreach($ordered_prod as $res_cart_prod)
							<div class="add-to-cart-box">
									@php
									$cart_photo=explode(',',$res_cart_prod->photo);
									@endphp
									
									<div class="cart-details">
											<div class="cart-header"><img style="width:20%" src="{{ url('/public/product/') }}/{{ $cart_photo[0] }}">
													<div class="cart-p-title"><a class="cart-p-title" href="{{ route('product-detail',$res_cart_prod->slug) }}" target="_blank">{{$res_cart_prod->title}} {{$res_cart_prod->product_sub_title}} @if(!empty($res_cart_prod->size)) – {{$res_cart_prod->size}} @endif </a></div>
													
                          <div class="cart-p-footer">
													<div class="cart-p-price">
														@if($res_cart_prod->is_cross_sell=='1')
														Price : $ <strike class="text-danger">{{number_format($res_cart_prod->price,2)}}</strike> $0.00 @else Price : ${{number_format($res_cart_prod->price,2)}}
														@endif
													</div>
                          <span type="text"><strong>Qnt.:</strong> {{$res_cart_prod->quantity}}	</span>
												
											</div>
													<div class="cart-p-subtotal total-amount cart_single_price money" data-title="Total">Subtotal 
															@if($res_cart_prod->is_cross_sell=='1')
																	<span>$0.00</span>
															@else
																	<span>${{number_format($res_cart_prod->amount,2)}}</span>
															@endif
													</div>
											</div>
											
									</div>
							</div>
							@endforeach

                      <!--Product info display end-->
                    
                    <div class="p-list-name"><span>Total Amount : </span> ${{number_format($order->total_amount,2)}}</div>
                    <div class="user-product-bottom">
                        <div class="status"> Status @if($order->status=='new') <span class="badge badge-primary">{{$order->status}}</span> @elseif($order->status=='process') <span class="badge badge-warning">{{$order->status}}</span> @elseif($order->status=='delivered') <span class="badge badge-success">{{$order->status}}</span> @else <span class="badge badge-danger">{{$order->status}}</span> @endif </div>
                        <div class="status">Action <a href="{{route('user.order.show',$order->id)}}" class="yellow-btn"><i class="fa-solid fa-eye"></i></a>
                            <form method="POST" action="{{route('user.order.delete',[$order->id])}}">
                                @csrf 
                                
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach </div>
    </div>
    <div class="user-product-box box-full-width">{{$orders->links()}}</div>
    @else
    <div class="user-product-box box-full-width">
        <div class="user-product-top">
            <div class="sl-no"><span>You have no order yet!! Please order some products</span></div>
        </div>
    </div>
    @endif
</div>
<style>
  div.dataTables_wrapper div.dataTables_paginate{
      display: none;
  }

.user-product-list {
    margin: 30px 0;
    padding: 0;
    position: relative;
    display: grid;
    gap: 30px;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    justify-content: start;
}
.user-product-list .user-product-box {
    margin: 0;
    padding: 15px;
    background: #f1f1f1;
    border-radius: 10px;
    position: relative;
}
.user-product-list .user-product-box .user-product-top {
    margin: 0 0 15px 0;
    padding: 0;
    position: relative;
    display: flex;
    gap: 0 10px;
    justify-content: space-between;
    align-items: center;
}
.user-product-top .sl-no {
    margin: 0;
    padding: 0;
    position: relative;
    font-size: 14px;
    font-weight: 500;
    color: #000;
}
.user-product-top .sl-no span {
    color: #878787;
    min-width: 32px;
    display: inline-flex;
}
.user-product-box .user-product-body {
    margin: 0;
    padding: 15px;
    background: #FFF;
    border-radius: 7px;
    box-shadow: 0 2px 5px #0000000d;
}
.user-product-box .user-product-body .p-list-name {
    margin: 0 0 5px 0;
    padding: 0;
    position: relative;
    display: flex;
    align-items: center;
    gap: 0 10px;
    font-size: 13px;
    color: #000;
    font-weight: 500;
}
.user-product-box .user-product-body .p-list-name span {
    margin: 0;
    padding: 0;
    min-width: 95px;
    display: inline-flex;
    color: #00867a;
}
.user-product-box .user-product-body .user-product-bottom {
    margin: 10px 0 0 0;
    padding: 10px 0 0 0;
    border-top: 1px solid #0000001a;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.user-product-bottom .status {
    margin: 0;
    padding: 0;
    position: relative;
    font-size: 13px;
    font-weight: 500;
    color: #000;
    display: flex;
    align-items: center;
    gap: 0 6px;
}
.user-product-bottom .status span {
    margin: 0 0 0 8px;
    padding: 4px 14px;
    background: #008643;
    color: #FFF;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 500;
    display: inline-flex;
    text-transform: uppercase;
}
.user-product-bottom .status a {
    margin: 0;
    padding: 5px 12px;
    background: #cf0014;
    font-size: 12px;
    color: #FFF;
    border-radius: 4px;
}
.user-product-bottom .status a.yellow-btn {
    background: #f7bb07;
}
  </style>


@endsection
@push('styles')
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush
@push('scripts') 
<!-- Page level plugins --> 
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<!-- Page level custom scripts --> 
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script> 
<script>
      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8]
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