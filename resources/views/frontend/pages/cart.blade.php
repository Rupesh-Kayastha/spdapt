@php
  $settings = DB::table('settings')->get();
@endphp

@extends('frontend.layouts.master')
@section('title', 'Cart - Morsh Golf')
@section('main-content')

  <!--BANNER SEC-->
  <section class="all-inner-banner-sec"
    style="background: url('{{ asset('frontend/images/add-to-cart/banner-bg.jpg') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
      <div class="inner-banne-left">
        <h1>Add To Cart</h1>
      </div>
      <div class="inner-banne-img"> <img src="{{ asset('frontend/images/product-details/product-img.png') }}"
          class="mar-minus-buttom" alt="Free Shipping Worldwide" /> </div>
    </div>
  </section>
  <!--BANNER SEC-->
  <section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a>Add To Cart</a></li>
      </ul>
    </div>
  </section>
  <section class="add-to-cart-sec">
    <div class="add-to-cart-img">
      <img src="{{ asset('/public/frontend/images/add-to-cart/add-to-cart-offer-img.png') }}" class="img-fluid"
        alt="Add To Cart">
      @include('frontend.layouts.notification')
    </div>

    @if (is_object(Helper::getAllProductFromCart()) && count(Helper::getAllProductFromCart()) > 0)
      <div class="add-to-cart-body">
        <form action="{{ route('cart.update') }}" method="POST">
          @csrf
          <div class="add-to-cart-list">
            <h3>Cart</h3>
            @foreach (Helper::getAllProductFromCart() as $key => $cart)
              <div class="add-to-cart-box">
                @php
                  $cart_photo = explode(',', $cart->product['photo']);
                @endphp
                <div class="cart-img" style="background-image: url('{{ url('/public/product/') }}/{{ $cart_photo[0] }}')">
                </div>
                <div class="cart-details">
                  <div class="cart-header">
                    <div class="cart-p-title"><a class="cart-p-title"
                        href="{{ route('product-detail', $cart->product['slug']) }}">{{ $cart->product['title'] }}
                        {{ $cart->product['product_sub_title'] }} @if (!empty($cart->product['size']))
                          – {{ $cart->product['size'] }}
                        @endif </a></div>
                    <div class="qty-container">
                      <button class="qty-btn-minus btn-light" type="button" data-type="minus"
                        data-field="quant[{{ $key }}]"><i class="fa fa-minus"></i></button>
                      <input type="text" name="quant[{{ $key }}]" value="{{ $cart->quantity }}"
                        class="input-qty input-number" data-min="1" data-max="100" />
                      <input type="hidden" name="qty_id[]" value="{{ $cart->id }}">
                      <button class="qty-btn-plus btn-light" type="button" data-type="plus"
                        data-field="quant[{{ $key }}]"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="cart-p-subtotal total-amount cart_single_price money" data-title="Total">Subtotal
                      @if ($cart['is_cross_sell'] == '1')
                        <span>$0.00</span>
                      @else
                        @php $currency = helper::getCurrency(number_format($cart['price'],2)); @endphp
                        <span>{{ session('symbol') . '' . number_format((float) $currency, 2, '.', '') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="cart-p-footer">
                    <div class="cart-p-price">
                      @php $currencyData = helper::getCurrency(number_format($cart['amount'],2)); @endphp
                      @if ($cart['is_cross_sell'] == '1')
                        Price : <strike
                          class="text-danger">{{ session('symbol') . ' ' . number_format((float) $currencyData, 2, '.', '') }}</strike>
                        $0.00
                      @else
                        Price : {{ session('symbol') . '' . number_format((float) $currencyData, 2, '.', '') }}
                      @endif
                    </div>
                    <div class="cart-delete" data-title="Remove"><a class="cart-delete"
                        href="{{ route('cart-delete', $cart->id) }}" title="Delete Item">Delete</a></div>
                  </div>
                </div>
              </div>
            @endforeach

            <div class="cart-btn-part">
              <button class="btn  updatebtns" type="submit">Update</button>
            </div>
          </div>
        </form>


        <div class="add-to-cart-details">
          <h3>Cart Details</h3>

          <div class="cart-coupon">
            <div class="cart-c-title">Coupon
              <br>
              @if (!empty(Session::get('coupon')['code']))
                <span>{{ Session::get('coupon')['code'] }}</span>
              @endif
            </div>
            @if (!empty(Session::get('coupon')['value']))
              @php $currency = helper::getCurrency(number_format(Session::get('coupon')['value'],2)); @endphp
              <div class="cart-c-discount">{{ session('symbol') . ' ' . number_format((float) $currency, 2, '.', '') }} <a
                  href="{{ route('coupon-delete', Session::get('coupon')['code']) }}" class="text-danger">Remove</a>
              </div>
            @endif

            <form action="{{ route('coupon-store') }}" method="POST">
              @csrf
              <input type="text" name="code" class="form-control" placeholder="Type Coupon Code">
              <button class="coupon-btn">Apply Coupon Code</button>
            </form>
          </div>

          <p>{{ $settings[0]->checkout_note_text }}</p>
          <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <div class="cart-total-part">
              <div class="cart-t-title">Cart Totals</div>


              <ul>
                @php $currencyData = helper::getCurrency(number_format(Helper::totalCartPriceWithCrossSell(),2)); @endphp
                <li><span class="order_subtotal" data-price="{{ Helper::totalCartPrice() }}">Cart Sub Total</span>
                  <span>{{ session('symbol') . '' . number_format((float) $currencyData, 2, '.', '') }}</span></li>
                @foreach (Helper::crosssell() as $key => $cross)
                  @php $cData = helper::getCurrency(number_format($cross['price'])); @endphp
                  <li>Discount <span>{{ session('symbol') . ' ' . number_format((float) $cData, 2, '.', '') }}</span></li>
                @endforeach

                @if (isset(Session::get('getshipping')['fuel_surcharge']) && Session::get('getshipping')['fuel_surcharge'] > 0)
                  @php $currData = helper::getCurrency(number_format(Session::get('getshipping')['fuel_surcharge'],2)); @endphp
                  <li>Fuel Surcharge
                    <span> {{ session('symbol') . '' . number_format((float) $currData, 2, '.', '') }}
                    </span>
                  </li>
                @endif


                @if (session()->has('coupon'))
                  @php $currency = helper::getCurrency(number_format(Session::get('coupon')['value'],2)); @endphp
                  <li class="coupon_price" data-price="{{ Session::get('coupon')['value'] }}">
                    Discount<span>{{ session('symbol') . ' ' . number_format((float) $currency, 2, '.', '') }}</span></li>
                @endif


                @php
                  $total_amount = Helper::totalCartPrice();
                  if (session()->has('coupon')) {
                      $total_amount = $total_amount - Session::get('coupon')['value'];
                  }
                  if (isset(Session::get('getshipping')['fuel_surcharge']) && Session::get('getshipping')['fuel_surcharge'] > 0) {
                      $total_amount = $total_amount + Session::get('getshipping')['fuel_surcharge'];
                  }
                @endphp

                @if (session()->has('coupon'))
                  @php $currency = helper::getCurrency(number_format($total_amount,2)); @endphp
                  <li class="last" id="order_total_price">
                    Total<span>{{ session('symbol') . ' ' . number_format((float) $currency, 2, '.', '') }}</span></li>
                @else
                  @php $currency = helper::getCurrency(number_format($total_amount,2)); @endphp
                  <li class="last" id="order_total_price">
                    Total<span>{{ session('symbol') . '' . number_format((float) $currency, 2, '.', '') }}</span></li>
                @endif
              </ul>


            </div>
            <div class="cart-total-btn-part">
              <a href="{{ route('checkout') }}" class="cart-total-btn">PROCEED TO CHECKOUT</a>
              <a href="{{ route('fairway-wood') }}" class="cart-total-btn btn-2">CONTINUE TO SHOPPING</a>
            </div>
          </form>
        </div>
      </div>
    @else
      <div class="add-to-cart-body">
        <div class="add-to-cart-list" style="width: 100%;">
          <h3>Cart</h3>
          <div class="add-to-cart-box">
            <div class="cart-details">
              <div class="cart-header">
                <div class="cart-p-title">There are no any carts available. <a href="{{ route('fairway-wood') }}"
                    style="color:blue;">Continue shopping</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </section>

  @include('frontend.layouts.facilities')
  @include('frontend.layouts.call_to_action')
  @include('frontend.layouts.testimonial')
  @include('frontend.layouts.faq')
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('.shipping select[name=shipping]').change(function() {
        let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
        let subtotal = parseFloat($('.order_subtotal').data('price'));
        let coupon = parseFloat($('.coupon_price').data('price')) || 0;
        $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
      });
    });
  </script>
@endpush
