@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Order <a href="{{route('order.pdf',$order->id)}}"
      class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i>PDF Invoice</a>

      <a style="margin-right: 10px;" href="{{route('order.pdfPackingSlip',$order->id)}}"
        class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i>PDF Packing Slip</a>
  </h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>S.N.</th>
          <th>Order No.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Quantity</th>
          <th>Charge</th>
          <th>Total Amount</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$order->id}}</td>
          <td>{{$order->order_number}}</td>
          <td>{{$order->first_name}} {{$order->last_name}}</td>
          <td>{{$order->email}}</td>
          <td>{{$order->quantity}}</td>
          <td>Free</td>
          <td>${{number_format($order->total_amount,2)}}</td>
          <td>
            @if($order->status=='new')
            <span class="badge badge-primary">{{$order->status}}</span>
            @elseif($order->status=='process')
            <span class="badge badge-warning">{{$order->status}}</span>
            @elseif($order->status=='delivered')
            <span class="badge badge-success">{{$order->status}}</span>
            @else
            <span class="badge badge-danger">{{$order->status}}</span>
            @endif
          </td>
          <td>
            <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1"
              style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
              data-placement="bottom"><i class="fas fa-edit"></i></a>
            <form method="POST" action="{{route('order.destroy',[$order->id])}}">
              @csrf
              @method('delete')
              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px;
                width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i
                  class="fas fa-trash-alt"></i></button>
            </form>
          </td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-12 col-lx-12">
            <div class="order-info">
              <h4 class="text-center pb-12">ORDER INFORMATION</h4>
              <table class="table">
                <tr class="">
                  <td>Order Number</td>
                  <td> : {{$order->order_number}}</td>

                  <td>Order Date</td>
                  <td> : {{$order->created_at->format('D d M, Y')}} at {{$order->created_at->format('g : i a')}} </td>
                </tr>
                <tr>
                  <td>Payment Method</td>
                  <td> : {{ $order->payment_method }}</td>

                  <td>Payment Status</td>
                  <td> : {{$order->payment_status}}</td>
                </tr>
                <tr>
                  <td>Order Status</td>
                  <td> : {{$order->status}}</td>

                  <td>Shipping Charge</td>
                  @if ($order->shipping_charge > 0)
                    <td> :$ {{ number_format($order->shipping_charge,2)  }}</td>
                  @else
                    <td> :Free</td>
                  @endif
                </tr>
                @foreach($ordered_prods as $res_cart_prod)
                  @php
									  $cart_photo=explode(',',$res_cart_prod->photo);
									@endphp
                  <tr>
                    <td>Product Name</td>
                    <td> :<a target="_blank" href="{{url('/')}}/shop/{{$res_cart_prod->slug}}"> {{$res_cart_prod->title}} {{$res_cart_prod->product_sub_title}} @if(!empty($res_cart_prod->size)) – {{$res_cart_prod->size}} </a> @endif</td>

                    <td>Product Image</td>
                    <td> : <img src="{{ url('/public/product/') }}/{{$cart_photo[0]}}" height="100px" width="100px"></td>
                  </tr>

                  <tr>
                    <td>Product Quantity</td>
                    <td> : {{$res_cart_prod->quantity}}</td>

                    <td>Product Price</td>
                    <td> : $ {{number_format($res_cart_prod->price,2)}}</td>
                  </tr>
                @endforeach
                <tr>
                  <td>Coupon</td>
                  <td> : $ {{number_format($order->coupon,2)}}</td>

                  <td>Total Amount</td>
                  <td> : $ {{number_format($order->total_amount,2)}}</td>
                </tr>
                
              </table>
            </div>

            <div class="shipping-info">
              <h4 class="text-center pb-12">BILLING INFORMATION</h4>
              <table class="table">
                <tr class="">
                  <td>Full Name</td>
                  <td> : {{$order->first_name}} {{$order->last_name}}</td>

                  <td>Email</td>
                  <td> : {{$order->email}} </td>
                </tr>
                <tr>
                  <td>Phone No.</td>
                  <td> : {{$order->phone}}</td>

                  <td>Post Code</td>
                  <td> : {{$order->post_code}}</td>
                </tr>
                <tr>
                  @php $country = DB::table('countries')->where('id', $order->country)->first(); @endphp
                  <td>Country</td>
                  <td> : {{ $country->country_name }}</td>
                  <td>Address</td>
                  <td> : {{$order->address1}}, {{$order->address2}}</td>
                </tr>
                <tr>
                    @php
                      $shipping_state_id = $order->state_id;                      

                      if(is_numeric($shipping_state_id))
                      {    
                        $billing_state = DB::table('states')->where('id', $shipping_state_id)->value('state_name');                            
                      }
                      else
                      {
                            $billing_state = trim($shipping_state_id); 
                      }

                    @endphp

                      <td>State</td><td>:{{$billing_state}}</td>
                </tr>

                @if ($order->order_note != null)
                  <tr>
                    <td>ORDER NOTES</td>
                    <td> : {{ $order->order_note }}</td>
                  </tr>
                @endif             
              </table>
            </div>
            @if ($order->ship_to_different == 1)
              <div class="shipping-info">
                <h4 class="text-center pb-12">SHIPPING DIFFERENT ADDRESS INFORMATION</h4>
                <table class="table">
                  <tr class="">
                    <td>Full Name</td>
                    <td> : {{$order->first_name_shipping}} {{$order->last_name_shipping}}</td>

                    <td>Email</td>
                    <td> : {{$order->email_shipping}} </td>
                  </tr>
                  <tr>
                    <td>Phone No.</td>
                    <td> : {{$order->phone_shipping}}</td>

                    <td>Post Code</td>
                    <td> : {{$order->post_code_shipping}}</td>
                  </tr>
                  <tr>
                    @php $country = DB::table('countries')->where('id', $order->country_shipping)->first(); @endphp
                    <td>Country</td>
                    <td> : {{ $country->country_name }}</td>

                    <td>Address</td>
                    <td> : {{$order->address1_shipping}}, {{$order->address2_shipping}}</td>
                  </tr> 
                  <tr>
                    @php
                      // Difference Address State

                      $diff_addrs_shipping_state_id = $order->state_id_shipping;

                      if(is_numeric($diff_addrs_shipping_state_id))
                      {
                        $billing_diff_addr_state = DB::table('states')->where('id', $diff_addrs_shipping_state_id)->value('state_name');                            
                            
                      }else
                      {
                            $billing_diff_addr_state = trim($diff_addrs_shipping_state_id); 
                      }
                     @endphp 
                     <td>State</td><td>:{{$billing_diff_addr_state}}</td>
                  </tr>
                  
                </table>
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>
    @endif

  </div>
</div>
@endsection

@push('styles')
<style>
  .order-info,
  .shipping-info {
    background: #ECECEC;
    padding: 20px;
  }

  .order-info h4,
  .shipping-info h4 {
    text-decoration: underline;
  }
</style>
@endpush