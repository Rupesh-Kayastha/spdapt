<!DOCTYPE html>
<html>

<head>
  <style>
    /* Add inline styles for better email client compatibility */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    table {
      width: 100%;
    }

    td {
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
    }

    .header {
      background-color: #010101;
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    .content {
      padding: 20px;
    }
    p, th{
      font-size: 15px !important;
    }

    .footer {
      background-color: #010101;
      color: #fff;
      text-align: center;
      padding: 10px;
    }

    .styled-table {
      border-collapse: collapse;
      margin: 25px 0;
      font-size: 0.9em;
      font-family: sans-serif;
      min-width: 400px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
      background-color: #ffc107;
      color: #ffffff;
      text-align: left;
    }

    .styled-table th,
    .styled-table td {
      padding: 12px 15px;
    }

    .styled-table tbody tr {
      border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
      border-bottom: 2px solid #ffc107;
    }

    .styled-table tbody tr.active-row {
      font-weight: bold;
      color: #ffc107;
    }
    .table-font td{
      font-size: 14px !important;
    }
  </style>
</head>

<body>
  <table>
    <tr>
      <td class="header">
        <img src="{{url('/')}}/public/storage/photos/1/General%20Settings/logo.png"
          alt="morshgolf">
        <h1>Your pending order process</h1>
      </td>
    </tr>
    <tr>
      <td class="content">
        <p>Dear {{ $name }}</p>
        <p>  It Looks like you haven't finished checking out yet.</p>
          <p style="font-weight:bold;">The good news?</p> 
            <p>We at Morsh Golf saved your cart for you. As an extra, go on and complete your order now before your cart expires and we will throw in FREE a dozen golf balls as well.</p>
            <p><a target="_blank" href="{{url('/')}}/user/login">FINNISH CHECKOUT</a></p>
        <br>

        @if ($data != null)
          <h4>Cart Details</h4>
          <table class="styled-table">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Product Photo</th>
                <th>Product Quantity</th>
                <!-- <th>Product Price</th>
                <th>Product Total Price</th> -->
              </tr>
            </thead>
            <tbody>
              @php
                

                $avondedcarts =DB::table('carts')
                        ->join('users','users.id','=','carts.user_id')                        
                        ->where('user_id','!=','1')
                        ->where(["order_id" => NULL, "user_type" => "reg"])
                        ->where('user_id',$cart_user_id)
                        ->get();

              @endphp
              @foreach($avondedcarts as $res_prod_item)
                @if($res_prod_item->product_id!=11)
                @php

                  $product = DB::table('products')->where('id', $res_prod_item->product_id)->first();
                  $cart_photo = explode(',', @$product->photo);

                @endphp
              <tr class="table-font">
                <td>{{ @$product->title }}</td>
                <td><img src="{{ url('/public/product/') }}/{{ $cart_photo[0] }}" class="img-fluid zoom"
                    style="max-width:80px" alt="{{ $cart_photo[0] }}"></td>
                <td>{{ $res_prod_item->quantity }}</td>
                {{--<td>${{ $res_prod_item->price }}</td>
                <td>${{ $res_prod_item->amount }}</td>
                --}}
              </tr>
                @endif
              @endforeach

            </tbody>
          </table>
          @endif
<br>          
<p>
<pre>
<strong>MorshGolf</strong>
9424-7285 Québec Inc.
1390, Boul de Montarville, Suite 10
Boucherville, QC. J4B 8B8
+1 888 800 1911
www.morshgolf.com
</pre>
</p>
  </td>
  </tr>
  </table>

</body>

</html>