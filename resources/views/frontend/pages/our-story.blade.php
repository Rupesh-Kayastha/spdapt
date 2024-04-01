@extends('frontend.layouts.master')

@section('title','Our Story - Morsh Golf')
@section('main-content')
@php $aboutus=DB::table('our_story')->first(); @endphp
<section class="inner-about-us-sec">
    <h1>Our Story</h1>
    <div class="inner-about-body">
        <div class="inner-about-left">
            <h3>{{ $aboutus->head_line1 }}</h3>

            <p>{{ $aboutus->head_line_content1 }}</p>
        </div>
        <div class="inner-about-middle">
            <img src="{{url('public/frontend/images/banner/'.$aboutus->image1)}}" class="img-fluid" alt="" >
        </div>
        <div class="inner-about-right">
            <p>{{ $aboutus->sub_head_line_content }}</p>
        </div>
    </div>
</section>
    
    
<section class="our-story-sec">
    <div class="our-story-body">
        <div class="our-story-title">
            <h2>{{ $aboutus->head_line2 }} <span>{{ $aboutus->head_line_content2 }}</span></h2>
            <img src="{{url('public/frontend/images/banner/'.$aboutus->image2)}}" alt="" class="img-fluid" />
        </div>
        <div class="story-content">
            {!! (stripslashes($aboutus->content)) !!}
        </div>
    </div>
</section>    
    
<!--MORSH WHY CHOOSE SEC--> 
<section class="morsh-why-choose-sec inner-why-choose-sec">
    <h2>Don't Rely on a Driver for Long Shots!</h2>
    <p>Are you struggling with driver accuracy or finding enough distance on the fairway?</p>
    <div class="morsh-why-choose-body">
        <div class="why-choose-left">
            <div class="why-choose-box">
                <div class="why-choose-content">
                    <h3>Unmatched Accuracy</h3>
                    <p>Achieve unmatched accuracy off the tee with the Morsh 2 wood, surpassing your driver's performance for good.</p>
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-1.png') }}')"></div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-content">
                    <h3>Master Control</h3>
                    <p>Experience superior control with the compact 183cc clubhead, giving you the edge you need on every swing.</p>
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-2.png') }}')"></div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-content">
                    <h3>Adjustable Wood</h3>
                    <p>Tailor your 2 wood to suit your preferences and trajectory. This allows for a personalized feel, ranging from 10.5 degrees.</p>
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-3.png') }}')"></div>
            </div>
        </div>
        <div class="why-choose-img" style="background: url('{{ asset('frontend/images/why-choose-img.jpg') }}')"></div>
        <div class="why-choose-right">
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-4.png') }}')"></div>
                <div class="why-choose-content">
                    <h3>Maximum Distance</h3>
                    <p>Unleash maximum distance from the fairway with the 10.5-degree loft, reaching greens that were once out of your range. </p>
                </div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-5.png') }}')"></div>
                <div class="why-choose-content">
                    <h3>Effortless Swing</h3>
                    <p>Swing it with ease, just like a 3 wood, but prepare for a massive increase in distance that will leave you astonished.</p>
                </div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/why-choose-icon-6.png') }}')"></div>
                <div class="why-choose-content">
                    <h3>Conquer Greens</h3>
                    <p>Conquer greens you never thought possible. Embrace the opportunity for more birdie putts, elevating your game to new heights.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--MORSH WHY CHOOSE SEC--> 
    
<!--MORSH CALL TO ACTION SEC-->
@include('frontend.layouts.call_to_action')
<!--MORSH CALL TO ACTION SEC--> 
@endsection
