<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;

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
			$storage = Helper::storageStatus(Helper::getToken(),session('customer._storageToken'), "payment");
			$arr 	 = json_decode($storage, false);
			$status  = ""; 

			foreach ($arr->_storage_status_list as $key => $value) {
				if($value->status == "reserved" && $value->id == "no.vipps"){
					$status = 200;
					$message = "Payment Success!";
					break;
	    			return view('/takk');
				}
			}

			if($status != 200){
	    		return redirect('/betaling/'+session('customer.phone'));
			}

		}else{
	    			return redirect('/');
		}
	}

	public function processPayment(Request $request){
		$phone 	  = $request->phoneNumber;
		$respObj  = json_decode(Helper::sendVipps(Helper::getToken(), $phone));

		$status = $respObj->status;
		echo json_encode($respObj);		
		if($status == 0){
			 return redirect($respObj->url);
		}else{
			 return redirect($respObj->url, ["error" => "Vipps failed."]);
		}
	}
}
