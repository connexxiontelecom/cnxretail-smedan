<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\InvoiceDetail;
use App\Models\InvoiceMaster;
use App\Models\Item;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = Contact::all();

        foreach ($contacts as $contact){
            $item = Item::getTenantItem($contact->tenant_id);
            if(!empty($item)){
                $invoiceNo = rand(1000,9000);
                $startTimestamp = strtotime('2022-11-01');
                $endTimestamp = strtotime('2023-06-29');
                $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
                $randomDate = date('Y-m-d', $randomTimestamp);
                $amount = rand(1000000,3000000);
                $paidAmount = rand(1000000,3000000);
                $refCode =  substr(sha1(rand()),31,40);
                $data = [
                    'contact_id'=>$contact->id,
                    'tenant_id'=>$contact->tenant_id,
                    'issued_by'=>$contact->added_by,
                    'invoice_no'=>$invoiceNo,
                    'ref_no'=>$refCode,
                    'issue_date'=>$randomDate,
                    'due_date'=>$randomDate,
                    'total'=>$amount,
                    'sub_total'=>0,
                    'vat_rate'=>0,
                    'vat_amount'=>0,
                    'slug'=>$refCode,
                    'status'=>($amount - $paidAmount) <= 0 ? 1 : 2,
                    'paid_amount'=>($amount - $paidAmount) <= 0 ? $amount : ($amount - $paidAmount),
                    'currency_id'=>1,
                    'exchange_rate'=>1,
                    'posted_by'=>$contact->added_by,
                    'posted'=>($amount - $paidAmount) <= 0 ? 1 : 2,
                    'post_date'=>$randomDate,
                    'created_at'=>$randomDate,
                    'updated_at'=>$randomDate,
                ];
                $invoice = InvoiceMaster::create($data);
                $detail = [
                  'invoice_id'=>$invoice->id,
                  'tenant_id'=>$contact->tenant_id,
                  'service_id'=>$item->id,
                  'quantity'=>1,
                  'unit_cost'=>$amount,
                  'total'=>$amount,
                  'created_at'=>$randomDate,
                  'updated_at'=>$randomDate,
                ];
                InvoiceDetail::create($detail);
            }

        }

    }
}
