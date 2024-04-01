@extends('frontend.layouts.master')
@section('title','Thank You - Morsh Golf')
@section('main-content')
<section class="thankyou-page">
    <div class="thankyou-page-body">
        <h2>Thank You!</h2>
        <i class="fa-sharp fa-solid fa-check-to-slot"></i>
        <h3>We will get back you soon!!!!</h3>
        <a href="{{ url('/') }}">Go to Home</a>
    </div>
</section>
<style> 
.thankyou-page {
    margin: 0;
    padding: 0;
    position: relative;
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.thankyou-page .thankyou-page-body {
    margin: 0;
    padding: 0;
    position: relative;
    text-align: center;
}
.thankyou-page .thankyou-page-body h2 {
    margin: 0;
    padding: 0;
    position: relative;
    font-size: 62px;
    font-weight: 700;
    color: #00867a;
}
.thankyou-page .thankyou-page-body i {
    margin: 0;
    padding: 0;
    position: relative;
    font-size: 130px;
    color: #ffd800;
    line-height: 140px;
}
.thankyou-page .thankyou-page-body h3 {
    margin: 0;
    padding: 0;
    position: relative;
    font-size: 26px;
    font-weight: 500;
    color: #000000;
}
.thankyou-page .thankyou-page-body a {
    position: relative;
    margin: 40px 0 0 0;
    background: #e3e3e3;
    height: 45px;
    width: 166px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #000;
    font-weight: bold;
    border-radius: 100px;
    font-size: 14px;
}
</style>
@endsection 