<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Vendor extends Model
{
    protected $fillable=['name','phone','contactAddress','status'];

public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
