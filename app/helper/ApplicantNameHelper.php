<?php
namespace App\helper;

use Auth;
use App\dbmodel\applicant;
use App\User;
class ApplicantNameHelper
{
    
    public function GetApplicantName()
    {
         $applicantFirstName=json_decode(applicant::where('user_userId','=',User::authuserid())->pluck('applicantFirstName'));
         $applicantLastName=json_decode(applicant::where('user_userId','=',User::authuserid())->pluck('applicantFirstName'));
  
         $fullname=$applicantFirstName[0].' '.$applicantLastName[0];
         return $fullname;
    }
    
}