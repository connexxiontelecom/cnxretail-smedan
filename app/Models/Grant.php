<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Grant extends Model
{
    use HasFactory;


    public function getGrantAuthor(){
        return $this->belongsTo(AdminUser::class, 'posted_by');
    }
    public function getGrantMaterials(){
        return $this->hasMany(GrantMaterial::class, 'grant_id');
    }

    public function addNewGrant(Request $request){
        $grant = new Grant();
        $grant->title = $request->title;
        $grant->description = $request->description;
        $grant->posted_by = Auth::user()->id;
        $grant->slug = Str::slug($request->title).'-'.substr(sha1(time()),32,40);
        $grant->save();
        return $grant;
    }

    public function updateGrant(Request $request){
        $grant =  Grant::find($request->grantId);
        $grant->title = $request->title;
        $grant->description = $request->description;
        $grant->posted_by = Auth::user()->id;
        $grant->slug = Str::slug($request->title).'-'.substr(sha1(time()),32,40);
        $grant->save();
        return $grant;
    }

    public function getGrantBySlug($slug){
        return Grant::where('slug', $slug)->first();
    }
    public function getGrantById($id){
        return Grant::find($id);
    }

    public function getAllGrants(){
        return Grant::orderBy('id', 'DESC')->get();
    }
}
