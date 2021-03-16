<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;

class APIController extends Controller
{

    public function testAPI(){
        // $token = Helper::getToken();
        // echo session("_tokenTimeout");
        // echo Helper::searchCompanies("norges", "orgnr");
        // session()->forget('customer.isNorges');
        // echo json_encode(session('customer'));
        // $storageToken  = Helper::initStorage($token);
       // echo $token = session('_initToken');
        // echo "<br>";
        echo Helper::getToken();
        // echo $sendOTP = Helper::sendOTP(Helper::getToken(), "92445024", "Flytteregisteret");
        // session()->put("billing_id_strex", $sendOTP);
        //$storageToken = session('customer')['_storageToken'];
        //$token = session('_initToken');
        // echo Helper::updateStorage($token, $storageToken, session('customer'));
        // echo Helper::storageStatus($token, "AByLg4ofukOK0w0T3xeNtnZmTUjhqxZiXcvpOYoKMepRmH749dqK2iEbW3ibKWzZ", "info");
        // echo Helper::tokenDetails("XU1ivp87caQsU6kBNYwNGHYlSct7eI9Pz36UpwIDDmz9n5MoF4qTvjiLPxlmfEqS");
        // echo Helper::tokenDetails("mjwpt0bYSGdrKYlygevWmnn44lbDGJqz02OIEOrHKkSRlACvLSzT245apryFdxWP");
        // "This is a sample message for Norges AS";
        // echo Helper::sendSMS($token, session('customer')['phone'], "Flytteregisteret", $message);
    }

    public function recoverStorage(Request $request){
        $storageToken = $request->token;
        Helper::getStorage(Helper::getToken(), $storageToken);
        // session(['customer'   => $newToken]);
        return redirect('/');
    }

    public function storageStatus(Request $request){
        $type         = $request->type;
        $storageToken = session('_storageToken');
        echo Helper::storageStatus(Helper::getToken(), $storageToken, $type);
    }

    public function getToken(Request $request){
        $people = $request->people;
        $person = explode("---", $people);
        $pctr   = 0;
        $request['first_name'] = Helper::firstName($request['full-name']);
        $request['last_name']  = Helper::lastName($request['full-name']);

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
            }
        }else{
            $request['pb-price'] = 0;
        }
        $request['price']         = 149;
        $request['adv-price']     = session('customer.adv-price') != "" ? session('customer.adv-price') : 0;
        $request['pb-free']       = session('customer.pb-free') != "" ? session('customer.pb-free') : 0;
        $request['mailbox-sign']  = isset($request['mailbox-sign']) ? $request['mailbox-sign'] : 0;
        $request['phone']         = isset($request['phone']) ? substr($request['phone'], -8) : $request['person0']['phone'];
        $request['totalPerson']   = $pctr == 0 ? 1 : $pctr;
        $request['services']      = session('customer.services') != "" ? session('customer.services') : array();
        $request['offers']        = session('customer.offers') != "" ? session('customer.offers') : array();
        $request['postbox']       = session('customer.postbox') != "" ? session('customer.postbox') : array();

        $request['old_post']      = $request['old_zipcode'].' '.$request['old_place'];
        $request['new_post']      = $request['new_zipcode'].' '.$request['new_place'];
        $request['tag']          = "malabon01";
        $request['isNorges']      = session('customer.isNorges') != "" ? session('customer.isNorges') : 0;
        $request['_status']       = session('customer._status') != "" ? session('customer._status') : "in progress";
        $request['_keyLogin']     = session('customer._keyLogin') != "" ? session('customer._keyLogin') : md5($request['full-name']."-".date("Y-m-d h:i:s"));
        
        // or when your server returns json
        // $content = json_decode($response->getBody(), true);

        unset($request['people']);
        unset($request['_token']);
        unset($request['_initToken']);
         // send otp for the first time
        if(!$request->session()->has('billing_id_strex')){
            $tId = Helper::sendOTP(Helper::getToken(), $request['phone'], "Flytteregisteret");
            session()->put("billing_id_strex", $tId);
            $request['billing_id_strex'] = $tId;
        }

        session(['customer' => $request->all()]);

        session(['old_post'          => $request['old_zipcode'].' '.$request['old_place'],
                 'new_post'          => $request['new_zipcode'].' '.$request['new_place'],
                 'billing_id_strex' => session("billing_id_strex"),
                 'customer'          => $request->all()]);

        if(!isset($request['person0'])){
            session()->put("customer.person0.name", $request['full-name']);
            session()->put("customer.person0.bday", $request['birth_year'].'-'.$request['birth_month'].'-'.$request['birth_day']);

            session()->put("customer.person0.last_name", $request['last_name']);
            session()->put("customer.person0.first_name", $request['first_name']);
            session()->put("customer.person0.phone", $request['phone']);
            session()->put("customer.person0.email", $request['email']);
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
                //update storage
                echo Helper::updateStorage(Helper::getToken(), $storageToken, $storage);
            }
        }


        # echo session('customer')['_storageToken'];
        return redirect('/mottakere/');

    }
    public function sendSMS(Request $request){
        $message = $request->type == 1 ? "Hei! Svar Ja på denne sms for å bekrefte strøm fra Norges Energi. Avtalen er Topp 5 garanti. Du får strøm til kun 77,99 øre/kWh! Ingen månedsavgift. Ingen bindingstid og du har 14 dagers angrerett. Se vilkår: norgesenergi.no/stromavtaler/topp-5-garanti/. Vennligst bekreft avtalen med å svare JA på denne meldingen. Mvh Flytteregisteret." : "Hei! Svar Ja på denne sms for å bekrefte strøm fra Norges Energi. Avtalen er Strøm til lavpris. Du får strøm til spotpris! Månedsbeløp 27 kr + 3,49øre/kWh. Ingen bindingstid og du har 14 dagers angrerett. Se vilkår: norgesenergi.no/stromavtaler/strom-til-lavpris/. Vennligst bekreft avtalen med å svare JA på denne meldingen. Mvh Flytteregisteret.";
        
        Helper::sendSMS(Helper::getToken(), session('customer')['phone'], 2099, $message);
    }

    public function confirmOtp(Request $request){
        $otp            = $request->otp;
        $phone          = session('customer')['phone'];
        $transactionId  = session('billing_id_strex');
        
        //check otp
        echo Helper::confirmOtp(Helper::getToken(), session('customer')['phone'], $transactionId, $otp);
    }

    public function getOtpStatus(Request $request){
        $transactionId  = session('billing_id_strex');
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
            Helper::updateStorage(Helper::getToken(), session('_storageToken'), session('customer'));
        }

        echo json_encode(session('customer'));
    }
}
