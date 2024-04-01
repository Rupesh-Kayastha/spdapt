@php
$whychoose=DB::table('why_choose')->where('status','1')->get();
@endphp
<!--MORSH WHY CHOOSE SEC--> 
<section class="morsh-why-choose-sec @if(!Request::is('/'))inner-why-choose-sec @endif">
    <h2>Don't Rely on a Driver for Long Shots!</h2>
    <p>Are you struggling with driver accuracy or finding enough distance on the fairway?</p>
    <div class="morsh-why-choose-body">
        <div class="why-choose-left">
            <div class="why-choose-box">
                <div class="why-choose-content">
                    {!! (stripslashes($whychoose[0]->content)) !!}
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/banner/'.$whychoose[0]->image) }}')"></div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-content">
                    {!! (stripslashes($whychoose[2]->content)) !!}
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/banner/'.$whychoose[2]->image) }}')"></div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-content">
                    {!! (stripslashes($whychoose[4]->content)) !!}
                </div>
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/banner/'.$whychoose[4]->image) }}')"></div>
            </div>
        </div>
        <div class="why-choose-img" style="background: url('{{ asset('frontend/images/why-choose-img.jpg') }}')"></div>
        <div class="why-choose-right">
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/banner/'.$whychoose[1]->image) }}')"></div>
                <div class="why-choose-content">
                    {!! (stripslashes($whychoose[1]->content)) !!}
                </div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/banner/'.$whychoose[3]->image) }}')"></div>
                <div class="why-choose-content">
                    {!! (stripslashes($whychoose[3]->content)) !!}
                </div>
            </div>
            <div class="why-choose-box">
                <div class="why-choose-icon" style="background-image: url('{{ asset('frontend/images/banner/'.$whychoose[5]->image) }}')"></div>
                <div class="why-choose-content">
                    {!! (stripslashes($whychoose[5]->content)) !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!--MORSH WHY CHOOSE SEC-->