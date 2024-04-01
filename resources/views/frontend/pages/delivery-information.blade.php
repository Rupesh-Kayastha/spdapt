@extends('frontend.layouts.master')

@section('title','Delivery information - Morsh Golf')
@php $settings=DB::table('settings')->first(); @endphp
@section('main-content')
<section class="common-policy-sec">
    <h1>Delivery information</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/delevery-img.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            {!! (stripslashes($settings->delivery_information)) !!}
        </div>
    </div>
</section>
@include('frontend.layouts.why_choose')

@include('frontend.layouts.call_to_action')

@endsection 