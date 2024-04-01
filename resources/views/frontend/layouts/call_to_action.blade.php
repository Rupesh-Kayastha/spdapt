@php 
$setting=DB::table('settings')->first();
@endphp
<!--MORSH CALL TO ACTION SEC-->
<section class="morsh-call-to-action-sec">
    <div class="morsh-call-to-action-body">
        <div class="morsh-call-to-action-left"> <img src="{{ asset('frontend/images/logo-2.png') }}" alt="" />
            <h2>Get Your 2 Wood Today! <span></span></h2>
            {!! (stripslashes($setting->todaynesw)) !!}
            <a href="{{ route('fairway-wood') }}">ORDER NOW <i class="fa-solid fa-arrow-right"></i></a> </div>
        <div class="morsh-call-to-action-right"> <img src="{{ asset('frontend/images/get-morsh-today.webp') }}" alt="" > </div>
    </div>
</section>
<!--MORSH CALL TO ACTION SEC--> 