<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingFeedbackReply extends Model
{
    use HasFactory;

    public function getCommentedByUser(){
        return $this->belongsTo(User::class, 'replied_by');
    }
    public function getCommentedByAdmin(){
        return $this->belongsTo(AdminUser::class, 'replied_by');
    }
    public function addTrainingFeedbackReply(Request $request){
        $reply = new TrainingFeedbackReply();
        $reply->training_id = $request->innerTrainingId;
        $reply->training_feedback_id = $request->innerCommentId;
        $reply->replied_by = Auth::user()->id;
        $reply->user_level = $request->userLevel;
        $reply->feedback_reply = $request->innerConversation;
        $reply->save();
        return $reply;
    }
}
