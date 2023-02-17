<?php

namespace App\Http\Controllers;


use App\Models\ServiceCatagory;

use Illuminate\Http\Request;
use App\Exports\ServiceCatagoryExport;

use Maatwebsite\Excel\Facades\Excel;
class ServiceCatagoryController extends Controller
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
        return view('frontend.service.add');
    }

    public function getServiceCatgoryData()
    {

        $servicescatagories = ServiceCatagory::where('status', '0')->simplePaginate(10);

        return view('frontend.servicecatagory.list', compact('servicescatagories'));
    }


    function postServiceCatagoryData(Request $request)
    {

        $request->validate([
            'service_catagory_name' => 'required | min:3',
            
        ]);
            
    
    $existingRecord = ServiceCatagory::select("*")->where('service_catagory_name', $request->service_catagory_name)->get()->first();


    if (!empty($existingRecord)) {
        return redirect()->back()->with('text', 'This name is already taken');

    } else {


        $servicecatagories = new ServiceCatagory;
        $servicecatagories->service_catagory_name = $request->service_catagory_name;

        $servicecatagories->status = 0;


        $servicecatagories->save();
        return redirect('servicecatagory/list')->with('status', 'Service has been added successfully');
    }
    }
    public function deleteServiceCatagory($id)
    {
        ServiceCatagory::where('id', '=', $id)->update([
               'status'  => 1,
        ]);
        return redirect()->back()->with('message', 'Service Bill Amount has been deleted successfully');
    }
    public function editServiceCatagory($id)
    {
        $data = ServiceCatagory::where(['id' => $id])->first();
        return view('frontend.servicecatagory.edit', compact('data'));
    }
    public function updateServiceCatagory($id, Request $request)
    {
        $request->validate([
            'service_catagory_name' => 'required',
            
        ]);

        ServiceCatagory::where('id', '=', $request->id)->update([
            'service_catagory_name' => $request->service_catagory_name,
            'status' => 0,
            
        ]);
        return redirect('servicecatagory/list')->with('status', 'Your data has been updated successfully');
    }
    public function search(Request $request,)
    {

        $get_name = $request->search_name;
        $servicescatagories = ServiceCatagory::where('status','0')->where('service_catagory_name', 'like', '%' . $get_name . '%')->paginate(10);
        return view('frontend.servicecatagory.list', compact('servicescatagories'));
    }
    public function export(){
        return  Excel::download(new ServiceCatagoryExport, 'servicecatagory.xlsx');
    }
    
}
