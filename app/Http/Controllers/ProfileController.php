<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Inbox;

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
    	}elseif(session('customer') && session('customer')['isLogged'] == true){    

            $status = Helper::storageStatus(Helper::getToken(), session('customer')['_storageToken'], "service");   
            $status = json_decode($status);

            if($status->_storage_status_list){
                foreach ($status->_storage_status_list as $key => $value) {
                    if (str_contains($value->detail, 'mailtrackingid')) {
                        $data = explode("|", $value->detail);
                        $ref  = explode(":", $data[1]);
                        $sql = Inbox::where('ref', '=', "_h55AD7Hb0")->first();
                    }
                }
            }


	        return view("/profile");
    	}else{
    		return redirect('/logginn');
    	}
	}

	public function logginn(){
		return view("logginn");
	}

	public function loginAuth(Request $request){
        $phone          = $request->number;
        $password       = $request->password;
        $_storageToken  = $request->_storageToken;

        $login = Helper::login(Helper::getToken(), $phone, $password);
        $arr = json_decode($login);
        
        if($arr->status == 10){
    		return redirect('/logginn')->with('error', 'Passordet er feil!')->withInput();
        }else{
    		$storage = Helper::getStorage(Helper::getToken(), $arr->token);
   		 	session()->put("customer", json_decode($storage, true));
            session()->put('customer.isLogged', true);      
                      
        	return redirect("/profile");
        }
        // if($login == session("customer")['number'] && $password == session("customer")['_keyLogin']){
        // 	Log::info("Customer Login: ".session('customer')['full-name']."/".date("Y-m-d H:i:s"));
        //     session()->put('customer.isLogged', true);                

        // 	return redirect("/profile");
        // }else{
        // 	return redirect("/logginn");
        // }
	}
}
