<?php

namespace App\Http\Controllers;

use App\Models\ExpensesFromEquipment;
use App\Models\IncomeFromEquipment;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $Expenses=ExpensesFromEquipment::select('*')->get();
        $data=IncomeFromEquipment::select('*')->get();
      
       


        return view('frontend.report.incomereport',compact('Expenses','data'));
    
    }
    public function showIncomeReport(IncomeFromEquipment $incomeFromEquipment)
    {
        $data = DB::table('income_from_equipment')
            ->join('customers', 'income_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'income_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('income_from_equipment.*', 'equipment.equipment_name','customers.customer_name')
            ->get();
            return view('frontend.report.incomereport', compact('data'));
    }
   

}
