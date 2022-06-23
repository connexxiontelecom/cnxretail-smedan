<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TrainingCategory extends Model
{
    use HasFactory;

    public function getBusinessCategory(){
        return $this->belongsTo(BusinessCategory::class, 'category_id');
    }
    public function addTrainingCategory($trainingId, $cat){
        $category = new TrainingCategory();
        $category->training_id = $trainingId;
        $category->category_id = $cat;
        $category->save();
    }
}
