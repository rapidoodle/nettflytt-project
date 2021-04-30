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
    public function search(Request $request){
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("type" => "OR", "search" => ["phone" => $request->query]); 
		$endpoint = "https://".$u.":".Helper::getToken()."@api.nettflytt.no/api/nettflytt/2020-10/storage/search";
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
