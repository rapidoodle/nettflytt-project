<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;

class APIController extends Controller
{
    //
    public function getToken(Request $request){
        // echo json_encode($request->all());

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
        //empty company list;
        // session()->put('customer.services', array());

        if($request->companies){
            $companies = $request->companies;
            $people    = $request->people;


            foreach ($companies as $company) {
                $pip        = explode("|", $people);
                $personList = "person0";

                //get the existing list
                foreach (session('customer')['services'] as $key => $cmp) {
                    if($cmp[0] == $company){
                        $personList = $cmp[2];
                    }        
                }   

                if($pip[0] != 0 || $pip[0] == $company){
                    $personList = $pip[1];
                }

                $newCompanies[] = array($company, "0912345678", $personList);
            }

            session()->put('customer.services', $newCompanies);


            echo json_encode(session('customer')['services']);
        }else{
            echo "No company selected";
        }
    }
}
