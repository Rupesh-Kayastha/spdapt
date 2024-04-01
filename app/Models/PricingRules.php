<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PricingRules extends Model
{
    protected $fillable=['product_id','quantity_from','quantity_to','type','discount'];

}
