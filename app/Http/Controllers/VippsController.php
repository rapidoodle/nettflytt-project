<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Log;

class VippsController extends Controller
{
	public function index()
	{	
	    return view('vipps');

	}

	public function checkMobile(Request $request){
    	$token 	  = Helper::getToken(); 
		$u 	  	  = "u46114-".session("_sessionSalt");
        $data     = array("type" => "AND", "search" => json_encode(["phone" => $request['number']])); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/storage/search";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
		$response = array();
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);
	    $obj  	  = json_decode($json);

	    if($obj->_status == 0){
	    	if(session('customer') === null){
		    	foreach ($obj->sids as $key => $value) {
				    $token = $value;
		    	}
		    	$storage = Helper::getStorage(Helper::getToken(), $token);
	   		 	session()->put("customer", json_decode($storage, true));
	            session()->put('customer.isLogged', false);      

        		$response['storage'] = session('customer');

	    	}
		    $response['result']    = true;
	    }else{
	    	$response['result'] = false;
	    }
        
		return $response;
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
							Helper::saveSale("vipps");
							Log::info("Vipps payment success; redirect to thank you page.");
				    		return redirect('/logginn');
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
	    		return redirect('/betaling#'.session('customer')['phone']);
			}
		}else{
			Log::error("Illegal access to vipps page");
	    	return redirect('/');
		}
	}


	public function vippsResult(){	
		if(session('customer')){
				echo $storage = Helper::storageStatus(Helper::getToken(), session('customer._storageToken'), "payment");
			// for ($i = 0; $i <= 10 ; $i++) { 
			// 	echo $storage = Helper::storageStatus(Helper::getToken(), session('customer._storageToken'), "payment");
			// 	$arr 	 = json_decode($storage, false);
			// 	$status  = ""; 

			// 	Log::info("Checking vipps storage: ".$storage);
			// 	if(isset($arr->_storage_status_list)){
			// 		foreach ($arr->_storage_status_list as $key => $value) {
			// 			if(($value->status == "reserved" || $value->status == "captured") && $value->id == "no.vipps"){
			// 				$status = 200;
			// 				$message = "Payment Success!";
			// 				Helper::saveSale("vipps");
			// 				Log::info("Vipps payment success; redirect to thank you page.");
			// 	    		return redirect('/logginn');
			// 				break;
			// 			}
			// 		}
			// 	}
			// 	if($status == 200)
			// 		break;
			// }

			if($status != 200){
				Log::error("Vipps payment cancelled by user: ");
				session()->put("customer.vipps-result", ["error" => "Din betaling var avvist eller avbrutt. Venligst prøv igjen."]);
	    		return redirect('/betaling#'.session('customer')['phone']);
			}
		}else{
			//Log::error("Illegal access to vipps page");
	    	//return redirect('/');
		}
	}

	public function processPayment(Request $request){
		$phone 	  = $request->phoneNumber;
		$respObj  = json_decode(Helper::sendVipps(Helper::getToken(), $phone));
		Log::info("Vipps response: ".json_encode($respObj));	
		$status = $respObj->status;
		if($status == 0){
			 return redirect($respObj->url);
		}elseif($status == 510){
			return redirect('/logginn');
		}elseif($status == 530){
			return redirect('/logginn');
		}else{
			 return redirect($respObj->url, ["error" => "Vipps failed."]);
		}
	}
}
