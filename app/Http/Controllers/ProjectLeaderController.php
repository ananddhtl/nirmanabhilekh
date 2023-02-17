<?php

namespace App\Http\Controllers;

use App\Models\ProjectLeader;
use App\Exports\ProjectLeaderExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProjectLeaderController extends Controller
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
    public function getProjectLeaderData()
    {
        $data = [
            "projectleaders" => ProjectLeader::where('status','0')->simplePaginate(10),
        ];
        return view('frontend.projectleader.list', $data);
    }

    public function searchProjectLeader($searchkey)
    {
        $data = ProjectLeader::select('id', 'project_leader_name', 'project_leader_mobilenumber')->where('project_leader_name', 'like', '' . $searchkey . '%')->get()->take(10);
        return json_encode($data);
    }


    function postProjectLeaderData(Request $request)
    {

        $request->validate([

            'project_leader_name' => 'required | ',
            'project_leader_mobilenumber' => 'required | min:10',
            'project_leader_address' => 'required | ',
            'project_leader_profession' => 'required | ',
        ]);

        $projectleader = new ProjectLeader;


        $projectleader->project_leader_name = $request->project_leader_name;
        $projectleader->project_leader_mobilenumber = $request->project_leader_mobilenumber;
        $projectleader->project_leader_address = $request->project_leader_address;
        $projectleader->project_leader_profession = $request->project_leader_profession;
        $projectleader->status = 0;

        $projectleader->save();
        return redirect('projectleader/list')->with('status', 'Project Leader Data has been added successfully');
    }
    public function deleteProjectLeader($id)
    {
        ProjectLeader::where('id', '=', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('message', 'Project Leader has been deleted successfully');
    }
    public function editProjectLeader($id)
    {
        $data  = ProjectLeader::where('id', $id)->first();
        return view('frontend.projectleader.edit', compact('data'));
    }
    public function updateProjectLeader($id, Request $request)
    {
        $request->validate([

            'project_leader_name' => 'required',
            'project_leader_mobilenumber' => 'required',
            'project_leader_address' => 'required',
            'project_leader_profession' => 'required',
        ]);
        ProjectLeader::where('id', '=', $request->id)->update([

            'project_leader_name' => $request->project_leader_name,
            'project_leader_mobilenumber' => $request->project_leader_mobilenumber,
            'project_leader_address' => $request->project_leader_address,
            'project_leader_profession' => $request->project_leader_profession,
            'status' => 0,


        ]);
        return redirect('projectleader/list')->with('messages', 'Your data has  been updated successfully.');
    }
    public function search(Request $request,)
    {

        $get_name = $request->project_leader_name;
        $projectleaders = ProjectLeader::where('status','0')->where('project_leader_name', 'like', '%' . $get_name . '%')->paginate(10);
        return view('frontend.projectleader.list', compact('projectleaders'));
    }
    public function export()
    {
        return  Excel::download(new ProjectLeaderExport, 'projectleader.xlsx');
    }
}
