<?php
namespace App\Http\business_services;

use Illuminate\Support\Facades\Redirect;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\dbmodel\user;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class termsconditionservice extends baseservice {

    public $validator = '';

    public function RequiredDocumentvalidate($requireddocdata) {

        $rules = array(
            'state' => 'Required',
            'city' => 'Required',
            'lang' => 'Required'
        );


        $this->validator = Validator::make($requireddocdata, $rules);


        // get the error messages from the validator

        $validationcheck = $this->validator->fails();
        //echo $test;
        return $validationcheck;
    }

}
