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
    }

    .product-reviews-part {
        width: 100%;
    }


    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        display: none;
        position: absolute;
        top: 0;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>

@php
//Get dynamic product content
$productContDetails=DB::table('productcont')->first();
@endphp 
@extends('frontend.layouts.master')
@section('meta')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name='copyright' content=''>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
@endsection
@section('title') {{ $product_detail->meta_title }} @endsection
@section('keyword') {{ $product_detail->meta_keyword }} @endsection
@section('description') {{ $product_detail->meta_description }} @endsection
@section('main-content') 
<!--BANNER SEC-->

<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/product-details/inner-banner.webp') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
        <div class="inner-banne-left">
            <h1>{{ $product_detail->title }} @if($product_detail->product_sub_title != '')– {{ $product_detail->product_sub_title }} @endif</h1>
        </div>
        <div class="inner-banne-img"> <img src="{{ asset('frontend/images/product-details/product-img.png') }}" class="mar-minus-buttom" alt="" /> </div>
    </div>
</section>

<!--BANNER SEC-->

<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#">{{$product_detail->cat_info['title']}}</a></li>
            <li><a>{{ $product_detail->title }} @if($product_detail->product_sub_title != '')– {{ $product_detail->product_sub_title }} @endif</a></li>
        </ul>
        @include('frontend.layouts.notification')
    </div>
</section>
<section class="product-details-sec">
    <div class="product-details-body">
        <div class="product-details">
            <div class="product-details-top">
                <div class="product-details-img">
                    @if($product_detail->photo)
                    @php
                        $photos=explode(',',$product_detail->photo);
                    @endphp
                    <div class="outer">
                        <div id="big" class="owl-carousel owl-theme">
                                @foreach($photos as $pplist)
                                    <div class="item" style="background: url('{{ url('/public/product/') }}/{{ $pplist }}')"></div>
                                @endforeach
                            </div>
                            <div id="thumbs" class="owl-carousel owl-theme">
                                @foreach($photos as $pplists)
                                    <div class="item" style="background: url('{{ asset('public/product/'.$pplists) }}')"></div>
                                @endforeach                           
                            </div>
                    </div>
                    @endif
                </div>
                <div class="product-details-content">
                    <h2>{{ $product_detail->title }} @if($product_detail->product_sub_title != '')– {{ $product_detail->product_sub_title }} @endif </h2>
                    <ul class="ratings-sold-list">
                        <li><i class="fa-solid fa-star"></i> <span>{{ $product_detail->rating }}</span> Ratings</li>
                        <li><i class="fa-sharp fa-solid fa-bag-shopping"></i> <span>{{ $product_detail->no_of_product_sold }}</span>+ Sold</li>
                        <li>
                                    @if($product_detail->discount != null)
                                    <div class="offer-discount">
                                        <div class="offer-d-box"><span>{{ intval($product_detail->discount) }}%</span> OFF</div>
                                    </div>
                                    @endif
                                </li>
                    </ul>
                    <!--@php $currency = Helper::getCurrency(number_format((float)$product_detail->price, 2, '.', '')); @endphp-->
                    <!--<div class="product-price">{{ session('symbol') .' '. number_format((float)$currency, 2, '.', '') }}</div>-->
                    
                    @php

                    if($product_detail->discount == null){
                    $currency = Helper::getCurrency(number_format((float)$product_detail->price, 2, '.', ''));
                    } else{
                    $discountPercentage = $product_detail->discount;
                    $discountAmount = $product_detail->price * ($discountPercentage / 100);
                    $currency = Helper::getCurrency(number_format(($product_detail->price - $discountAmount), 2, '.',
                    ''));
                    }
                    @endphp
                    @if($product_detail->discount == null)
                    <div class="product-price">{{ session('symbol') .''. number_format((float)$currency, 2, '.', '') }}
                    </div>
                    @else()
                    <div class="product-price"><s>{{ session('symbol') .''.
                            number_format((float)$product_detail->price, 2, '.', '') }} </s> {{ session('symbol') .''.
                        number_format((float)$currency, 2, '.', '') }}
                    </div>
                    @endif
                    
                    <hr>
                    @if(!empty($product_detail->hand_orientation) || !empty($product_detail->shaft_material) || !empty($product_detail->flex) || !empty($product_detail->configuration) || !empty($product_detail->volume) || !empty($product_detail->length) || !empty($product_detail->swing_weight))
                    <ul class="product-content-list">
                        @if($product_detail->hand_orientation != null)
                            <li><span>Hand Orientation</span> : {{ $product_detail->hand_orientation }}</li>
                        @endif
                        @if($product_detail->shaft_material != null)
                            <li><span>Shaft Material</span> : {{ $product_detail->shaft_material }}</li>
                        @endif
                        @if($product_detail->flex != null)
                            <li><span>Flex</span> : {{ $product_detail->flex }}</li>
                        @endif
                        @if($product_detail->configuration != null)
                            <li><span>Configuration</span> : {{ $product_detail->configuration }}</li>
                        @endif
                        @if($product_detail->volume != null)
                            <li><span>Volume</span> : {{ $product_detail->volume }}</li>
                        @endif
                        @if($product_detail->length != null)
                            <li><span>Length</span> : {{ $product_detail->length }}</li>
                        @endif
                        @if($product_detail->swing_weight != null)
                            <li><span>Swing weight</span> : {{ $product_detail->swing_weight }}</li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        <!--SIDEBAR-->
        <aside class="sidebar">
            <form action="{{route('single-add-to-cart')}}" method="POST">
                @csrf
                <div class="set-order-sec">
                    <h4>Set Order</h4>
                    <!--<div class="product-title">{{ $product_detail->title }} – {{ $product_detail->product_sub_title }} </div>-->
                    
                    <div class="product-title">{{ $product_detail->title }} @if($product_detail->product_sub_title !=
                        null)– {{ $product_detail->product_sub_title }} @endif</div>
                        
                    <div class="quantity qty-stock-part">
                        <div class="qty-container">
                            <button class="qty-btn-minus btn-light" type="button"><i class="fa fa-minus"></i></button>
                            <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                            <input type="text" name="quant[1]" data-min="1" data-max="1000" value="1" id="quantity" class="input-qty input-number"/>
                            <button class="qty-btn-plus btn-light" type="button" data-field="quant[1]"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="stock-list">Stock : <span>{{ $product_detail->stock }}</span></div>
                    </div>
                    @if($product_detail->size)
                    @php
                    $attr_dts = explode(',',$product_detail->size);
                    $new_string = "";
                    @endphp
                    <div class="stick-choose">
                        @if(str_contains($product_detail->title, "Ladies")) 
                        @php
                                $new_string = 'ORIENTATION';
                                @endphp
                        @endif
                        @if(str_contains($product_detail->title, "Senior")) 
                        @php
                                $new_string = 'FLEX';
                                @endphp
                        @endif
                        <label><span>{{ $new_string }}</span></label>
                        <select class="form-control attributes">
                            <option value="">Choose an Option</option>
                            @foreach($attr_dts as $attr)
                                <option value="{{ $attr }}">{{ $attr }}</option>
                            @endforeach
                        </select>
                        <div id="showerror"></div>
                    </div>
                    @endif
                    <div class="product-category">
                        <div class="p-categories">Categories</div>
                        <ul>
                            <li>{{$product_detail->cat_info['title']}}</li>
                        </ul>
                    </div>
                    <div class="add-to-cart mt-4 addto-cart-btn-part">
                        <button type="submit" class="add-to-cart">Add To Cart</button>
                    </div>
                </div>
            </form>
            <em class="text-danger" style="font-size:14px;">DISCLAIMER: Product prices do not include taxes, so there may be additional import costs when ordering internationally.</em>
            @php
            $settings=DB::table('settings')->get();
            @endphp
        </aside>
    </div>
    
    <div class="product-details-body">
        <div class="product-details">
            <!--MORSH FACILITIES SEC-->
            <div class="morsh-facilities-sec">
                <div class="morsh-facilities-body">
                    <div class="morsh-facilities-box">
                        <div class="morsh-facilities-icon"><img src="{{ asset('frontend/images/facilities-icon-1.png') }}" alt=""></div>
                        <div class="morsh-facilities-content">
                            <h3>{{ $productContDetails->title1 }}</h3>
                            <p>{{  $productContDetails->content1 }}</p>
                        </div>
                    </div>
                    <div class="morsh-facilities-box">
                        <div class="morsh-facilities-icon"><img src="{{ asset('frontend/images/facilities-icon-4.png') }}" alt=""></div>
                        <div class="morsh-facilities-content">
                            <h3>{{ $productContDetails->title2 }}</h3>
                            <p>{{ $productContDetails->content2 }}</p>
                        </div>
                    </div>
                    <div class="morsh-facilities-box">
                        <div class="morsh-facilities-icon"><img src="{{ asset('frontend/images/facilities-icon-3.png') }}" alt=""></div>
                        <div class="morsh-facilities-content">
                            <h3>{{ $productContDetails->title3 }}</h3>
                            <p>{{ $productContDetails->content3 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--MORSH FACILITIES SEC--> 
            
            <!--PRODUCT DESCRIPTION SEC-->
            
            <div class="tabs product-details-tab">
                <ul class="tab-links">
                    @if($product_detail->summary != '')
                    <li class="active"><a href="#tab1"> About</a></li>
                    @endif
                    @if($product_detail->description != '')
                    <li> <a href="#tab2"> Know The Brand</a></li>
                    @endif
                    @if($product_detail->product_description != '')
                    <li> <a href="#tab3"> Product Description</a></li>
                    @endif
                    @if($product_detail->technical_details != '')
                    <li> <a href="#tab4"> Technical Details</a></li>
                    @endif
                    <li> <a href="#tab5"> Write a Review</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="tab active"> {!! (stripslashes($product_detail->summary)) !!} </div>
                    <div id="tab2" class="tab">
                        <div class="product-details-brand">
                            {{-- <div class="brand-img" style="background: url('{{ asset('frontend/images/product-details/product-slider-img-4.jpg') }}')"></div> --}}
                            <div class="brand-content"> {!! (stripslashes($product_detail->description)) !!} </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab"> {!! (stripslashes($product_detail->product_description)) !!} </div>
                    <div id="tab4" class="tab"> {!! (stripslashes($product_detail->technical_details)) !!} </div>
                    <div id="tab5" class="tab">
                        <h3>Write A Review</h3>
                       
                        <p>Your email address will not be published. Required fields are marked</p>
                        <form class="write-a-review-form" method="post" method="post" action="{{route('review.store',$product_detail->slug)}}" >
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="reviewer_name" placeholder="Write your Name*">
                                @error('reviewer_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="reviewer_email" placeholder="Write your Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="reviewer_webisite" placeholder="Website Link">
                            </div>
                            <div class="form-group">
                                <!--<select class="form-control" name="rate">-->
                                <!--    <option value=""> --put your rating--</option>-->
                                <!--    <option value="1">1</option>-->
                                <!--    <option value="2">2</option>-->
                                <!--    <option value="3">3</option>-->
                                <!--    <option value="4">4</option>-->
                                <!--    <option value="5">5</option>-->
                                <!--</select>-->
                                
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                @error('rate')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group full-width">
                                <textarea class="form-control" name="review" placeholder="Write your Review"></textarea>
                                 @error('review')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="contact-form-btn">Submit</button>
                        </form>
                       
                    </div>
                </div>
            </div>
            <!--PRODUCT DESCRIPTION SEC--> 
            
            <!--PRODUCT REVIEWS SEC-->
            @if(count($product_detail['getReview'])>0)
            <div class="product-reviews-sec">
                <div class="product-ratings-part">
                    <h3>Reviews & Ratings</h3>
                    <div class="product-ratings-body">
                        <h4>5 <span>/ 5.0</span></h4>
                        <div class="rating-star"> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> </div>
                        <div class="pro-reviews-user"><span> 500+ </span> Reviews</div>
                    </div>
                </div>
                <div class="product-reviews-part">
                    <h3>Top Reviews</h3>

                    @foreach($product_detail['getReview'] as $data)
                    <div class="product-reviews-list">
                        <div class="product-reviews-top">
                            <!--<div class="product-r-img" style="background: url('{{ asset('https://morshgolf.com/wp-content/uploads/2020/01/testimonial-christophe-150x150.png') }}')"></div>-->
                            <div class="product-reviews-body">
                                <h4>{{$data->reviewer_name}}</h4>
                                <p>“{{$data->review}}”</p>
                                <div class="product-reviews-star"><div class="rating-star"> 
                                    @for ($x = 0; $x < $data->rate; $x++) <i class='fa-solid fa-star'></i>@endfor
                                    @for ($x = 0; $x < 5-$data->rate; $x++) <i class='fa-solid fa-star-half-alt'></i>@endfor
                                 </div>
                                 </div>
                            </div>
                        </div>
                        <!--<div class="product-reviews-bottom">-->
                        <!--    <div class="reviews-helpful"><a href="#"><i class="fa-solid fa-thumbs-up"></i> Helpful ?</a></div>-->
                        <!--    <div class="reviews-date"><a href="#"><i class="fa-solid fa-calendar-days"></i> 05/06/2023</a></div>-->
                        <!--</div>-->
                    </div>
                    @endforeach
                    <div class="pagination-footer">
                        <div id="pagination-container"></div>
                    </div>
                </div>
            </div>
            
            @endif
            <!--PRODUCT REVIEWS SEC--> 
        </div>
        <!--SIDEBAR-->
        <aside class="sidebar">
            <div class="offer-bar"> <video width="100%" height="100%" controls>
    <!-- Provide the path to your video file -->
   
    <!-- Fallback for browsers that don't support the MOV format -->
    <source src="{{ url('/video/video-right-bar-cart.mov')}}" type="video/mp4">
    Your browser does not support the video tag.
</video> </div>
        </aside>
    </div>
</section>
@include('frontend.layouts.call_to_action')
@include('frontend.layouts.testimonial')
@include('frontend.layouts.faq')
@endsection 