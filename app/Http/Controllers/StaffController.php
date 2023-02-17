<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            

        ]);

            $staff = new Staff;
            $staff->id = $request->id;
            $staff->staff_name = $request->staff_name;
            $staff->staff_address = $request->staff_address;
            $staff->staff_email = $request->staff_email;
            $staff->staff_phonenumber = $request->staff_phonenumber;
            $staff->dob = $request->dob;
            $staff->staff_position = $request->staff_position;
            $staff->staff_profession = $request->staff_profession;
            $staff->status = 0;

            $staff->save();
            return redirect('staff/list')->with('status', 'Customer has been added successfully');
        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $data = DB::table('staff')
        
        ->get();
        return view('frontend.staff.list', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff, $id)
    {
        
        $data  = Staff::where('id', $id)->first();
        return view('frontend.staff.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        Staff::where('id', '=', $request->id)->update([
            'staff_name' => $request->staff_name,
            'staff_address' => $request->staff_address,
            'staff_email' => $request->staff_email,
            'staff_phonenumber' => $request->staff_phonenumber,
            'staff_position' => $request->staff_position,
            'dob' => $request->dob,
            'staff_profession' => $request->staff_profession,
            'status' => 0,


        ]);
        return redirect('staff/list')->with('messages', 'Your data has  been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff, $id)
    {
        Staff::where('id', '=', $id)->delete([
            'status' => 1,
            
        ]);

        // Customer::where('id', '=', $id)->delete();
        return redirect('staff/list')->with('message', 'Customer has been deleted successfully');
    }
    public function search(Request $request,)
    {
        // 

        $get_name = $request->staff_name;
        $data = Staff::where('status', '0')->where('staff_name', 'like', '%' . $get_name . '%')->paginate(10);
        return view('frontend.staff.list', compact('data'));
    }
    public function searchStaff($StaffName)
    {
        $Staff = Staff::select('id', 'staff_name', 'staff_phonenumber','staff_address','staff_phonenumber')->where('staff_name', 'like', '' . $StaffName . '%')->get()->take(10);
        return json_encode($Staff);
    }
    public function forStaffInvoice(Request $request)
    {
        //dd($request->all());
        $Invoice = Invoice::select('*')->get();
        $staff = DB::table('expenses_staff')
        ->join('staff', 'expenses_staff.staff_id', '=', 'staff.id')
        ->select('expenses_staff.*', 'staff.staff_name')
        ->where('expenses_staff.cancel', '=', 0)
        ->get();

        // dd($serviceBillAmount);
        return view('frontend.invoice.staffexpenses', compact('Invoice','staff'));
    }

}
