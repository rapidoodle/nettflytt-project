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
use App\SMS;
use Helper;

class SMSManagementController extends Controller
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

        return view('sms-management', ['sms' => SMS::all()]);
    }

    public function saveSMS(Request $request)
    {	

    	SMS::whereId($request->id)->update(["text" => $request->text, "sender" => intval($request->sender)]);

        return view('sms-management', ['sms' => SMS::all()]);
    }
}
