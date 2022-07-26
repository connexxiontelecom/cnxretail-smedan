<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Consultation extends Model
{
    use HasFactory;

    public function getConsultationInterests(){
        return $this->hasMany(ConsultationInterest::class, 'consultation_id');
    }

    public function getConsultationComments(){
        return $this->hasMany(ConsultationComment::class, 'consultation_id');
    }

    public function getConsultationAttachments(){
        return $this->hasMany(ConsultationAttachment::class, 'consultation_id');
    }

    public function addConsultation(Request $request){
        $consult = new Consultation();
        $consult->subject = $request->subject;
        $consult->body = $request->body;
        $consult->tenant_id = Auth::user()->tenant_id;
        $consult->slug = Str::slug($request->subject).'-'.substr(sha1(time()),33,40);
        $consult->save();
        return $consult;
    }

    public function getConsultationsByTenantId($tenantId){
        return Consultation::where('tenant_id', $tenantId)->orderBy('id', 'DESC')->get();
    }

    public function getConsultationBySlug($slug){
        return Consultation::where('slug', $slug)->first();
    }

    public function updateConsultationStatus($consultationId, $status){
        $consultation = Consultation::find($consultationId);
        $consultation->status = $status;
        $consultation->save();
    }

    public function getConsultationRequestById($id){
        return Consultation::find($id);
    }

    public function getAllConsultations(){
        return Consultation::orderBy('id', 'DESC')->get();
    }
}
