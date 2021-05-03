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
		// $data 	  = array("type" => "OR", "search" => json_encode(["phone" => $request->query])); 
		$data 	  = array("type" => "AND", "search" => json_encode(["_recordid" => 175719])); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/storage/search";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
	    $context  = stream_context_create( $options );
	    echo $json 	  = file_get_contents( $endpoint, FALSE, $context);
		// $response = json_decode($json);

		// return $response;
    }
}
