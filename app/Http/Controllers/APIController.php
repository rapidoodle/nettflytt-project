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
    	$pctr    = 0;
    	$request['first_name'] = Helper::firstName($request['full-name']);
    	$request['last_name']  = Helper::lastName($request['full-name']);
    	foreach ($person as $key => $value) {
    		if($value){
    			$pos 	   = $key;
	    		$record    = explode("|", $value);
	    		$firstName = Helper::firstName($record['0']);
	    		$lastName  = Helper::lastName($record['0']);
	  			$request['person'.$pos] = array("name" => $record[0], "under18" => false, "bday" => $record[3], "last_name" => $lastName, "first_name" => $firstName, "phone" => $record[1], "email" => $record[2]);
	  			$pctr++;
    		}
    	}

    	$request['totalPerson'] = $pctr;
		// or when your server returns json
		// $content = json_decode($response->getBody(), true);

    	unset($request['people']);
    	unset($request['_token']);



    	//customer unique token -- store in session
    	$token = Helper::getToken();

    	//update customer record
    	$update = Helper::updateData($token, $request->all());

    	// echo json_encode($update);

    	session(['_token' 	=> $token, 
    			 'old_post' => $request['old_zipcode'].' '.$request['old_place'],
    			 'new_post' => $request['new_zipcode'].' '.$request['new_place'],
    			 'customer' => $request->all()]);
    	// echo json_encode(session('customer'));

    	 return redirect('/receiver/');

    }
}
