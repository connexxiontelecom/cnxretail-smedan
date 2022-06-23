<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Training extends Model
{
    use HasFactory;


    public function getTrainingAuthor(){
        return $this->belongsTo(AdminUser::class, 'posted_by');
    }
    public function getTrainingMaterials(){
        return $this->hasMany(TrainingMaterial::class, 'training_id');
    }

    public function addNewTraining(Request $request){
        $training = new Training();
        $training->title = $request->title;
        $training->description = $request->description;
        $training->posted_by = Auth::user()->id;
        $training->slug = Str::slug($request->title).'-'.substr(sha1(time()),32,40);
        $training->save();
        return $training;
    }

    public function updateTraining(Request $request){
        $training =  Training::find($request->trainingId);
        $training->title = $request->title;
        $training->description = $request->description;
        $training->posted_by = Auth::user()->id;
        $training->slug = Str::slug($request->title).'-'.substr(sha1(time()),32,40);
        $training->save();
        return $training;
    }

    public function getTrainingBySlug($slug){
        return Training::where('slug', $slug)->first();
    }
    public function getTrainingById($id){
        return Training::find($id);
    }

    public function getAllTrainings(){
        return Training::orderBy('id', 'DESC')->get();
    }
}
