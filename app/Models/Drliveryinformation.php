<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drliveryinformation extends Model
{
    protected $table = 'drlivery_information';
    protected $fillable=['content','image','status'];
}