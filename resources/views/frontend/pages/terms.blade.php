@php $settings=DB::table('settings')->first(); @endphp
@extends('frontend.layouts.master')

@section('title','Terms and Conditions - Morsh Golf')
@section('main-content')
<section class="common-policy-sec">
    <h1>Terms and Conditions</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/common-policy.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            {!! (stripslashes($settings->terms_and_conditions)) !!}
        </div>
    </div>
</section>
    
@include('frontend.layouts.why_choose')
@include('frontend.layouts.call_to_action')
@endsection 
