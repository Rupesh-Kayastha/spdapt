@extends('frontend.layouts.master')

@section('title','Partners - Morsh Golf')
@section('main-content')
<section class="common-policy-sec">
    <h1>Partners</h1>
    <div class="common-policy-body">
        <div class="common-policy-img" style="background: url('{{ asset('frontend/images/privacy-policy.jpg') }}') center center no-repeat;"></div>
        <div class="common-policy-content">
            <h3>Would you like to become our selling partner?</h3>
            <p>We’re thrilled you’re interested in becoming our business partner, we’re looking for partners from different countries all around the world!</p>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>We’re looking for B2B partners in:</h4>
                    <ul>
                        <li>United States</li>
                        <li>UK</li>
                        <li><s>Brazil</s></li>
                        <li><s>Argentina</s></li>
                        <li>Germany</li>
                        <li>Canada</li>
                        <li>Switzerland</li>
                        <li><s>Belgium</s></li>
                        <li>Austria</li>
                        <li>Australia</li>
                        <li>Japan</li>
                        <li>Scandinavia</li>
                        <li>Spain</li>
                        <li><s>Russia</s></li>
                        <li>South Africa</li>
                        <li>Other (contact us)</li>
                    </ul>
                    <p>Fill out the contact form or write us on info@morshgolf.com and tell us more about your business model, your location, your goals and everything related to it.</p>
                    <p>Our B2B representative will get back to you as soon as possible.</p>
                </div>
                <div class="col-12 col-md-6">
                    <form class="common-form"  method="post" action="{{route('partners.store')}}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="first_name" required placeholder="Full Name" />
                            <input type="hidden" class="form-control" name="type"  value="P" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" required placeholder="Email Address" />
                        </div>
                        <div class="form-group full-width">
                            <input type="text" class="form-control" required name="company_name_address"  placeholder="Company Name & Address *" />
                        </div>
                        <div class="form-group full-width">
                            <input type="text" class="form-control" required name="subject" placeholder="Subject" />
                        </div>
                        <div class="form-group full-width">
                            <textarea class="form-control" name="message" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="contact-form-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.common-policy-sec .common-policy-body .common-policy-content ul li {
    margin: 0 0 5px 0;
}
</style>

@include('frontend.layouts.why_choose')

@include('frontend.layouts.call_to_action') 

@endsection