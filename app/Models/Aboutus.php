<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    protected $table = 'about_us';
    protected $fillable=['head_line1','head_line2','head_line_content1','head_line_content2','image1','image2','sub_head_line_content','content'];
}
