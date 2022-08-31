<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Imprest extends Model
{
    use HasFactory;

    public function getBank(){
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getResponsibleOfficer(){
        return $this->belongsTo(User::class, 'responsible_officer');
    }

    public function setNewImprest(Request $request){
        $imprest = new Imprest;
        $imprest->amount = str_replace(",","",$request->amount);
        $imprest->transaction_date = $request->date;
        $imprest->description = $request->description ?? '';
        $imprest->user_id = Auth::user()->id;
        $imprest->tenant_id = Auth::user()->tenant_id;
        $imprest->responsible_officer = $request->responsible_person;
        $imprest->bank_id = $request->bank ?? '';
        $imprest->slug = substr(sha1(time()),27,40);
        $imprest->save();
        $_imprest = $this->getImprestBySlug($imprest->slug );
        $_imprest->officer =  User::where('id', $_imprest->responsible_officer)->first();
        $_imprest->issued_by =  User::where('id', $_imprest->user_id)->first();
        $_imprest->bank =  Bank::where('id', $imprest->bank_id)->first();
        return $_imprest;
    }


    public function getMyImprest($user_id){
        return Imprest::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
    }

    public function getImprestBySlug($slug){
        return Imprest::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
    }

    public function getAllTenantImprests($tenant_id){
        return Imprest::where('tenant_id', $tenant_id)->orderBy('id', 'DESC')->get();
    }


    ///Posted and Non-Posted Bills
    public function getPostedImprestTotalSum(){
        return Imprest::where('tenant_id', Auth::user()->tenant_id)->where('status', 1)->sum('amount');
    }

    public function getTenantImprests(bool $paginate = false, int $id = 0)
    {
        if (!$paginate) {
            return Imprest::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        } else {
            if ($id == 0) {
                $results  =  Imprest::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->take(10)->get();
                $count = Imprest::where('tenant_id', Auth::user()->tenant_id)->count();
                foreach ($results as $result){
                    $result->officer =  User::where('id', $result->responsible_officer)->first();
                    $result->issued_by =  User::where('id', $result->user_id)->first();
                    $result->bank =  Bank::where('id', $result->bank_id)->first();
                }
                return ["imprests"=>$results,  "count"=>$count];
            } else {
                $results  =  Imprest::where('tenant_id', Auth::user()->tenant_id)->where('id', '<', $id)->orderBy('id', 'DESC')->take(10)->get();
                $count = Imprest::where('tenant_id', Auth::user()->tenant_id)->count();
                foreach ($results as $result){
                    $result->officer =  User::where('id', $result->responsible_officer)->first();
                    $result->issued_by =  User::where('id', $result->user_id)->first();
                    $result->bank =  Bank::where('id', $result->bank_id)->first();
                }
                return ["imprests"=>$results,  "count"=>$count];
            }
        }
    }

    public function approveDeclineImprest($id, $action){
        $imprest = $this->getImprestById($id);
        if(!empty($imprest)){
            if($action == 'approve'){
                $imprest->status = 1;
                $imprest->save();
            }else{
                $imprest->status = 2;//declined
                $imprest->save();
                return back();
            }
        }
    }


    public function getImprestById($id){
        return Imprest::find($id);
    }

    public function getAllTenantImpressesByDateRange(Request $request){
        $results =  Imprest::where('tenant_id', Auth::user()->tenant_id)
            ->whereBetween('transaction_date', [$request->from, $request->to])->get();
        foreach ($results as $result){
            $result->officer =  User::where('id', $result->responsible_officer)->first();
            $result->issued_by =  User::where('id', $result->user_id)->first();
            $result->bank =  Bank::where('id', $result->bank_id)->first();
        }
        return $results;
    }

}
