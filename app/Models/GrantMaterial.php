<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GrantMaterial extends Model
{
    use HasFactory;

    public function uploadGrantMaterials($grantId, Request $request){
        if ($request->hasFile('attachments')) {
            foreach($request->attachments as $attachment){
                $extension = $attachment->getClientOriginalExtension();
                $size = $attachment->getSize();
                $filename = config('app.name').'_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $dir = 'assets/drive/';
                $attachment->move(public_path($dir), $filename);
                $file = new GrantMaterial();
                $file->attachment = $filename;
                $file->grant_id = $grantId;
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
