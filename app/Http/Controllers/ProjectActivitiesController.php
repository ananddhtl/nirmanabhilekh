<?php

namespace App\Http\Controllers;


use App\Exports\ProjectActivtiesExport;
use App\Models\Project;
use App\Models\ProjectActivity;
use App\Models\Activity;
use App\Models\IncomeFromEquipment;
use App\Models\Invoice;
use App\Models\ServiceBillItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;

class ProjectActivitiesController extends Controller
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

        $project = Project::select('*')->get();
        $activity = Activity::select('*')->get();

        //dd($activity);
        return view('frontend.projectactivities.add', compact('project', 'activity'));
    }
    public function getProjectActivitiesData()
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
        $data = \DB::select("select sum(debit) as debit,sum(credit) as credit, qty,fullname,project_name,fiscal_year,tCode from project_activities inner join projects on project_activities.project_id=projects.id inner join suppliers on project_activities.suppliers_id=suppliers.id where project_activities.cancel=0  group by tCode,project_name,fiscal_year,fullname,qty");


        //dd($data);
        return view('frontend.projectactivities.list', compact('data'));
    }
    public function getSingleWiseData($id, $projectName)
    {






        $data = DB::table('project_activities',)
            ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
            ->join('suppliers', 'project_activities.suppliers_id', '=', 'suppliers.id')
            ->select('project_activities.*', 'activities.activities_title', 'suppliers.fullname')
            ->where('project_activities.project_id', '=', $id)
            ->where('project_activities.cancel', '=', 0)
            ->orderBy('project_activities.created_at', 'ASC')
            ->get();

        // dd($data);

        return view('frontend.report.singlewiseprojectdetails', compact('data', 'projectName'));
    }
    public function getSuppliersSingleWiseData($id, $fullname)
    {






        $data = DB::table('project_activities',)
            ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
            ->join('suppliers', 'project_activities.suppliers_id', '=', 'suppliers.id')
            ->select('project_activities.*', 'activities.activities_title', 'suppliers.fullname')
            ->where('project_activities.suppliers_id', '=', $id)
            ->where('project_activities.cancel', '=', 0)
            ->orderBy('project_activities.created_at', 'ASC')
            ->get();

        // dd($data);

        return view('frontend.report.suppliersreport', compact('data', 'fullname'));
    }

    public function getProjectActivitiesReport(Request $request)
    {
        // $data = DB::table('project_activities',)
        //     ->join('projects', 'project_activities.project_id', '=', 'projects.id')
        //     ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
        //     ->select('project_activities.*', 'projects.project_name', 'activities.activities_title')
        //     ->where('project_activities.status', '=', 0)
        //     ->where('project_activities.cancel', '=', 0)
        //     ->simplePaginate(10);

        $data = \DB::select("select sum(debit) as debit,sum(credit) as credit, qty,fullname,project_name,project_id,fiscal_year,tCode from project_activities inner join projects on project_activities.project_id=projects.id inner join suppliers on project_activities.suppliers_id=suppliers.id where project_activities.cancel=0  group by tCode,project_name,fiscal_year,fullname,qty,project_id");



        // dd($data);
        return view('frontend.report.projectactivities', compact('data'));
    }
    public function getSuppliersActivitiesReport(Request $request)
    {
       
        //$data = \DB::select("SELECT sum(debit) as debit,sum(credit) as credit, project_name,project_id,fullname,qty FROM `project_activities` INNER JOIN projects on project_activities.project_id=projects.id INNER JOIN suppliers on project_activities.suppliers_id=suppliers.id  where project_activities.cancel=0 and project_id='" . $request->project_id . "' GROUP by project_id,project_name,fullname,qty;");

        $data = \DB::select("select sum(debit) as debit,sum(credit) as credit, qty,fullname,project_name,fiscal_year,tCode from project_activities inner join projects on project_activities.project_id=projects.id inner join suppliers on project_activities.suppliers_id=suppliers.id where project_activities.cancel=0  and suppliers_id='' . $request->suppliers_id . ''  group by tCode,project_name,fiscal_year,fullname,qty");
       
      
        return view('frontend.report.supplierssearch', compact('data'));
    }

    public function getProfitData()
    {

        $Invoice = ServiceBillItem::select('*')->get();
        $data = DB::table('project_activities',)
            ->join('projects', 'project_activities.project_id', '=', 'projects.id')
            ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
            ->select('project_activities.*', 'projects.project_name', 'activities.activities_title')
            ->where('project_activities.status', '=', 0)
            ->where('project_activities.cancel', '=', 0)
            ->simplePaginate(10);
        return view('frontend.home', compact('data', 'Invoice'));
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



    function updateProjectActivitiesData(Request $request)
    {
        try {
            $tcode = $request->tcode;

            $activities = $request->activities;
            $activities_array = explode(',', $activities);
            $convetDate = explode('-', $request->fiscal_year);
            $convetDate = $convetDate[0] . "/" . $convetDate[1] . "/" . $convetDate[2];


            ProjectActivity::where('tCode', '=', $tcode)->update([
                'cancel' => 1,
            ]);

            $debit = 0;
            $credit = 0;
            $qunatity = 0;


            for ($i = 0; $i < count($activities_array); $i++) {
                $val = explode('{#}', $activities_array[$i]);
                if ($val[2] != '') {
                    $debit = $val[2];
                } else {
                    $debit = 0;
                }
                if ($val[3] != '') {
                    $credit = $val[3];
                } else {
                    $credit = 0;
                }
                if ($val[4] != '') {
                    $qunatity = $val[4];
                } else {
                    $qunatity = 0;
                }


                $projectactivity = new ProjectActivity;
                $projectactivity->project_id = $request->project_id;
                $projectactivity->activities_id = $val[1];
                $projectactivity->debit = $debit;
                $projectactivity->credit = $credit;
                $projectactivity->suppliers_id = $val[5];
                $projectactivity->qty = $qunatity;
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
    function postProjectActivitiesData(Request $request)
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
            $credit = 0;
            $qunatity = 0;


            for ($i = 0; $i < count($activities_array); $i++) {
                $val = explode('{#}', $activities_array[$i]);
                if ($val[2] != '') {
                    $debit = $val[2];
                } else {
                    $debit = 0;
                }
                if ($val[3] != '') {
                    $credit = $val[3];
                } else {
                    $credit = 0;
                }
                if ($val[4] != '') {
                    $qunatity = $val[4];
                } else {
                    $qunatity = 0;
                }


                $projectactivity = new ProjectActivity;
                $projectactivity->project_id = $request->project_id;
                $projectactivity->activities_id = $val[1];
                $projectactivity->debit = $debit;
                $projectactivity->credit = $credit;
                $projectactivity->suppliers_id = $val[5];
                $projectactivity->qty = $qunatity;
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




    public function deleteProjectActivity($tCode,)
    {

        ProjectActivity::where('tCode', '=', $tCode)->update([
            'cancel' => 1,
        ]);
        ProjectActivity::where('tCode', '=', $tCode)->update([
            'cancel' => 1,
        ]);
        return redirect('projectactivities/list/')->with('message', 'Your data  has been deleted successfully');
    }
    public function editProjectActivity($tcode)
    {


        $data = \DB::select("select project_activities.*,activities.activities_title,projects.project_name,suppliers.fullname from project_activities  inner join suppliers on project_activities.suppliers_id=suppliers.id inner join projects on project_activities.project_id=projects.id inner join activities on  project_activities.activities_id=activities.id where project_activities.cancel=0 and   project_activities.tCode='" . $tcode . "'");

        // dd($data);
        // $data  = ProjectActivity::where('id', $id)->first();
        return view('frontend.projectactivities.edit', compact('data'));
    }
    public function showProjectActivity($id)
    {
        $project = Project::select('*')->get();
        $activity = Activity::select('*')->get();
        $data  = ProjectActivity::where('id', $id)->first();
        return view('frontend.report.viewproject', compact('project', 'activity', 'data'));
    }



    public function updateProjectActivity($id, Request $request)
    {
        // $request->validate([


        //     'debit' => 'required',
        //     'credit' => 'required',

        //     'fiscal_year' => 'required',

        // ]);
        // ProjectActivity::where('id', '=', $request->id)->update([
        //     'project_id' => $request->project_id,
        //     'activities_id' => $request->activities_id,
        //     'debit' => $request->debit,
        //     'credit' => $request->credit,

        //     'fiscal_year' => $request->fiscal_year,
        //     'status' => 0,


        // ]);
        // return redirect('projectactivities/list/')->with('messages', 'Your given data  has been updated successfully!');
    }
    public function search(Request $request,)
    {

        $get_name = $request->project_id;

        $data = DB::table('project_activities',)
            ->join('projects', 'project_activities.project_id', '=', 'projects.id')
            ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
            ->join('suppliers', 'project_activities.suppliers_id', '=', 'suppliers.id')
            ->select('project_activities.*', 'projects.project_name', 'activities.activities_title', 'suppliers.fullname')
            ->where('project_activities.cancel', '=', 0)
            ->where('project_name', 'like', '%' . $get_name . '%')
            ->simplePaginate(10);


        return view('frontend.projectactivities.list', compact('data'));
    }
    public function export()
    {
        return  Excel::download(new ProjectActivtiesExport, 'projectactivities.xlsx');
    }
    public function searchDate(Request $request)
    {
        //  dd($request->all());
        $data = DB::table('project_activities')
            ->join('projects', 'project_activities.project_id', '=', 'projects.id')
            ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
            ->select('project_activities.*', 'projects.project_name', 'activities.activities_title')
            ->whereBetween('project_activities.created_at', [$request->From, $request->To])
            ->get();
        return view('frontend.report.projectactivities', compact('data'));
    }
    public function searchProject(Request $request)
    {

        // $data = DB::table('project_activities')
        //     ->join('projects', 'project_activities.project_id', '=', 'projects.id')
        //     ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
        //     ->select('project_activities.*', 'projects.project_name', 'activities.activities_title')
        //     ->where('project_activities.project_id', '=', $request->project_id)
        //     ->whereBetween('project_activities.created_at', [$request->from, $request->to])
        //     ->get();
        // dd($data);
        $data = \DB::select("SELECT sum(debit) as debit,sum(credit) as credit, project_name,project_id,fullname,qty FROM `project_activities` INNER JOIN projects on project_activities.project_id=projects.id INNER JOIN suppliers on project_activities.suppliers_id=suppliers.id  where project_activities.cancel=0 and project_id='" . $request->project_id . "' GROUP by project_id,project_name,fullname,qty;");



        return view('frontend.report.projectactivities', compact('data'));
    }



    public function forProjectActivitiesData()
    {

        $Invoice = Invoice::select('*')->get();
        $data = DB::table('project_activities',)
            ->join('projects', 'project_activities.project_id', '=', 'projects.id')
            ->join('activities', 'project_activities.activities_id', '=', 'activities.id')
            ->select('project_activities.*', 'projects.project_name', 'activities.activities_title')
            ->where('project_activities.status', '=', 0)
            ->simplePaginate(10);
        return view('frontend.invoice.projectactivities', compact('data', 'Invoice'));
    }
}
