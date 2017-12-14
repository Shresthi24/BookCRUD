<?php

namespace App\Http\Requests;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Http\FormRequest;

class PersonalFormRequest extends FormRequest
{
     //public  $validator='';
 
    //public function FullFormvalidate(\Request $vendordata ) {
     // die(var_dump($vendordata));
       // dd($vendordata->all());

public function authorize()
{
  return false;
}

    public function rules()
{
  return [
       // $rules = array(
            
            
            'vendor_1st_Name' => 'Required|Min:3|Max:15|Alpha',
            'vendor_Last_Name' => 'Required|Min:3|Max:15|Alpha',
            'Email' => 'Required|email',
            'web_url' => 'Required',
            'con_num_1' => 'Required|Min:10|Max:10',
            ];
            
        //dd($vendordata->all());

        //$this->validator = Validator::make($vendordata);
        
            // get the error messages from the validator
           
        //$validationcheck=$this->validator->fails();
        //echo $test;
        //return $validationcheck;
  
    }
}
