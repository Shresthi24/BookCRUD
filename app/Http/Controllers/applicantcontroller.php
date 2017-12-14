<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\business_services\applicantservice;
use App\vendor;
use App\User;
use App\countrymaster;
use App\statemaster;
use App\citymaster;
use App\areamaster;

class applicantcontroller extends Controller {

public function postAcceptproceed(Request $request) {


$vendordata = $request->all();

$applicantservice = new applicantservice();

$validationcheckfails = $applicantservice->FullFormvalidate($applicantdata);


if ($validationcheckfails == false) {

$validator = $applicantservice->validator;

return Redirect::route('applicant')->withInput()->withErrors($validator);
} else { 
    return Redirect::route('father');
     //id retervial for current address
      if($applicantdata['applicantaddressradio']=='no')
     {
         $currentstateid= json_decode(statemaster::where(['stateName','=',$applicantdata['applicantcurrentStateName']])->pluck('stateId'));
         $currentcityid= json_decode(citymaster::where(['cityName','=',$applicantdata['cityName']])->pluck('cityId'));
         $currentareaid= json_decode(areamaster::where(['areaName','=',$applicantdata['applicantcurrentAreaName']])->pluck('areaId'));
     }
     $permanentstateid= json_decode(statemaster::where('stateName','=',2000)->pluck('stateId'));
     $permanentcity=json_decode(citymaster::where('cityName','=',$applicantdata['applicantpermanentCityName'])->pluck('cityId'));
     $permanentareaid=json_decode(areamaster::where('areaName','=',$applicantdata['applicantpermanentAreaName'])->pluck('areaId'));
    
     $applicantid=json_decode(applicant::where('user_userId','=',User::authuserid())->pluck('applicantId'));
      $birthstate= statemaster::where('stateId','=',$applicantdata['applicantstateBirthstateId'])->pluck('stateName');
       $birthcity= citymaster::where('cityId','=',$applicantdata['applicantcityBirthcityId'])->pluck('cityName');   
    //new applicant
       
 if ((!applicant::where('user_userId', '=', Auth::user()->id)->count())) {

  
   
     //filling data for database
                $applicant=new applicant();    
                $applicant->applicantMiddleName = $applicantdata['applicantMiddleName'];
                $applicant->applicantLastName = $applicantdata['applicantLastName'];
                $applicant->applicantFirstName = $applicantdata['applicantFirstName'];
                $applicant->thirdlanguage_serialId = $applicantdata['applicantthirdlanguageserialId'];
                $applicant->telprefix = 91;
                $applicant->telno = $applicantdata['applicanttelno'];
                $applicant->telcitycode = $applicantdata['applicanttelcitycode'];
                $applicant->streetName =($applicantdata['applicantcurrentStreetName']==null)?null:$applicantdata['applicantcurrentStreetName'];
                $applicant->stateBirth_stateId = $applicantdata['applicantstateBirthstateId'];
                $applicant->state_stateId = (empty($currentstateid)==true)?null:$currentstateid[0];
                //  $applicant->stage=$applicantdata[''];
                $applicant->specialNeeds_serialId = ($applicantdata['applicantspecialNeedsserialId']==null)?null:$applicantdata['applicantspecialNeedsserialId'];
                //$applicant->sisterCount=$applicantdata[''];
                //$applicant->siblingCount=$applicantdata[''];
                $applicant->secondlanguage_serialId = ($applicantdata['applicantsecondlanguageserialId']==null)?null:$applicantdata['applicantsecondlanguageserialId'];
                $applicant->schoolAttended_id = $applicantdata['applicantschoolAttendedid'];
                $applicant->samePermanentAddress = ($applicantdata['applicantaddressradio']=='no')?0:1;
                $applicant->religion_serialId = $applicantdata['applicantreligionserialId'];
                 $applicant->birthStateName=$birthstate[0];
                $applicant->birthCityName=$birthcity[0];      
                $applicant->pincode =($applicantdata['applicantcurrentPincode']==null)?null:$applicantdata['applicantcurrentPincode'];
                $applicant->permanentStreetName = $applicantdata['applicantpermanentStreetName'];
                $applicant->permanentState_stateId =(empty($permanentstateid)==true)?null:$permanentstateid[0];
                $applicant->permanentPincode = $applicantdata['applicantpermanentPincode'];
                //  $applicant->permanentOutsideLocalityName=$applicantdata[''];
                // $applicant->permanentOtherStateName=$applicantdata[''];
                //  $applicant->permanentOtherLocalityName=$applicantdata[''];
                // $applicant->permanentOtherCityName=$applicantdata[''];
                // $applicant->permanentOtherAreaName=$applicantdata[''];
                //  $applicant->permanentLocality_localityId=$applicantdata[''];
                $applicant->permanentCountry_countryId = ($applicantdata['applicantpermanentCountrycountryId']==null)?null:$applicantdata['applicantpermanentCountrycountryId'];
                $applicant->permanentCity_cityId = (empty($permanentcity)==true)?null:$permanentcity[0];
                $applicant->permanentBuildingName = $applicantdata['applicantpermanentBuildingName'];
                $applicant->permanentArea_areaId = (empty($permanentareaid)==true)?null:$permanentareaid[0];
                // $applicant->otherSchoolAttended=$applicantdata[''];
                //    $applicant->OtherAreaName=$applicantdata[''];
                //  $applicant->OtherAreaLocalityName=$applicantdata[''];
                // $applicant->medicalPath=$applicantdata[''];
                // $applicant->marksheet_imageId=$applicantdata[''];      
                // $applicant->locality_localityId = $applicantdata[''];
                //$applicant->leavingCertificate_imageId=$applicantdata[''];            
                $applicant->lastClassPassed_serialId = ($applicantdata['applicantclassAttendedid']==null)?null:$applicantdata['applicantclassAttendedid'];
                $applicant->language_serialId = $applicantdata['applicantlanguageserialId'];
                 $applicant->secondlanguage_serialId=($applicantdata['applicantlanguageserialId']==null)?null:$applicantdata['applicantlanguageserialId'];
                 $applicant->thirdlanguage_serialId=($applicantdata['applicantlanguageserialId']==null)?null:$applicantdata['applicantlanguageserialId'];
                $applicant->hasSpecialNeeds = ($applicantdata['applicanthasSpecialNeeds']=='true')?1:0;
                //$applicant->hasSiblings=$applicantdata[''];
                $applicant->gender_serialId = $applicantdata['genderSerialId'];
                //  $applicant->familyPhoto_imageId=$applicantdata[''];
                //    $applicant->disabilityCertificate_imageId = $applicantdata[''];
                $applicant->dateOfBirth = $applicantdata['applicantdateofbirthready'];
                // $applicant->currentOtherLocalityName=$applicantdata[''];
                //  $applicant->currentOtherAreaName=$applicantdata[''];
                //  $applicant->currentOtherAreaLocalityName=$applicantdata[''];
                $applicant->countryBirth_countryId = $applicantdata['applicantcountryBirthcountryId'];
                $applicant->country_countryId =($applicantdata['applicantcurrentCountrycountryId']==null)?null:$applicantdata['applicantcurrentCountrycountryId'];
                //  $applicant->community=$applicantdata[''];
                $applicant->cityBirth_cityId = $applicantdata['applicantcityBirthcityId'];
                $applicant->city_cityId = (empty($currentcityid)==true)?null:$currentcityid[0];
                //   $applicant->childAadharCard_imageId=$applicantdata[''];
                //  $applicant->castePath=$applicantdata[''];
                //    $applicant->casteCertificate_imageId=$applicantdata[''];
                $applicant->caste_serialId = $applicantdata['applicantcasteserialId'];
                $applicant->buildingName = ($applicantdata['applicantcurrentBuildingName']==null)?null:$applicantdata['applicantcurrentBuildingName'];
                //   $applicant->brotherCount=$applicantdata[''];
                $applicant->bloodGroup_serialId = $applicantdata['applicantbloodGroupserialId'];
                //   $applicant->birthStateName = $applicantdata[''];
                //   $applicant->birthCityName = $applicantdata[''];
                // $applicant->baptismCertificate_imageId = $applicantdata[''];
                $applicant->area_areaId = (empty($currentareaid)==true)?null:$currentareaid[0];
                $applicant->applyingToClass_serialId = ($applicantdata['applyingToClassserialId']==null)?null:$applicantdata['applyingToClassserialId'];
                //    $applicant->applicantPhoto_imageId = $applicantdata[''];
                // $applicant->applicantFamilyPhoto_imageId=
                // $applicant->academicYearApplying_serialId=
                // $applicant->aadharNumber=
                $applicant->subcaste = ($applicantdata['applicantsubcasteserialId']==null)?null:$applicantdata['applicantsubcasteserialId'];   
               $applicant->userid()->associate(User::authuserid());
                $applicant->save();
$lastinsertid=\Response::json(array('success' => true, 'last_insert_id' => $applicant->applicantId), 200)->getData()->last_insert_id;

return Redirect::route('father');

} else {

$applicant = applicant::find($applicantid[0]);
    $applicant->applicantMiddleName = $applicantdata['applicantMiddleName'];
                $applicant->applicantMiddleName = $applicantdata['applicantMiddleName'];
                $applicant->applicantLastName = $applicantdata['applicantLastName'];
                $applicant->applicantFirstName = $applicantdata['applicantFirstName'];
                $applicant->thirdlanguage_serialId = $applicantdata['applicantthirdlanguageserialId'];
                $applicant->telprefix = 91;
                $applicant->telno = $applicantdata['applicanttelno'];
                $applicant->telcitycode = $applicantdata['applicanttelcitycode'];
                $applicant->streetName =($applicantdata['applicantcurrentStreetName']==null)?null:$applicantdata['applicantcurrentStreetName'];
                $applicant->stateBirth_stateId = $applicantdata['applicantstateBirthstateId'];
                $applicant->state_stateId = (empty($currentstateid)==true)?null:$currentstateid[0];
                $applicant->birthStateName=$birthstate[0];
                $applicant->birthCityName=$birthcity[0];       
                $applicant->specialNeeds_serialId = ($applicantdata['applicantspecialNeedsserialId']==null)?null:$applicantdata['applicantspecialNeedsserialId'];
               
                $applicant->secondlanguage_serialId = ($applicantdata['applicantsecondlanguageserialId']==null)?null:$applicantdata['applicantsecondlanguageserialId'];
                $applicant->schoolAttended_id = $applicantdata['applicantschoolAttendedid'];
                $applicant->samePermanentAddress = ($applicantdata['applicantaddressradio']=='no')?0:1;
                $applicant->religion_serialId = $applicantdata['applicantreligionserialId'];
           
                $applicant->pincode =($applicantdata['applicantcurrentPincode']==null)?null:$applicantdata['applicantcurrentPincode'];
                $applicant->permanentStreetName = $applicantdata['applicantpermanentStreetName'];
                $applicant->permanentState_stateId =(empty($permanentstateid)==true)?null:$permanentstateid[0];
                $applicant->permanentPincode = $applicantdata['applicantpermanentPincode'];
                //  $applicant->permanentOutsideLocalityName=$applicantdata[''];
                // $applicant->permanentOtherStateName=$applicantdata[''];
                //  $applicant->permanentOtherLocalityName=$applicantdata[''];
                // $applicant->permanentOtherCityName=$applicantdata[''];
                 // $applicant->permanentOtherAreaName=$applicantdata[''];
                //  $applicant->permanentLocality_localityId=$applicantdata[''];
                $applicant->permanentCountry_countryId = ($applicantdata['applicantpermanentCountrycountryId']==null)?null:$applicantdata['applicantpermanentCountrycountryId'];
                $applicant->permanentCity_cityId = (empty($permanentcity)==true)?null:$permanentcity[0];
                $applicant->permanentBuildingName = $applicantdata['applicantpermanentBuildingName'];
                $applicant->permanentArea_areaId = (empty($permanentareaid)==true)?null:$permanentareaid[0];
                // $applicant->otherSchoolAttended=$applicantdata[''];
                //    $applicant->OtherAreaName=$applicantdata[''];
                //  $applicant->OtherAreaLocalityName=$applicantdata[''];
                // $applicant->medicalPath=$applicantdata[''];
                // $applicant->marksheet_imageId=$applicantdata[''];      
                // $applicant->locality_localityId = $applicantdata[''];
                //$applicant->leavingCertificate_imageId=$applicantdata[''];            
                $applicant->lastClassPassed_serialId = ($applicantdata['applicantclassAttendedid']==null)?null:$applicantdata['applicantclassAttendedid'];
                $applicant->language_serialId = $applicantdata['applicantlanguageserialId'];
                 $applicant->secondlanguage_serialId=($applicantdata['applicantlanguageserialId']==null)?null:$applicantdata['applicantlanguageserialId'];
                 $applicant->thirdlanguage_serialId=($applicantdata['applicantlanguageserialId']==null)?null:$applicantdata['applicantlanguageserialId'];
                $applicant->hasSpecialNeeds = ($applicantdata['applicanthasSpecialNeeds']=='true')?1:0;
                //$applicant->hasSiblings=$applicantdata[''];
                $applicant->gender_serialId = $applicantdata['genderSerialId'];
                //  $applicant->familyPhoto_imageId=$applicantdata[''];
                //    $applicant->disabilityCertificate_imageId = $applicantdata[''];
                $applicant->dateOfBirth = $applicantdata['applicantdateofbirthready'];
                // $applicant->currentOtherLocalityName=$applicantdata[''];
                //  $applicant->currentOtherAreaName=$applicantdata[''];
                //  $applicant->currentOtherAreaLocalityName=$applicantdata[''];
                $applicant->countryBirth_countryId = $applicantdata['applicantcountryBirthcountryId'];
                $applicant->country_countryId =($applicantdata['applicantcurrentCountrycountryId']==null)?null:$applicantdata['applicantcurrentCountrycountryId'];
                //  $applicant->community=$applicantdata[''];
                $applicant->cityBirth_cityId = $applicantdata['applicantcityBirthcityId'];
                $applicant->city_cityId = (empty($currentcityid)==true)?null:$currentcityid[0];
                //   $applicant->childAadharCard_imageId=$applicantdata[''];
                //  $applicant->castePath=$applicantdata[''];
                //    $applicant->casteCertificate_imageId=$applicantdata[''];
                $applicant->caste_serialId = $applicantdata['applicantcasteserialId'];
                $applicant->buildingName = ($applicantdata['applicantcurrentBuildingName']==null)?null:$applicantdata['applicantcurrentBuildingName'];
                //   $applicant->brotherCount=$applicantdata[''];
                $applicant->bloodGroup_serialId = $applicantdata['applicantbloodGroupserialId'];
                //   $applicant->birthStateName = $applicantdata[''];
                //   $applicant->birthCityName = $applicantdata[''];
                // $applicant->baptismCertificate_imageId = $applicantdata[''];
                $applicant->area_areaId = (empty($currentareaid)==true)?null:$currentareaid[0];
                $applicant->applyingToClass_serialId = ($applicantdata['applyingToClassserialId']==null)?null:$applicantdata['applyingToClassserialId'];
                //    $applicant->applicantPhoto_imageId = $applicantdata[''];
                // $applicant->applicantFamilyPhoto_imageId=
                // $applicant->academicYearApplying_serialId=
                // $applicant->aadharNumber=
                $applicant->subcaste = ($applicantdata['applicantsubcasteserialId']==null)?null:$applicantdata['applicantsubcasteserialId'];   
                $applicant->save();

$applicant->userid()->associate(User::authuserid());
$applicant->save();

return Redirect::route('father');

}
}
}
}


