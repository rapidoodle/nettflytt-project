<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Helper;

class StorageUpdateController extends Controller
{
    //
    public function index()
    {
        $norges = DB::table('norgesenergi')->where('created_date', '>=', '2021-04-01 00:00:00')->get();
        return view('storage-update', ['records' => $norges]);
    }
    public function recoverStorage(Request $request){
    	$storageToken = $request->token;
    	$token = Helper::getToken();
    	return Helper::getStorage($token, $storageToken);
    }

    public function search(Request $request){
    	$token 	  = Helper::getToken(); 
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("type" => "AND", "search" => json_encode(["_recordid" => $request['query']])); 
		// $data 	  = array("type" => "AND", "search" => json_encode(["_recordid" => 175719])); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/storage/search";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
		$response  = array();
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);
	    $obj  	  = json_decode($json);

	    $response['searchResult'] = true;
	    $response['result'] 	  = $obj;
        return view('storage-update', ['response' => $response]);
    }

    public function selectUpdate(Request $request){
	    $storageToken = $request->token;
    	$response['error'] 	  = 0;
	    $response['storage']  = Helper::getStorage(Helper::getToken(), $storageToken);
	    session(['new_storage' => $response['storage']]);

        return view('storage-update', ['response' => $response]);
    }

    public function saveStorage(Request $request){
    		$json = json_decode(session("new_storage"));

    		foreach ($request->all() as $key => $value) {
    			if(isset($json->$key) && $key != "_token"){
    					if($json->$key != $value){
    							$json->$key = $value;
    					}
    			}
    		}
    		$response = array("error" => 0, "storage" => json_encode($json));
    		Helper::updateStorage(Helper::getToken(), $json->_token, $json);

    		//save log for backups
    		DB::insert('Insert into logs (action, token, storage) values (?, ?, ?)', ["update", $json->_token, session("new_storage")]);   

    		return view('storage-update', ['response' => $response]);
    }
}
