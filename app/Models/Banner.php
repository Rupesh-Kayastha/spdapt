<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable=['main_heading','sub_heading','description','photo','link','status'];
}
