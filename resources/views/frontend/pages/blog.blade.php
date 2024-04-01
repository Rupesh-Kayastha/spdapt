<style>
    .pagination{
        display: flex;
        justify-content: center;
        margin: 30px 0;
    }
</style>


@extends('frontend.layouts.master')
@section('title','Blog - Morsh Golf')
@section('main-content') 
<section class="all-bedcrumbs-sec">
    <div class="bedcrumb-body">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Blog</li>
        </ul>
    </div>
</section>
<!-- Start Blog Single -->
    <section class="gallery-page offers-sec p-0">
        <div class="gallery-page-body offer-body">
            <h1>Blog</h1>
            <div class="gallery-page-list offer-list" >
                @foreach($posts as $post)
                    <div class="offer-box">
                        <div class="shop-single-blog">
                            <div class="offer-box-img">
                                @if($post->photo)
                                    <img src="{{asset('backend/gallery/'.$post->photo)}}" class="img-fluid"  alt="{{$post->photo}}" width="300px" height="300px"> 
                                @else
                                    <img src="{{ asset('/public/images/No_Image_Available.jpg') }}" alt="{{$post->photo}}" width="300px" height="300px">
                                @endif
                            </div>
                            <h3><a href="{{route('blog.detail',$post->slug)}}" >{{$post->title}}</a></h3>

                            <div class="blog_contents">
                                <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i> {{$post->created_at->format('d M, Y. D')}}
                                    <span class="float-right">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        {{$post->author_info->name ?? 'Anonymous'}}
                                    </span>
                                </p>
                                <div class="blog_title"></div>
                                <p class="summary">{!! html_entity_decode($post->summary) !!}</p>
                            </div>
                            <div class="offer-box-bottom readmore "><a class="offer-box-btn" title="Add to cart" href="{{route('blog.detail',$post->slug)}}">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </section>
    <div class="col-12 col-md-12 col-lg-12">
        {{$posts->appends($_GET)->links()}} 
    </div>
<!--/ End Blog Single -->
@endsection
<style>
    .gallery-page {
        margin: 0px 0 0 0;
        padding: 50px 0;
        position: relative;
        text-align: center;
    }

    .gallery-page .gallery-page-body {
        margin: 0 auto;
        padding: 0 30px;
        max-width: 1320px;
        position: relative;
    }
    .gallery-page .gallery-page-body h1 {
        margin: 0 0 -20px  0;
        padding: 0;
        position: relative;
        font-weight: bold;
        color: #000;
    }
    .gallery-page-list {
        margin: 50px 0 0 0;
        padding: 0;
        position: relative;
        gap: 34px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        justify-items: start;

    }

        

    /* Slider */
    .slick-slider {
        position: relative;
        display: block;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-touch-callout: none;
        -khtml-user-select: none;
        -ms-touch-action: pan-y;
        touch-action: pan-y;
        -webkit-tap-highlight-color: transparent;
    }

    .slick-list {
        position: relative;
        display: block;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }
    .slick-list:focus {
        outline: none;
    }
    .slick-list.dragging {
        cursor: pointer;
        cursor: hand;
    }
    .slick-slider .slick-track, .slick-slider .slick-list {
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
        -o-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
    .slick-track {
        position: relative;
        top: 0;
        left: 0;
        display: block;
    }
    .slick-track:before, .slick-track:after {
        display: table;
        content: '';
    }
    .slick-track:after {
        clear: both;
    }
    .slick-loading .slick-track {
        visibility: hidden;
    }
    .slick-slide {
        display: none;
        float: left;
        height: 100%;
        min-height: 1px;
    }
    [dir='rtl'] .slick-slide {
        float: right;
    }
    .slick-slide img {
        display: block;
    }
    .slick-slide.slick-loading img {
        display: none;
    }
    .slick-slide.dragging img {
        pointer-events: none;
    }
    .slick-initialized .slick-slide {
        display: block;
    }
    .slick-loading .slick-slide {
        visibility: hidden;
    }
    .slick-vertical .slick-slide {
        display: block;
        height: auto;
        border: 1px solid transparent;
    }
    /* Slider */
    .slick-loading .slick-list {
        background: #fff url('./ajax-loader.gif') center center no-repeat;
    }

    /* Icons */
    .shop-single-blog h3 a {
        margin: 20px 0 0px 0;
        padding: 0 0 10px 0;
        font-size: 20px;
        font-weight: 600;
        color: #000;
        min-height: ys0px;
        text-align: left;
    }
    @font-face {
        font-family: 'slick';
        font-weight: normal;
        font-style: normal;
        src: url('./fonts/slick.eot');
        src: url('./fonts/slick.eot?#iefix') format('embedded-opentype'), url('./fonts/slick.woff') format('woff'), url('./fonts/slick.ttf') format('truetype'), url('./fonts/slick.svg#slick') format('svg');
    }

    /* Arrows */
    .slick-prev, .slick-next {
        font-size: 0;
        line-height: 0;
        position: absolute;
        top: 50%;
        display: block;
        width: 20px;
        height: 20px;
        margin-top: -10px;
        padding: 0;
        cursor: pointer;
        color: transparent;
        border: none;
        outline: none;
        background: transparent;
    }
    .slick-prev:hover, .slick-prev:focus, .slick-next:hover, .slick-next:focus {
        color: transparent;
        outline: none;
        background: transparent;
    }
    .slick-prev:hover:before, .slick-prev:focus:before, .slick-next:hover:before, .slick-next:focus:before {
        opacity: 1;
    }

    .slick-prev.slick-disabled:before, .slick-next.slick-disabled:before {
        opacity: .25;
    }
    .slick-prev:before, .slick-next:before {
        font-family: 'slick';
        font-size: 20px;
        line-height: 1;
        opacity: .75;
        color: white;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .slick-prev {
        left: -25px;
    }
    [dir='rtl'] .slick-prev {
        right: -25px;
        left: auto;
    }
    .slick-prev:before {
        content: '\f190';
        font-family: 'FontAwesome';
    }
    .slick-next {
        right: -25px;
    }
    [dir='rtl'] .slick-next {
        right: auto;
        left: -25px;
    }
    .slick-next:before {
        content: '\f18e';
        font-family: 'FontAwesome';
    }
    /* Dots */
    .slick-slider {
        margin-bottom: 30px;
    }
    .slick-dots {
        position: absolute;
        bottom: -45px;
        display: block;
        width: 100%;
        padding: 0;

        list-style: none;

        text-align: center;

    }

    .slick-dots li {

        position: relative;

        display: inline-block;

        width: 20px;

        height: 20px;

        margin: 0 5px;

        padding: 0;

        cursor: pointer;

    }

    .slick-dots li button {

        font-size: 0;

        line-height: 0;

        display: block;

        width: 20px;

        height: 20px;

        padding: 5px;

        cursor: pointer;

        color: transparent;

        border: 0;

        outline: none;

        background: transparent;

    }

    .slick-dots li button:hover, .slick-dots li button:focus {

        outline: none;

    }

    .slick-dots li button:hover:before, .slick-dots li button:focus:before {

        opacity: 1;

    }

    .slick-dots li button:before {

        font-family: 'slick';

        font-size: 6px;

        line-height: 20px;

        position: absolute;

        top: 0;

        left: 0;

        width: 20px;

        height: 20px;

        content: '•';

        text-align: center;

        opacity: .25;

        color: black;

        -webkit-font-smoothing: antialiased;

        -moz-osx-font-smoothing: grayscale;

    }

    .slick-dots li.slick-active button:before {

        opacity: .75;

        color: black;

    }

    .slick-lightbox {

        position: fixed;

        top: 0;

        left: 0;

        z-index: 9999;

        width: 100%;

        height: 100%;

        background: black;

        -webkit-transition: opacity 0.5s ease;

        transition: opacity 0.5s ease

    }

    .slick-lightbox .slick-loading .slick-list {

        background-color: transparent

    }

    .slick-lightbox .slick-prev {

        left: 15px

    }

    .slick-lightbox .slick-next {

        right: 15px

    }

    .slick-lightbox-hide {

        opacity: 0

    }

    .slick-lightbox-hide.slick-lightbox-ie {

        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";

        filter: alpha(opacity=0)

    }

    .slick-lightbox-hide-init {

        position: absolute;

        top: -9999px;

        opacity: 0

    }

    .slick-lightbox-hide-init.slick-lightbox-ie {

        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";

        filter: alpha(opacity=0)

    }

    .slick-lightbox-inner {

        position: fixed;

        top: 0;

        left: 0;

        width: 100%;

        height: 100%

    }

    .slick-lightbox-slick-item {

        text-align: center;

        overflow: hidden

    }

    .slick-lightbox-slick-item:before {

        content: '';

        display: inline-block;

        height: 100%;

        vertical-align: middle;

        margin-right: -0.25em

    }

    .slick-caption-bottom .slick-lightbox-slick-item .slick-lightbox-slick-item .slick-lightbox-slick-caption {

        position: absolute;

        bottom: 0;

        left: 0;

        text-align: center;

        width: 100%;

        margin-bottom: 20px

    }

    .slick-caption-dynamic .slick-lightbox-slick-item .slick-lightbox-slick-item .slick-lightbox-slick-caption {

        display: block;

        text-align: center

    }

    .slick-lightbox-slick-item-inner {

        display: inline-block;

        vertical-align: middle;

        max-width: 90%;

        max-height: 90%

    }

    .slick-lightbox-slick-img {

        margin: 0 auto;

        display: block;

        max-width: 90%;

        max-height: 90%

    }

    .slick-lightbox-slick-caption {

        margin: 10px 0 0;

        color: white

    }

    .slick-lightbox-close {

        position: absolute;

        top: 15px;

        right: 15px;

        display: block;

        height: 20px;

        width: 20px;

        line-height: 0;

        font-size: 0;

        cursor: pointer;

        background: transparent;

        color: transparent;

        padding: 0;

        border: none

    }

    .slick-lightbox-close:focus {

        outline: none

    }

    .slick-lightbox-close:before {

        font-family: "slick";

        font-size: 20px;

        line-height: 1;

        color: white;

        opacity: 0.85;

        -webkit-font-smoothing: antialiased;

        -moz-osx-font-smoothing: grayscale;

        content: '×'

    }

    .gallery-page-list .gallery-item {

        width: 100%;

    }

    .thumbnail img {

        width: auto;

        height: 100%;

        object-fit: cover;

        border-radius: 5px;

    }

    #default-demo .thumbnail {

        display: block;

        padding: 15px !important;

        line-height: 1.42857143;

        background-color:  #f7f7f7 !important;

        border: none !important;

        border-radius: 8px !important;

        -webkit-transition: border .2s ease-in-out;

        -o-transition: border .2s ease-in-out;

        transition: border .2s ease-in-out;

        overflow: hidden;

        object-fit: cover;

        height: 200px;

        width: 100% !important;

    }

    .blog_contents .date {

        text-align: left;

    }

    .blog_title, .blog_title a {

        margin: 0px;

        padding: 0;

        width: 100%;

        font-size: 20px;

        font-weight: 700;

        color: #000;

        float: left;

    }

    p.summary {
        margin: 0 0 24px 0;
        position: relative;
        font-size: 14px;
        font-weight: 400;
        color: #666666;
        line-height: 22px;
        text-align:left;
    }

    .offer-box-bottom.readmore {

        float: right;

    }

    </style>

@push('styles')

   



@endpush

