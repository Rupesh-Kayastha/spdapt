<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=['short_des','long_des','logo','photo','address','phone','email','country','state','city','postcode','meta_title','meta_keyword','meta_description','extra_code','free_shipping_cost','facebook_url','instagram_url','twitter_url','youtube_url','location_map','checkout_note_text','home_banner1_content1','home_banner1','home_banner2_content2','home_banner2','home_banner3_content3','home_banner3','home_banner4_content4','home_banner4','home_page_about_us','delivery_information','privacy_policy','terms_and_conditions','home_page_heding','home_page_heding_image','todaynesw'];
}
