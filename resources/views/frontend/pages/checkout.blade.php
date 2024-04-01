@php
  $settings = DB::table('settings')->get();
@endphp
@extends('frontend.layouts.master')
@section('title', 'Morsh Golf 2 Wood | 10 Degree 3 Wood Golf Club || Checkout')
@section('main-content')
  <section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a>Checkout</a></li>
      </ul>
    </div>
  </section>
  <section class="checkout-sec">
    <div class="checkout-body">
      <h2>Checkout</h2>
      @include('frontend.layouts.notification')
      @if (!empty(Helper::getAllProductFromCart()))
        <div class="checkout-product-list">
          @php $tot_shipping_fees=0;@endphp
          @foreach (Helper::getAllProductFromCart() as $key => $cart)
            @if ($cart->product_id == 11)
              <input type="hidden" name="shipping_product" id="shipping_product" value="{{ $cart->product_id }}">
            @endif
            <div class="checkout-product-box">
              <div class="checkout-p">
                @php
                  $checkout_photo = explode(',', $cart->product['photo']);
                @endphp
                <div class="checkout-product-img"
                  style="background: url('{{ url('/public/product/') }}/{{ $checkout_photo[0] }}')"></div>
                <h3><a href="{{ route('product-detail', $cart->product['slug']) }}">{{ $cart->product['title'] }}
                    {{ $cart->product['product_sub_title'] }} @if (!empty($cart->product['size']))
                      – {{ $cart->product['size'] }}
                    @endif </a></h3>
              </div>
              <div class="c-product-qty">{{ $cart->quantity }}</div>
              <div class="c-product-price">
                @if ($cart['is_cross_sell'] == '1')
                  @php $currif = Helper::getCurrency(number_format($cart['price'],2)); @endphp
                  Price : <strike
                    class="text-danger">{{session('symbol'). '' . number_format($currif, 2, '.', '') }}</strike>{{session('symbol')}}0.00
                @else
                  @php
                    $currelse = Helper::getCurrency(number_format($cart['price'],2));
                  @endphp
                  Price : {{ session('symbol') . '' . number_format($currelse, 2, '.', '') }}
                @endif

                @if($cart->product['shipping_price']!=NULL)
                  <h6>Shipping Fees:  {{session('symbol').$cart->product['shipping_price']}}</h6>
                  @php $tot_shipping_fees=$tot_shipping_fees+$cart->product['shipping_price']; @endphp
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @endif



      <div class="billing-details-sec">
        @if (session('error'))
          <div class="alert alert-danger alert-dismissable fade show text-center">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('error') }}
          </div>
        @endif

        <h3>Billing Details</h3>
        <div class="billing-details-body">
          <form class="form" method="POST" action="{{ route('cart.order') }}">
            @csrf
            <div class="billing-details-form">
              <div class="form-group">
                <label for="">First Name *</label>
                <input type="text" class="form-control" placeholder="" name="first_name" id=""
                  value="{{ old('first_name') }}" required>
                @error('first_name')
                  <span class='text-danger'>{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Last Name *</label>
                <input type="text" class="form-control" placeholder="" name="last_name" id=""
                  value="{{ old('lat_name') }}" required>
                @error('last_name')
                  <span class='text-danger'>{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Email Address *</label>
                <input type="email" class="form-control" placeholder="" name="email" id=""
                  value="{{ old('email') }}" required>
                @error('email')
                  <span class='text-danger'>{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Phone no *</label>
                <input type="number" class="form-control" placeholder="" name="phone" id=""
                  value="{{ old('phone') }}" required>
                @error('phone')
                  <span class='text-danger'>{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Countr *</label>
                @if (Helper::country())
                  <select class="nice-select-country form-control" id="country" name="country" required>
                    <option value=""> - select country - </option>
                    @foreach (Helper::country() as $cn)
                      <option value="{{ $cn->id }}">{{ $cn->country_name }}</option>
                    @endforeach
                  </select>
                @endif
              </div>

              <div class="form-group" id="image_loader">
                <label for="">&nbsp;</label>
                <img src="{{ asset('public/frontend/images/loader.gif') }}" alt="Loader">
              </div>
              <div class="form-group child_cat_hide">
                <label for="">State *</label>
                <select class="form-control" id="child_cat_id" name="state_id">
                  <option value=""> - select state - </option>
                </select>

                <input type="text" name="state_etxt_id" class="form-control show_state_name">
              </div>

              <div class="form-group">
                <label for="">Street Address *</label>
                <input type="text" class="form-control" placeholder="" name="address1" id=""
                  value="{{ old('address1') }}" required>
                @error('address1')
                  <span class='text-danger'>{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Address Details (Optional) </label>
                <input type="text" class="form-control" placeholder="" name="address2" id=""
                  value="{{ old('address2') }}">
                @error('address2')
                  <span class='text-danger'>{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Postcode / Zip *</label>
                <input type="text" class="form-control" placeholder="" name="post_code" id="post_code_shipping"
                  value="{{ old('post_code') }}" required>
                @error('post_code')
                  <span class='text-danger'>{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Town / City *</label>
                <input type="text" class="form-control" placeholder="" name="city" id="city_shipping_data"
                  value="{{ old('city') }}">
                @error('city')
                  <span class='text-danger'>{{ $message }}</span>
                @enderror
              </div>
              <input type="checkbox" id="ship_to_different" name="ship_to_different" value="" >
              <label for="ship_to_different" style="margin-top: 9px;">Ship to a different address?</label><br>
              
              <div class="form-group full-width-f-g defferent_add">
                <div class="billing-details-form shipping_address" style="display: none;">
                  <div class="form-group">
                    <label for="">First Name *</label>
                    <input type="text" class="form-control" placeholder="" name="first_name_shipping"
                      id="" value="{{ old('first_name_shipping') }}">
                    @error('first_name_shipping')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Last Name *</label>
                    <input type="text" class="form-control" placeholder="" name="last_name_shipping"
                      id="" value="{{ old('last_name_shipping') }}">
                    @error('last_name_shipping')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Email Address *</label>
                    <input type="email" class="form-control" placeholder="" name="email_shipping" id=""
                      value="{{ old('email_shipping') }}">
                    @error('email_shipping')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Phone no *</label>
                    <input type="number" class="form-control" placeholder="" name="phone_shipping" id=""
                      value="{{ old('phone_shipping') }}">
                    @error('phone_shipping')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Country *</label>
                    @if (Helper::country())
                      <select class="nice-select-country_shipping form-control" name="country_shipping">
                        <option value=""> - select country - </option>
                        @foreach (Helper::country() as $cn)
                          <option value="{{ $cn->id }}">{{ $cn->country_name }}</option>
                        @endforeach
                      </select>
                    @endif
                  </div>
                  <div class="form-group" id="image_loader_shipping">
                    <label for="">&nbsp;</label>
                    <img src="{{ asset('public/frontend/images/loader.gif') }}" alt="Loader">
                  </div>
                  <div class="form-group child_cat_hide_shipping">
                    <label for="">State *</label>
                    <select class="form-control" id="child_cat_id_shipping" name="state_id_shipping">
                      <option value=""> - select state - </option>
                    </select>
                    <input type="text" name="state_text_shipping" class="form-control show_state_name_shipping">
                  </div>
                  <div class="form-group full-width-f-g" style="display:none;">
                    <label for="">Postcode Lookup *</label>
                    <input type="text" class="form-control" placeholder="" name="post_code_shipping"
                      value="{{ old('post_code_shipping') }}">
                    @error('post_code')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Street Address *</label>
                    <input type="text" class="form-control" placeholder="" name="address1_shipping" id=""
                      value="{{ old('address1_shipping') }}">
                    @error('address1_shipping')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Address Details (Optional) </label>
                    <input type="text" class="form-control" placeholder="" name="address2_shipping" id=""
                      value="{{ old('address2_shipping') }}">
                    @error('address2_shipping')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Postcode / Zip *</label>
                    <input type="text" class="form-control" placeholder="" name="post_code_shipping"
                      id="" value="{{ old('post_code_shipping') }}">
                    @error('post_code')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Town / City *</label>
                    <input type="text" class="form-control" placeholder="" name="city_shipping"
                      value="{{ old('city_shipping') }}">
                    @error('city_shipping')
                      <span class='text-danger'>{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
              
              <div class="form-group full-width-f-g">
                <label for="">Order Notes (Optional) </label>
                <textarea class="form-control" name="order_note" rows="4"></textarea>
              </div>
            </div>
            <div class="billing-details-sidebar">
              <div class="your-order-box">
                <h3>Your Order</h3>
                <ul>
                  @php
                    $totalCrtPrice = Helper::totalCartPrice();
                    $currency = Helper::getCurrency(number_format((float) $totalCrtPrice, 2, '.', ''));
                  @endphp

                  @if($tot_shipping_fees>0)
                  @php $currency = $totalCrtPrice + $tot_shipping_fees; @endphp
                  @endif

                  <li class="order_subtotal" data-price="{{ $currency }}">Sub Total
                    <span>{{session('symbol') . '' . number_format((float) $currency, 2, '.', '')}}</span>
                  </li>
                  @if (session('coupon'))
                    @php
                      $curcoupon = Helper::getCurrency(number_format(session('coupon')['value']));
                    @endphp
                    <li class="coupon_price" data-price="{{ $curcoupon }}">You
                      Save<span>{{session('symbol') . '' . number_format((float) $curcoupon, 2, '.', '') }}</span></li>
                  @endif

                  @php
                    $totalAmount = Helper::totalCartPrice();
                    $total_amount = Helper::getCurrency(number_format((float) $totalAmount, 2, '.', ''));
                    if (session('coupon')) {
                        $total_amount = $total_amount - Helper::getCurrency(number_format(session('coupon')['value']));
                    }
                  @endphp

                  @if($tot_shipping_fees>0)
                  @php $total_amount = $total_amount + $tot_shipping_fees; @endphp
                  @endif
                </ul>
                
                <div class="billing-details-form cart-coupon shipping_calculation" style="background:none;">
                  <div id="shipping_method" style="display: none;">
                    <div class="cart-c-title">Shipping&nbsp;
                      <span style="float:right"><span id="shipping_country_name"></span>
                        @if (Helper::totalCartPrice() >= $settings[0]->free_shipping_cost)
                        <input type="hidden" name="shipping_amount" value="{{ '00.00' }}">
                          {{ '( Free )' }}
                        @else
                          @php 
                            $currency = Helper::getCurrency(number_format($total_amount, 2));
                          @endphp
                             <input type="hidden" name="shipping_amount" value="" id="ship_amnt">
                          {{session('symbol')}}
                          <span id="shipping_charge"></span>
                        @endif

                        @if($tot_shipping_fees>0)
                            @php $currency = $currency + $tot_shipping_fees; @endphp
                          @endif
                          
                      </span>
                    </div>
                  </div>
                  <div id="shipping_method_1" style="display: block;">
                    <div class="cart-c-title">Shipping<span
                        style="float:right;margin: 0px 0 25px 0;padding: 0;
                                        position: relative;font-size: 13px;font-weight: 500;color: #686868;"
                        id="shipping_log">Enter your address to view shipping options.</span>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="currency_total_amount" id="total_amount_data" value="{{ number_format($total_amount, 2) }}">
                @if (session('coupon'))
                <input type="hidden" name="coupon" value="{{ session('coupon')['value'] }}">
                  <div class="total-price last" id="order_total_price">Total <span> {{session('symbol')}}
                    @if (Helper::totalCartPrice() >= $settings[0]->free_shipping_cost)
                    {{number_format($total_amount, 2)}}
                      @else
                        <span class="shipping_charge_data">{{ number_format($total_amount, 2) }}</span>
                      @endif
                    </span></div>
                @else
               
                  <div class="total-price last">Total <span> {{session('symbol')}}
                      @if (Helper::totalCartPrice() >= $settings[0]->free_shipping_cost)
                        {{ number_format($total_amount, 2) }}
                      @else
                        <span class="shipping_charge_data">
                          {{ number_format($total_amount, 2) }}
                        </span>
                      @endif
                    </span></div>
                @endif
              </div>

              <div class="card-details">
                <h3>Payment</h3>
                <div class="payment-list">
                  <label><input type="radio" name="payment_method" id="byPaypal" class="paypal active" checked
                      value="paypal"> Paypal <img src="{{ asset('frontend/images/checkout/paypal.jpg') }}"
                      alt="Pay with Paypal"></label>
                </div>

                <p>You will be redirected to PayPal to finish your payment.</p>
                <div class="payment-list">
                  <label><input type="radio" id="credit_card" class="credit" name="payment_method" value="stripe">
                    Stripe <img src="{{ asset('frontend/images/checkout/card.jpg') }}" alt="Pay with Stripe"></label>
                </div>

                <p>Your personal data will be used to process your order and for other purposes described in
                  our privacy
                  policy.</p>
                <div class="terms-and-conditions-checkbox-text">
                  <label for="terms-and-conditions-checkbox-text"><input type="checkbox" name="terms_and_condition"
                      required> I HAVE READ AND AGREE TO THE WEBSITE
                    PRIVACY POLICY AND TERMS AND CONDITIONS *</label>
                  @error('terms_and_condition')
                    <span class='text-danger'>{{ $message }}</span>
                  @enderror
                </div>
                <button type="submit" class="place-order-btn">Place Order</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!--MORSH OFFERS SEC-->
  @include('frontend.layouts.facilities')
@endsection
