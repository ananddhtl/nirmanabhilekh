<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $request->validate([]);

        $suppliers = new Suppliers;
        $suppliers->id = $request->id;
        $suppliers->fullname = $request->fullname;
        $suppliers->address = $request->address;
        $suppliers->contact_number = $request->contact_number;
        $suppliers->email = $request->email;


        $suppliers->save();
        $id = Suppliers::select('id','fullname')->orderBy('created_at', 'desc')->first();
        $suppliers_id = $id->id;
        return json_encode(array(
            'status' => true, 'message' => "Successfully done." ,'suppliers_id' => $suppliers_id,'full_name' => $id->fullname
            
        ));
       
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers)
    {
        $suppliers = DB::table('suppliers')

            ->get();
        return view('frontend.suppliers.list', compact('suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data  = Suppliers::where('id', $id)->first();
        return view('frontend.suppliers.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $suppliers)
    {
        Suppliers::where('id', '=', $request->id)->update([
            'fullname' => $request->fullname,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'email' => $request->email,



        ]);
        return redirect('suppliers/list')->with('messages', 'Your data has  been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Suppliers::where('id', '=', $id)->delete([]);

        // Customer::where('id', '=', $id)->delete();
        return redirect('suppliers/list')->with('message', 'Suppliers has been deleted successfully');
    }
    public function search(Request $request)
    {
        $get_name = $request->fullname;
        $suppliers = Suppliers::where('fullname', 'like', '%' . $get_name . '%')->paginate(10);
        return view('frontend.suppliers.list', compact('suppliers'));
    }
    public function searchSuppliers($searchkey)
    {
        $suppliers = Suppliers::select('id', 'fullname', 'address')->where('fullname', 'like', '' . $searchkey . '%')->get()->take(10);
        return json_encode($suppliers);
    }
    public function getSuppliersWise()

    {
        $Suppliers = Suppliers::select('*')->get();
        $data = DB::table('suppliers',)

            ->get();
        return view('frontend.report.supplierswise', compact('data', 'Suppliers'));
    }
   
}
