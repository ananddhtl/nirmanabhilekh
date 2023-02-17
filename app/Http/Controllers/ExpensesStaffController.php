<?php

namespace App\Http\Controllers;

use App\Models\ExpensesStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensesStaffController extends Controller
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
            'amount' => 'required ',
            'staff_name' => 'required ',



        ]);

        $incomeequipments = new ExpensesStaff();
        $incomeequipments->id = $request->id;
        $incomeequipments->amount = $request->amount;
        $incomeequipments->cancel = 0;
        $incomeequipments->narration = $request->narration;

        $incomeequipments->date = $request->date;
        $incomeequipments->staff_id = $request->staff_id;



        $incomeequipments->save();
        return redirect('/expensesfromstaff/list')->with('status', ' Your data has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensesStaff  $expensesStaff
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensesStaff $expensesStaff)
    {
        $data = DB::table('expenses_staff')

            ->join('staff', 'expenses_staff.staff_id', '=', 'staff.id')
            ->select('expenses_staff.*', 'staff.staff_name')
            ->get();
        return view('frontend.expensesfromstaff.list', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensesStaff  $expensesStaff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data  = ExpensesStaff::join('staff')
        //     ->where('id', $id)->first();
        $data = \DB::select("select expenses_staff.*, staff_name from expenses_staff inner join staff on expenses_staff.staff_id=staff.id where expenses_staff.id='" . $id . "' ");
        return view('frontend.expensesfromstaff.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensesStaff  $expensesStaff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpensesStaff $expensesStaff)
    {
        ExpensesStaff::where('id', '=', $request->id)->update([
            'staff_id' => $request->staff_id,
            'amount' => $request->amount,
            'narration' => $request->narration,



        ]);
        return redirect('/expensesfromstaff/list')->with('messages', 'Your data has  been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesStaff  $expensesStaff
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensesStaff $expensesStaff, $id)
    {
        ExpensesStaff::where('id', '=', $id)->delete();
        return redirect('/expensesfromstaff/list')->with('messages', ' Your data has been deleted successfully');
    }
    public function search(Request $request,)
    {
        // 
        $get_name = $request->staff_name;
        $data = DB::table('expenses_staff')
            ->join('staff', 'expenses_staff.staff_id', '=', 'staff.id')

            ->select('expenses_staff.*', 'staff.staff_name')
            ->where('expenses_staff.cancel', '=', 0)
            ->where('staff_name', 'like', '%' . $get_name . '%')
            ->simplePaginate(10);
        return view('frontend.expensesfromstaff.list', compact('data'));
    }

    public function getStaffExpensesReport(ExpensesStaff $expensesStaff)
    {
        $data = DB::table('expenses_staff')

            ->join('staff', 'expenses_staff.staff_id', '=', 'staff.id')
            ->select('expenses_staff.*', 'staff.staff_name')
            ->get();
        return view('frontend.report.staffreport', compact('data'));
    }
    public function searchDateWithStaff(Request $request)
    {
      //  dd($request->all());
        $data = DB::table('expenses_staff')
            ->join('staff', 'expenses_staff.staff_id', '=',  'staff.id')
            ->select('expenses_staff.*', 'staff.staff_name')
            ->where('expenses_staff.staff_id', '=', $request->staff_id)
            ->whereBetween('expenses_staff.date', [$request->from, $request->to])
            ->get();

        // dd($serviceBillAmount);
        return view('frontend.report.staffreport', compact('data'));
    }
}
