<?php

namespace App\Http\Controllers;

use App\Models\AddUser;
use App\Models\ManagementUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $adduser = \DB::table('add_users')->get();
       
        
        return view('frontend.manageuser.list', compact('adduser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $userPrivilage = new ManagementUser;
        $userPrivilage->userId=$request->userId;
        $userPrivilage->options=$request->dashboard.",".$request->incomefromequipment.",".$request->expensesfromequipment.",".$request->servicebillitems.",".$request->projectactivitiesitems.",".$request->equipmentTypes.",".$request->serviceTypes.",".$request->activitiesTypes.",".$request->datewise.",".$request->customerwise.",".$request->projectactivities.",".$request->incomereport.",".$request->expensesreport.",".$request->customer.",".$request->service.",".$request->equipment.",".$request->project.",".$request->activities.",".$request->projectleader.",";
        $userPrivilage->save();
        return redirect('/manageuser')->with('status', ' Your data has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagementUser  $managementUser
     * @return \Illuminate\Http\Response
     */
    public function show(ManagementUser $managementUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagementUser  $managementUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adduser = DB::table('add_users')->get();
        $users  = AddUser::select('*')->where('id', $id)->get();


        //dd($users);
        return view('frontend.manageuser.list', compact('adduser','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManagementUser  $managementUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManagementUser $managementUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagementUser  $managementUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManagementUser $managementUser)
    {
        //
    }
}
