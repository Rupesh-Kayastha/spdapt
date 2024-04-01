@php
$settings=DB::table('settings')->get();
$testimonials=DB::table('testimonials')->where('status','active')->get();
@endphp
<section class="testimonial-sec">
    <div class="testimonial-body">
        <div class="tes-title">
            <h2>Morsh 2 Wood Fairway <span>Reviews</span></h2>
            <div class="tes-slider-part">
                <div class="tes-slider owl-carousel">
                    @foreach($testimonials as $test)    
                    <div class="tes-item">
                        <p>“{{ $test->description }}”</p>
                        <h3>{{ $test->title }} @if(!empty($test->from_address)) FROM @endif <span>{{ $test->from_address }}</span></h3>
                    </div>
                    @endforeach

                </div>
                <div class="tes-slider-btn-part">
                    <a href="#left" class="btn  prev"><i class="fa-regular fa-arrow-left-long"></i></a> 
                    <a href="#right" class="btn  next"><i class="fa-regular fa-arrow-right-long"></i></a> 
                </div>
            </div>
        </div>
        <div class="testimonial-video">
            <iframe width="100%" height="315" src="@foreach($settings as $data) {{$data->short_des}} @endforeach" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <iframe width="100%" height="315" src="@foreach($settings as $data) {{$data->long_des}} @endforeach" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
</section>