<style>
    .offer-d-box {
        position: absolute;
        top: -24px !important;
        right: -50px !important;
    }

    .product-details-content .product-price {
        display: flex;
        gap: 20px;
        margin-top: 20px
    }

    .product-price s {
        font-weight: 600 !important;
        color: goldenrod;
        margin-right: 10px;
    }

    .offer-discount {
        top: 31px !important;
        left: 26px !important;

    }
    .product-price{
        color: #54a500;
        font-weight: 600;
        
    }
</style>
@extends('frontend.layouts.master')
@section('title','Fairway Wood')
@section('main-content')

<!--BANNER SEC-->
<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/product-details/inner-banner.webp') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
        <div class="inner-banne-left">
            <h1>Fairway Wood</h1>
        </div>
        <div class="inner-banne-img">
            <img src="{{ asset('frontend/images/product-details/product-img.png') }}" class="mar-minus-buttom" alt="" />
        </div>
    </div>
</section>
<!--BANNER SEC--> 


<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">Fairway Wood</a></li>
        </ul>
    </div>
</section>

<!--MORSH OFFERS SEC-->
<section class="offers-sec product-listing-sec">
    <div class="offer-body">
        <div class="offer-list">
            @foreach($plist as $p)
            <div class="offer-box"> <a href="{{ route('product-detail',$p->slug) }}">
                <div class="offer-box-img">
                    @if($p->photo)
                    @php
                    $photo=explode(',',$p->photo);
                    @endphp
                    <img src="{{ url('/public/product/') }}/{{ $photo[0] }}" class="img-fluid" alt="{{ $p->title }}" />
                    @endif
                    <div class="offer-discount">
                        @if($p->discount > 1)
                        <div class="offer-d-box"><span>{{ intval($p->discount) }}%</span> OFF</div>
                        @endif
                    </div>
                </div>
                <h3>{{ $p->title }}  <span> {{ $p->product_sub_title }}</span>  <span>{{ $p->size }}</span></h3>
                <div class="ratings">
                    <div class="r-star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star-half-stroke"></i>
                    </div>
                    <!--<span>320 Reviews</span>-->
                </div>
                
                @php
                    if($p->discount == null){
                    $currency = helper::getCurrency(number_format((float)$p->price, 2, '.', ''));
                    } else{
                    $discountPercentage = $p->discount;
                    $discountAmount = $p->price * ($discountPercentage / 100);
                    $discount_price = helper::getCurrency(number_format(($p->price - $discountAmount), 2, '.', ''));
                    }
                    @endphp
                
                <div class="offer-box-bottom">
                        @php $currency = helper::getCurrency(number_format((float)$p->price, 2, '.', '')); @endphp
                        @if($p->discount == null)
                        <div class="offer-p">{{ session('symbol') .''. number_format((float)$currency, 2, '.', '') }}
                        </div>
                        @else()
                        <div class="product-price"><s>{{ session('symbol') .''.
                                number_format((float)$p->price, 2, '.', '') }} </s> {{ session('symbol') .''.
                            number_format((float)$discount_price, 2, '.', '') }}
                        </div>
                        @endif
                        @if(!empty($p->size))
                        <a class="offer-box-btn" title="Select Option"
                            href="{{route('product-detail',$p->slug)}}">Select Options <i
                                class="fa-solid fa-arrow-right"></i></a>
                        @else
                        <a class="offer-box-btn" title="View Details" href="{{ route('product-detail',$p->slug) }}">View
                            Details <i class="fa-solid fa-arrow-right"></i></a>
                        <!--<a class="offer-box-btn" title="Add to cart" href="{{route('add-to-cart',$p->slug)}}">Add to Cart <i class="fa-solid fa-arrow-right"></i></a>-->
                        @endif
                    </div>
                </a> 
            </div>
           @endforeach
            </div>
    </div>
</section>
<!--MORSH OFFERS SEC--> 

@include('frontend.layouts.call_to_action')
@include('frontend.layouts.testimonial')
@include('frontend.layouts.faq')
@endsection

