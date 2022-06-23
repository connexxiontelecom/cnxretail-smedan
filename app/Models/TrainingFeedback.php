<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingFeedback extends Model
{
    use HasFactory;


    public function getTrainingFeedbackReply(){
        return $this->hasMany(TrainingFeedbackReply::class, 'training_feedback_id');
    }

    public function newFeedback(Request $request){
        $feedback = new TrainingFeedback();
        $feedback->training_id = $request->commentTrainingId;
        $feedback->comment = $request->comment ?? '';
        $feedback->commented_by = Auth::user()->id;
        $feedback->user_level = $request->userLevel;
        $feedback->save();
        return $feedback;
    }

    public function getCommentedByUser(){
        return $this->belongsTo(User::class, 'commented_by');
    }
    public function getCommentedByAdmin(){
        return $this->belongsTo(AdminUser::class, 'commented_by');
    }
}
