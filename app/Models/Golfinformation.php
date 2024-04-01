<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Golfinformation extends Model
{
    protected $table = 'golf_information';
    protected $fillable=['content','image','status'];
}