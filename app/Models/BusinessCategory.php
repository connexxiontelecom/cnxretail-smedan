<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BusinessCategory extends Model
{
    use HasFactory;

    public function addNewBusinessCategory(Request $request){
        $category = new BusinessCategory();
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name).substr(sha1(time()), 32,40);
        $category->save();
    }

    public function updateBusinessCategory(Request $request){
        $category =  BusinessCategory::find($request->categoryId);
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name).substr(sha1(time()), 32,40);
        $category->save();
    }

    public function getBusinessCategories(){
        return BusinessCategory::orderBy('category_name', 'ASC')->get();
    }
}
