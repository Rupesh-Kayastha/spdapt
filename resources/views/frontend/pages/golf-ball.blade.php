@extends('frontend.layouts.master')
@section('title','Golf Balls')
@section('main-content')
<!--BANNER SEC-->
<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/product-details/inner-banner.webp') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
        <div class="inner-banne-left">
            <h1>Golf Balls</h1>
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
            <li><a href="javascript:void(0)">Golf Balls</a></li>
        </ul>
    </div>
</section>

<!--MORSH OFFERS SEC-->
<section class="offers-sec product-listing-sec">
    <div class="offer-body">
        <div class="offer-list">
            @foreach($golf_list as $p)
            <div class="offer-box"> <a href="{{ route('product-detail',$p->slug) }}">
                <div class="offer-box-img">
                    @if($p->photo)
                        @php
                        $photo=explode(',',$p->photo);
                        //echo '<pre>';
                        //print_r($photo);
                        @endphp
                            <img src="{{ url('/public/product/') }}/{{ $photo[0] }}" class="img-fluid" alt="{{ $p->title }}" />
                    @endif
                    <div class="offer-discount">
                        @if($p->discount > 1)
                            <div class="offer-d-box"><span>  {{ $p->discount }}%</span> OFF </div>
                        @endif
                    </div>
                </div>
                <h3>{{ $p->title }}  <span>{{ $p->product_sub_title }}</span>  <span>{{ $p->size }}</span></h3>
                <div class="ratings">
                    <div class="r-star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star-half-stroke"></i>
                    </div>
                </div>
                <div class="offer-box-bottom">
                    @php $currency = helper::getCurrency(number_format((float)$p->price, 2, '.', '')); @endphp
                    <div class="offer-p">{{ session('symbol') .' '. number_format((float)$currency, 2, '.', '') }}</div>
                    <a class="offer-box-btn" title="Add to cart" href="{{route('add-to-cart',$p->slug)}}">Add to Cart <i class="fa-solid fa-arrow-right"></i></a>
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

