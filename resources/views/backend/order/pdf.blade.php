<!DOCTYPE html>
<html>

<head>
    <title>Order @if ($order) - {{ $order->order_number }} @endif </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    @if ($order)
    <style type="text/css">
        .invoice-header {
            background: #f7f7f7;
            padding: 10px 20px 10px 20px;
            border-bottom: 1px solid gray;
        }

        .site-logo {
            margin-top: 20px;
        }

        .invoice-right-top h3 {
            padding-right: 20px;
            color: black;
            font-size: 30px !important;
            font-family: serif;
        }

        .invoice-left-top {
            border-left: 4px solid black;
            padding-left: 20px;
            padding-top: 20px;
        }

        .invoice-left-top p {
            margin: 0;
            line-height: 20px;
            font-size: 16px;
            margin-bottom: 3px;
        }

        thead {
            background: black;
            color: #FFF;
        }

        .authority h5 {
            margin-top: -10px;
            color: black;
        }

        .thanks h4 {
            color: black;
            font-size: 25px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }

        .site-address p {
            line-height: 6px;
            font-weight: 300;
        }

        .table tfoot .empty {
            border: none;
        }

        .table-bordered {
            border: none;
        }

        .table-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .table td,
        .table th {
            padding: .30rem;
        }

        .address p{
            margin-bottom:0 !important;
        }

        .invoice-right-top{
            margin-top:-3px;
            margin-right:66px !important;
        }

    
    </style>
    <div class="invoice-header">
        <div class="float-left site-logo">
            <img src="{{ asset('storage/photos/1/General%20Settings/morsh-golf-logo-est.png') }}" alt="morshgolf">
            <div>
                <br>
            <h3>Invoice #{{ $order->order_number }}</h3>
            <!-- <p>{{ $order->created_at->format('m-d-Y') }}</p> -->
            {{-- <img class="img-responsive"
                src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate(route('admin.product.order.show', $order->id )))}}">
            --}}
            </div>
        </div>
        <div class="float-right site-address">
            <h4>MorshGolf</h4>
            <p>9424-7285 Québec Inc.</p>
            <p>1390, Boul de Montarville, Suite 10</p>
            <p>Boucherville, QC. J4B 8B8</p>
            <p>+1 888 800 1911</p>
            <p>www.morshgolf.com</p>
          {{--<p>Phone: <a href="tel:+1 888 800 1911">+1 888 800 1911</a></p>
            <p>Email: <a href="mailto:{{ env('MAIL_USERNAME') }}">{{ env('MAIL_USERNAME') }}</a></p> --}}
            <p>Payment Method: {{$order->payment_method}}</p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="invoice-description">
        <div class="invoice-left-top float-left">
            <h6>Invoice to</h6>
           
            <h3>{{ $order->first_name }} {{ $order->last_name }}</h3>
         
            <div class="address">
     
                <p>
                    @php $country = DB::table('countries')->where('id', $order->country)->first(); @endphp
                    <strong>Country: </strong>
                    {{ $country->country_name }}
                </p>
                <!-- <h3>Invoice #{{ $order->order_number }}</h3> -->
            <!-- <p>{{ $order->created_at->format('m-d-Y') }}</p> -->
            {{-- <img class="img-responsive"
                src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate(route('admin.product.order.show', $order->id )))}}">
            --}}
                <p>
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
                   <strong> State: </strong>  {{$billing_state}}
                </p>
                
                <p>
                    <strong>Address: </strong>
                    {{ $order->address1 }} <br> {{ $order->address2 }}
                </p>
                <p>
                    <strong>Post Code: </strong>
                    {{ $order->post_code }}
                </p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
            </div>
        </div>
        <div class="invoice-right-top float-right" class="text-right">

          <!--Shipping Difference Address-->
          @if($order->ship_to_different==1)
            <br>
            <h6>Shipping to</h6>
            <h3>{{ $order->first_name_shipping }} {{ $order->last_name_shipping }}</h3>
            <div class="address">
                <p>
                    @php $country_diff_ship = DB::table('countries')->where('id', $order->country_shipping)->first(); @endphp
                    <strong>Country: </strong>
                    {{ $country_diff_ship->country_name }}
                </p>
                <!-- <p>{{ $order->created_at->format('m-d-Y') }}</p> -->
                <p>
                @php
                      $shipping_state_id = $order->state_id_shipping;                      

                      if(is_numeric($shipping_state_id))
                      {    
                        $billing_state = DB::table('states')->where('id', $shipping_state_id)->value('state_name');                            
                      }
                      else
                      {
                            $billing_state = trim($shipping_state_id); 
                      }

                @endphp
                   <strong> State: </strong>  {{$billing_state}}
                </p>
                
                <p>
                    <strong>Address: </strong>
                    {{ $order->address1_shipping }} <br> {{ $order->address2_shipping }}
                </p>
                <p>
                    <strong>Post Code: </strong>
                    {{ $order->post_code_shipping }}
                </p>
                <p><strong>Phone:</strong> {{ $order->phone_shipping }}</p>
                <p><strong>Email:</strong> {{ $order->email_shipping }}</p>
            </div> 
            @else

            <h6>Shipping to</h6>
            <h3>{{ $order->first_name }} {{ $order->last_name }}</h3>
         
            <div class="address">
     
                <p>
                    @php $country = DB::table('countries')->where('id', $order->country)->first(); @endphp
                    <strong>Country: </strong>
                    {{ $country->country_name }}
                </p>
                <!-- <h3>Invoice #{{ $order->order_number }}</h3> -->
            <p>{{ $order->created_at->format('m-d-Y') }}</p>
            
                <p>
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
                   <strong> State: </strong>  {{$billing_state}}
                </p>
                
                <p>
                    <strong>Address: </strong>
                    {{ $order->address1 }} <br> {{ $order->address2 }}
                </p>
                <p>
                    <strong>Post Code: </strong>
                    {{ $order->post_code }}
                </p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
            </div>
               @endif       

        </div>
        <div class="clearfix"></div>
    </div>



    <section class="order_details pt-3">
        <div class="table-header">
            <h5>Order Details</h5>
        </div>
        <table class="table table-bordered table-stripe">
            <thead>
                <tr>
                    <th scope="col" class="col-3">Product</th>
                    <th scope="col" class="col-3">Quantity</th>
                    <th scope="col" class="col-3">Product Price</th>
                    <th scope="col" class="col-3">Discount</th>
                    <th scope="col" class="col-3">Product Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $product = DB::table('carts')->join('products', 'carts.product_id', '=', 'products.id')->where('carts.order_id', $order->order_number)->get();
                @endphp
                @foreach($product as $item)
                    <tr>
                        <td>{{ $item->title ." - ". $item->product_sub_title }}</td>
                        <td>{{ $item->quantity }}</td>                                            
                        <td>${{ number_format($item->amount, 2) }}</td>
                        @if($item->discount>0)
                        <td>{{ $item->discount }}%</td> 
                        @else
                        <td>0</td> 
                        @endif 

                        @php
                           $prod_after_discount=0;                            
                        @endphp

                        @if($item->discount>0)
                            @php 
                               $prod_sub_tot_price = $item->amount*$item->quantity; 
                                  $prod_after_discount = $prod_sub_tot_price-(($prod_sub_tot_price/100)*$item->discount);
                            
                            @endphp
                        @else
                       @php $prod_after_discount = $item->price; @endphp
                        @endif 
                        <td>${{ number_format($prod_after_discount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            @if($item->shipping_price>0)
                <tr>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="text-right">Shipping fees:</th>
                    <th scope="col"> 
                        <span>${{ number_format($item->shipping_price, 2) }}</span>

                        @if($order->ship_to_different==1)
                            Via {{$country_diff_ship->country_name}}
                        @else
                            Via {{$country->country_name}}
                        @endif
                
                    </th>
                </tr>
                @endif
                <tr>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="text-right">Subtotal:</th>
                    <th scope="col"> <span>${{ number_format($order->sub_total, 2) }}</span></th>
                </tr>
                

                @if($order->coupon>0)
                <tr>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="text-right">Coupon Discount:</th>
                    <th scope="col"> <span>-${{ number_format($order->coupon, 2) }}</span></th>
                </tr>
                @endif

                <tr>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="empty"></th>
                    <th scope="col" class="text-right">Total:</th>
                    <th>
                        <span>
                            ${{ number_format($order->total_amount, 2) }}
                        </span>
                    </th>
                </tr>
            </tfoot>
        </table>
    </section>

    <!-- <div class="thanks mt-3">
        <h4>Thank you for your business !!</h4>
    </div> -->
<br><br>
    <hr>
    <h6 align="center">For more information, please contact us at info@morshgolf.com</h6> 
   
    <!-- <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div> -->
    <div class="clearfix"></div>
    @else
    <h5 class="text-danger">Invalid</h5>
    @endif
</body> 

</html>