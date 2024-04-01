<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlexAttribute extends Model
{
    protected $fillable=['flex_name','status'];

    public function storeData($data)
    {
        return self::create($data);
    }

    public function listData()
    {
        return self::orderBy('created_at', 'DESC')->get();  
    }

    public function alldata()
    {
        return self::orderBy('name', 'ASC')->get();
    }

    public function getDataById($id)
    {
        return self::find($id);
    }

    public function getDataBySlug($slug)
    {
        return self::where('slug',$slug);
    }

    public function updateData($data, $id)
    {
        return self::find($id)->update($data);
    }

    public function deleteData($id)
    {
        return self::find($id)->delete();
    }
}