@php
$drliverys=DB::table('drlivery_information')->where('status','1')->get();
@endphp
<section class="morsh-facilities-sec">
    <div class="morsh-facilities-body">
        @foreach ($drliverys as $drlivery)
        <div class="morsh-facilities-box">
            <div class="morsh-facilities-icon"><img src="{{ url('public/frontend/images/banner/') }}/{{ $drlivery->image }}"
                    alt="{{ $drlivery->image }}">
            </div>

            <div class="morsh-facilities-content">
                {!! (stripslashes($drlivery->content)) !!}
            </div>
        </div>
        @endforeach
        {{-- <div class="morsh-facilities-box">
            <div class="morsh-facilities-icon"><img src="{{ asset('frontend/images/facilities-icon-1.png') }}"
                    alt="Best Price Guarantee"></div>
            <div class="morsh-facilities-content">
                <h3>Best Price Guarantee</h3>
                <p>If You Find a Lower Price, We’ll Match It.</p>
            </div>
        </div>
        <div class="morsh-facilities-box">
            <div class="morsh-facilities-icon"><img src="{{ asset('frontend/images/facilities-icon-4.png') }}"
                    alt="30-day no-risk policy"></div>
            <div class="morsh-facilities-content">
                <h3>30-day no-risk policy *</h3>
                <p>Ensure complete satisfaction on purchase of all our products.</p>
            </div>
        </div>
        <div class="morsh-facilities-box">
            <div class="morsh-facilities-icon"><img src="{{ asset('frontend/images/facilities-icon-3.png') }}"
                    alt="International Free Shipping"></div>
            <div class="morsh-facilities-content">
                <h3>International Free Shipping</h3>
                <p>Connecting customers worldwide with the best value.</p>
            </div>
        </div>
        <div class="morsh-facilities-box">
            <div class="morsh-facilities-icon"><img src="{{ asset('frontend/images/facilities-icon-4.png') }}"
                    alt="Encourage Golfers"></div>
            <div class="morsh-facilities-content">
                <h3>Encourage Golfers</h3>
                <p>Everybody Deserves a Chance to Play Golf.</p>
            </div>
        </div> --}}
    </div>
</section>