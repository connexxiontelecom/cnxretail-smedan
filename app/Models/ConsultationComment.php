<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationComment extends Model
{
    use HasFactory;

    public function getCommentedByUser(){
        return $this->belongsTo(User::class, 'commented_by');
    }
    public function getCommentedByAdmin(){
        return $this->belongsTo(AdminUser::class, 'commented_by');
    }

    public function getConsultationCommentReply(){
        return $this->hasMany(ConsultationCommentReply::class, 'consultation_comment_id');
    }

    public function newComment(Request $request){
        $feedback = new ConsultationComment();
        $feedback->consultation_id = $request->consultationId;
        $feedback->comment = $request->comment ?? '';
        $feedback->commented_by = Auth::user()->id;
        $feedback->user_level = $request->userLevel;
        $feedback->save();
        return $feedback;
    }
}
