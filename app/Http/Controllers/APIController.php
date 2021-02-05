<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;

class APIController extends Controller
{
    //
    public function getToken(Request $request){
    	$people = $request->people;
    	$person = explode("---", $people);
    	$pctr   = 0;
    	$request['first_name'] = Helper::firstName($request['full-name']);
    	$request['last_name']  = Helper::lastName($request['full-name']);

    	foreach ($person as $key => $value) {

    		if($value){
    			$pos 	   = $key;
	    		$record    = explode("|", $value);
	    		$firstName = Helper::firstName($record['0']);
	    		$lastName  = Helper::lastName($record['0']);
                if($firstName != "" && $lastName != "" && $record[1] != "" && $record[2] != ""){
                    $request['person'.$pos] = array("name" => $record[0], "under18" => false, "bday" => $record[3], "last_name" => $lastName, "first_name" => $firstName, "phone" => $record[1], "email" => $record[2]);
                    $pctr++;
                }
    		}
    	}

    	if(isset($request['person0'])){
    		$bdayArr = explode("-", $request['person0']['bday']);
    		$request['full-name'] 	= $request['person0']['name'];
    		$request['first_name'] 	= $request['person0']['first_name'];
    		$request['last_name'] 	= $request['person0']['last_name'];
    		$request['email'] 	  	= $request['person0']['email'];
    		$request['phone'] 	  	= $request['person0']['phone'];
    		$request['birth_day'] 	= $bdayArr[2];
    		$request['birth_month'] = $bdayArr[1];
    		$request['birth_year'] 	= $bdayArr[0];
    	}

        if(isset($request['mailbox-sign']) && $request['mailbox-sign'] == 1){
            $request['pb-price'] = 169;
        }else{
            $request['pb-price'] = 149;
        }

        $request['price']       = 149;
        $request['adv-price']   = 0;
        $request['totalPerson'] = $pctr;
    	$request['services']    = session('customer.services') != "" ? session('customer.services') : array();
    	$request['old_post'] 	= $request['old_zipcode'].' '.$request['old_place'];
    	$request['new_post'] 	= $request['new_zipcode'].' '.$request['new_place'];
		// or when your server returns json
		// $content = json_decode($response->getBody(), true);

    	unset($request['people']);
    	unset($request['_token']);

    	//customer unique token -- store in session
        // if(!session("_token")){
        //     $token = Helper::getToken();
        // }else{
        //     $token = session("_token");
        // }

        echo    $token = Helper::getToken();
    	//update customer record
    	// $update = Helper::updateData($token, $request->all());

        echo $sendOTP = Helper::sendOTP($token, "+639178713844", "Nettflytt");

    	session(['customer' => $request->all()]);
    	// echo json_encode($update);

    	session(['_token' 	=> $token, 
    			 'old_post' => $request['old_zipcode'].' '.$request['old_place'],
    			 'new_post' => $request['new_zipcode'].' '.$request['new_place'],
    			 'customer' => $request->all()]);

        if(!isset($request['person0'])){

            session()->put("customer.person0.name", $request['full-name']);
            session()->put("customer.person0.under18", true);
            session()->put("customer.person0.bday", $request['birth_year'].'-'.$request['birth_month'].'-'.$request['birth_day']);

            session()->put("customer.person0.last_name", $request['last_name']);
            session()->put("customer.person0.first_name", $request['first_name']);
            session()->put("customer.person0.phone", $request['phone']);
            session()->put("customer.person0.email", $request['email']);
        }
    	echo json_encode(session('customer'));

    	 return redirect('/receiver/');

    }

    public function updateCompanyList(Request $request){
        //empty company list;
        session()->put('customer.services', $request->services);

        echo json_encode(session('customer.services'));
    }

    public function searchCompany(Request $request){
        if($request->cat == "categories" && session('allcompanies')){
        $query = $request['query'];

        $filteredItems = array_values(array_filter(json_decode(session('allcompanies')), function($elem) use($query){
            return strtolower($elem->category) == strtolower($query);
        }));

        echo json_encode($filteredItems);

        }else{
            echo Helper::searchCompanies($request['query'], $request->cat);
        }
    }

    public function updateCustomerData(Request $request){
        foreach ($request->fields as $key => $value) {
            $newKey = substr($key, 0, 6) == "person" ? str_replace("-", ".", $key) : $key;
            $sessionKey = 'customer.'.$newKey;
            session()->put($sessionKey, $value);
        }

        echo json_encode(session('customer'));
    }
}
