<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use Illuminate\Http\Request;
use App\Models\Customer;


use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
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
        return ('frontend.customer.add');
    }





    public function searchCustomer($searchkey)
    {
        $Customer = Customer::select('id', 'customer_name', 'customer_phonenumber','customer_address','customer_phonenumber')->where('customer_name', 'like', '' . $searchkey . '%')->get()->take(10);
        return json_encode($Customer);
    }

    public function getCustomerData()
    {
        $data = [
            "customers" => Customer::where('status', '0')->simplePaginate(10)
        ];
        return view('frontend.customer.list', $data);
    }

    function postCustomerData(Request $request)
    {

        $request->validate([
            'customer_name' => 'required | min:3',
            'customer_address' => 'required  | min:3',
            // 'customer_email' => 'required | min:3',
            'customer_phonenumber' => 'required | max:10',
            // 'dob' => 'required | min:3',
            // 'customer_profession' => 'required  | min:3',

        ]);



        $existingRecord = Customer::select("*")->where('customer_phonenumber', $request->customer_phonenumber)->get()->first();


        if (!empty($existingRecord)) {
            return redirect()->back()->with('text', 'This contact number is already taken');
        } else {
            $customer = new Customer;
            $customer->id = $request->id;
            $customer->customer_name = $request->customer_name;
            $customer->customer_address = $request->customer_address;
            $customer->customer_email = $request->customer_email;
            $customer->customer_phonenumber = $request->customer_phonenumber;
            $customer->dob = $request->dob;
            $customer->customer_profession = $request->customer_profession;
            $customer->status = 0;

            $customer->save();
            return redirect('customer/list')->with('status', 'Customer has been added successfully');
        }
    }
    public function deleteCustomer($id)
    {


        Customer::where('id', '=', $id)->update([
            'status' => 1,
            
        ]);

        // Customer::where('id', '=', $id)->delete();
        return redirect('customer/list')->with('message', 'Customer has been deleted successfully');
    }

    public function EditCustomer($id)
    {

        $data  = Customer::where('id', $id)->first();
        return view('frontend.customer.edit', compact('data'));
    }

    public function updateCustomer($id, Request $request)
    {
        // $request->validate([
        //     'customer_name'=>'required',
        //     'customer_address'=>'required',
        //     'customer_email'=>'required',
        //     'customer_phonenumber'=>'required',
        //     'dob'=>'required',
        //     'customer_profession'=>'required',

        //    ]);


        // $customer = new Customer;
        // $customer->customer_id = $request->customer_id;
        // $customer->customer_name = $request->customer_name;
        // $customer->customer_address = $request->customer_address;
        // $customer->customer_email = $request->customer_email;
        // $customer->customer_phonenumber = $request->customer_phonenumber;
        // $customer->dob = $request->dob;
        // $customer->customer_profession = $request->customer_profession;

        Customer::where('id', '=', $request->id)->update([
            'customer_name' => $request->customer_name,
            'customer_address' => $request->customer_address,
            'customer_email' => $request->customer_email,
            'customer_phonenumber' => $request->customer_phonenumber,
            'dob' => $request->dob,
            'customer_profession' => $request->customer_profession,
            'status' => 0,


        ]);
        return redirect('customer/list')->with('messages', 'Your data has  been updated successfully');
    }
    public function search(Request $request,)
    {
        // 

        $get_name = $request->customer_name;
        $customers = Customer::where('status', '0')->where('customer_name', 'like', '%' . $get_name . '%')->paginate(10);
        return view('frontend.customer.list', compact('customers'));
    }

    public function export()
    {
        return  Excel::download(new CustomerExport, 'customer.xlsx');
    }
    
    
   
}
