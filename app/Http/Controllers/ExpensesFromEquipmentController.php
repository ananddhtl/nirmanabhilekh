<?php

namespace App\Http\Controllers;

use App\Exports\ExpensesExport;
use App\Models\Equipment;
use App\Models\ExpensesFromEquipment;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpensesFromEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Equipment = Equipment::select('*')->get();




        return view('frontend.expensesfromequipment.add', compact('Equipment'));
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
            


        ]);

        $incomeequipments = new ExpensesFromEquipment();
        $incomeequipments->id = $request->id;
        $incomeequipments->amount = $request->amount;
        $incomeequipments->cancel = 0;
        $incomeequipments->narration = 0;
        $incomeequipments->customer_id = $request->customer_id;
        $incomeequipments->date = $request->date;
        $incomeequipments->equipment_id = $request->equipment_id;



        $incomeequipments->save();
        return redirect('/showexpensesequipment')->with('status', ' Your data has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensesFromEquipment  $expensesFromEquipment
     * @return \Illuminate\Http\Response
     */
    public function showExpenses(ExpensesFromEquipment $expensesFromEquipment)
    {

        $data = DB::table('expenses_from_equipment')
            ->join('customers', 'expenses_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'expenses_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('expenses_from_equipment.*', 'equipment.equipment_name', 'customers.customer_name')
            ->get();
        return view('frontend.expensesfromequipment.list', compact('data'));
    }
    public function showExpensesReport(ExpensesFromEquipment $expensesFromEquipment)
    {

        $data = DB::table('expenses_from_equipment')
            ->join('customers', 'expenses_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'expenses_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('expenses_from_equipment.*', 'equipment.equipment_name', 'customers.customer_name')
            ->get();
        return view('frontend.report.expensesreport', compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensesFromEquipment  $expensesFromEquipment
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpensesFromEquipment $expensesFromEquipment, $id)
    {
        // $Equipment = Equipment::select('*')->get();
        // $data  = ExpensesFromEquipment::where('id', $id)->first();
        $data = \DB::select("select expenses_from_equipment.*,equipment_name,customer_name from expenses_from_equipment inner join equipment on expenses_from_equipment.equipment_id=equipment.id inner join customers on expenses_from_equipment.customer_id=customers.id where expenses_from_equipment.id='" . $id . "'");

        return view('frontend.expensesfromequipment.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensesFromEquipment  $expensesFromEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpensesFromEquipment $expensesFromEquipment)
    {
        ExpensesFromEquipment::where('id', '=', $request->id)->update([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'equipment_id' => $request->equipment_id,



        ]);
        return redirect('/showexpensesequipment')->with('messages', 'Your data has  been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesFromEquipment  $expensesFromEquipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensesFromEquipment $expensesFromEquipment, $id)
    {
        ExpensesFromEquipment::where('id', '=', $id)->delete();
        return redirect('/showexpensesequipment')->with('messages', ' Your data has been deleted successfully');
    }
    public function search(Request $request,)
    {
        // 

        $get_name = $request->customer_name;
        $data = DB::table('expenses_from_equipment')
            ->join('customers', 'expenses_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'expenses_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('expenses_from_equipment.*', 'customers.customer_name', 'equipment.equipment_name')
            ->where('expenses_from_equipment.cancel', '=', 0)
            ->where('customer_name', 'like', '%' . $get_name . '%')
            ->simplePaginate(10);
        return view('frontend.expensesfromequipment.list', compact('data'));
    }
    public function forexpenseData(ExpensesFromEquipment $expensesFromEquipment)
    {
        $Invoice = Invoice::select('*')->get();
        $data = DB::table('expenses_from_equipment')
            ->join('customers', 'expenses_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'expenses_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('expenses_from_equipment.*', 'equipment.equipment_name', 'customers.customer_name')
            ->get();
        return view('frontend.invoice.expenses', compact('data', 'Invoice'));
    }
    public function searchDateInExpenses(Request $request)
    {
        //dd($request->all());
        $data = DB::table('expenses_from_equipment')
            ->join('customers', 'expenses_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'expenses_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('expenses_from_equipment.*', 'customers.customer_name', 'equipment.equipment_name')
            ->where('expenses_from_equipment.equipment_id', '=', $request->equipment_id)
            ->whereBetween('expenses_from_equipment.date', [$request->From, $request->To])
            ->get();
        return view('frontend.report.expensesreport', compact('data'));
    }
    public function export()
    {
        return  Excel::download(new ExpensesExport, 'expenses.xlsx');
    }
}
