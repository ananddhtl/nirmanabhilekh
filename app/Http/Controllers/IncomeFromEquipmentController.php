<?php

namespace App\Http\Controllers;

use App\Exports\IncomeExport;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeFromEquipment;
use App\Models\ExpensesFromEquipment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IncomeFromEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Equipment = Equipment::select('*')->get();






        return view('frontend.incomefromequipment.add', compact('Equipment'));
    }
    public function indexIncome()
    {
        $Equipment = Equipment::select('*')->get();






        return view('frontend.report.incomereport', compact('Equipment'));
    }
    public function getProfitData()
    {
        $Equipment = Equipment::select('*')->get();






        return view('frontend.home', compact('Equipment'));
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


        $incomeequipments = new IncomeFromEquipment;
        $incomeequipments->id = $request->id;
        $incomeequipments->amount = $request->amount;
        $incomeequipments->date = $request->date;
        $incomeequipments->cancel = 0;
        $incomeequipments->narration = 0;
        $incomeequipments->customer_id = $request->customer_id;
        $incomeequipments->equipment_id = $request->equipment_id;



        $incomeequipments->save();
        return redirect('/showincomeequipment')->with('status', ' Your data has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomeFromEquipment  $incomeFromEquipment
     * @return \Illuminate\Http\Response
     */
    public function showIncome(IncomeFromEquipment $incomeFromEquipment)
    {
        $data = DB::table('income_from_equipment')
            ->join('customers', 'income_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'income_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('income_from_equipment.*', 'equipment.equipment_name', 'customers.customer_name')
            ->where('income_from_equipment.cancel', '=', 0)
            ->get();

        return view('frontend.incomefromequipment.list', compact('data'));
    }
    public function showIncomeReport(IncomeFromEquipment $incomeFromEquipment)
    {
        $data = DB::table('income_from_equipment')
            ->join('customers', 'income_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'income_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('income_from_equipment.*', 'equipment.equipment_name', 'customers.customer_name')
            ->where('income_from_equipment.cancel', '=', 0)
            ->get();
        // dd($data);

        return view('frontend.report.incomereport', compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomeFromEquipment  $incomeFromEquipment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $Equipment = Equipment::select('*')->get();
        // $data  = IncomeFromEquipment::where('id', $id)->first();
        $data = \DB::select("select income_from_equipment.*,equipment_name,customer_name from income_from_equipment inner join equipment on income_from_equipment.equipment_id=equipment.id inner join customers on income_from_equipment.customer_id=customers.id where income_from_equipment.id='" . $id . "'");

        return view('frontend.incomefromequipment.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncomeFromEquipment  $incomeFromEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncomeFromEquipment $incomeFromEquipment)
    {
        IncomeFromEquipment::where('id', '=', $request->id)->update([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'equipment_id' => $request->equipment_id,
            'date' => $request->date,


        ]);
        return redirect('/showincomeequipment')->with('messages', 'Your data has  been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomeFromEquipment  $incomeFromEquipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeFromEquipment $incomeFromEquipment, $id)
    {
        IncomeFromEquipment::where('id', '=', $id)->delete();
        return redirect('/showincomeequipment')->with('messages', ' Your data has been deleted successfully');
    }
    public function search(Request $request,)
    {
        // 

        $get_name = $request->customer_name;
        $data = DB::table('income_from_equipment')
            ->join('customers', 'income_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'income_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('income_from_equipment.*', 'customers.customer_name', 'equipment.equipment_name')
            ->where('income_from_equipment.cancel', '=', 0)
            ->where('customer_name', 'like', '%' . $get_name . '%')
            ->simplePaginate(10);
        return view('frontend.incomefromequipment.list', compact('data'));
    }
    public function forinvoiceData(IncomeFromEquipment $incomeFromEquipment)
    {
        $Invoice = Invoice::select('*')->get();
        $data = DB::table('income_from_equipment')
            ->join('customers', 'income_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'income_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('income_from_equipment.*', 'equipment.equipment_name', 'customers.customer_name', 'customers.customer_email', 'customers.customer_address', 'customers.customer_phonenumber')
            ->where('income_from_equipment.cancel', '=', 0)
            ->get();
        // dd($data);

        return view('frontend.invoice.income', compact('data','Invoice'));
    }
    public function searchDateInIncome(Request $request)
    {
        $Equipment = Equipment::select('*')->get();
        $data = DB::table('income_from_equipment')
            ->join('customers', 'income_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'income_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('income_from_equipment.*', 'customers.customer_name', 'equipment.equipment_name')
            ->where('income_from_equipment.equipment_id', '=', $request->equipment_id)
            ->whereBetween('income_from_equipment.created_at', [$request->From, $request->To])
            ->get();
        return view('frontend.report.incomereport', compact('data', 'Equipment'));
    }
    public function export()
    {
        return  Excel::download(new IncomeExport, 'income.xlsx');
    }
    
}
