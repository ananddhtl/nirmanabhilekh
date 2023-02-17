<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ServiceExport;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer;

use App\Models\ServiceCatagory;
use App\Models\ActivityCatagory;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
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

        //$data=ServiceCatagory::select('*')->get();
        $data=ServiceCatagory::select('*')->get();



        return view('frontend.service.add',compact('data'));

        
    }
    

    public function getServiceData(Request $request)
    {
        
       
        $data = DB::table('services')
      
        ->join('service_catagories', 'services.service_category_id', '=', 'service_catagories.id')
        ->select('services.*', 'service_catagories.service_catagory_name')
        ->where('services.status', '=', 0)
        ->simplePaginate(10);
         
        return view('frontend.service.list', compact('data'));
    }
    
    
    public function searchService($searchkey)
    {
       $Service = Service::select('id','service_name','service_rate')->where('service_name','like','' . $searchkey . '%')->get()->take(10);
       return json_encode($Service);
       
    }


    function postServiceData(Request $request)
    {

        $request->validate([
            'service_name' => 'required | min:3',
            'service_rate' => 'required',
        

        ]);
        $existingRecord = Service::select("*")->where('service_name', $request->service_name)->get()->first();


        if (!empty($existingRecord)) {
            return redirect()->back()->with('text', 'This  service name  is exists  in the record');

        } else {

        $service = new Service;
        $service->id = $request->id;

        $service->service_name = $request->service_name;
        $service->service_rate = $request->service_rate;
        $service->service_category_id = $request->service_category_id;
        $service->status = 0;

        $service->save();
       
        return redirect('service/list')->with('status', 'Service has been added successfully');
        }
    }
    public function deleteService($id)
    {
        Service::where('id','=', $id)->update([
            'status' => 1, 

        ]);
        // Service::where('id', '=', $id)->delete();
        return redirect('service/list')->with('message', 'Service has been deleted successfully');
    }
    public function EditService($id)
    {
        $servicescatagories=ServiceCatagory::select('*')->get();

        $data  = Service::where('id', $id)->first();
        return view('frontend.service.edit', compact('data','servicescatagories'));
    }
    public function updateService($id, Request $request)
    {
        $request->validate([
            'service_name' => 'required',
            'service_rate' => 'required',
            'service_category_id' => 'required',
        ]);

        Service::where('id', '=', $request->id)->update([
            'service_name' => $request->service_name,
            'service_rate' => $request->service_rate,
            'service_category_id' => $request->service_category_id,
            'status' => 0,


        ]);
        return redirect('service/list')->with('messages', 'Service has been updated successfully');
    }
    public function search(Request $request,)
    {

        $get_name = $request->service_name;
        $data = Service::where('service_name', 'like', '%' . $get_name . '%')->paginate(10);
      

        $data = DB::table('services')
      
        ->join('service_catagories', 'services.service_category_id', '=', 'service_catagories.id')
        ->select('services.*', 'service_catagories.service_catagory_name')
        ->where('services.status', '=', 0)
        ->where('service_name', 'like', '%' . $get_name . '%')
        ->simplePaginate(10);
         
        return view('frontend.service.list', compact('data'));
    }

   
    public function export(){
        return  Excel::download(new ServiceExport, 'service.xlsx');
    }
    
}
