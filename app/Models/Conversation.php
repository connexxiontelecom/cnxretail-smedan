<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;

    public function getAddedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }


    /*
     * Use-case methods
     */
    public function setNewConversation(Request $request){
        $conversation = new Conversation();
        $conversation->tenant_id = Auth::user()->tenant_id;
        $conversation->added_by = Auth::user()->id;
        $conversation->contact_id = $request->contact_id;
        $conversation->subject = $request->subject;
        $conversation->conversation = $request->conversation;
        $conversation->save();
        $conversation->is_Added_by = Auth::user();
        return $conversation;
    }

    public function getContactConversations($contact_id){
        $results = Conversation::where('contact_id', $contact_id)->orderBy('id', 'DESC')->get();
        foreach ($results as $result)
        {
            $result->is_Added_by = User::where('id', $result->added_by)->first();
        }
        return $results;
    }

}
