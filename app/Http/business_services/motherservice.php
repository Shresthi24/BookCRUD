<?php
namespace App\Http\business_services;

use App\Http\business_services\baseservice;
use Illuminate\Support\Facades\Redirect;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\mother;

class motherservice
{
        public  $validator='';
    
    public function FullFormvalidate($motherdata) {
    
        if($motherdata['motherMastermotherDeceased']=='true'){
            
            $rules=array(
                'motherMastermotherFirstName'=>'Required|alpha|min:3|max:15',
                'motherMastermotherLastName'=>'Required|alpha|min:3|max:15',
                'motherMastermotherNationality'=>'required',
                'motherMastermotherNationalityOther'=>'required_if:motherMastermotherNationality,Other',
                'motherMastermotherReligionSerialId'=>'required',
                'motherMasterschoolid'=>'required',
                'motherMasteryearOfCompletion'=>'required',
              
            );
        
            
        }
        else{
             $rules=array(
                 'motherMastermotherFirstName'=>'Required|alpha|min:3|max:15',
                'motherMastermotherLastName'=>'Required|alpha|min:3|max:15',
                'motherMastermotherNationality'=>'required',
                'motherMastermotherNationalityOther'=>'required_if:motherMastermotherNationality,Other',
                'motherMastermotherReligionSerialId'=>'required',              
                 'motherMastermotherAge'=>'numeric|digits:2',
                 'motherMastermotherResidingCountry'=>'Required',
                 'motherMastermotherResidingCountryOther'=>'required_if:motherMastermotherResidingCountry,Other',
                 'motherMobilePrefix'=>'required|numeric|digits_between:2,4',
                 'motherMobile'=>'required|numeric|digits:10',
                 'motherHighestQualificationSerialId'=>'required',
                 'motherMastermotherNameOfInstitute'=>'educheck:motherHighestQualificationSerialId',
                 'motherMasterinstituteCity'=>'educheck:motherHighestQualificationSerialId',
                'motherMasterschoolid'=>'required',
                'motherMasteryearOfCompletion'=>'required',    
                 'motherMasteroccupationSerialId'=>'required',
                 'motherMasterprofessionSerialId'=>'occuptionhomemaker:motherMasteroccupationSerialId',
                 'motherMastermotherEmployerName'=>'occuptionhomemaker:motherMasteroccupationSerialId',
                 'motherMastermotherOfficeAddress'=>'occuptionhomemaker:motherMasteroccupationSerialId',
                 'motherMastermotherMonthlyIncomeSerialId'=>'occuptionhomemaker:motherMasteroccupationSerialId',
                 'aadharCardNumber'=>'required',
                 'motherAddressProofSerialId'=>'required',
                 'identityProofmotherAddressProofSerialId'=>'required',
                   'aadharCardCheck'=>'required_unless:aadharCardNumber,212223242526',
                 'AddressDocCheck'=>'required',
                 'IdentityDocCheck'=>'required',
                 
            );
            
        }
        
        
        $nicenames=array(
            'motherMastermotherFirstName'=>'First Name',
            'motherMastermotherLastName'=>'Last Name',
            'motherMastermotherNationality'=>'Nationality',
            'motherMastermotherNationalityOther'=>'Other Nationality',
            'motherMastermotherReligionSerialId'=>'Religion',
            'motherMasterschoolid'=>'School Name',
            'motherMasteryearOfCompletion'=>'Year Of Completion',
            'motherMastermotherAge'=>'Age',
            'motherMastermotherResidingCountry'=>'Country Of Residence',
            'motherMastermotherResidingCountryOther'=>'Country Of Residence',
            'motherMobilePrefix'=>'Mobile Prefix',
            'motherMobile'=>'Mobile',
            'motherHighestQualificationSerialId'=>'Highest Qualification',
            'motherMastermotherNameOfInstitute'=>'Name of Institute',
            'motherMasterinstituteCity'=>'Institute City',
            'motherMasteroccupationSerialId'=>'Occuption',
            'motherMasterprofessionSerialId'=>'Profession',
            'motherMastermotherEmployerName'=>'Employer\'s Name',
            'motherMastermotherOfficeAddress'=>'Office Address',
            'motherMastermotherMonthlyIncomeSerialId'=>'Annual Income',
            'aadharCardNumber'=>'Aadhar Card Number',
            'motherAddressProofSerialId'=>'Address Proof',
            'identityProofmotherAddressProofSerialId'=>'Identity Proof',
            'IdentityDocCheck'=>'Identity Document',
            'AddressDocCheck'=>'Address Document',
            'aadharCardCheck'=>'Aadhar Card',
        );
        
           $messages=array(
            'occuptionhomemaker'=>'The :attribute is required',
               'educheck'=>'The :attribute is required',
        );
           
           
            Validator::extend('educheck',function($attribute, $value, $params, $validator) {
                          $attributecheck=$attribute;
                        $paramSC1 = array_get($validator->getData(), $params[0]);
                        $valuecheck=$value;
                        if($paramSC1=='87' && $valuecheck==null )
                        {
                            return true;
                        }
                       else if($valuecheck==null && $paramSC1=='86' && $attributecheck=='motherMastermotherNameOfInstitute' )
                       {
                           return true;
                       }
                       else if($valuecheck==null && $paramSC1=='86' && $attributecheck=='motherMasterinstituteCity' )
                       {
                           return true;
                       }
                       else if($valuecheck==null && $paramSC1=='86' && $attributecheck=='motherMasterschoolid' )
                       {
                            return false;
                       }
                        else if($valuecheck==null && $paramSC1=='86' && $attributecheck=='motherMasteryearOfCompletion' )
                       {
                            return false;
                       }
               });
           
           
           
           
                 Validator::extend('occuptionhomemaker',function($attribute, $value, $params, $validator) {
                        $paramSC1 = array_get($validator->getData(), $params[0]);

                     $valuecheck=$value;
           if($paramSC1=='147' && $valuecheck==null )
                        {
                            return true;
                        }
                     
                       else if($valuecheck!=null && $paramSC1!='147' )
                       {
                            return true;
                       }
                       else
                       {
                           return false;
                       }
               });
        
        
        
            $this->validator = Validator::make($motherdata, $rules,$messages,$nicenames);
        
            // get the error messages from the validator
           
        $validationcheck=$this->validator->fails();
          return $validationcheck;
    
        
        
    }
}