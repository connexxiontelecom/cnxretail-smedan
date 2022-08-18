<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceDetail extends Model
{
    use HasFactory;


    public function getService(){
        return $this->belongsTo(Item::class, 'service_id');
    }


    public function setNewInvoiceItems(Request $request, $invoice){
        for($n = 0; $n<count($request->item_name); $n++){
                $invoice_item = new InvoiceDetail();
                $invoice_item->invoice_id = $invoice->id;
                $invoice_item->tenant_id = Auth::user()->tenant_id;
                $invoice_item->service_id = $request->item_name[$n];
                $invoice_item->quantity = $request->quantity[$n];
                $invoice_item->unit_cost = $request->amount[$n];
                $invoice_item->total = $request->quantity[$n] * $request->amount[$n];
                $invoice_item->save();
            }
    }

    public function setNewInvoiceItemsAPI(Request $request, $invoice){
        //$items = json_decode($request->items);
        $items= $request->items;
        foreach ($items as $item)
        {
            $invoice_item = new InvoiceDetail();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->tenant_id = Auth::user()->tenant_id;
            $invoice_item->service_id = $item["id"];
            $invoice_item->quantity = $item["qty"];
            $invoice_item->unit_cost = $item["amount"];
            $invoice_item->total = $item["total"];
            $invoice_item->save();
        }

    }

    public function getInvoiceDetails($id){
        $details =  InvoiceDetail::where('invoice_id', $id)->orderBy('id', 'DESC')->get();
        foreach ($details as $detail)
        {
            $detail->item = Item::where("id", $detail->service_id)->first();
        }
        return $details;
    }

}
