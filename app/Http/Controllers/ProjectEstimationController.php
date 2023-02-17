<?php

namespace App\Http\Controllers;

use App\Models\ProjectEstimation;
use App\Models\Project;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
class ProjectEstimationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::select('*')->get();
        $activity = Activity::select('*')->get();

        //dd($activity);
        return view('frontend.projectestimation.add', compact('project', 'activity'));
    }
    public function progressIndex()
    {
        $project = Project::select('*')->get();
        $activity = Activity::select('*')->get();

        //dd($activity);
        return view('frontend.projectprogress.add', compact('project', 'activity'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectEstimation  $projectEstimation
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectEstimation $projectEstimation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectEstimation  $projectEstimation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectEstimation $projectEstimation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectEstimation  $projectEstimation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectEstimation $projectEstimation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectEstimation  $projectEstimation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectEstimation $projectEstimation)
    {
        //
    }
    function generateuniqueid()
    {
        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('-10 days'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $uniqueid = $startDate + $rand;
        $length = 20;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $tCode = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $tCode = $tCode . $uniqueid;

        return $tCode;
    }
    function postProjectEstimationData(Request $request)
    {

        try {
            $tcode = $this->generateuniqueid();
            $tcode = $tcode . $request->project_id;
            $activities = $request->activities;
            $activities_array = explode(',', $activities);
            $convetDate = explode('-', $request->fiscal_year);
            $convetDate = $convetDate[0] . "/" . $convetDate[1] . "/" . $convetDate[2];
            //return $convetDate;
            $debit = 0;
            $amount = 0;
           


            for ($i = 0; $i < count($activities_array); $i++) {
                $val = explode('{#}', $activities_array[$i]);
                if ($val[2] != '') {
                    $debit = $val[2];
                } else {
                    $debit = 0;
                }
                if ($val[3] != '') {
                    $amount = $val[3];
                } else {
                    $amount = 0;
                }
               


                $projectactivity = new ProjectEstimation;
                $projectactivity->project_id = $request->project_id;
                $projectactivity->activities_id = $val[1];
                $projectactivity->quantity_in = $debit;
                $projectactivity->quantity_out = 0;
                $projectactivity->amount = $amount;
                $projectactivity->suppliers_id = $val[4];
               
                $projectactivity->cancel = 0;
                $projectactivity->fiscal_year = $convetDate;
                $projectactivity->status = 0;
                $projectactivity->tCode = $tcode;
                $projectactivity->save();
            }


            return json_encode(array(
                'status' => true, 'message' => "Successfully done."
            ));
        } catch (QueryException $e) {
            return json_encode(array(
                'status' => false, 'message' => $e
            ));
        }
    }
    function postProjectProgressData(Request $request)
    {

        try {
            $tcode = $this->generateuniqueid();
            $tcode = $tcode . $request->project_id;
            $activities = $request->activities;
            $activities_array = explode(',', $activities);
            $convetDate = explode('-', $request->fiscal_year);
            $convetDate = $convetDate[0] . "/" . $convetDate[1] . "/" . $convetDate[2];
            //return $convetDate;
            $debit = 0;
            $amount = 0;
           


            for ($i = 0; $i < count($activities_array); $i++) {
                $val = explode('{#}', $activities_array[$i]);
                if ($val[2] != '') {
                    $credit = $val[2];
                } else {
                    $credit = 0;
                }
                if ($val[3] != '') {
                    $amount = $val[3];
                } else {
                    $amount = 0;
                }
               


                $projectactivity = new ProjectEstimation;
                $projectactivity->project_id = $request->project_id;
                $projectactivity->activities_id = $val[1];
                $projectactivity->quantity_in = 0;
                $projectactivity->quantity_out = $credit;
                $projectactivity->amount = $amount;
                $projectactivity->suppliers_id = $val[4];
               
                $projectactivity->cancel = 0;
                $projectactivity->fiscal_year = $convetDate;
                $projectactivity->status = 0;
                $projectactivity->tCode = $tcode;
                $projectactivity->save();
            }


            return json_encode(array(
                'status' => true, 'message' => "Successfully done."
            ));
        } catch (QueryException $e) {
            return json_encode(array(
                'status' => false, 'message' => $e
            ));
        }
    }
    public function getProjectEstimationData()
    {


        // $data = DB::table('project_activities',)
        //     ->join('projects', 'project_activities.project_id', '=', 'projects.id')
        //     ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
        //     ->select('project_activities.*', 'projects.project_name', 'activities.activities_title')
        //     ->where('project_activities.status', '=', 0)
        //     ->where('project_activities.cancel', '=', 0)
        //     // ->groupBy('tCode')
        //     ->simplePaginate(10);

        // $data = \DB::select("select sum(debit) as debit,sum(credit) as credit,project_name,fiscal_year,tCode from project_activities inner join projects on project_activities.project_id=projects.id where project_activities.cancel=0  group by tCode,project_name,fiscal_year order by project_activities.created_at desc   limit 20 ");
        $estimationData = \DB::select("select sum(quantity_in) as quantity_in,sum(quantity_out) as quantity_out,amount,fullname,project_name,fiscal_year,tCode from project_estimations inner join projects on project_estimations.project_id=projects.id inner join suppliers on project_estimations.suppliers_id=suppliers.id where project_estimations.quantity_out=0  group by tCode,project_name,fiscal_year,fullname,amount");


        //dd($data);
        return view('frontend.projectestimation.list', compact('estimationData'));
    }
    public function getProjectProgressData()
    {


        // $data = DB::table('project_activities',)
        //     ->join('projects', 'project_activities.project_id', '=', 'projects.id')
        //     ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
        //     ->select('project_activities.*', 'projects.project_name', 'activities.activities_title')
        //     ->where('project_activities.status', '=', 0)
        //     ->where('project_activities.cancel', '=', 0)
        //     // ->groupBy('tCode')
        //     ->simplePaginate(10);

        // $data = \DB::select("select sum(debit) as debit,sum(credit) as credit,project_name,fiscal_year,tCode from project_activities inner join projects on project_activities.project_id=projects.id where project_activities.cancel=0  group by tCode,project_name,fiscal_year order by project_activities.created_at desc   limit 20 ");
        $estimationData = \DB::select("select sum(quantity_in) as quantity_in,sum(quantity_out) as quantity_out,amount,fullname,project_name,fiscal_year,tCode from project_estimations inner join projects on project_estimations.project_id=projects.id inner join suppliers on project_estimations.suppliers_id=suppliers.id where project_estimations.quantity_in=0  group by tCode,project_name,fiscal_year,fullname,amount");


        //dd($data);
        return view('frontend.projectprogress.list', compact('estimationData'));
    }
    public function deleteProjectEstimation($tCode,)
    {

        ProjectEstimation::where('tCode', '=', $tCode)->update([
            'cancel' => 1,
        ]);
        ProjectEstimation::where('tCode', '=', $tCode)->update([
            'cancel' => 1,
        ]);
        return redirect('/projectestimation/list')->with('message', 'Your data  has been deleted successfully');
    }
    public function editProjectEstimation($tcode)
    {


        $data = \DB::select("select project_estimations.*,activities.activities_title,projects.project_name,suppliers.fullname from project_estimations  inner join suppliers on project_estimations.suppliers_id=suppliers.id inner join projects on project_estimations.project_id=projects.id inner join activities on  project_estimations.activities_id=activities.id where project_estimations.cancel=0 and   project_estimations.tCode='" . $tcode . "'");

        // dd($data);
        // $data  = ProjectActivity::where('id', $id)->first();
        return view('frontend.projectestimation.edit', compact('data'));
    }
    function updateProjectEstimationData(Request $request)
    {
        try {
            $tcode = $this->generateuniqueid();
            $tcode = $tcode . $request->project_id;
            $activities = $request->activities;
            $activities_array = explode(',', $activities);
            $convetDate = explode('-', $request->fiscal_year);
            $convetDate = $convetDate[0] . "/" . $convetDate[1] . "/" . $convetDate[2];

            ProjectEstimation::where('tCode', '=', $tcode)->update([
                'cancel' => 1,
            ]);

            //return $convetDate;
            $debit = 0;
            $amount = 0;
           


            for ($i = 0; $i < count($activities_array); $i++) {
                $val = explode('{#}', $activities_array[$i]);
                if ($val[2] != '') {
                    $debit = $val[2];
                } else {
                    $debit = 0;
                }
                if ($val[3] != '') {
                    $amount = $val[3];
                } else {
                    $amount = 0;
                }
               


                $projectactivity = new ProjectEstimation;
                $projectactivity->project_id = $request->project_id;
                $projectactivity->activities_id = $val[1];
                $projectactivity->quantity_in = $debit;
                $projectactivity->quantity_out = 0;
                $projectactivity->suppliers_id = $val[4];
               
                $projectactivity->cancel = 0;
                $projectactivity->fiscal_year = $convetDate;
                $projectactivity->status = 0;
                $projectactivity->amount = $amount;
                $projectactivity->tCode = $tcode;
                $projectactivity->save();
            }


            return json_encode(array(
                'status' => true, 'message' => "Successfully done."
            ));
        } catch (QueryException $e) {
            return json_encode(array(
                'status' => false, 'message' => $e
            ));
        }


    }
    public function search(Request $request,)
    {

        $get_name = $request->project_id;

        $estimationData = DB::table('project_estimations',)
            ->join('projects', 'project_estimations.project_id', '=', 'projects.id')
            ->join('activities', 'project_estimations.activities_id', '=', 'activities.id')
            ->join('suppliers', 'project_estimations.suppliers_id', '=', 'suppliers.id')
            ->select('project_estimations.*', 'projects.project_name', 'activities.activities_title', 'suppliers.fullname')
            ->where('project_estimations.cancel', '=', 0)
            ->where('project_name', 'like', '%' . $get_name . '%')
            ->simplePaginate(10);


        return view('frontend.projectestimation.list', compact('estimationData'));
    }
    public function estimationReport(Request $request)
    {
      
        $estimationData = DB::table('project_estimations')
        ->join('projects', 'project_estimations.project_id', '=', 'projects.id')
        ->join('activities', 'project_estimations.activities_id', '=', 'activities.id')
        ->join('suppliers', 'project_estimations.suppliers_id', '=', 'suppliers.id')
        ->select('project_estimations.*', 'projects.project_name', 'activities.activities_title', 'suppliers.fullname')
        ->where('project_estimations.cancel', '=', 0)
            ->get();
        return view('frontend.report.projectestimation', compact('estimationData'));
    }
    public function reportSearch(Request $request,)
    {

        $data = \DB::select("SELECT sum(debit) as debit,sum(credit) as credit, project_name,project_id,fullname,qty FROM `project_activities` INNER JOIN projects on project_activities.project_id=projects.id INNER JOIN suppliers on project_activities.suppliers_id=suppliers.id  where project_activities.cancel=0 and project_id='" . $request->project_id . "' GROUP by project_id,project_name,fullname,qty;");



        return view('frontend.report.projectestimation', compact('estimationData'));
    }
}