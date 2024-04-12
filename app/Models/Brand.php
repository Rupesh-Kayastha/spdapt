<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable=['userid','level1','level2','level3'];
}
