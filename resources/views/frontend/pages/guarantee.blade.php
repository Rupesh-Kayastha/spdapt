@extends('frontend.layouts.master')
@section('title','Guarantee - Morsh Golf')
@section('main-content')
<section class="common-policy-sec">
    <h1>Guarantee</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/common-policy.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            <h3>30 Day Money Back Guarantee</h3>
            <p>With a 30 day money back guarantee you have more than enough time to get the full picture of the products performance and start enjoying it.</p>
            <p>In case you don’t love it contact us and follow our returns procedure within 30 day period of first attempt of delivery to be eligible for the Exchange or Refund. Used products in our shop are not under 30 day money back guarantee unless stated otherwise. Note: We do not offer free returns. Return shipping-cost should be paid by the customer. Also the refund will not include order shipping costs. Before sending the club back please contact us about the return, otherwise we won’t know about the return and the club won’t be accepted from the courier service provider. If you don’t contact us for the return before sending the club back you’re not eligible to receive a refund. If you want to read more go to our Terms & Conditions page and scroll down to our Returns Policy.

            </p>

            <h3>Quality Guarantee</h3>
            <p>In addition to the 30 days grace period for normal returns, and a return period for faults, we also honor manufacturers’ quality warranties which are typically 12 months. If you wish to return a product that has developed a fault in the first 12 months, please read more in our Returns Policy.</p>

        </div>
    </div>
</section>


   
    
@include('frontend.layouts.why_choose')
@include('frontend.layouts.call_to_action')
@endsection