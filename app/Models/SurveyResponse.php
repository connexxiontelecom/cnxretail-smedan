<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SurveyResponse extends Model
{
    use HasFactory;

    public function getSurveyQuestions(){
        return $this->hasMany(SurveyQuestion::class, 'survey_question_id');
    }

    public function publishSurveyResponse($surveyId, $questionId, $tenantId, $rating){
        $response = new SurveyResponse();
        $response->survey_id = $surveyId;
        $response->survey_question_id = $questionId;
        $response->tenant_id = $tenantId;
        $response->rating = $rating;
        $response->save();
    }

    public function getSurveyResponseByTenantId($tenantId){
        return SurveyResponse::where('tenant_id', $tenantId)->orderBy('id', 'DESC')->get();
    }

    public function getSurveyResponseBySurveyId($surveyId){
        return SurveyResponse::where('survey_id', $surveyId)->orderBy('id', 'DESC')->get();
    }
}
