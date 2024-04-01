@extends('frontend.layouts.master')
@section('title','Fairway Wood')
@section('main-content')

<style>
  #category{
    position: absolute;
    right: 0;
    border: 1px solid gainsboro;
    border-radius: 5px;
    padding: 5px
  }
</style>
<!--BANNER SEC-->
<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/product-details/inner-banner.webp') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
        <div class="inner-banne-left">
            <h1>Product</h1>
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
          <li><a href="#">Catagory</a></li>
      </ul>
    </div>
</section>

<!--MORSH OFFERS SEC-->
<section class="offers-sec product-listing-sec">
    <div class="offer-body">
        <div class="offer-list">
            @foreach($categorys as $category)
            <div class="offer-box"> 
                <a href="{{ route('product_category',$category->id) }}">
                    <div class="offer-box-img">
                        <img src="{{ url('/public/frontend/images/banner') }}/{{ $category->photo }}" class="img-fluid" alt="{{ $category->photo }}" />
                    </div>
                    <h3>{{ $category->title }}<br> <span style="padding-top: 3%;">{!! (stripslashes($category->summary)) !!}</span></h3>
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
