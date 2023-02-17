<?php

namespace App\Http\Controllers;

use App\Exports\Equipment as ExportsEquipment;
use App\Exports\EquipmentExport;
use Illuminate\Support\Facades\DB;
use App\Models\Equipment;
use App\Models\EquipmentCatagory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=EquipmentCatagory::select('*')->get();



    return view('frontend.equipment.add',compact('data'));
    }

    public function searchEquipment($searchKey)
    {
        $Equipment = Equipment::select('id', 'equipment_name', 'purchase_rate')->where('equipment_name', 'like', '' . $searchKey . '%')->get()->take(10);
        return json_encode($Equipment);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request,)
    {
        // 

        $get_name = $request->equipment_name;
        $data = Equipment::where('equipment_name', 'like', '%' . $get_name . '%')->paginate(10);
        return view('frontend.equipment.list', compact('data'));
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
            'equipment_name' => 'required | min:3',
            'purchase_rate' => 'required ',
            

        ]);
        $equipments = new Equipment;
        $equipments->id = $request->id;
        $equipments->equipment_name = $request->equipment_name;
        $equipments->equipment_cat_id = $request->equipment_cat_id;
        $equipments->purchase_rate = $request->purchase_rate;



        $equipments->save();
        return redirect('/viewequipment')->with('status', ' Your data has been added successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function showEquipment(Equipment $equipment)
    {
        $data = DB::table('equipment')
        ->join('equipment_catagories', 'equipment.equipment_cat_id', '=', 'equipment_catagories.id')
        ->select('equipment.*', 'equipment_catagories.equipment_catagories_name')
        ->get();
        return view('frontend.equipment.list', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment , $id)
    {   $Catagory=EquipmentCatagory::select('*')->get();
        $data  = Equipment::where('id', $id)->first();
        return view('frontend.equipment.edit', compact('data','Catagory'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        Equipment::where('id', '=', $request->id)->update([
            'equipment_name' => $request->equipment_name,
            'equipment_cat_id' => $request->equipment_cat_id,
            'purchase_rate' => $request->purchase_rate,
            


        ]);
        return redirect('/viewequipment')->with('messages', 'Your data has  been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment ,$id)
    {
        Equipment::where('id','=',$id)->delete();
        return redirect('/viewequipment')->with('messages', ' Your data has been deleted successfully');
    }
    public function export()
    {
        return  Excel::download(new EquipmentExport, 'equipment.xlsx');
    }
    
    
   

}
