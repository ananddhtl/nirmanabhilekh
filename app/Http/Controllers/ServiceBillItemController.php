<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceBillItem;
use App\Models\Service;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use App\Exports\ServiceBillItemsExport;
use App\Models\ExpensesFromEquipment;
use App\Models\IncomeFromEquipment;
use App\Models\Invoice;
use App\Models\ProjectActivity;
use App\Models\ServiceBillingAmount;
use Illuminate\Database\QueryException;


class ServiceBillItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function tCodeGenerate()
    {
        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('-10 days'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $uniqueid = $startDate + $rand;
        $length = 20;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $Sid = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $Sid = $Sid . $uniqueid;

        return $Sid;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $service = Service::select('*')->get();
        $customer = Customer::select('*')->get();

        //dd($activity);
        return view('frontend.servicebillitems.add', compact('service', 'customer'));
    }


    public function serviceItems($tCode)
    {
        $servicebillitems = DB::table('service_bill_items',)
            ->join('services', 'service_bill_items.service_id', '=', 'services.id')
            ->select('service_bill_items.*', 'service_name')

            ->where('tCode', '=', $tCode)
            ->get();

        return  json_encode($servicebillitems);
    }

    public function getServiceBillItemsData()

    {
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name')
            ->where('service_billing_amounts.status', '=', 0)
            ->simplePaginate(10);




        // $servicebillitems = \DB::table('service_bill_items',)
        //     // ->join('customers', 'service_bill_items.customer_id', '=', 'customers.id')
        //     ->join('services', 'service_bill_items.service_id', '=', 'services.id')
        //     // ->select('service_bill_items.*', 'services.service_name', 'customers.customer_name')
        //     // ->where('service_bill_items.status', '=', 0)
        //     ->simplePaginate(10);

        return view('frontend.report.servicebillitem', compact('serviceBillAmount'));
    }
    public function totalData()

    {
        $Expenses = ExpensesFromEquipment::select('*')->get();
        $Income = IncomeFromEquipment::select('*')->get();
        $Invoice = ProjectActivity::select('*')->get();
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name')
            ->where('service_billing_amounts.status', '=', 0)
            ->simplePaginate(10);




        // $servicebillitems = \DB::table('service_bill_items',)
        //     // ->join('customers', 'service_bill_items.customer_id', '=', 'customers.id')
        //     ->join('services', 'service_bill_items.service_id', '=', 'services.id')
        //     // ->select('service_bill_items.*', 'services.service_name', 'customers.customer_name')
        //     // ->where('service_bill_items.status', '=', 0)
        //     ->simplePaginate(10);

        return view('frontend.home', compact('serviceBillAmount', 'Invoice', 'Income', 'Expenses'));
    }

    public function getServiceBillItemData()

    {
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name')
            ->where('service_billing_amounts.status', '=', 0)
            ->simplePaginate(10);




        // $servicebillitems = \DB::table('service_bill_items',)
        //     // ->join('customers', 'service_bill_items.customer_id', '=', 'customers.id')
        //     ->join('services', 'service_bill_items.service_id', '=', 'services.id')
        //     // ->select('service_bill_items.*', 'services.service_name', 'customers.customer_name')
        //     // ->where('service_bill_items.status', '=', 0)
        //     ->simplePaginate(10);

        return view('frontend.servicebillitems.list', compact('serviceBillAmount'));
    }

    public function getCustomerWiseData()

    {
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name')
            ->where('service_billing_amounts.status', '=', 0)
            ->simplePaginate(10);

        return view('frontend.report.servicebiiling', compact('serviceBillAmount'));
    }
    public function forinvoiceData($id)

    {
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name', 'customers.customer_email', 'customers.customer_address', 'customers.customer_phonenumber')
            ->where('service_billing_amounts.status', '=', 0)
            ->simplePaginate(10);

        $servicebillitems = DB::table('service_bill_items',)
            ->join('services', 'service_bill_items.service_id', '=', 'services.id')
            ->select('service_bill_items.service_id', 'service_bill_items.service_rate', 'quantity', 'service_name')

            ->where('service_bill_items.status', '=', 0)
            ->get();

        return view('frontend.invoice.invoice', compact('serviceBillAmount', 'servicebillitems'));
    }



    function updateServieBillItemsData(Request $request)
    {


        try {
            $tcode = $request->tCode;
            $services = $request->services;
            $services_array = explode(',', $services);
            $convetDate = explode('-', $request->billDate);
            $convetDate = $convetDate[0] . "/" . $convetDate[1] . "/" . $convetDate[2];
            $quantity = 0;
            $service_rate = 0;
            ServiceBillingAmount::where('tCode', '=', $tcode)->update([
                'totalamount' => $request->totalamount,
                'alltotalamount' => $request->alltotalamount,
                'discount' => $request->discount,
                'billDate' => $convetDate,
                'customer_id' => $request->customer_id,
            ]);
            ServiceBillItem::where('tCode', '=', $tcode)->update([
                'status' => 1,
            ]);

            for ($i = 0; $i < count($services_array); $i++) {
                $val = explode('{#}', $services_array[$i]);
                // if ($val[2] != '') {
                //     $quantity = $val[2];
                // } else {
                //     $quantity = 0;
                // }
                // if ($val[3] != '') {
                //     $service_rate = $val[3];
                // } else {
                //     $service_rate = 0;
                // }
                $servicebillitems = new ServiceBillItem;

                $servicebillitems->service_id = $val[1];
                $servicebillitems->quantity = $val[2];
                $servicebillitems->service_rate = $val[3];
                $servicebillitems->tCode = $tcode;

                $servicebillitems->save();
            }



            return json_encode(array(
                'status' => true, 'message' => "Successfully done."
            ));
        } catch (QueryException $e) {
            return json_encode(array(
                'status' => false, 'message' => $e
            ));
        }
    }



    function postServieBillItemsData(Request $request)
    {


        try {
            $tcode = $this->tCodeGenerate();
            $services = $request->services;
            $services_array = explode(',', $services);
            $convetDate = explode('-', $request->billDate);
            $convetDate = $convetDate[0] . "/" . $convetDate[1] . "/" . $convetDate[2];
            $quantity = 0;
            $service_rate = 0;
            for ($i = 0; $i < count($services_array); $i++) {
                $val = explode('{#}', $services_array[$i]);
                // if ($val[2] != '') {
                //     $quantity = $val[2];
                // } else {
                //     $quantity = 0;
                // }
                // if ($val[3] != '') {
                //     $service_rate = $val[3];
                // } else {
                //     $service_rate = 0;
                // }
                $servicebillitems = new ServiceBillItem;

                $servicebillitems->service_id = $val[1];
                $servicebillitems->quantity = $val[2];
                $servicebillitems->service_rate = $val[3];
                $servicebillitems->tCode = $tcode;

                $servicebillitems->save();
            }
            $serviceBillAmount = new ServiceBillingAmount();

            $serviceBillAmount->tCode = $tcode;
            $serviceBillAmount->totalamount = $request->totalamount;
            $serviceBillAmount->alltotalamount = $request->alltotalamount;
            $serviceBillAmount->discount = $request->discount;
            $serviceBillAmount->billDate = $convetDate;
            $serviceBillAmount->cancel = 0;
            $serviceBillAmount->customer_id = $request->customer_id;
            $serviceBillAmount->save();


            return json_encode(array(
                'status' => true, 'message' => "Successfully done."
            ));
        } catch (QueryException $e) {
            return json_encode(array(
                'status' => false, 'message' => $e
            ));
        }
    }


    public  function deleteServiceBillItems($id)
    {
        ServiceBillItem::where('id', '=', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('message', 'Service Bill items has been deleted successfully');
    }
    public function editServiceBillItems($id)
    {
        $service = Service::select('*')->get();
        $customer = Customer::select('*')->get();
        $data  = ServiceBillItem::where('id', $id)->first();
        return view('frontend.servicebillitems.edit', compact('data', 'service', 'customer'));
    }

    public function search(Request $request,)
    {
        $get_name = $request->customer_id;
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name')
            ->where('service_billing_amounts.status', '=', 0)
            ->where('customer_name', 'like', '%' . $get_name . '%')
            ->simplePaginate(10);

        return view('frontend.servicebillitems.list', compact('serviceBillAmount'));
    }
    public function export()
    {
        return  Excel::download(new ServiceBillItemsExport, 'servicebillitem.xlsx');
    }
    public function searchBillDate(Request $request)
    {
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name')
            ->where('service_billing_amounts.status',0)
            ->whereBetween('service_billing_amounts.billDate', [$request->from, $request->to])
            ->get();
        return view('frontend.report.servicebillitem', compact('serviceBillAmount'));
    }


    public function searchBillDateWithCustomer(Request $request)
    {
        //dd($request->all());
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=',  'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name')
            ->where('service_billing_amounts.customer_id', '=', $request->customer_id)
            ->where('service_billing_amounts.status',0)
            ->whereBetween('service_billing_amounts.billDate', [$request->from, $request->to])
            ->get();

        // dd($serviceBillAmount);
        return view('frontend.report.servicebiiling', compact('serviceBillAmount'));
    }
    public function forServiceInvoiceData(Request $request)
    {
        //dd($request->all());
        $Invoice = Invoice::select('*')->get();
        $serviceBillAmount = DB::table('service_billing_amounts')
            ->join('customers', 'service_billing_amounts.customer_id', '=', 'customers.id')
            ->select('service_billing_amounts.*', 'customers.customer_name')
            ->where('service_billing_amounts.status', '=', 0)
            ->get();

        // dd($serviceBillAmount);
        return view('frontend.invoice.servicebill', compact('serviceBillAmount', 'Invoice'));
    }
}
