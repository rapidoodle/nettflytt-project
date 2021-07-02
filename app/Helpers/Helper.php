<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\SMS;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Conversion;
class Helper
{

    public static function saveSale($provider = "strex"){

    	//save conversion;
    	Conversion::where("ip", "=", Helper::getIp())->update(["sale" => 1, "token" => session('customer._storageToken')]);

        return DB::insert('Insert into sales (storage_token, name, phone_number, email, total_price, is_postbox, is_advertise, provider) values (?, ?, ?, ?, ?, ?, ?, ?)', [session('customer._storageToken'), session('customer.full-name'), session('customer.phone'), session('customer.email'), session('customer.total_price'), session('customer.mailbox-sign'), session('customer.isAdv'), $provider]);   
    }

    public static function addOffer($offer){
    	$birthday = session('customer')['birth_year'].'-'.session('customer')['birth_month'].'-'.session('customer')['birth_day'];

		// $file = fopen("../public/files/".$offer.".csv", "a");
		// $d = array(session('customer')['_recordid'], session('customer')['full-name'], session('customer')['email'], session('customer')['phone'], session('customer')['new_address'].' '.session('customer')['new_place'].' '.session('customer')['new_post'], session('customer')['new_house_type'], $birthday, session('customer')['moving_date'], session('customer')['_created']);
		// fputcsv($file, $d);
		// fclose($file);

        return DB::insert('Insert into offers (storage_token, service, recordid, phone, name, email, new_address, birthday, moving_date, created) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [session('customer._storageToken'), $offer, session('customer')['_recordid'], session('customer')['phone'], session('customer')['full-name'], session('customer')['email'], session('customer')['new_address'].' '.session('customer')['new_place'], $birthday, session('customer')['moving_date'], session('customer')['_created']]);  
    }

	public static function firstName(string $string){
		return implode(' ', array_slice(explode(' ', $string), 0, -1));
    }

    public static function lastName(string $string){
       return array_slice(explode(' ', $string), -1)[0];
    }
    
    public static function under18(string $birthday){
	    if(is_string($birthday)) {
	        $birthday = strtotime($birthday);
	    }

	    if(time() - $birthday < 18 * 31536000)  {
	        return false;
	    }

	    return true;
	}

    public static function digits2($num){
       return $num_padded = sprintf("%02d", $num);
    }

    public static function getToken(){
    	$dateNow = date("Y-m-d H:i:s");

    	if(session("_accessToken") !== null && session("_tokenTimeout") != null && session("_tokenTimeout") >= $dateNow){
    		return session("_accessToken");
    	}else{
		    $u 	  = "u46114-";
		    $p 	  = "a6b15b2e218e3479ed99b7aaae3b5502";
		    $url  = "https://api.nettflytt.no/api/nettflytt/2020-10/token/init";
		    $vars = [
		        "username" => $u,
		        "password" => $p,
		    ];
		    $postdata = http_build_query( $vars );
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output  = curl_exec($ch);
			$res 	 		= json_decode($server_output, true);
			curl_close ($ch);

		    session()->put("_accessToken", $res["token"]);
		    session()->put("_sessionSalt", $res["session_salt"]);
		    session()->put("_tokenTimeout", date("Y-m-d H:i:s", strtotime($res['_created']) + 60 * 30));

		    return $res['token'];
    	}
    }

    public static function tokenDetails($token){
		    $u 	  	  = "u46114".session("_sessionSalt");
		    $newToken = Helper::getToken();
		    echo $url 	  = "https://".$u.":".$newToken."@api.nettflytt.no/api/nettflytt/2020-10/token/".$token."/details";
		    $json 	  = file_get_contents( $url, FALSE);
			$res 	  = json_decode( $json, true );
			
			return json_encode($res);
    }


    public static function initStorage($token){
		    $u 	  	  = "u46114-".session("_sessionSalt");
		    $p 	  = "a6b15b2e218e3479ed99b7aaae3b5502";
		    $url = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/storage/init";
		    $vars = [
		        "username" => $u,
		        "password" => $p,
		    ];
		    $postdata = http_build_query( $vars );
		    $options = [ 'http' => [
		        'method' => "POST",
		        'header' => "Content-type: application/x-www-form-urlencoded",
		        'content' => $postdata
		    ]];
		    $context = stream_context_create( $options );
		    $json = file_get_contents( $url, FALSE, $context );
		    $res = json_decode( $json, true );

		    return $t = $res['_token'];
    }

   	public static function getStorage($token, $storageToken){
		$u 	  	  = "u46114-".session("_sessionSalt");

	    // Get storage
	    $url = "https://". $u .":". $token ."@api.nettflytt.no/api/nettflytt/2020-10/storage/".$storageToken."/details";
		    $json = file_get_contents( $url, FALSE);
		    $res = json_decode( $json, true );

		    return $json;
   	}

   	public static function storageStatus($token, $storageToken, $type){
		$u 	  = "u46114-".session("_sessionSalt");
	    $url  = "https://". $u .":". $token ."@api.nettflytt.no/api/nettflytt/2020-10/storage-status/".$storageToken."/details/".$type;
	    $json = file_get_contents( $url, FALSE);

	    return $json;
   	}

    public static function updateStorage($token, $storageToken, $data){
		    $u 	  	  = "u46114-".session("_sessionSalt");
		    $p 	  = "a6b15b2e218e3479ed99b7aaae3b5502";
		    $url  = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/storage/".$storageToken."/update";
		    $vars = [
		        "storage" => json_encode($data),
		    ];
		    $postdata = http_build_query( $vars );
		    $options = [ 'http' => [
		        'method' => "POST",
		        'header' => "Content-type: application/x-www-form-urlencoded",
		        'content' => $postdata
		    ]];

		    $context = stream_context_create( $options );
		    $json = file_get_contents( $url, FALSE, $context );
		    $res = json_decode( $json, true );

		    return $json;
    }
	public static function sendVipps($token, $phone){
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("msn" => "+47".$phone); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/billing-vipps";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);
		$response = json_decode($json);

	    return json_encode($response);

	}
    public static function sendOTP($token, $phone, $sender = "Flyttereg"){
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("msn" => "+47".$phone, "sender" => $sender); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/billing-otp";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);
		$response = json_decode($json);
		Log::info("billing-otp response: ".$json);
		session()->put("billing_id_strex", $response->transactionid);
	    return $response->transactionid;
    }
    public static function login($token, $phone, $password){
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("msn" => "+47".$phone, "password" => $password); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/login";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);
		$response = json_decode($json);

	    return $json;
    }

    public static function sendSMS($token, $phone, $sender = 2099, $message){
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("msn" => "+47".$phone, "sender" => $sender, "message" => $message); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/sms-message";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);
		$response = json_decode($json);

	    return $json;
    }

    public static function sendPowerSMS($token, $phone, $sender = 2099, $message, $type = "power", $storageToken){
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("msn" => "+47".$phone, "message" => $message, "type" => $type, "storageid" => $storageToken, "hid" => 132); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/sms-confirmation/request";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);
		$response = json_decode($json);

	    return $json;
    }

    public static function confirmOtp($token, $phone, $transactionid, $otp, $totalPrice){
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("msn" => "+47".$phone, "transactionid" => $transactionid, "otp" => $otp, "price" => $totalPrice, "sender" => "Flyttereg"); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/billing-otp";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);
		$response = json_decode($json);

	    // return json_encode([$token, $phone, $transactionid, $otp]);
	    return $json;
    }

    public static function getOtpStatus($token, $transactionid){
		$u 	  	  = "u46114-".session("_sessionSalt");
		$data 	  = array("transactionid" => $transactionid); 
		$endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/billing-otp";
	    $postdata = http_build_query( $data );
	    $options  = [ 'http' => [
					        'method' => "POST",
					        'header' => "Content-type: application/x-www-form-urlencoded",
					        'content' => $postdata]
					  ];
	    $context  = stream_context_create( $options );
	    $json 	  = file_get_contents( $endpoint, FALSE, $context);

	    return $json;
    }

    public static function updateData($token, $data){
		$endpoint = "https://api.nettflytt.no/api/nettflytt/2020-04/storage/".$token."/update";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$output = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($output);

		return $response;
    }


    public static function getRecordId($token){
		$endpoint = "https://api.nettflytt.no/api/nettflytt/2020-04/storage/".$token."/details";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		$output = curl_exec($ch);
		curl_close($ch);
		echo $output;
		$response = json_decode($output);
		session()->put("customer._created", $response->_created);
		
		return $response->_recordid;
    }

    public static function getSearchToken(){
	        $user = "guest-".session('_sessionSalt');
	        $pass = "guest";
			$endpoint = "https://api.nettflytt.no/api/nettflytt/2020-10/token/init";
	        $creds = array( "username" => $user, "password" => $pass);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $endpoint);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $creds);
			$output = curl_exec($ch);
			curl_close($ch);
			$response = json_decode($output, false);
			$token = $response->token;
			session(['searchToken' => $token]);

			return $token;
    }
    public static function searchLocation($keyword){
        $file = fopen(storage_path("geo/no.txt"), "r");
        $isHere = false;
        $matched = "";
        $response = array();
        while(!feof($file)) {
            $line = fgets($file);
            $arr = explode("\t", $line);

            if(isset($arr[1])){
                if($keyword == $arr[1]){
                	$matched = $arr[2];
                	$isHere = true;
                	break;
                }
            }

        }

        fclose($file);
    
        if($isHere){
        	$response['error'] = 0;
        	$response['result'] = $matched;
        }else{
        	$response['error'] = 1;
        	$response['result'] = "Not found";
        }

        return $response;
    }

    public static function searchCompanies($query, $type){
      
    	if(session('searchToken')){
    		$token = session('searchToken');
    	}else{
		    $u 	  = "guest-";
		    $p 	  = "guest";
		    $url  = "https://api.nettflytt.no/api/nettflytt/2020-10/token/init";
		    $vars = [
		        "username" => $u,
		        "password" => $p,
		    ];
		    $postdata = http_build_query( $vars );
		    $options  = [ 'http' => [
		        'method'  => "POST",
		        'header'  => "Content-type: application/x-www-form-urlencoded",
		        'content' => $postdata
		    ]];
		    $context = stream_context_create( $options );
		    $json 	 = file_get_contents( $url, FALSE, $context );
		    $res 	 = json_decode($json, true);
			$token 	 = $res['token'];
			$salt 	 = $res['session_salt'];
			session(['searchToken' => $token]);
			session(['searchSalt' => $salt]);
    	}

	        $postvars   = ["q" => $query];
	        $url 		= "https://guest-".session('searchSalt').":".session('searchToken')."@api.nettflytt.no/api/nettflytt/2020-10/".$type;
			$ch 		= curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
			$output 	= curl_exec($ch);
			curl_close($ch);

			//put to session for future search
			if($type == "categories"){
	            session()->put('allcompanies', $output);
			}

			return $output;
    }

    public static function getRef($string){
    	$start  = "(Ref:";
    	$end    = ")";
	    $string = ' ' . $string;
	    $ini 	= strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;

	    return substr($string, $ini, $len);
	}

	public static function seachStorageBy($query){
        $token    = Helper::getToken(); 
        $u        = "u46114-".session("_sessionSalt");
        $data     = array("type" => "AND", "search" => json_encode($query)); 
        // $data      = array("type" => "AND", "search" => json_encode(["_recordid" => 175719])); 
        $endpoint = "https://".$u.":".$token."@api.nettflytt.no/api/nettflytt/2020-10/storage/search";
        $postdata = http_build_query( $data );
        $options  = [ 'http' => [
                    'method' => "POST",
                    'header' => "Content-type: application/x-www-form-urlencoded",
                    'content' => $postdata]
              ];
        $response  = array();
        $context  = stream_context_create( $options );
        $json     = file_get_contents( $endpoint, FALSE, $context);
        $obj      = json_decode($json);


        return $obj;
    }


    public static function checkCompanyStatus($date, $token){

    }

    public static function getSMS($type){
    	$obj = SMS::where("type", "=", $type)->first();

    	return $obj->text;
    	// return $obj[->text];
    }

    public static function getIp(){
	    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
	        if (array_key_exists($key, $_SERVER) === true){
	            foreach (explode(',', $_SERVER[$key]) as $ip){
	                $ip = trim($ip); // just to be safe
	                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
	                    return $ip;
	                }
	            }
	        }
	    }
	    return request()->ip(); // it will return server ip when no client ip found
	}

    public static function saveVisitor(){
    	//check if unique
    	$ip    = Helper::getIp();
    	$check = Conversion::where("ip", "=", $ip)->first();

    	if($check == null){
			$conv 		= new Conversion;
			$conv->ip 	= $ip;
			$conv->sale = 0;
			$conv->save();    		
    	}

    }
}


?>