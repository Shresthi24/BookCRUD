<?php
namespace App\Http\business_services;

use App\Http\business_services\baseservice;
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
use App\Http\Controllers\FatherController;

class fatherservice extends baseservice
{
    
    public  $validator='';
    
    public function FullFormvalidate($fatherdata) {
        
           
        If ($fatherdata['fatherDeceased'] == 'true') {
            $rules = array(
                'fatherFirstName' => 'Required|alpha|min:3|max:15',
                'fatherLastName' => 'Required|alpha|min:3|max:15',
                'fatherMasterfatherReligionserialId'=>'Required',
                'fatherNationality'=>'Required',
                'fatherMasterfatherNationalityOther'=>'required_if:fatherNationality,Other',
                'fatherMasterfatherReligionserialId'=>'required',
                'graduationYear'=>'required',
                'fatherMasterschoolid'=>'required',
               
                
            );
        } else {
            
             $rules = array(
                'fatherFirstName' => 'Required|alpha|min:3|max:12',
                'fatherLastName' => 'Required|alpha|min:3|max:12',
                'fatherMasterfatherReligionserialId'=>'Required',
                'fatherNationality'=>'Required',
                'fatherMasterfatherNationalityOther'=>'required_if:fatherNationality,Other',
                'fatherMasterfatherReligionserialId'=>'required',
                'graduationYear'=>'educheck:fatherMasterfatherHighestQualificationserialId',
                'fatherMasterschoolid'=>'educheck:fatherMasterfatherHighestQualificationserialId',
                 'fatherAge'=>'required|numeric|digits:2',
                 'fatherMasterfatherResidingCountry'=>'Required|alpha',
                  'fatherMasterfatherResidingCountryOther'=>'required_if:fatherMasterfatherResidingCountry,Other',
                 'fatherMasterfatherEmail'=>'email',
                  'fatherMasterfatherMobilePrefix'=>'required|numeric|digits_between:2,4',
                  'fatherMasterfatherMobile'=>'required|digits:10',
                 'fatherMasterfatherHighestQualificationserialId'=>'required',
                  'fatherMasterfatherNameOfInstitute'=>'educheck:fatherMasterfatherHighestQualificationserialId',
                'fatherMasterinstituteCity'=>'educheck:fatherMasterfatherHighestQualificationserialId',
                 'fatherMasteroccupationserialId'=>'required',
                    'fatherMasterprofessionserialId'=>'occuptionhomemaker:fatherMasteroccupationserialId',
                 'fatherMasterfatherEmployerName'=>'occuptionhomemaker:fatherMasteroccupationserialId',
                 'fatherMasterfatherOfficeAddress'=>'occuptionhomemaker:fatherMasteroccupationserialId',
                 'fatherMasterfatherMonthlyIncomeserialId'=>'occuptionhomemaker:fatherMasteroccupationserialId',
                 'fatherMasteraadharCardNumber'=>'required',
                 'aadharCardCheck'=>'required_unless:fatherMasteraadharCardNumber,212223242526',
                 'fatherMasterdocumentsserialId'=>'required',
                 'fatherMasteridentityProofserialId'=>'required',
                 'AddressDocCheck'=>'required',
                 'IdentityDocCheck'=>'required',
                 );
         
        }

        $nicenames=array(
          'fatherFirstName'=>'First Name',
           'fatherLastName' =>'Last Name',
            'fatherMasterfatherReligionserialId'=>'Religion',
            'fatherNationality'=>'Nationality',
            'fatherMasterfatherNationalityOther'=>'Other Nationality',
            'fatherMasterfatherReligionserialId'=>'Religion',
            'graduationYear'=>'Year of Completion',
            'fatherMasterschoolid'=>'Completed Standard 10 from',       
            'fatherAge'=>'Age',
            'fatherMasterfatherResidingCountry'=>'Residing Country',
           'fatherMasterfatherResidingCountryOther'=>'Country Of Residence',
            'fatherMasterfatherEmail'=>'Email',
            'fatherMasterfatherMobilePrefix'=>'Mobile Prefix',
             'fatherMasterfatherMobile'=>'Mobile Number',
            'fatherMasterfatherHighestQualificationserialId'=>'Highest Qualification',
            'fatherMasterfatherNameOfInstitute'=>'Name Of Institute',
            'fatherMasterinstituteCity'=>'Institute City',
            'fatherMasteroccupationserialId'=>'Occuption',
            'fatherMasterprofessionserialId'=>'Profession',
            'fatherMasterfatherEmployerName'=>'Business/Employer\'s Name',
            'fatherMasterfatherOfficeAddress'=>'Father Office Address',
            'fatherMasterfatherMonthlyIncomeserialId'=>'Annual Income',
            'fatherMasterdocumentsserialId'=>'Address Proof',
            'fatherMasteridentityProofserialId'=>'Identity Proof',
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
                       else if($valuecheck==null && $paramSC1=='86' && $attributecheck=='fatherMasterfatherNameOfInstitute' )
                       {
                           return true;
                       }
                       else if($valuecheck==null && $paramSC1=='86' && $attributecheck=='fatherMasterinstituteCity' )
                       {
                           return true;
                       }
                       else if($valuecheck==null && $paramSC1=='86' && $attributecheck=='motherMasterschoolid' )
                       {
                            return false;
                       }
                        else if($valuecheck==null && $paramSC1=='86' && $attributecheck=='fatherMasterschoolid' )
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
        
        $this->validator = Validator::make($fatherdata, $rules,$messages,$nicenames);
        
            // get the error messages from the validator
           
        $validationcheck=$this->validator->fails();
        //echo $test;
        return $validationcheck;
  
    }

    
    
    
}