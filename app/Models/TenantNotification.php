<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantNotification extends Model
{
    use HasFactory;


    public function getNotifications(){
        return TenantNotification::orderBy('id', 'DESC')->get();
    }

    public function setNewAdminNotification($subject, $body, $route_name, $route_param, $route_type, $user_id){
        $notify = new TenantNotification();
        $notify->user_id = $user_id;
        $notify->tenant_id = $user_id;
        $notify->subject = $subject ?? '';
        $notify->body = $body ?? '';
        $notify->route_name = $route_name ?? '';
        $notify->route_param = $route_param ?? '';
        $notify->route_type = $route_type ?? "" ;
        $notify->is_read = 0; //not read
        $notify->save();
    }
}
