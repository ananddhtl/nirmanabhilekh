<?php

namespace App\Http\Controllers;

use App\Models\ServiceBillingAmount;

use App\Exports\ServiceBillAmountExport;
use App\Models\ServiceBillItem;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ServiceBillAmountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function getServiceBillAmountData()
    {

        $servicebillamounts = ServiceBillingAmount::where('status', '0')->simplePaginate(10);

        return view('frontend.servicebillitems.list', compact('servicebillamounts'));
    }


    public function deleteServiceBillAmount($tCode)
    {

        ServiceBillingAmount::where('tCode', '=', $tCode)->update([
            'status' => 1,
        ]);
        ServiceBillItem::where('tCode', '=', $tCode)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('message', 'Test');
    }
    public function editServiceBillAmount($tCode)
    {
        $data = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name', 'customers.customer_address', 'customers.customer_phonenumber')
            ->where('service_billing_amounts.tCode', $tCode)
            ->get();
        //dd($data);
        $servicebillitems = DB::table('service_bill_items',)
            ->join('services', 'service_bill_items.service_id', '=', 'services.id')
            ->select('service_bill_items.service_id', 'service_bill_items.service_rate', 'quantity', 'service_name')
            ->where('tCode', '=', $tCode)
            ->where('service_bill_items.status', '=', 0)
            ->get();
        return view('frontend.servicebillitems.edit', compact('data', 'servicebillitems'));
    }


    public function editServiceBilling($tCode)

    {
        $data = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')

            ->select('service_billing_amounts.*', 'customers.customer_name', 'customers.customer_address', 'customers.customer_phonenumber')

            ->where('service_billing_amounts.tCode', $tCode)

            ->get();

        //dd($data);

        $servicebillitems = DB::table('service_bill_items',)
        ->join('services', 'service_bill_items.service_id', '=', 'services.id')
        ->select('service_bill_items.service_id','service_bill_items.service_rate','quantity','service_name')
        ->where('service_bill_items.status', '=', 0)
        ->where('tCode', '=', $tCode)
        ->get();


        return view('frontend.report.viewservicebillitem', compact('data','servicebillitems'));
    }




    public function export()
    {
        return  Excel::download(new ServiceBillAmountExport, 'servicebillamout .xlsx');
    }
}
