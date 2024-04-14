<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['title','lock_days','price','owner', 'status','description','photo'];

    public static function countActiveProduct(){
        $data=Product::count();
        if($data){
            return $data;
        }
        return 0;
    }
   
}
