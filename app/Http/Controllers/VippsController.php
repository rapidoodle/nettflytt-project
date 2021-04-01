<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Log;

class VippsController extends Controller
{
	public function index($number)
	{	
		if(session('customer._storageToken') != ""){
	    	return view('vipps', ['number' => $number]);
		}else{
	    	return redirect('/');
		}
	}

	public function checker(){	
		if(session('customer._storageToken') != ""){
			for ($i = 0; $i <= 10 ; $i++) { 
				$storage = Helper::storageStatus(Helper::getToken(), session('customer._storageToken'), "payment");
				$arr 	 = json_decode($storage, false);
				$status  = ""; 

				Log::info("Checking vipps storage: ".$storage);
				if(isset($arr->_storage_status_list)){
					foreach ($arr->_storage_status_list as $key => $value) {
						if(($value->status == "reserved" || $value->status == "captured") && $value->id == "no.vipps"){
							$status = 200;
							$message = "Payment Success!";
							Log::info("Vipps payment success; redirect to thank you page.");
				    		return redirect('/takk');
							break;
						}
					}
				}
				if($status == 200)
					break;
			}

			if($status != 200){
				Log::error("Vipps payment cancelled by user: ");
				session()->put("customer.vipps-result", ["error" => "Din betaling var avvist eller avbrutt. Venligst prøv igjen."]);
	    		return redirect('/betaling/'.session('customer')['phone']);
			}
		}else{
			Log::error("Illegal access to vipps page");
	    	return redirect('/');
		}
	}

	public function processPayment(Request $request){
		$phone 	  = $request->phoneNumber;
		$respObj  = json_decode(Helper::sendVipps(Helper::getToken(), $phone));
		Log::info("Vipps response: ".json_encode($respObj));	
		$status = $respObj->status;
		if($status == 0){
			 return redirect($respObj->url);
		}else{
			 return redirect($respObj->url, ["error" => "Vipps failed."]);
		}
	}
}
