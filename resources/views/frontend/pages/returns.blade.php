@extends('frontend.layouts.master')
@section('title','Returns - Morsh Golf')
@section('main-content')
<!--BANNER SEC-->
<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/product-details/inner-banner.webp') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
        <div class="inner-banne-left">
            <h1>Returns</h1>
        </div>
        <div class="inner-banne-img"> <img src="{{ asset('frontend/images/product-details/product-img.png') }}" class="mar-minus-buttom" alt="Returns" /> </div>
    </div>
</section>
<!--BANNER SEC-->

<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a>Returns</a></li>
        </ul>
    </div>
</section>

<section class="returns-sec">
    <h2>Returns</h2>
    <div class="returns-body">
        <h3>Would you like to return your product?</h3>
        <p>If you’re not completely happy with your purchase please contact us before sending the product back. We don’t accept packages and returns without notice so please make sure to contact us and we will advise you how to handle the matter. Read more about our returns policy <a href="{{ route('guarantee') }}">HERE</a>.</p>
    </div>
    <div class="returns-form">
        <form  method="post"  action="{{route('returns.store')}}">
            @csrf
            <input type="hidden" name="type" value="R">
            <div class="billing-details-form">
                <div class="form-group">
                    <label for="">First Name *</label>
                    <input type="text" class="form-control" placeholder="" name="first_name" value="{{old('first_name')}}">
                    @error('first_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Last Name </label>
                    <input type="text" class="form-control" placeholder="" name="last_name" value="{{old('last_name')}}">
                    @error('last_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group full-width-f-g">
                    <label for="">Email Address *</label>
                    <input type="text" class="form-control" placeholder="" name="email" value="{{old('email')}}">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group full-width-f-g">
                    <label for="">Order Notes</label>
                    <textarea class="form-control" name="order_notes" rows="4">{{old('order_notes')}}</textarea>
                </div>
                <div class="form-group full-width-f-g">
                    <button type="submit" class="checkout-f-btn">SEND MESSAGE</button>
                </div>
            </div>
        </form>
    </div>
</section>

    
@include('frontend.layouts.why_choose')
@include('frontend.layouts.call_to_action')
@endsection 