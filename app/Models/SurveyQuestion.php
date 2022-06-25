<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SurveyQuestion extends Model
{
    use HasFactory;

    public function getSurveyResponses(){
        return $this->hasMany(SurveyResponse::class, 'survey_question_id');
    }

    public function getSurveyResponsesByTenant(){
        return $this->hasMany(SurveyResponse::class, 'survey_question_id')
            ->where('tenant_id', Auth::user()->tenant_id);
    }

    public function publishSurveyQuestion($surveyId, $question){
        $survey = new SurveyQuestion();
        $survey->survey_id = $surveyId;
        $survey->question = $question;
        $survey->save();
    }
}
