<?php

namespace App\Http\Controllers\mobilenotification;

use Illuminate\Support\Facades\Redirect;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\dbmodel\user;
use Auth;
use Session;

class registernotification extends Controller {

    private $smsLink = "http://59.162.167.52/api/MessageCompose";
    private $smsUser = 'info@meavita.in';
    private $smsPass = 'M3Q8I7C';
    private $smsSender = 'MEAVIT';
    private $smsSendercdma = 'dsouzaronald@gmail.com';
    public $url;
    private $response;
  
    public function __contruct() {

      
        
    }
    
    public function sendMessage($message,$mobile){
           $url =  $this->smsLink.'?admin='.$this->smsSendercdma.'&user='.$this->smsUser.':'.$this->smsPass.'&senderID='.$this->smsSender;
      $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "msgtxt=$message&receipientno=".$mobile."");

try
{
    $response = curl_exec($ch);
    // dd($response);
    if($response===FALSE)
    {
        die("Curl Failed : ".curl_error($ch));
    }
}
catch(exception $ex)
{
    die($ex->getMessage());
}
     
    }
    
  

// private $url = $smsLink."?admin=".$smsSendercdma."&user=".$smsUser."&pass=".$smsPass&".senderID=".$smsSender;
}



