<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ConsultationAttachment extends Model
{
    use HasFactory;

    public function uploadAttachments($consultationId, Request $request){
        if ($request->hasFile('attachments')) {
            foreach($request->attachments as $attachment){
                $extension = $attachment->getClientOriginalExtension();
                $size = $attachment->getSize();
                $filename = config('app.name').'_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $dir = 'assets/drive/';
                $attachment->move(public_path($dir), $filename);
                $file = new ConsultationAttachment();
                $file->attachment = $filename;
                $file->consultation_id = $consultationId;
                $file->save();
            }
        }
    }

    public function downloadFile($file_name) {
        $file_path = public_path('assets/drive/'.$file_name);
        if(file_exists($file_path)){
            return response()->download($file_path);
        }else{
            return 0; //file not found.
        }
    }
}
