<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Exports\ActivtiesExport;
use App\Models\ActivityCatagory;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ActivitiesController extends Controller
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
public function activitiesCatagoriesForProjectEstimation (){
    
        $activitiescatagories=ActivityCatagory::select('*')->get();
    
    
    
        return view('frontend.projectestimation.add',compact('activitiescatagories'));
    }     
public function activitiesCatagoriesForProjectProgress (){
    
        $activitiescatagories=ActivityCatagory::select('*')->get();
    
    
    
        return view('frontend.projectprogress.add',compact('activitiescatagories'));
    }
public function activitiesCatagories (){
    
        $activitiescatagories=ActivityCatagory::select('*')->get();
    
    
    
        return view('frontend.projectactivities.add',compact('activitiescatagories'));
    }

public function index(){
    
    $activitiescatagories=ActivityCatagory::select('*')->get();



    return view('frontend.activities.add',compact('activitiescatagories'));
}
public function searchActivities($searchkey)
{
    $Activity = Activity::select('id', 'activities_title', )->where('activities_title', 'like', '' . $searchkey . '%')->get()->take(10);
    return json_encode($Activity);
}  
    public function getActivityData()
{
    $data = DB::table('activities',)
    ->join('activity_catagories', 'activities.activities_cat_ID', '=', 'activity_catagories.id')
    ->select('activities.*', 'activity_catagories.activity_catagories_name')
    ->where('activities.status','=',0)
    ->simplePaginate(10);
    return view('frontend.activities.list', compact('data'));
    

    
}  
    function postActivitiesData(Request $request){

        $request->validate([
        
        'activities_title'=>'required  | min:3',
        'activities_subtitle'=>'required  | min:3',
      
        ]);
        $existingRecord = Activity::select("*")->where('activities_title', $request->activities_title)->get()->first();


        if (!empty($existingRecord)) {
            return json_encode(array(
                'text' => true, 'message' => " You already have that item"
                
            ));
        } else {

        $activities = new Activity;
        $activities->id= $request->id;
        $activities->activities_title= $request->activities_title;
        $activities->activities_subtitle= $request->activities_subtitle;
        $activities->activities_cat_ID= $request->activities_cat_ID;
        $activities->unit= $request->unit;
        $activities->status = 0;
        $activities->save();
        $id = Activity::select('id','activities_title')->orderBy('created_at', 'desc')->first();
        $activities_id = $id->id;
        return json_encode(array(
            'status' => true, 'message' => "Successfully done." ,'activities_id' => $activities_id,'activities_name' => $id->activities_title
            
        ));
       //s alert('activities_id');
   
    }
    }
    public function deleteActivities($id) 
    {
        Activity::where('id','=',$id)->update([
           'status' => 1,
        ]);
        return redirect('/activities/list')->with('message','Your data has been deleted successfully');
    }
    public function editActivities($id){

        $activitiescatagories=ActivityCatagory::select('*')->get();
        $data = Activity::where('id',$id)->first();
    
        return view('frontend.activities.edit',compact('data','activitiescatagories'));
    }
    public function updateActivities($id ,Request $request)
    {
        Activity::where('id','=' ,$request->id) ->update([
            'activities_title'=>$request->activities_title,
            'activities_subtitle'=>$request->activities_subtitle,
            'activities_cat_ID'=>$request->activities_cat_ID,
            'unit'=>$request->unit,
            'status' => 0,
            
        ]);
        return redirect('/activities/list')->with('messages', 'Your  data has been updated succesfully');
    }
    public function search(Request $request, )
    {   $get_name = $request->activities_title;
        $data = DB::table('activities',)
        ->join('activity_catagories', 'activities.activities_cat_ID', '=', 'activity_catagories.id')
        ->select('activities.*', 'activity_catagories.activity_catagories_name')
        ->where('activities.status','=',0)
        ->where('activities_title','like','%'.$get_name.'%')
        ->simplePaginate(10);
        
         
        return view('frontend.activities.list',compact('data'));
  
    
    }
    public function export(){
        return  Excel::download(new ActivtiesExport, 'activity.xlsx');
    }

}