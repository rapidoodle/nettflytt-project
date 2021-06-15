<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Users;

class UserManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }    

    public function index()
    {	

        return view('users-management', ['users' => Users::all()]);
    }

    public function create(Request $request){
        $user 			= new Users;
        $user->name 	= $request->name;
        $user->email 	= $request->email;
        $user->password = Hash::make($request->password);
        $user->type 	= $request->type;
        $user->save();


        return redirect('/users-management')->with('success', 'User added!');

    }
}
