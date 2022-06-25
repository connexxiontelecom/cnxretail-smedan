<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Survey extends Model
{
    use HasFactory;

    public function getSurveyQuestions(){
        return $this->hasMany(SurveyQuestion::class, 'survey_id');
    }

    public function setNewSurvey(Request $request){
        $sur = new Survey();
        $sur->question = $request->description;
        $sur->title = $request->title;
        $sur->status = $request->status;
        $sur->slug = Str::slug($request->title).'-'.substr(sha1(time()),32,40);
        $sur->save();
        return $sur;
    }
    public function updateSurvey(Request $request){
        $sur =  Survey::where('id',$request->surveyId)->first();
        $sur->question = $request->description;
        $sur->title = $request->title;
        $sur->status = $request->status;
        $sur->slug = Str::slug($request->title).'-'.substr(sha1(time()),32,40);
        $sur->save();
    }

    public function getSurveyById($id){
        return Survey::find($id);
    }
    public function getSurveyBySlug($slug){
        return Survey::where('slug',$slug)->first();
    }

    public function getAllSurvey(){
        return Survey::orderBy('id', 'DESC')->get();
    }
    public function getAllActiveSurveys(){
        return Survey::where('status',1)->orderBy('id', 'DESC')->get();
    }
}
