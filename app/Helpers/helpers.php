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
		$endpoint = "https://api.nettflytt.no/api/nettflytt/2020-04/storage";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($output);
		return $response->_token;
    }

    public static function updateData($token, $data){
		$endpoint = "https://api.nettflytt.no/api/nettflytt/2020-04/storage/".$token."/update";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($output);

		return $response;
    }
}

?>