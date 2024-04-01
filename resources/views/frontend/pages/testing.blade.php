@extends('frontend.layouts.master')


@section('main-content') 
<!--BANNER SEC-->

<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/product-details/inner-banner.webp') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
        <div class="inner-banne-left">
            <h1>Demo Testingggg – wwwwwwwwwww – qqqqqqqqqqqqq</h1>
        </div>
        <div class="inner-banne-img"> <img src="{{ asset('frontend/images/product-details/product-img.png') }}" class="mar-minus-buttom" alt="" /> </div>
    </div>
</section>

<!--BANNER SEC-->
Demo Testingggg
@include('frontend.layouts.call_to_action')
@include('frontend.layouts.testimonial')
@include('frontend.layouts.faq')
@endsection 