<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BillMaster;
use App\Models\Contact;
use App\Models\DailyMotivation;
use App\Models\InvoiceMaster;
use App\Models\PaymentMaster;
use App\Models\ReceiptMaster;
use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->receiptmaster = new ReceiptMaster();
        $this->invoicemaster = new InvoiceMaster();
        $this->billmaster = new BillMaster();
        $this->paymentmaster = new PaymentMaster();
        $this->contact = new Contact();
        $this->dailymotivation = new DailyMotivation();
        $this->reminder = new Reminder();
    }

    public function summary(): \Illuminate\Http\JsonResponse
    {
        try {

            $receipts = $this->receiptmaster->getAllTenantReceiptsThisYear();
            $invoices = $this->invoicemaster->getTenantInvoices();
            $bills = $this->billmaster->getTenantBills();
            $payments = $this->paymentmaster->getAllTenantPayments();
            $contacts = $this->contact->getTenantContacts(Auth::user()->tenant_id);
            $thisMonth = $this->receiptmaster->getAllTenantReceiptsThisMonth();
            $reminders = $this->reminder->getAllTenantReminders();

            $income = 0;
            $unpaidInvoices = 0;
            $unpaidBills = 0;
            $expenses = 0;

            foreach ($receipts as $receipt)
            {
                $income += $receipt->amount;
            }

            foreach ($invoices as $invoice)
            {
                $unpaidInvoices += (($invoice->total) - ($invoice->paid_amount));
            }

            foreach ($bills as $bill)
            {
                $unpaidBills += (($bill->total) - ($bill->paid_amount));
            }

            foreach ($payments as $payment)
            {
                $expenses += ($payment->amount);
            }
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => "Success",
                'data' => [
                    "receipts" => $receipts,
                    "invoices" => $invoices,
                    "bills" => $bills,
                    "payments" => $payments,
                    "contacts" => $contacts,
                    "thisMonth" => $thisMonth,
                    "reminders" => $reminders,
                    "income" => $income,
                    "unpaidInvoices" => $unpaidInvoices,
                    "unpaidBills" => $unpaidBills,
                    "expenses" => $expenses,
                ]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'code' => 500,
                'message' => "Oops something bad happened, Please try again! ",
                'data' => ''
            ]);
        }
    }

}
