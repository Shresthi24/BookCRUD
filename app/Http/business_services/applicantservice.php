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
use App\Http\business_services\baseservice;
use App\Http\Controllers\father;
class applicantservice extends baseservice {
    
 public  $validator='';
 
    public function FullFormvalidate($applicantdata) {
     // die(var_dump($applicantdata));
        
        $rules = array(
            'applyingToClassserialId' => 'Required',
            'genderSerialId' => 'Required',
            'applicantFirstName' => 'Required|Min:3|Max:15|Alpha',
            'applicantLastName' => 'Required|Min:3|Max:15|Alpha',
            'applicantnationality' => 'Required',
            'applicantnationalityOther' => 'required_if:applicantnationality,Other',
            'applicantcountryBirthcountryId' => 'Required',
            'applicantstateBirthstateId' => 'is_birthindia:applicantcountryBirthcountryId',
            'applicantcityBirthcityId' => 'is_birthindia:applicantcountryBirthcountryId',
            'applicanttelcitycode' => 'digits_between:2,4',
            'applicanttelno' => 'numeric|digits_between:7,10',
            'dtp_input2' => 'Required',
            'applicantpermanentCountrycountryId' => 'Required',
            'applicantpermanentPincode' => 'Required|numeric|digits:6',
            'applicantpermanentBuildingName' => 'Required',
            'applicantpermanentStreetName' => 'Required',
            'applicantaddressradio' => 'Required',
            'applicantcurrentCountrycountryId' => 'required_if:applicantaddressradio,no',
            'applicantcurrentPincode' => 'required_if:applicantaddressradio,no',
            'applicantcurrentBuildingName' => 'required_if:applicantaddressradio,no',
            'applicantcurrentStreetName' => 'required_if:applicantaddressradio,no',
            'applicantreligionserialId' => 'Required',
            'applicantbloodGroupserialId' => 'Required',
            'applicantcasteserialId' => 'Required',
            'applicantlanguageserialId' => 'Required',
            'applicantpermanentStateName' => 'required',
            'applicantpermanentCityName' => 'required',
            'applicantpermanentAreaName' => 'required',
            //  'SecondLanguage'=>'Required',
            // 'ThirdLang'=>'Required',
            'applicanthasSpecialNeeds' => 'Required',
            'applicantspecialNeedsserialId' => 'Required_if:applicanthasSpecialNeeds,true',
            'reservedcategory'=>'required',
            'applicantcasteserialId'=>'required',
            'applicantsubcasteserialId' => 'required',
            
            'applicantclassAttendedid' => 'classselectedover:applyingToClassserialId',
            'applicantschoolAttendedid' => 'classselectedover:applyingToClassserialId',
            'applicantsbirthcertificateCheck' => 'required',
            'applicantaadharNumber' => 'required|numeric|digits:12',
            'applicantAadharCardCheck' => 'required_unless:applicantaadharNumber,212223242526',
            'applicantphotocheck' => 'required',
            'leavingCertificateCheck' => 'classselectedover:applyingToClassserialId',
            'marksheetCheck' => 'classselectedover:applyingToClassserialId',
            'disabilityCertificateCheck' => 'Required_if:applicanthasSpecialNeeds,true',
            'casteCertificateCheck' => 'is_rc:applicantcasteserialId',
            'birthstateother'=>'is_birthother:applicantcountryBirthcountryId',
            'birthcityother'=>'is_birthother:applicantcountryBirthcountryId',
        
    
    );

        $niceNames = array(
    'PermanentPincode' => 'Pincode',
     'PermanentBuilding'=>'Flat No./Building',       
     'PermanentStreetName'=>'Street Address',
     'applicantaddressradio'=>'Same Address',
     'CurrentCountry'=>'Country',
     'CurrentPincode'=>'Pincode',       
     'CurrentBuilding'=>'Flat No./Building',        
     'CurrenSteetAddress'=>'Street Address',  
            'Religion'=>'Religion',
            'BloodGroup'=>'Blood Group',
            'ReservedCategory'=>'Reserved Category',
            'MainLanguage'=>'Main Language',
         //   'SecondLanguage'=>'Secondary language',
          //  'ThirdLang'=>'Third Language',
            'specialneeds'=>'Applicant Special Needs',
            'specialneedselect'=>'Disability',
            'subcaste'=>'Sub-Caste',
            'CurrentlyClass'=>'Currently In Class',
            'LastSchool'=>'Last School',
            'BirthCertificate'=>'Birth Certificate',
            'AadharCardNumber'=>'Aadhar Card Number',
            'AadharCardCheck'=>'Adhar Card ',
            'applicantphoto'=>'Applicant Photo',
            'leavingCertificate'=>'Leaving Certificate',
            'medicalCertificate'=>'Medical Certificate',
            'casteCertificate'=>'Caste Certificate',
            );
        
             Validator::extendImplicit('is_sc', function($attribute, $value, $params, $validator) {
            $paramSC = array_get($validator->getData(), $params[0]);
            if ($value == "" && $paramSC == '46') {
                return false;
            } else {
                return true;
            }
        });


        Validator::extendImplicit('is_rc', function($attribute, $value, $params, $validator) {
            $paramSC1 = array_get($validator->getData(), $params[0]);
            $checkcategory = array('45', '46', '47', '48', '163');


            if ($value !== "" && in_array($paramSC1, $checkcategory)) {
                return true;
            } else if ($value == "") {
                return false;
            }
        });


        Validator::extendImplicit('classselectedover', function($attribute, $value, $params, $validator) {
            $applyingToClassId = array_get($validator->getData(), $params[0]);
            $valuecheck = $value;
            if ($applyingToClassId == '4') {

                return True;
            } else if ($applyingToClassId == '5') {

                return True;
            } else if ($applyingToClassId == '73') {


                return True;
            } else if ($valuecheck == "") {


                return false;
            }
            return true;
        });

/*state city birth validation     */
           Validator::extendImplicit('is_birthother', function($attribute, $value, $params, $validator) {
            $paramSC1 = array_get($validator->getData(), $params[0]);
          


            if ($value == ""  && $paramSC1=='99' ) {
              
                return true;
            }
            else if($value!== ""  && $paramSC1!=='99'){
              
                     return true;
            }
            else  {
                   
                return false;
            }
        });

           Validator::extendImplicit('is_birthindia', function($attribute, $value, $params, $validator) {
            $paramSC1 = array_get($validator->getData(), $params[0]);
          


            if ($value == ""  && $paramSC1=='99' ) {
                return false;
            } else if($value!== ""  && $paramSC1=='99') {
                return true;
            }
        });
 $messages = array(
    'is_sc' => 'The :attribute field is required when Reserved Category Selected',
            'classselectedover' => 'The :attribute is required when Class Applied is over SR KG',
            'is_rc' => 'The :attribute field is required when category is not OPEN',
            'is_birthother'=>'The :attribute field is required',
            'is_birthindia'=>'The :attribute field is required',
       );

        $this->validator = Validator::make($applicantdata, $rules,$messages,$niceNames);
        
            // get the error messages from the validator
           
        $validationcheck=$this->validator->fails();
        //echo $test;
        return $validationcheck;
  
    }

}
