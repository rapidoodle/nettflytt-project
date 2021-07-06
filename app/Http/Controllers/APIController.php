<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Webklex\IMAP\Facades\Client;

class APIController extends Controller
{

    public function testAPI(){
        // echo Helper::getToken();
        // echo "<br>";
        // echo Helper::initStorage(Helper::getToken());
            // $query = "norges";
            // echo Helper::searchCompanies($query, "$request->cat");
        // $oClient = Client::account('default');    //Connect to the IMAP Server
        // $oClient->connect();
        // // $oClient = Client::account('default');
        // // $oClient->connect();
        // // //Connect to the IMAP Server
        // // //Get all Mailboxes
        // // /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        // $aFolder = $oClient->getFolders();
        // // //Loop through every Mailbox
        // // /** @var \Webklex\IMAP\Folder $oFolder */
        // foreach($aFolder as $oFolder){
        //     //Get all Messages of the current Mailbox $oFolder
        //     /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
        //     $aMessage = $oFolder->messages()->all()->get();
            
        //     /** @var \Webklex\IMAP\Message $oMessage */
        //     foreach($aMessage as $oMessage){
        //         echo  Helper::getRef($oMessage->getSubject());
        //         echo "<br>";
        //         // echo 'Attachments: '.$oMessage->getAttachments()->count().'<br />';
        //         // echo $oMessage->getHTMLBody(true);
        //     }
        // }
           // echo $list =  Helper::storageStatus(Helper::getToken(), "mWyG79kTUYOL60u2kJZ5MlxMcore7SzmE3VJJH1bzU2xuxAVbelOCepWQjf06wBe", "info");

        // $file     = fopen(storage_path("app/public/tokens.txt"), "r");
        // $isHere   = false;
        // $matched  = "";
        // $response = array();
        // while(!feof($file)) {
        //     $line = fgets($file);
        //     $arr  = explode("\t", $line);
        //     $list = Helper::getStorage(Helper::getToken(), $line);
        //     $json = json_decode($list);

        //     DB::insert('Insert into norgesenergi (storage_token, name, phone_number, email, created_date) values (?, ?, ?, ?, ?)', [$line, $json->first_name.' '.$json->last_name, $json->phone, $json->email, $json->_created]);   
        // }

        // fclose($file);
        // echo Helper::storageStatus(Helper::getToken(), "C6p2iecDzIuA1kSDwImwGS6KCRHZoZKqxV2RwlZFfkvGcyEdFN6KnMvJTwBRipRv", "service");        
        // echo "<br>---------------<br>";
        // echo Helper::storageStatus(Helper::getToken(), "GFiKg29uB8Y95peHOqQdKmflQBIVkH06z1cORURLaQCmP9LfZYVti93kcqO3VK8r", "info");

        // echo Helper::getStorage(Helper::getToken(), "ErVSR3P5Z65XoQ6bUWJEIFujqttgFtS5kXuHbONxdnaw3KAZKaoWNL19UpckLTAj");
        // echo Helper::getRecordId("mWyG79kTUYOL60u2kJZ5MlxMcore7SzmE3VJJH1bzU2xuxAVbelOCepWQjf06wBe");
        // $headers = ['First Name', 'Last Name', 'Email', 'Phone'];

        // $file = fopen("../storage/app/public/Strom.csv", "a");
        // foreach($data as $d){
        //     fputcsv($file, $d);
        // }
        // fclose($file);
        // echo json_encode(Helper::searchLocation("1461"));
        // Log::info("TEST API");
        // return redirect()->route('/betaling/92445024', ['error' => "Din betaling var avvist eller avbrutt. Venligst prøv igjen."]);
        // echo Helper::getStorage(Helper::getToken(), "JGWAn4mCgmyDFWalhakAHRWxrLavgoaeaq3VMY3pqgT1lJ0ZiCMOcsHla5cESkzm");
        // $token = Helper::getToken();
        // echo session("_tokenTimeout");
        // echo Helper::searchCompanies("norges", "orgnr");
        // session()->forget('customer.isNorges');
        // echo json_encode(session('customer'));
        // $storageToken  = Helper::initStorage($token);
       // echo $token = session('_initToken');
        // echo "<br>";
        // echo Helper::getToken();
        // echo $sendOTP = Helper::sendOTP(Helper::getToken(), "92445024", "Flytteregisteret");
        // session()->put("billing_id_strex", $sendOTP);
        //$storageToken = session('customer')['_storageToken'];
        //$token = session('_initToken');
        // echo Helper::updateStorage($token, $storageToken, session('customer'));
        // echo Helper::storageStatus(Helper::getToken(), "6jHeiGjv1j4qxaSGq4WBAjxpfpE9R9NcC9xCv7McEOBmLUe3DQ7RgLNAB3LdHruv", "payment");
        // echo Helper::tokenDetails("XU1ivp87caQsU6kBNYwNGHYlSct7eI9Pz36UpwIDDmz9n5MoF4qTvjiLPxlmfEqS");
        // echo Helper::tokenDetails("mjwpt0bYSGdrKYlygevWmnn44lbDGJqz02OIEOrHKkSRlACvLSzT245apryFdxWP");
        // "This is a sample message for Norges AS";
        // echo Helper::sendSMS($token, session('customer')['phone'], "Flytteregisteret", $message);
    }


    public function searchLocation(Request $request){
        $keyword  = $request->keyword;
        echo json_encode(Helper::searchLocation($keyword ));
    }

    public function recoverStorage(Request $request){
        $storageToken = $request->token;
        return Helper::getStorage(Helper::getToken(), $storageToken);
    }

    public function storageStatus(Request $request){
        $type         = $request->type;
        $storageToken = session('_storageToken');
        echo Helper::storageStatus(Helper::getToken(), $storageToken, $type);
    }

    public function getToken(Request $request){
        $isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL) == $email ? true : false;
        if(($request['full-name'] === null && $request['people'] === null) || !$isValidEmail){

        Log::error("Invalid Form: ".json_encode($request->all()));
            return redirect('/');
        }

        Log::info("Request: ".json_encode($request->all()));
        $people = $request->people;
        $person = explode("---", $people);
        $pctr   = 0;
        $request['first_name'] = Helper::firstName($request['full-name']);
        $request['last_name']  = Helper::lastName($request['full-name']);
        $names = array();

        foreach ($person as $key => $value) {
            if($value){
                $pos       = $key;
                $record    = explode("|", $value);
                $firstName = Helper::firstName($record['0']);
                $lastName  = Helper::lastName($record['0']);
                if($firstName != "" && $lastName != "" && $record[1] != "" && $record[2] != ""){
                    $request['person'.$pos] = array("name" => $record[0], "bday" => $record[3], "last_name" => $lastName, "first_name" => $firstName, "phone" => $record[1], "email" => $record[2]);
                    $pctr++;
                }

                $names[] = $record[0];
            }
        }



        if(isset($request['person0'])){
            $bdayArr = explode("-", $request['person0']['bday']);
            $request['full-name']   = $request['person0']['name'];
            $request['first_name']  = $request['person0']['first_name'];
            $request['last_name']   = $request['person0']['last_name'];
            $request['email']       = $request['person0']['email'];
            $request['phone']       = $request['person0']['phone'];
            $request['birth_day']   = $bdayArr[2];
            $request['birth_month'] = $bdayArr[1];
            $request['birth_year']  = $bdayArr[0];
        }

        if(isset($request['mailbox-sign']) && $request['mailbox-sign'] == 1){
            if(session('customer.pb-free') != "" && session('customer.pb-price') == 149){
                $request['pb-price'] = 149;
            }elseif(session('customer.pb-free') != "" && session('customer.pb-free') == 1){
                $request['pb-price'] = 0;
            }else{
                $request['pb-price'] = 169;
            }
        }else{
            $request['pb-price']  = 0;
        }

        $request['ip_address']     = session('customer.ip_address') != "" ? session('customer.ip_address') : Helper::getIp();
        $request['power-type']     = session('customer.power-type') != "" ? session('customer.power-type') : 0;
        $request['tracking_gclid'] = session('customer.tracking_gclid') != "" ? session('customer.tracking_gclid') : $request['tracking_gclid'];
        $request['adv-price']      = session('customer.adv-price') != "" ? session('customer.adv-price') : 0;
        $request['isAdv']          = session('customer.isAdv') != "" ? session('customer.isAdv') : 0;
        $request['price']          = 149;
        $request['basis']          = 149;
        $request['total_price']    = 149 + $request['pb-price'] + $request['adv-price'];
        $request['pb-free']        = session('customer.pb-free') != "" ? session('customer.pb-free') : 0;
        $request['mailbox-sign']   = isset($request['mailbox-sign']) ? $request['mailbox-sign'] : 0;
        $request['phone']          = isset($request['phone']) ? substr($request['phone'], -8) : $request['person0']['phone'];
        $request['totalPerson']    = $pctr == 0 ? 1 : $pctr;
        $request['services']       = session('customer.services') != "" ? session('customer.services') : array();
        $request['switch_service'] = session('customer.switch_service') != "" ? session('customer.switch_service') : array();
        $request['postbox']        = session('customer.postbox') != "" ? session('customer.postbox') : array();
        $request['old_post']       = $request['old_zipcode'].' '.$request['old_place'];
        $request['new_post']       = $request['new_zipcode'].' '.$request['new_place'];
        $request['tag']            = "malabon01";
        $request['isNorges']       = session('customer.isNorges') != "" ? session('customer.isNorges') : 0;
        $request['_status']        = session('customer._status') != "" ? session('customer._status') : "in progress";
        $request['_storageToken']  = session('customer._storageToken') != "" ? session('customer._storageToken') : "";
        $request['_keyLogin']      = session('customer._keyLogin') != "" ? session('customer._keyLogin') : substr(time(), -5);
        $request['pb-names']       = session('customer.pb-names') != "" ? session('customer.pb-names') : $names;
        $request['is-subscribe']   = session('customer.is-subscribe') != "" ? session('customer.is-subscribe') : false;
        $request["vipps-result"]   = session('customer.vipps-result') != "" ? session('customer.vipps-result') : [];
        $request['isLogged']       = session('customer.isLogged') != "" ? session('customer.isLogged') : false;
        $request['moving_date']    = session('customer.moving_date_year') != "" ? session('customer.moving_date_year') : $request['moving_date_year']."-".$request['moving_date_month']."-".$request['moving_date_day'];
        $request['sign_send_to_address'] = $request['sign_send_to_address'] != "" ? session('sign_send_to_address') : "";

        unset($request['people']);
        unset($request['_token']);
        unset($request['_initToken']);
         // send otp for the first time
        if(!$request->session()->has('billing_id_strex')){
            $tId = Helper::sendOTP(Helper::getToken(), $request['phone'], "Flyttereg");
            // session()->put("billing_id_strex", $tId);
            $request['billing_id_strex'] = $tId;
            Log::info("Send OTP result: " . session("billing_id_strex"));

        }

        session(['customer' => $request->all()]);

        session(['old_post'          => $request['old_zipcode'].' '.$request['old_place'],
                 'new_post'          => $request['new_zipcode'].' '.$request['new_place'],
                 'customer'          => $request->all()]);

        if(!isset($request['person0'])){
            session()->put("customer.person0.name", $request['full-name']);
            session()->put("customer.person0.bday", $request['birth_year'].'-'.$request['birth_month'].'-'.$request['birth_day']);

            session()->put("customer.person0.last_name", $request['last_name']);
            session()->put("customer.person0.first_name", $request['first_name']);
            session()->put("customer.person0.phone", $request['phone']);
            session()->put("customer.person0.email", $request['email']);

            session()->put("customer.pb-names", array($request['full-name']));
        }

        //mailbox sign pricing
        if(session('customer.pb-price') != "" && session('customer.pb-price') == 169){
            session()->put('customer.sign_mailbox-a', 0);
            session()->put('customer.sign_mailbox-c', 0);
            session()->put("customer.sign_mailbox-b", $names);
        }elseif(session('customer.pb-price') != "" && session('customer.pb-price') == 149){
            session()->put('customer.sign_mailbox-a', 0);
            session()->put('customer.sign_mailbox-b', 0);
            session()->put("customer.sign_mailbox-c", $names);
        }elseif(session('customer.pb-price') != "" && session('customer.pb-price') == 0){
            session()->put('customer.sign_mailbox-b', 0);
            session()->put('customer.sign_mailbox-c', 0);
            session()->put("customer.sign_mailbox-a", $names);
        }else{
            session()->forget('customer.sign_mailbox-a');
            session()->forget('customer.sign_mailbox-b');
            session()->forget('customer.sign_mailbox-c');                
        }


        if(!$request->session()->has('customer.mailbox-sign')){
            session()->forget('customer.sign_mailbox-a');
            session()->forget('customer.sign_mailbox-b');
            session()->forget('customer.sign_mailbox-c');

        }
        //save to storage
        $storage = session('customer');

        if($request->session()->has('_storageToken')){
            //update storage
            Helper::updateStorage(Helper::getToken(), session('_storageToken'), $storage);
        }else{
            //new storage 
            $storageToken  = Helper::initStorage(Helper::getToken());

            if($storageToken){
                session()->put("_storageToken", $storageToken);
                session()->put("customer._storageToken", $storageToken);
                session()->put("customer._recordid", Helper::getRecordId($storageToken));

                //update storage
                Helper::updateStorage(Helper::getToken(), $storageToken, $storage);
            }
        }


        # echo session('customer')['_storageToken'];
        // Log::info("Saving storage update: ".json_encode(session('customer')));
        return redirect('/mottakere/');

    }

    public function initTokens(){
        if(!$request->session()->has('_storageToken')){
            $storageToken  = Helper::initStorage(Helper::getToken());
            session()->put("_storageToken", $storageToken);
            session()->put("customer._storageToken", $storageToken);
        }
    }

    public function sendSMS(Request $request){
        $message = Helper::getSMS($request->type);

        echo Helper::sendPowerSMS(Helper::getToken(), session('customer')['phone'], 2099, $message, "power", session('customer._storageToken'));

        //set power type to storage
        session()->put("customer.power-type", $request->type);

        //save power subsction customer
        DB::insert('Insert into norgesenergi (storage_token, name, phone_number, email, type) values (?, ?, ?, ?, ?)', [session('customer._storageToken'),session('customer.full-name'), session('customer.phone'), session('customer.email'), $request->type]);   
    }

    public function confirmOtp(Request $request){
        $otp            = $request->otp;
        $phone          = session('customer')['phone'];
        $transactionId  = str_replace("#", "", session('billing_id_strex'));
        
        //check otp
        Log::info("Confirm otp request: ".json_encode(array(session('customer')['phone'], $transactionId, $otp, session('customer')['total_price'])));
        echo $result = Helper::confirmOtp(Helper::getToken(), session('customer')['phone'], $transactionId, $otp, session('customer')['total_price']);
        Log::info("Confirm otp result: ".$result);
    }

    public function getOtpStatus(Request $request){
        $transactionId  = session('customer')['billing_id_strex'];
        //check otp
        echo Helper::getOtpStatus(Helper::getToken(), $transactionId);
    }

    public function updateCompanyList(Request $request){
        //empty company list;
        session()->put('customer.services', $request->services);
        echo json_encode(session('customer.services'));
        Helper::updateStorage(Helper::getToken(), session('_storageToken'), session('customer'));
    }

    public function searchCompany(Request $request){
        if($request->cat == "categories" && session('allcompanies')){
            $query = $request['query'];

            $filteredItems = array_values(array_filter(json_decode(session('allcompanies')), function($elem) use($query){
                return strtolower($elem->category) == strtolower($query);
            }));

            echo json_encode($filteredItems);

        }else{
            echo Helper::searchCompanies($request['query'], $request->cat);
        }
    }

    public function updateCustomerData(Request $request){
        foreach ($request->fields as $key => $value) {
            $newKey = substr($key, 0, 6) == "person" ? str_replace("-", ".", $key) : $key;
            $sessionKey = 'customer.'.$newKey;
            session()->put($sessionKey, $value);
            $names = is_array(session('customer')['pb-names']) ? session('customer')['pb-names'] : explode(",", session('customer')['pb-names']);

            //mailbox sign pricing
            if(session('customer.pb-price') != "" && session('customer.pb-price') == 169){
                session()->put('customer.sign_mailbox-a', 0);
                session()->put('customer.sign_mailbox-c', 0);
                session()->put("customer.sign_mailbox-b", $names);
            }elseif(session('customer.pb-price') != "" && session('customer.pb-price') == 149){
                session()->put('customer.sign_mailbox-a', 0);
                session()->put('customer.sign_mailbox-b', 0);
                session()->put("customer.sign_mailbox-c", $names);
            }elseif(session('customer.pb-price') != "" && session('customer.pb-price') == 0){
                session()->put('customer.sign_mailbox-b', 0);
                session()->put('customer.sign_mailbox-c', 0);
                session()->put("customer.sign_mailbox-a", $names);
            }else{
                session()->forget('customer.sign_mailbox-a');
                session()->forget('customer.sign_mailbox-b');
                session()->forget('customer.sign_mailbox-c');                
            }

            //no ads pricing
            if(session('customer.isAdv') != "" && session('customer.isAdv') == 1){
                session()->put("customer.sign_noads-a", true);
            }else{
                session()->forget("customer.sign_noads-a");
            }
        }

        Helper::updateStorage(Helper::getToken(), session('_storageToken'), session('customer'));
        echo json_encode(session('customer'));
    }


    //saving sales
    public function saveSale(Request $request){
        $provider = $request->type;
        Helper::saveSale($provider); 
    }
    public function addOffer(Request $request){
        $offer = $request->offer;
        $type  = $request->type;
        Helper::addOffer($offer); 
        session()->put("customer.switch_service.".$type, 1);
        Helper::updateStorage(Helper::getToken(), session('_storageToken'), session('customer'));
        echo json_encode(session('customer'));

    }
    public function checkPb(Request $request){
        $names = is_array(session('customer')['pb-names']) ? session('customer')['pb-names'] : explode(",", session('customer')['pb-names']);

        if(session('customer.pb-price') != "" && session('customer.pb-price') == 0){
            session()->put('customer.sign_mailbox-b', 0);
            session()->put('customer.sign_mailbox-c', 0);
            session()->put("customer.sign_mailbox-a", $names);
            echo "sign_mailbox-a";
        }elseif(session('customer.pb-price') != "" && session('customer.pb-price') == 149){
            session()->put('customer.sign_mailbox-a', 0);
            session()->put('customer.sign_mailbox-b', 0);
            session()->put("customer.sign_mailbox-c", $names);
            echo "sign_mailbox-c";
        }elseif(session('customer.pb-price') != "" && session('customer.pb-price') == 169){
            session()->put('customer.sign_mailbox-a', 0);
            session()->put('customer.sign_mailbox-c', 0);
            session()->put("customer.sign_mailbox-b", $names);
            echo "sign_mailbox-b";
        }else{
            session()->forget('customer.sign_mailbox-a');
            session()->forget('customer.sign_mailbox-b');
            session()->forget('customer.sign_mailbox-c');    
            echo "nothing";            
        }
    }
}
