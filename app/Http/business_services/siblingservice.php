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
use App\Http\Repository\SiblingRepository;

class siblingservice extends baseservice
{
      public  $validator='';
    
      
      public function rules($siblingdata)
      {
           $rules = [];
           if($siblingdata['applicantbrotherCount']!=null){
           for($i=1;$i<=$siblingdata['applicantbrotherCount'];$i++){
                $rules['firstnamebrother'.$i]='required|alpha|min:3|max:15';
                $rules['lastnamebrother'.$i] ='required|alpha|min:3|max:15';
                 $rules['agebrother'.$i]='required|numeric|digits:2';
                 $rules['brotherschool'.$i]='required';
                 $rules['brotherclass'.$i]='required';
                 $rules['brotherdiv'.$i]='required';       
                  $rules['brotherroll'.$i]='required|numeric';       
           }
           }
           
            if($siblingdata['applicantsisterCount']!=null){
             for($i=1;$i<=$siblingdata['applicantbrotherCount'];$i++){
                  $rules['firstnamesister'.$i]='required|alpha|min:3|max:15';
                  $rules['lastnamesister'.$i]='required|alpha|min:3|max:15';
                  $rules['agesister'.$i]='required|numeric|digits:2';        
                  $rules['sisterschool'.$i]='required';
                   $rules['sisterclass'.$i]=  'required';     
                    $rules['sisterdiv'.$i]= 'required';     
                     $rules['sisterroll'.$i]= 'required|numeric';     
                         
             }
            }
           return $rules;
           
      }
      
      
public function attributes(){
        return [
            'firstnamebrother1'=>'First Name',
            'lastnamebrother1'=>'Last Name',
            'agebrother1'=>'age',
            'brotherdiv1'=>'Division',
             'firstnamebrother2'=>'First Name',
            'lastnamebrother2'=>'Last Name',
            'agebrother2'=>'age',
            'brotherdiv2'=>'Division',
            'firstnamebrother3'=>'First Name',
            'lastnamebrother3'=>'Last Name',
            'agebrother3'=>'age',
            'brotherdiv3'=>'Division',
            'firstnamesister1'=>'First Name',
            'lastnamesister1'=>'Last Name',
            'agesister1'=>'Age',
            'sisterdiv1'=>'Division',
            'sisterroll1'=>'Roll No'
        ];
    }
      
       
      
      
    public function FullFormvalidate($siblingdata) {
        
        
              $this->validator = Validator::make($siblingdata,$this->rules($siblingdata),[],$this->attributes($siblingdata));
        
            // get the error messages from the validator
           
        $validationcheck=$this->validator->fails();
          return $validationcheck;
        
        
    }


    public function InsertService($siblingdata,$applicantid)
    {
       $sibdata =new SiblingRepository();
        $sibdata->InsertData($siblingdata, $applicantid);
         return;
    }

    
    public function UpdateService($siblingdata,$applicantid)
    {
          $sibdata =new SiblingRepository();
          $sibdata->UpdateData($siblingdata, $applicantid);
        return;
    }
    
    
}
