<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homepagepopup extends Model
{
    protected $table = 'homepage_popup';
    protected $fillable=['popup_enable','main_heading1','sub_heading1','sub_title1','photo1','main_heading2','sub_heading2','main_heading3'];
}
