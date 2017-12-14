<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\User;
use File;


use Auth;
use Session;

use Illuminate\Http\Request;

class passwordresetcontroller extends Controller
{
     public function getWelcome() {

        if (auth::guest()) {

            return View::make('auth.login');
        } else {
            return View::make('home');
        }
    }

    public function postAcceptproceed(Request $request) {


        $requireddocdata = $request->all();

        $termcondt = new termsconditionservice;

        $validationcheckfails = $termcondt->RequiredDocumentvalidate($requireddocdata);

            /*select languageid from languagehelptext */
        if ($validationcheckfails == true) {
            /*formid */
            // $userdataform=User::find(Auth::user()->id);
          
            // $userid= substr($userdataform->name,0,3);
            // $mobileno= substr($userdataform->mobile,-3,3);
            // $statename= substr(statemaster::find($requireddocdata['state'])->stateName,0,2);
            // $cityname= substr(citymaster::find($requireddocdata['city'])->cityName,0,2);
      
            // $formid= strtolower($userid.$mobileno.$statename.$cityname);
        
            // //creatingdirectory 
            // $result = File::makeDirectory('formdoc/'.$formid, 0777, true);
      
            
            // $user = new User();
            // $user = User::find(Auth::user()->id); 
            // $user->agreedToTermsOfUse = 1;
            // $user->Cityid()->associate($requireddocdata['city']);
            // $user->Stateid()->associate($requireddocdata['state']);
            // $user->LanguageHelptext()->associate($requireddocdata['lang']);
            // $user->formId=$formid;
            
          
            // $user->save();
     
            return Redirect::route('applicant');
        } else {

                 
           
            $validator = $termcondt->validator;
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    public function getlogout() {

        Auth::logout();
        Session::flush();
        return Redirect::to('/home');
    }

}

}
