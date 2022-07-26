<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationCommentReply extends Model
{
    use HasFactory;

    public function getCommentedByUser(){
        return $this->belongsTo(User::class, 'replied_by');
    }
    public function getCommentedByAdmin(){
        return $this->belongsTo(AdminUser::class, 'replied_by');
    }
    public function addConsultationCommentReply(Request $request){
        $reply = new ConsultationCommentReply();
        $reply->consultation_id = $request->consultationId;
        $reply->consultation_comment_id = $request->commentId;
        $reply->replied_by = Auth::user()->id;
        $reply->user_level = $request->userLevel;
        $reply->reply = $request->reply;
        $reply->save();
        return $reply;
    }
}
