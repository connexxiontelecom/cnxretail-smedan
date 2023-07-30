<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillMaster extends Model
{
    use HasFactory;


    public function getVendor(){
        return $this->belongsTo(Contact::class, 'vendor_id');
    }

    public function getTenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function getBillItems(){
        return $this->hasMany(BillDetail::class, 'bill_id');
    }

    public function getBillBySlug($slug){
        return BillMaster::where('slug', $slug)->first();
    }

    public function getBillById($id){
        return BillMaster::find($id);
    }

    public function getBillByStatus($status){
        return BillMaster::where('tenant_id', Auth::user()->tenant_id)->where('status', $status)->orderBy('id', 'DESC')->get();
    }

    public function setNewBill(Request $request){
        $bill_no = $this->getLatestBill();
        $total = $this->getBillItemTotal($request) ?? 0;
        $bill = new BillMaster();
        $bill->vendor_id = $request->vendor ?? '';
        $bill->tenant_id = Auth::user()->tenant_id ?? '';
        $bill->issued_by = Auth::user()->id;
        $bill->bill_no = $bill_no;
        $bill->ref_no = substr(sha1(time()),29,40);
        $bill->issue_date = $request->issue_date ?? '';
        //$bill->due_date = $request->due_date ?? '';
        $bill->bill_amount = $total;
        $bill->slug = substr(sha1(time()),25,40);
        $bill->save();
        return $bill;

    }


    public function createBillAPI(Request $request)
    {
        $bill_no = $this->getLatestBill();
        $total = $request->total ?? 0;
        $bill = new BillMaster();
        $bill->vendor_id = $request->vendor ?? '';
        $bill->tenant_id = Auth::user()->tenant_id ?? '';
        $bill->issued_by = Auth::user()->id;
        $bill->bill_no = $bill_no;
        $bill->ref_no = substr(sha1(time()),29,40);
        $bill->issue_date = $request->issue_date ?? '';
        //$bill->due_date = $request->due_date ?? '';
        $bill->bill_amount = $total;
        $bill->slug = substr(sha1(time()),25,40);
        $bill->save();
        $_bill = BillMaster::find($bill->id);
        $_bill->contact =  Contact::where('id', $bill->vendor_id)->first();
        $_bill->tenant =  Tenant::where('id', $bill->tenant_id)->first();
        return $_bill;
    }

    public function getLatestBill(){
        $bill =  BillMaster::orderBy('id', 'DESC')->first();
        $bill_no = null;
        if(!empty($bill)){
            $bill_no = $bill->bill_no;
            return $bill_no + 1;
        }else{
            $bill_no = 100000;
            return $bill_no;
        }
    }

    public function getBillItemTotal(Request $request){
        $sum = 0;
        for ( $i = 0; $i<count($request->item_name); $i++){
            $sum += $request->quantity[$i] * $request->amount[$i];
        }
        return $sum;
    }

    ///[$paginate] indicates whether it's a paginated request
    /// to fetch Bills by batch
    /// [$id] the offset to start from
    public function getTenantBills(bool $paginate = false, int $id = 0){
        if (!$paginate) {
            return BillMaster::where('tenant_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        } else {
            if ($id == 0) {
                $results =  BillMaster::where('tenant_id', Auth::user()->id)->orderBy('id', 'DESC')->take(10)->get();
                foreach ($results as $result){
                    $result->contact =  Contact::where('id', $result->vendor_id)->first();
                    $result->tenant =  Tenant::where('id', $result->tenant_id)->first();
                }
                $count = BillMaster::count();
                return ["bills"=>$results,  "count"=>$count];
            } else {
                $results =  BillMaster::where('tenant_id', Auth::user()->id)->where('id', '<', $id)->orderBy('id', 'DESC')->take(10)->get();
                $count = BillMaster::count();
                foreach ($results as $result){
                    $result->contact =  Contact::where('id', $result->vendor_id)->first();
                    $result->tenant =  Tenant::where('id', $result->tenant_id)->first();
                }
                return ["bills"=>$results,  "count"=>$count];
            }
        }
    }


    ///only Posted Bills
    public function getTotalSumPostedBills(){
        return BillMaster::where('tenant_id', Auth::user()->id)->where('posted', 1)->sum('bill_amount');
    }

    ///Only Posted Bills
    public function getTotalPaidSumPostedBills(){
        return BillMaster::where('tenant_id', Auth::user()->id)->where('posted', 1)->sum('paid_amount');
    }

    ///Posted and Non-Posted Bills
    public function getAllBillsTotalSum(){
        return BillMaster::where('tenant_id', Auth::user()->id)->sum('bill_amount');
    }

    public function getTenantBillsThisYear(){
        return BillMaster::where('tenant_id', Auth::user()->id)->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->get();
    }

    public function getTenantBillsByDateRange(Request $request){
        return BillMaster::where('trash',0)->where('tenant_id', Auth::user()->tenant_id)
            ->whereBetween('issue_date', [$request->from, $request->to])->get();
    }

    public function updateBillPayment(BillMaster $bill, $amount){
        $bill->paid_amount += ($amount) ?? 0;
        $bill->status = $bill->paid_amount >= $bill->total  ? 1 : 2; //0=pending,1=fully-paid,2=partly-paid, 3=declined
        $bill->save();
    }

    public function updateBillStatus($bill_id, $status){
        $bill = BillMaster::find($bill_id);
        if($status == 'post'){
            $bill->posted = 1;
            $bill->posted_by = Auth::user()->id;
            $bill->post_date = now();
            $bill->save();
            return $bill;
        }else{
            $bill->trash = 1;
            $bill->trashed_by = Auth::user()->id;
            $bill->trash_date = now();
            #Deduct paid amount
            $bill->bill_amount -= $bill->paid_amount;
            $bill->status = 3; //0=pending,1=paid,2=partly-paid, 3=declined
            $bill->save();
            return $bill;
        }

    }

    public function getAllBills(){
        return BillMaster::all();
    }

}
