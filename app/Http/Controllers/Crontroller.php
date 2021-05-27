<?php

namespace App\Http\Controllers;
ini_set('MAX_EXECUTION_TIME', '-1');
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
        $aMessage = $aFolder[4]->messages()->all()->get();
        $x 		  = 0;

    //     foreach($aMessage as $oMessage){
    //     	$ref = Helper::getRef($oMessage->getSubject());
    //     	if($ref != ""){
				// $i = Inbox::where('ref', '=', $ref)->first();
				// 	if ($i === null) {
				//         $inbox 			= new Inbox;
				//         $inbox->ref 	= str_replce("_", "", $ref);
				//         $inbox->save();
				// 	}
    //     	}
    //     }
    }
}
