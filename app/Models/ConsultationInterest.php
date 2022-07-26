<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ConsultationInterest extends Model
{
    use HasFactory;

    public function getInterest(){
        return $this->belongsTo(Interest::class, 'interest_id');
    }

    public function addConsultationInterest($consultationId, Request $request){
        for($i = 0; $i<count($request->interests); $i++){
            $category = new ConsultationInterest();
            $category->consultation_id = $consultationId;
            $category->interest_id = $request->interests[$i];
            $category->save();
        }

    }

}
