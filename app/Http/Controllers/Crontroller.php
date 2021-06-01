<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Webklex\IMAP\Facades\Client;
use App\Inbox;

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
                            $inbox->ref     = str_replace("_", "", $ref);
                            $inbox->save();
                        }
                }
            }
         // }
    }
}
