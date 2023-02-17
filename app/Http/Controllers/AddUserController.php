<?php

namespace App\Http\Controllers;

use App\Models\AddUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class AddUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('add_users')->get();
        return view('frontend.adduser.adduser', compact('users'));
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

        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);
        $adduser = new AddUser();
        $adduser->id = $request->id;
        $adduser->username = $request->username;
        $adduser->password = Hash::make($request->password);
        $adduser->email = $request->email;

        $adduser->save();
        return redirect('/adduser')->with('status', ' Your data has been added successfully');
    }


    public function loginAccount(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = DB::table('add_users')->where('email', $email)->get();

        //dd($user[0]->password);
        if (!empty($user[0])) {
            if (Hash::check($password, $user[0]->password)) {
                $request->session()->put('sessionUserId', $user[0]->password);
                $request->session()->save();    // This will actually store the value in session and it will be available then all over
                return redirect('/');
            } else {
                return Redirect::back()->withErrors(['msg' => 'These credentials do not match our records.']);
            }
        } else {
            return Redirect::back()->withErrors(['msg' => 'These credentials do not match our records.']);
        }
    }

    public function createAccount(Request $request)
    {

        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);
        $adduser = new AddUser();
        // $adduser->id = $request->id;
        $adduser->username = $request->username;
        $adduser->password = Hash::make($request->password);
        $adduser->email = $request->email;

        $adduser->save();


        $request->session()->put('sessionUserId', Hash::make($request->password));
        $request->session()->save();    // This will actually store the value in session and it will be available then all over

        return redirect('/');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddUser  $addUser
     * @return \Illuminate\Http\Response
     */
    public function show(AddUser $addUser)
    {


        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddUser  $addUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AddUser $addUser, $id)
    {

        $users  = AddUser::where('id', $id)->first();
        return view('frontend.adduser.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddUser  $addUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddUser $addUser)
    {
        AddUser::where('id', '=', $request->id)->update([
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,


        ]);
        return redirect('/adduser')->with('messages', 'Your data has  been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddUser  $addUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddUser $addUser, $id)
    {

        AddUser::where('id', '=', $id)->destroy([]);


        return redirect('/adduser')->with('message', 'Customer has been deleted successfully');
    }
}
