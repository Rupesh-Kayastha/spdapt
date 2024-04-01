<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manu extends Model
{
    protected $table = 'manu';
    protected $fillable=['name','url','status'];
}
