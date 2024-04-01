<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable=['country_code','country_name','currency_symbol','currency','default_currency_symbol','default_currency','shipping_charge','fuel_surcharge','status'];

    public static function getAllCountry(){
        return Country::with('countries')->where('status','active')->orderBy('country_name','ASC')->paginate(10);
    }
}
