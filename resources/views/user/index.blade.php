@extends('user.layouts.master')


<style>
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


@section('main-content')
<div class="container-fluid"> @include('user.layouts.notification') 
    
    <!-- Page Heading -->
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
      <!--Recharge-->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Recharge</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format(\App\Models\Transaction::countUserRecharge(),2)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Withdrawal-->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Withdrawal</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format(\App\Models\Transaction::countUserWithdrawal(),2)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--income-->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Income</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format(\App\Models\Transaction::countUserIncome(),2)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Order -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countUserOrder()}}</div>
                  </div>
                  
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- whatsapp -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Whatsapp</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">7205022110</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-gray-300" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Products -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">REFERRAL CODE</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-cubes fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>       
    </div>
    
    <div class="user-product-list-sec"> @php
        $orders=DB::table('orders')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->paginate(10);
        @endphp
        <!-- Order -->
        <div class="user-product-list">
            @if(count($orders)>0)
            @php $m = 1; @endphp
            @foreach($orders as $order)

            @php
              $product_id = $order->product_id;
              $product_id_arr = explode(',',$product_id);
              $ordered_prod=DB::table('products')->join('carts','products.id', '=', 'carts.product_id')->select('*')->whereIn('products.id',$product_id_arr)->where('order_id','=',$order->order_number)->get();

            @endphp

           

            <div class="user-product-box">
                <div class="user-product-top">
                    <div class="sl-no"><span>S.N.</span> {{ $m }}</div>
                    <div class="sl-no"><span>Order No.</span> {{$order->order_number}}</div>
                </div>
                <div class="user-product-body">
                    <div class="p-list-name"><span>Order Date : </span> {{ date('Y-m-d', strtotime($order->created_at)) }}</div>
                    <div class="p-list-name"><span>Name : </span> {{$order->first_name}} {{$order->last_name}}</div>
                    <div class="p-list-name"><span>Email : </span> {{$order->email}}</div>
                    <div class="p-list-name"><span>Total Quantity : </span>  {{$order->quantity}}</div>

                      <!--Product info display start-->

                      {{-- cart product listing start here --}}	
							@foreach($ordered_prod as $res_cart_prod)
							<div class="add-to-cart-box">
									@php
									$cart_photo=explode(',',$res_cart_prod->photo);
									// echo '<pre>';
									// print_r($cart_photo);
									@endphp
									
									<div class="cart-details">
											<div class="cart-header"><img style="width:20%" src="{{ url('/public/product/') }}/{{ $cart_photo[0] }}">
													<div class="cart-p-title"><a class="cart-p-title" href="{{ route('product-detail',$res_cart_prod->slug) }}" target="_blank">{{$res_cart_prod->title}} {{$res_cart_prod->product_sub_title}} @if(!empty($res_cart_prod->size)) – {{$res_cart_prod->size}} @endif </a></div>
													
                          <div class="cart-p-footer">
													<div class="cart-p-price">
														@if($res_cart_prod->is_cross_sell=='1')
														Price : <strike class="text-danger">{{number_format($res_cart_prod->price,2)}}</strike> 0.00 @else Price : ${{number_format($res_cart_prod->price,2)}}
														@endif
													</div>
                          <span type="text"><strong>Qnt.:</strong> {{$res_cart_prod->quantity}}	</span>
												
											</div>
													<div class="cart-p-subtotal total-amount cart_single_price money" data-title="Total">Subtotal 
															@if($res_cart_prod->is_cross_sell=='1')
																	<span>0.00</span>
															@else
																	<span>{{number_format($res_cart_prod->amount,2)}}</span>
															@endif
													</div>
											</div>
											
									</div>
							</div>
							@endforeach

                      <!--Product info display end-->
                    
                  

                    <div class="p-list-name"><span>Total Amount : </span>  	{{number_format($order->total_amount,2)}}</div>
                    <div class="user-product-bottom">
                    <div class="status"> Status @if($order->status=='new') <span class="badge badge-primary">{{$order->status}}</span> @elseif($order->status=='process') <span class="badge badge-warning">{{$order->status}}</span> @elseif($order->status=='delivered') <span class="badge badge-success">{{$order->status}}</span> @else <span class="badge badge-danger">{{$order->status}}</span> @endif </div>
                    
                    <!-- <div class="status">Action <a href="{{route('user.order.show',$order->id)}}" class="yellow-btn"><i class="fa-solid fa-eye"></i></a> <form method="POST" action="{{route('user.order.delete',[$order->id])}}">
                            @csrf 
                            
                            @method('delete')
                            <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form></div> -->
                </div>
                </div>
            </div>
            @php $m++; @endphp
            @endforeach
            @else
            <div class="user-product-box box-full-width">
                    <div class="user-product-top">
                        <div class="sl-no"><span>You have no order yet!! Please order some products</span></div>
                    </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection










@push('scripts') 
<script type="text/javascript">

  const url = "{{route('product.order.income')}}";



// Set new default font family and font color to mimic Bootstrap's default styling

Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';

Chart.defaults.global.defaultFontColor = '#858796';



function number_format(number, decimals, dec_point, thousands_sep) {

  // *     example: number_format(1234.56, 2, ',', ' ');

  // *     return: '1 234,56'

  number = (number + '').replace(',', '').replace(' ', '');

  var n = !isFinite(+number) ? 0 : +number,

    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),

    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,

    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,

    s = '',

    toFixedFix = function(n, prec) {

      var k = Math.pow(10, prec);

      return '' + Math.round(n * k) / k;

    };

  // Fix for IE parseFloat(0.55).toFixed(0) = 0;

  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

  if (s[0].length > 3) {

    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);

  }

  if ((s[1] || '').length < prec) {

    s[1] = s[1] || '';

    s[1] += new Array(prec - s[1].length + 1).join('0');

  }

  return s.join(dec);

}



// Area Chart Example

var ctx = document.getElementById("myAreaChart");



axios.get(url)

            .then(function (response) {

              const data_keys = Object.keys(response.data);

              const data_values = Object.values(response.data);





var myLineChart = new Chart(ctx, {

  type: 'line',

  data: {

    labels: data_keys, //["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

    datasets: [{

      label: "Earnings",

      lineTension: 0.3,

      backgroundColor: "rgba(78, 115, 223, 0.05)",

      borderColor: "rgba(78, 115, 223, 1)",

      pointRadius: 3,

      pointBackgroundColor: "rgba(78, 115, 223, 1)",

      pointBorderColor: "rgba(78, 115, 223, 1)",

      pointHoverRadius: 3,

      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",

      pointHoverBorderColor: "rgba(78, 115, 223, 1)",

      pointHitRadius: 10,

      pointBorderWidth: 2,

      data: data_values, //[0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 44660],

    }],

  },

  options: {

    maintainAspectRatio: false,

    layout: {

      padding: {

        left: 10,

        right: 25,

        top: 25,

        bottom: 0

      }

    },

    scales: {

      xAxes: [{

        time: {

          unit: 'date'

        },

        gridLines: {

          display: false,

          drawBorder: false

        },

        ticks: {

          maxTicksLimit: 7

        }

      }],

      yAxes: [{

        ticks: {

          maxTicksLimit: 5,

          padding: 10,

          // Include a dollar sign in the ticks

          callback: function(value, index, values) {

            return '$' + number_format(value);

          }

        },

        gridLines: {

          color: "rgb(234, 236, 244)",

          zeroLineColor: "rgb(234, 236, 244)",

          drawBorder: false,

          borderDash: [2],

          zeroLineBorderDash: [2]

        }

      }],

    },

    legend: {

      display: false

    },

    tooltips: {

      backgroundColor: "rgb(255,255,255)",

      bodyFontColor: "#858796",

      titleMarginBottom: 10,

      titleFontColor: '#6e707e',

      titleFontSize: 14,

      borderColor: '#dddfeb',

      borderWidth: 1,

      xPadding: 15,

      yPadding: 15,

      displayColors: false,

      intersect: false,

      mode: 'index',

      caretPadding: 10,

      callbacks: {

        label: function(tooltipItem, chart) {

          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';

          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);

        }

      }

    }

  }

});


            })

            .catch(function (error) {

            //   vm.answer = 'Error! Could not reach the API. ' + error

            console.log(error)

            });











  </script> 
@endpush