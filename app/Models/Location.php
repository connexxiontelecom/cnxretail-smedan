<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['l_name'];


    public static function createLocation($name){
        $name = ucfirst(strtolower($name));
        Location::firstOrCreate(['l_name'=>$name]);
    }

    public static function getLocationByName($name){
        return Location::where('l_name', 'LIKE', '%'.$name.'%')->first();
    }
}
