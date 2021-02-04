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
  //       $user = "u46114";
  //       $pass = "a6b15b2e218e3479ed99b7aaae3b5502";
  //       $data = ["username" => $user, "password" => $pass];
		// $endpoint = "https://api.nettflytt.no/api/nettflytt/2020-10/token/init";
		// $ch   = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $endpoint);
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		// $output = curl_exec($ch);
		// curl_close($ch);
		// $response = json_decode($output);
		// return json_encode($response);
		    $u = "u46114";
		    $p = "a6b15b2e218e3479ed99b7aaae3b5502";
		    $url = "https://api.nettflytt.no/api/nettflytt/2020-10/token/init";
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
		    echo $t = $res['token'];
		    // // Get storage
		    // $url = "https://". $u .":". $t ."@api.nettflytt.no/api/nettflytt/2020-10/storage/".$t."/details";
		    // $c = file_get_contents( $url );
		    // echo 'STORAGE DETAILS: '. $c . PHP_EOL;
		    // $url = "https://". $u .":". $t ."@api.nettflytt.no/api/nettflytt/2020-10/token/". $t ."/details";
		    // $c = file_get_contents( $url );
		    // echo 'TOKEN DETAILS: '. $c . PHP_EOL;
    }

    public static function sendOTP($token,$phone, $sender = "Nettflytt"){
		$endpoint = "https://u46114:".$token."@api/nettflytt/2020-10/billing-otp";
		$ch = curl_init();
		$data = array("msn" => $phone, "sender" => $sender); 
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		curl_close($ch);

		return json_encode([$token, $phone, $sender]);
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