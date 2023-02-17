<?php

namespace App\Http\Controllers;

use App\Exports\EquipmentCatagoryExport;
use App\Models\EquipmentCatagory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EquipmentCatagoryController extends Controller
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
            'equipment_catagories_name' => 'required | min:2',
            


        ]);


        $equipments = new EquipmentCatagory();
        $equipments->id = $request->id;
        $equipments->equipment_catagories_name = $request->equipment_catagories_name;



        $equipments->save();
        return redirect('/showequipmentCatagory')->with('status', ' Your data has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentCatagory  $equipmentCatagory
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentCatagory $equipmentCatagory, Request $request)
    {


        $data = DB::table('equipment_catagories')

            ->get();
        return view('frontend.equipmentcatagory.list', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipmentCatagory  $equipmentCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentCatagory $equipmentCatagory , $id)
    {
        $data  = EquipmentCatagory::where('id', $id)->first();
        return view('frontend.equipmentcatagory.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EquipmentCatagory  $equipmentCatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentCatagory $equipmentCatagory)
    {
        EquipmentCatagory::where('id', '=', $request->id)->update([
            'equipment_catagories_name' => $request->equipment_catagories_name,
            


        ]);
        return redirect('/showequipmentCatagory')->with('messages', 'Your data has  been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentCatagory  $equipmentCatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentCatagory $equipmentCatagory, $id)
    {
        EquipmentCatagory::where('id', '=', $id)->delete();
        return redirect('/showequipmentCatagory')->with('messages', ' Your data has been deleted successfully');
    }
    public function search(Request $request,)
    {
        // 

        $get_name = $request->equipment_catagories_name;
        $data = EquipmentCatagory::where('equipment_catagories_name', 'like', '%' . $get_name . '%')->paginate(10);
        return view('frontend.equipmentcatagory.list', compact('data'));
    }
    public function export()
    {
        return  Excel::download(new EquipmentCatagoryExport, 'equipmentcatagory.xlsx');
    }
    
}
