<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Contact;
use App\Models\InvoiceDetail;
use App\Models\InvoiceMaster;
use App\Models\Item;
use App\Models\ItemGallery;
use App\Models\MarginReport;
use App\Models\ReceiptDetail;
use App\Models\ReceiptMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->category = new Category();
        $this->item = new Item();
        $this->itemgallery = new ItemGallery();
        $this->contact = new Contact();
        $this->invoice = new InvoiceMaster();
        $this->invoiceitem = new InvoiceDetail();
        $this->receipt = new ReceiptMaster();
        $this->receiptitem = new ReceiptDetail();
        $this->bank = new Bank();
        $this->marginreport = new MarginReport();
    }

    public function getInvoices(Request $request)
    {
        try {
            $id = $request->id??0;
            $invoices = $this->invoice->getTenantInvoices(true, (int)$id);
            $totalSumInvoices = $this->invoice->getTotalSumPostedInvoices();
            $totalPaidAmount = $this->invoice->getTotalPaidSumPostedInvoices();
            $totalAllInvoices = $this->invoice->getAllInvoicesTotalSum();
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => "Success",
                'data' => [
                    "totalSumInvoices" => $totalSumInvoices,
                    "totalPaidAmount" => $totalPaidAmount,
                    "totalAllInvoices" => $totalAllInvoices,
                    "invoices" => $invoices,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => "Oops something bad happened, Please try again! ",
                'data' => ''
            ]);
        }
    }


    public function createInvoice(Request $request){

        $validator = Validator::make($request->all(),[
            'contact_type'=>'required',
            'issue_date'=>'required|date',
            'due_date'=>'required|date',
            'items.*'=>'required'
        ],[
            'contact_type.required'=>'Select contact type',
            'issue_date.required'=>'Choose issue date',
            'issue_date.date'=>'Enter a valid date format',
            'due_date.required'=>'Choose due date',
            'due_date.date'=>'Enter a valid date format'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'code'=> 400,
                'message' => $validator->errors()->first(),
                'data'=>""
            ]);
        }
        try {
            $invoice = $this->invoice->setNewInvoice($request);
            $this->invoiceitem->setNewInvoiceItems($request, $invoice);
            $totalSumInvoices = $this->invoice->getTotalSumPostedInvoices();
            $totalPaidAmount = $this->invoice->getTotalPaidSumPostedInvoices();
            $totalAllInvoices = $this->invoice->getAllInvoicesTotalSum();
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => "Success",
                'data' => [
                    "totalSumInvoices" => $totalSumInvoices,
                    "totalPaidAmount" => $totalPaidAmount,
                    "totalAllInvoices" => $totalAllInvoices,
                    "invoice" => $invoice,
                ],
            ]);
        }
        catch (\Exception $e){
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => "Oops something bad happened, Please try again! ",
                'data' => ''
            ]);
        }

    }

    public function declineInvoice(Request $request){

        //validate request
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'code'=> 400,
                'message' => $validator->errors()->first(),
                'data'=>""
            ]);
        }
        try{
            $invoice = $this->invoice->getInvoiceById($request->id);
            if(!empty($invoice)){
                $_invoice = $this->invoice->updateInvoiceStatus($invoice->id, 'decline');
                return response()->json([
                    'success'=> true,
                    'code'=> 200,
                    'message' => "Declined Successfully",
                    'data'=>[
                        "invoice"=>$_invoice
                    ]
                ]);
            }else{
                return response()->json([
                    'success'=> false,
                    'code'=> 400,
                    'message' => "Invoice not found",
                    'data'=>""
                ]);
            }
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => "Oops something bad happened, Please try again! ",
                'data' => ''
            ]);
        }

    }

    public function approveInvoice(Request $request){
        //validate request
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'code'=> 400,
                'message' => $validator->errors()->first(),
                'data'=>""
            ]);
        }
        try{
            $invoice = $this->invoice->getInvoiceById($request->id);
            if(!empty($invoice)){
                $_invoice =  $this->invoice->updateInvoiceStatus($invoice->id, 'post');
                return response()->json([
                    'success'=> true,
                    'code'=> 200,
                    'message' => "Approved Successfully",
                    'data'=>[
                        "invoice"=>$_invoice
                    ]
                ]);
            }else{
                return response()->json([
                    'success'=> false,
                    'code'=> 400,
                    'message' => "Invoice not found",
                    'data'=>""
                ]);
            }
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => "Oops something bad happened, Please try again! ",
                'data' => ''
            ]);
        }

    }


    public function sendInvoice(Request $request){

        //validate request
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'code'=> 400,
                'message' => $validator->errors()->first(),
                'data'=>""
            ]);
        }
        $invoice = $this->invoice->getInvoiceBySlug($request->id);
        try{
            if(!empty($invoice)){
                #Contact
                $contact = $this->contact->getContactById($invoice->contact_id);
                if(!empty($contact)){
                    //return dd($contact);
                    $this->invoice->sendInvoiceAsEmailService($contact, $invoice);
                    return response()->json([
                        'success'=> true,
                        'code'=> 200,
                        'message' => "Sent Successfully",
                        'data'=>""
                    ]);
                }else{
                    return response()->json([
                        'success'=> false,
                        'code'=> 400,
                        'message' => "Could not send",
                        'data'=>""
                    ]);
                }
            }else{
                return response()->json([
                    'success'=> false,
                    'code'=> 400,
                    'message' => "Invoice not found",
                    'data'=>""
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => "Oops something bad happened, Please try again! ",
                'data' => ''
            ]);
        }

    }


}
