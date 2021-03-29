<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request){
    	if(isset($request->sid)){
        	$storage = Helper::getStorage(Helper::getToken(), $request->sid);
        	$sObj = json_decode($storage);

        	if($sObj->_status == 300){
        		return redirect("/");
        	}else{
        		session()->put("customer", json_decode($storage, true));
        		session()->put("customer.isLogged", false);
        		return redirect("/logginn");
        	}
    	}else{
    		return redirect('/logginn');
    	}
	}

	public function logginn(){
		return view("logginn");
	}

	public function loginAuth(Request $request){
        $login          = $request->email;
        $password       = $request->password;
        $_storageToken  = $request->_storageToken;

        if($login == session("customer")['email'] && $password == session("customer")['_keyLogin']){

        	Log::info("Customer Login: ".session('customer')['full-name']."/".date("Y-m-d H:i:s"));
            session()->put('customer.isLogged', true);                

        	return redirect("/profile");
        }else{
        	return redirect("/logginn");
        }
	}
}
