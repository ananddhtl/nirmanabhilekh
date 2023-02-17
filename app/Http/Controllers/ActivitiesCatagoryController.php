<?php

namespace App\Http\Controllers;

use App\Exports\ActivityCatagoryExport;

use App\Models\ActivityCatagory;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ActivitiesCatagoryController extends Controller
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
        return view('home');
    }
    public function getActivitiesCatagoryData()
    {


        $activitiescatagories = ActivityCatagory::where('status', '0')->simplePaginate(10);
        return view('frontend.activitiescatagory.list', compact('activitiescatagories'));
    }
    function postActivitiesCatagoryData(Request $request)
    {

        $request->validate([
        'activity_catagories_name' => 'required  | min:3'

            
        ]);
        $existingRecord = ActivityCatagory::select("*")->where('activity_catagories_name', $request->activity_catagories_name)->get()->first();


        if (!empty($existingRecord)) {
            return redirect()->back()->with('text', 'This name is already taken');

        } else {

        $activitiescatagories = new ActivityCatagory;
        $activitiescatagories->activity_catagories_name = $request->activity_catagories_name;
        $activitiescatagories->status = 0;

        $activitiescatagories->save();
        return redirect('activitiescatagory/list')->with('status', '  Your Data has been added successfully');
        }
    }
    public function deleteActivityCatagory($id)
    {
        ActivityCatagory::where('id', '=', $id)->update([
           'status' => 1,
        ]);
        return redirect()->back()->with('message', 'Your Data has been deleted successfully');
    }
    public function editActivityCatagory($id)
    {
        $data  = ActivityCatagory::where('id', $id)->first();
        return view('frontend.activitiescatagory.edit', compact('data'));
    }
    public function updateActivitiesCatagory($id, Request $request)
    {
        ActivityCatagory::where('id', '=', $request->id)->update([
            'activity_catagories_name' => $request->activity_catagories_name,
            'status' => $request->status,
            'status' => 0,
        ]);
        return redirect('/activitiescatagory/list')->with('messages', "Your data has been updated successfully");
    }
    public function search(Request $request,)
    {

        $get_name = $request->activity_catagories_name;
        $activitiescatagories = ActivityCatagory::where('status','0')->where('activity_catagories_name', 'like', '%' . $get_name . '%')->paginate(10);
        return view('frontend.activitiescatagory.list', compact('activitiescatagories'));
    }
    public function export()
    {
        return  Excel::download(new ActivityCatagoryExport, 'activitycatagory.xlsx');
    }
}
