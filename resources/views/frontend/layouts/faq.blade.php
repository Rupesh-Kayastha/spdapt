@php
    $faq_lists=DB::table('faqs')->where('status','active')->get();

@endphp
@if(count($faq_lists)>0)
<section class="faq-sec">
    <div class="faq-body">
        <h2>Frequently Asked Questions</h2>
        <div class="accordion" id="accordionExample" >
            @foreach($faq_lists as $key=>$fq)
                <div class="card">
                    <div class="card-header" id="heading{{ $key }}">
                        <button class="btn" type="button" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}"> {{ $fq->title }} </button>
                    </div>
                    <div id="collapse{{ $key }}" class="collapse {{ ($key=='0') ? "show" : "" }}" aria-labelledby="heading{{ $key }}" data-parent="#accordionExample">
                        <div class="card-body"> {{ $fq->description }} </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
</section>
@endif