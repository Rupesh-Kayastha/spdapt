@extends('frontend.layouts.master')
@section('title','Morsh Golf 2 Wood | 10 Degree 3 Wood Golf Club || CART')
@section('main-content')

<!--BANNER SEC-->
<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/add-to-cart/banner-bg.jpg') }}') center center no-repeat;">
	<div class="all-inner-banner-body">
			<div class="inner-banne-left">
					<h1>Add To Cart</h1>
			</div>
			<div class="inner-banne-img"> <img src="{{ asset('frontend/images/product-details/product-img.png') }}" class="mar-minus-buttom" alt="" /> </div>
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
			<img src="{{ asset('frontend/images/add-to-cart/add-to-cart-offer-img.png') }}" class="img-fluid" alt="Add To Cart" >
	</div>


	<form action="{{route('cart.update')}}" method="POST">
			@csrf
			@if(Helper::getAllProductFromCart())

		<div class="add-to-cart-body">
				<div class="add-to-cart-list">
						<h3>Cart</h3>


						@foreach(Helper::getAllProductFromCart() as $key=>$cart)
						<div class="add-to-cart-box">
								<div class="cart-img" style="background-image: url('{{ asset('frontend/images/product-details/product-img.png') }}')"></div>
								<div class="cart-details">
										<div class="cart-header">
												<div class="cart-p-title">{{$cart->product['title']}} {{$cart->product['product_sub_title']}} – {{$cart->product['size']}}</div>
												<div class="qty-container">
														<button class="qty-btn-minus btn-light" type="button" data-type="minus" data-field="quant[{{$key}}]"><i class="fa fa-minus"></i></button>
														<input type="text" name="quant[{{$key}}]" value="{{$cart->quantity}}" class="input-qty input-number" data-min="1" data-max="100"/>
														<input type="hidden" name="qty_id[]" value="{{$cart->id}}">
														<button class="qty-btn-plus btn-light" type="button" data-type="plus" data-field="quant[{{$key}}]"><i class="fa fa-plus"></i></button>
												</div>
												<div class="cart-p-subtotal total-amount cart_single_price money" data-title="Total">Subtotal <span>${{$cart['amount']}}</span></div>
										</div>
										<div class="cart-p-footer">
												<div class="cart-p-price">Price : ${{number_format($cart['price'],2)}}</div>
												<div class="cart-delete" data-title="Remove"><a class="cart-delete" href="{{route('cart-delete',$cart->id)}}">Delete</a></div>
										</div>
								</div>
						</div>
						@endforeach

						{{-- cart update start --}}
						<div class="float-right">
							<div class="cart-details">
								<div class="cart-header ">
									<div class="cart-p-title"><button class="btn float-right updatebtns" type="submit">Update</button></div>
								</div>
							</div>
						</div>
						{{-- cart update end --}}
					
				</div>
				<div class="add-to-cart-details">
						<h3>Cart Details</h3>
						<div class="cart-d-title">Morsh 2 Wood GEN. 2 RH – Regular, Stiff, and X-Stiff Shaft

						</div>
						 <div class="cart-coupon">
							<div class="cart-c-title">Coupon Code</div>
							<div class="cart-c-discount">25 % Discount</div>
							<form action="{{route('coupon-store')}}" method="POST">
										<input type="text" name="code" class="form-control" placeholder="Type Coupon Code">
										<button type="button" class="coupon-btn">Apply Coupon Code</button>
								</form>
						</div>
						<div class="cart-total-part">
								<div class="cart-t-title">Cart Totals</div>
								@php
								$total_amount=Helper::totalCartPrice();
								if(session()->has('coupon')){
									$total_amount=$total_amount-Session::get('coupon')['value'];
								}
							@endphp
								<ul>
										<li><span class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Cart Sub Total</span> <span>${{number_format(Helper::totalCartPrice(),2)}}</span></li>
										<li>Discount <span>(25%) - $674.7</span></li>
										<li>Shipping <span>$29.00</span></li>
										<li>Tax <span>$0.00</span></li>
										@if(session()->has('coupon'))
										<li>Total <span>${{number_format($total_amount,2)}}</span></li>
										@else
										<li>Total <span>${{number_format($total_amount,2)}}</span></li>
										@endif
								</ul>
						</div>
						<div class="cart-total-btn-part">
								<a href="{{route('checkout')}}" class="cart-total-btn">PROCEED TO CHECKOUT</a>
								<a href="{{ route('fairway-wood') }}" class="cart-total-btn btn-2">CONTINUE TO SHIPPING</a>
						</div> 
				</div>
		</div>
		@else
		


		







		<div class="add-to-cart-body">
			<div class="add-to-cart-list">
					<h3>Cart</h3>
		
		
		
					<div class="add-to-cart-box">
							
							<div class="cart-details">
									<div class="cart-header">
											<div class="cart-p-title">There are no any carts available. <a href="{{route('fairway-wood')}}" style="color:blue;">Continue shopping</a></div>
											
											
									</div>
									
							</div>
					</div>
					
		
			</div>
			
	</div>


















		
		@endif
	</form>



	
</section>
	
@include('frontend.layouts.facilities')
@include('frontend.layouts.call_to_action')
@include('frontend.layouts.testimonial')
@include('frontend.layouts.faq')
@push('scripts')
<script>
	$(document).ready(function(){
		$('.shipping select[name=shipping]').change(function(){
			let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
			let subtotal = parseFloat( $('.order_subtotal').data('price') );
			let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
			// alert(coupon);
			$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
		});

	});

</script>
@endpush


