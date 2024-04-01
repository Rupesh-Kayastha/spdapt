@php
$settings=DB::table('settings')->get();
@endphp 
<section class="morsh-info-sec">
    <div class="morsh-info-body">
        <div class="morsh-info-box">
            
            <div class="morsh-info-img" style="background: url('@foreach($settings as $data) {{ asset('public/product/'.$data->home_banner1) }} @endforeach')"></div>
            <div class="morsh-info-overlay">
                <h3>{{ $settings[0]->home_banner1_content1 }}</h3>
            </div>
        </div>
        <div class="morsh-info-box">
            <div class="morsh-info-img" style="background: url('@foreach($settings as $data) {{ asset('public/product/'.$data->home_banner2) }} @endforeach')"></div>
            <div class="morsh-info-overlay">
                <h3>{{ $settings[0]->home_banner2_content2 }}</h3>
            </div>
        </div>
        <div class="morsh-info-box">
            <div class="morsh-info-img" style="background: url('@foreach($settings as $data) {{ asset('public/product/'.$data->home_banner3) }} @endforeach')"></div>
            <div class="morsh-info-overlay">
                <h3>{{ $settings[0]->home_banner3_content3 }} </h3>
            </div>
        </div>
        <div class="morsh-info-box">
            <div class="morsh-info-img" style="background: url('@foreach($settings as $data) {{ asset('public/product/'.$data->home_banner4) }} @endforeach')"></div>
            <div class="morsh-info-overlay">
                <h3>{{ $settings[0]->home_banner4_content4 }}</h3>
            </div>
        </div>
    </div>
</section>