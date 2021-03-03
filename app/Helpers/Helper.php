<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
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
  //   	$dateNow = date("Y-m-d H:i:s");
		// session()->put("_tokenTimeout", "2021-03-03 07:41:07");
  //   	if(session("_accessToken") !== null && session("_tokenTimeout") != null && session("_tokenTimeout") >= $dateNow){
  //   		return session("_accessToken");
  //   	}else{
		    $u 	  = "u46114";
		    $p 	  = "a6b15b2e218e3479ed99b7aaae3b5502";
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

		    session()->put("_accessToken", $res["token"]);
		    session()->put("_tokenTimeout", date("Y-m-d H:i:s", strtotime($res['_created']) + 60 * 30));

		    return $res['token'];
    // 	}
    }

    public static function tokenDetails($token){
		    $u 	  	  = "u46114";
		    $newToken = Helper::getToken();
		    $url 	  = "https://".$u.":".$newToken."@api.nettflytt.no/api/nettflytt/2020-10/token/".$token."/details";
		    $json 	  = file_get_contents( $url, FALSE);
			$res 	  = json_decode( $json, true );
			
			return json_encode($res);
    }


    public static function initStorage($token){
		    $u 	  = "u46114";
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
		$u 	  = "u46114";

	    // Get storage
	    $url = "https://". $u .":". $token ."@api.nettflytt.no/api/nettflytt/2020-10/storage/".$storageToken."/details";
		    $json = file_get_contents( $url, FALSE);
		    $res = json_decode( $json, true );

		    return $json;
   	}

   	public static function storageStatus($token, $storageToken, $type = "payment"){
		$u 	  = "u46114";
	    $url  = "https://". $u .":". $token ."@api.nettflytt.no/api/nettflytt/2020-10/storage-status/".$storageToken."/details/".$type;
	    $json = file_get_contents( $url, FALSE);

	    return $json;
   	}

    public static function updateStorage($token, $storageToken, $data){
    	echo "token: ".$token;
		    $u 	  = "u46114";
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

    public static function sendOTP($token, $phone, $sender = "Nettflytt"){
		$u 	  	  = "u46114";
		echo $token;
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

	    return $response->transactionid;
    }

    public static function sendSMS($token, $phone, $sender = 2099, $message){
		$u 	  	  = "u46114";
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

    public static function confirmOtp($token, $phone, $transactionid, $otp){
		$u 	  	  = "u46114";
		$data 	  = array("msn" => "+47".$phone, "transactionid" => $transactionid, "otp" => $otp); 
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
		$u 	  	  = "u46114";
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


    public static function getData($token){
		$endpoint = "https://api.nettflytt.no/api/nettflytt/2020-04/storage/".$token."/details";
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

    public static function getSearchToken(){
	        $user = "guest";
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

    public static function searchCompanies($query, $type){
      
    	if(session('searchToken')){
    		$token = session('searchToken');
    	}else{
	        $user = "guest";
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
    	}

        $postvars   = ["q" => $query];
        $url 		= "https://guest:".$token."@api.nettflytt.no/api/nettflytt/2020-10/".$type;
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
}

?>