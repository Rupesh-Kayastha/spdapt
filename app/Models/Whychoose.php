<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Whychoose extends Model
{
    protected $table = 'why_choose';
    protected $fillable=['content','image','status'];
}