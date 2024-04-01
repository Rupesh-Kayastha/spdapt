<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $fillable=['type','url','first_name','last_name','subject','email','photo','phone','company_name_address','message'];
}
