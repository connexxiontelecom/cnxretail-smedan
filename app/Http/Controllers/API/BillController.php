<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BillDetail;
use App\Models\BillMaster;
use App\Models\Contact;
use App\Models\MarginReport;
use App\Models\PaymentMaster;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function __construct()
    {
        $this->vendor = new Contact();
        //$this->vendor = new Vendor();
        $this->billmaster = new BillMaster();
        $this->billdetail = new BillDetail();
        $this->bank = new Bank();
        $this->paymentmaster = new PaymentMaster();
        $this->marginreport = new MarginReport();
    }

    public function getBills(Request $request)
    {
        try {
            $id = $request->id??0;
            $bills = $this->billmaster->getTenantBills(true, (int)$id);
            $totalSumBills = $this->billmaster->getTotalSumPostedBills();
            $totalPaidAmount = $this->billmaster->getTotalPaidSumPostedBills();
            $totalAllBills = $this->billmaster->getAllBillsTotalSum();
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => "Success",
                'data' => [
                    "totalSumBills" => $totalSumBills,
                    "totalPaidAmount" => $totalPaidAmount,
                    "totalAllBills" => $totalAllBills,
                    "invoices" => $bills,
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
}
