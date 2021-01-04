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

        $request['totalPerson'] = $pctr;
    	$request['services']    = array();
    	$request['old_post'] 	= $request['old_zipcode'].' '.$request['old_place'];
    	$request['new_post'] 	= $request['new_zipcode'].' '.$request['new_place'];
		// or when your server returns json
		// $content = json_decode($response->getBody(), true);

    	unset($request['people']);
    	unset($request['_token']);

    	//customer unique token -- store in session
    	// echo $token = Helper::getToken();

    	//update customer record
    	// $update = Helper::updateData($token, $request->all());

    	// echo json_encode($update);

    	session(['customer' => $request->all()]);
    	// echo json_encode($update);

    	// session(['_token' 	=> $token, 
    	// 		 'old_post' => $request['old_zipcode'].' '.$request['old_place'],
    	// 		 'new_post' => $request['new_zipcode'].' '.$request['new_place'],
    	// 		 'customer' => $request->all()]);

    	// echo json_encode(session('customer'));

    	 return redirect('/receiver/');

    }
    public function updateCompanyList(Request $request){
        if(isset($request->companies)){
            $companies = $request->companies;
            
            //empty company list;
            session()->put('customer.services', array());

            foreach ($companies as $company) {
                session()->push('customer.services', array($company, "0912345678", "person0"));
            }        

            echo json_encode(session('customer')['services']);
        }else{
            echo "No company selected";
        }
    }
}
