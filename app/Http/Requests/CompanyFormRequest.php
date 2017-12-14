<?php

namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
{
   
    public  $validator='';
 
    public function FullFormvalidate($comapnyalldata) {
     // die(var_dump($vendordata));
        
        $rules = array(
            
            
            'Company_Name' => 'Required',
            'Service_Type' => 'Required',
            'Locality' => 'Required',
            'District' => 'Required',
            'Area' => 'Required';
            'State' => 'Required';
        'Country' => 'Required';
        'Pincode' => 'Required';

        $this->validator = Validator::make($Companyalldata);
        
            // get the error messages from the validator
           
        $validationcheck=$this->validator->fails();
        //echo $test;
        return $validationcheck;
  
    }
}
