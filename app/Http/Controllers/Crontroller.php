<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Webklex\IMAP\Facades\Client;
use App\Inbox;
use App\Offers;

class Crontroller extends Controller
{
    //
    public function getInbox(){
        $oClient  = Client::account('default');    //Connect to the IMAP Server
        $oClient->connect();

        $aFolder  = $oClient->getFolders();
         // for ($q = 1; $q < 31; $q++) { 
            $aMessage = $aFolder[4]->query()->on(date("d.m.Y"))->get();
            $x        = 0;
            foreach($aMessage as $oMessage){
                $ref = Helper::getRef($oMessage->getSubject());
                if($ref != ""){
                    $i = Inbox::where('ref', '=', $ref)->first();
                        if ($i === null) {
                            $inbox          = new Inbox;
                            $inbox->ref     = str_replace("_", "", trim($ref));
                            $inbox->save();
                        }
                }
            }
         // }
    }

    public function getOffers(){

        $storages = Helper::seachStorageBy(["_created_from" => "2021-06-06 00:00:00", "_created_to" => "2021-06-06 12:59:59" ]);

            if($storages->_status == 0){
                foreach ($storages->sids as $key => $value) {
                    $storage = Helper::getStorage(Helper::getToken(), $value);
                    // echo $storage = Helper::getStorage(Helper::getToken(), "lJ1okHRtLBctJkAWDMIcHcz2nqExd5E3cS0YAaj1QpKckIHBNpA4EU4rMSgbBkNX");
                    $sObj = json_decode($storage);
                        if(isset($sObj->switch_service)){
                            $service  = isset($sObj->switch_service) ? $sObj->switch_service : "";
                            $token    = isset($sObj->_token) ? $sObj->_token : "";
                            $phone    = isset($sObj->phone) ? $sObj->phone : "";
                            $recordid = isset($sObj->_recordid) ? $sObj->_recordid : "";
                            $created  = isset($sObj->_created) ? $sObj->_created : "";
                            if($service){
                            foreach ($service as $key => $value) {
                                    $service = $key == "isStrom" ? "Strom" : ($key == "isTV" ? "TV" : ($key == "isFlyttevask" ? "Flyttevask" : ($key == "isBoligalarm" ? "Boligalarm" : "NULL")));
                                // $i = Offers::where('ref', '=', $ref)->first();
                                // if ($i === null) {
                                //     $inbox          = new Inbox;
                                //     $inbox->ref     = str_replace("_", "", $ref);
                                //     $inbox->save();
                                // }
                                $offer                = new Offers;
                                $offer->service       = $service;
                                $offer->recordid      = $recordid;
                                $offer->phone         = $phone;
                                $offer->storage_token = $token;
                                $offer->created_at    = $created;
                                $offer->save();
                            }

                            }

                    }
                }
            }
        echo json_encode($storages);
    }
    public function getStoragesByDate(){
        $storages = Helper::seachStorageBy(["_created_from" => "2021-06-16 00:00:00", "_created_to" => "2021-06-16 23:59:59" ]);

        if($storages->_status == 0){
            foreach ($storages->sids as $key => $value) {
                $storage = Helper::getStorage(Helper::getToken(), $value);
                $obj = json_decode($storage);
                if($obj->_state == "payment-captured" || $obj->_state == "payment-reserved"){
                    $data[] = [$obj->email, $obj->phone, $obj->first_name, $obj->last_name, "no", $obj->old_zipcode];
                }


                // if(($obj->_state == "payment-captured" || $obj->_state == "payment-reserved") && (isset($obj->billing_id_vipps))){
                //     echo $storage;
                //     echo "<br><br>";
                // }
            }

            echo json_encode($data);
            $headers = ['Email', 'Phone', 'First Name', 'Last Name', 'Country', 'Zip'];

            $file = fopen("../storage/app/public/google_ads.csv", "w");
            foreach($data as $d){
                fputcsv($file, $d);
            }
            fclose($file);
        }
    }

    public function getSalesByCompany(Request $request){
        // $dateFrom = $request->date_from;
        // $dateFrom = $request->date_to;
        // $company  = $request->date_company;
        // $isPaid   = $request->is_paid;
        $storages = Helper::seachStorageBy(["_created_from" => "2021-06-01 00:00:00", "_created_to" => "2021-06-30 23:59:59", "_address_change-companynr" => "982584027"]);

        if($storages->_status == 0){
            $total = 0;
            foreach ($storages->sids as $key => $value) {

                $total++;
            }

            echo $total;
        }
    }

    public function getVippsByDate(){

        $storages = Helper::seachStorageBy(["_created_from" => "2021-06-06 00:00:00", "_created_to" => "2021-06-06 23:59:59" ]);
        $sids = array();

            if($storages->_status == 0){
                foreach ($storages->sids as $key => $value) {
                    $storage = Helper::storageStatus(Helper::getToken(), $value, "payment");
                    $arr     = json_decode($storage, false);
                    $sid     = $value;
                    if(isset($arr->_storage_status_list)){
                        foreach ($arr->_storage_status_list as $key => $value) {
                            if(($value->status == "reserved" || $value->status == "captured") && $value->id == "no.vipps"){
                                if(!in_array($sid, $sids)){
                                    $sids[] = $storage;              
                                }
                            }
                        }
                    }
                }
                if($sids){
                    foreach ($sids as $key => $value) {
                        echo $storage = Helper::getStorage(Helper::getToken(), $value);

                        echo "<br><br>";
                    }
                }
            }

    }
}
