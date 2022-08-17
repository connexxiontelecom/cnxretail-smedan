<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillDetail extends Model
{
    use HasFactory;


    public function setNewBillItems(Request $request, $bill){
        for($n = 0; $n<count($request->item_name); $n++){
            $bill_item = new BillDetail();
            $bill_item->bill_id = $bill->id;
            $bill_item->tenant_id = Auth::user()->tenant_id;
            $bill_item->description = $request->item_name[$n];
            $bill_item->quantity = $request->quantity[$n];
            $bill_item->unit_cost = $request->amount[$n];
            $bill_item->total = $request->quantity[$n] * $request->amount[$n];
            $bill_item->save();
        }
    }

    public function setNewBillItemsAPI(Request $request, $bill){
        //$items = json_decode($request->items);
        $items= $request->items;
        foreach ($items as $item)
        {
            $bill_item = new BillDetail();
            $bill_item->bill_id = $bill->id;
            $bill_item->tenant_id = Auth::user()->tenant_id;
            $bill_item->description = $item["description"];
            $bill_item->quantity = $item["qty"];
            $bill_item->unit_cost = $item["amount"];
            $bill_item->total = $item["total"];
            $bill_item->save();
        }

    }


    public function getBillDetails($id){
        $details =  BillDetail::where('bill_id', $id)->orderBy('id', 'DESC')->get();
        return $details;
    }

}
