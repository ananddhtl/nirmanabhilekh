<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectLeader;
use App\Models\Customer;
use App\Exports\ProjectExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{

    public function getProjectData()
    {
        $data = DB::table('projects',)
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->join('project_leaders', 'projects.project_leader_id', '=', 'project_leaders.id')
            ->select('projects.*', 'project_leaders.project_leader_name', 'customers.customer_name')
            ->where('projects.status', '=', 0)
            ->simplePaginate(10);
        return view('frontend.project.list', compact('data'));
    }
    public function getProjectWise()

    {
        $Project = Project::select('*')->get();
        $data = DB::table('projects',)

            ->get();
        return view('frontend.report.projectwise', compact('data', 'Project'));
    }
    public function searchProject($searchkey)
    {
        $Project = Project::select('id', 'project_name', 'project_address')->where('project_name', 'like', '' . $searchkey . '%')->get()->take(10);
        return json_encode($Project);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ProjectLeader = ProjectLeader::select('*')->get();
        return view('frontend.project.add', compact('ProjectLeader'));
    }

    function postProjectData(Request $request)
    {

        $request->validate([
            'project_name' => 'required',
            'project_address' => 'required',
            'project_city' => 'required',
            'project_fiscal_year' => 'required',
            'project_duration' => 'required',
            'project_costestimation' => 'required',
            'project_leader_id' => 'required',
            'customer_id' => 'required'
        ]);

        $project = new Project;

        $project->customer_id = $request->customer_id;
        $project->project_name = $request->project_name;
        $project->project_address = $request->project_address;
        $project->project_city = $request->project_city;
        $project->project_fiscal_year = $request->project_fiscal_year;
        $project->project_duration = $request->project_duration;
        $project->project_costestimation = $request->project_costestimation;
        $project->project_leader_id = $request->project_leader_id;
        $project->status = 0;

        $project->save();
        return redirect('/project/list')->with('status','Your data has been saved successfully');
    }
    function postProject(Request $request)
    {

        $request->validate([
            'project_name' => 'required',
            'project_address' => 'required',
            'project_city' => 'required',
            'project_fiscal_year' => 'required',
            'project_duration' => 'required',
            'project_costestimation' => 'required',
            'project_leader_id' => 'required',
            'customer_id' => 'required'
        ]);
        

        $project = new Project;

        $project->customer_id = $request->customer_id;
        $project->project_name = $request->project_name;
        $project->project_address = $request->project_address;
        $project->project_city = $request->project_city;
        $project->project_fiscal_year = $request->project_fiscal_year;
        $project->project_duration = $request->project_duration;
        $project->project_costestimation = $request->project_costestimation;
        $project->project_leader_id = $request->project_leader_id;
        $project->status = 0;

        $project->save();
        $id = Project::select('id','project_name')->orderBy('created_at', 'desc')->first();
        $project_id = $id->id;
        return json_encode(array(
            'status' => true, 'message' => "Successfully done.",'project_id' => $project_id,'project_name' => $id->project_name
        ));
    }
    
    public function deleteProject($id)
    {
        Project::where('id', '=', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('message', 'Project has been deleted successfully');
    }
    public function editProject($id)
    {
        // 
        // $ProjectLeader=ProjectLeader::select('*')->get();
        // $Customer=Customer::select('*')->get();
        // $data  = Project::where('id', $id)->first();


        $data = \DB::select("select projects.*, project_leader_name,customer_name  from projects inner join  project_leaders on projects.project_leader_id=project_leaders.id inner join customers on projects.customer_id=customers.id where projects.id='" . $id . "' ");

        // dd($data);

        return view('frontend.project.edit', compact('data'));
    }
    public function updateProject($id, Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'project_address' => 'required',
            'project_city' => 'required',
            'project_fiscal_year' => 'required',
            'project_duration' => 'required',
            'project_costestimation' => 'required',
            'project_leader_id' => 'required'
        ]);
        Project::where('id', '=', $request->id)->update([
            'id' => $request->id,
            'project_name' => $request->project_name,
            'project_address' => $request->project_address,
            'project_city' => $request->project_city,
            'project_fiscal_year' => $request->project_fiscal_year,
            'project_costestimation' => $request->project_costestimation,
            'project_leader_id' => $request->project_leader_id,
            'status' => 0,

        ]);
        return redirect('/project/list')->with('messages', 'Your given data has been updatede succesfully');
    }

    public function search(Request $request,)
    {

        $get_name = $request->project_name;
        // $data = Project::where('status','0')->where('project_name', 'like', '%' . $get_name . '%')->paginate(10);
        // return view('frontend.project.list', compact('data'));


        $data = DB::table('projects',)
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->join('project_leaders', 'projects.project_leader_id', '=', 'project_leaders.id')
            ->select('projects.*', 'project_leaders.project_leader_name', 'customers.customer_name')
            ->where('projects.status', '=', 0)
            ->where('project_name', 'like', '%' . $get_name . '%')
            ->simplePaginate(10);
        return view('frontend.project.list', compact('data'));
    }
    public function export()
    {

        return  Excel::download(new ProjectExport, 'project.xlsx',);
    }
}