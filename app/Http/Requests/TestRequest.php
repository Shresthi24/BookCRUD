<?php
namespace app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
class TestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $siblingdata=Input::all();
     $rules = [];
     if($siblingdata['applicantbrotherCount']!=null)
             for($i=1;$i<=$siblingdata['applicantbrotherCount'];$i++){
                $rules['firstnamebrother'.$i]='required|alpha|min:3|max:15';
                $rules['lastnamebrother'.$i] ='required|alpha|min:3|max:15';
                 $rules['agebrother'.$i]='required|numeric|digits:2';
                 $rules['brotherschool'.$i]='required';
                 $rules['brotherclass'.$i]='required';
                 $rules['brotherdiv'.$i]='required';       
                  $rules['brotherroll'.$i]='required|numeric';       
           }
           
           if($siblingdata['applicantsisterCount']!=null){
                for($i=1;$i<=$siblingdata['applicantsisterCount'];$i++){
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
            'agebrother1'=>'Age',
            'brotherdiv1'=>'Division',
            'brotherschool1'=>'School',
            'brotherclass1'=>'Class', 
             'firstnamebrother2'=>'First Name',
            'lastnamebrother2'=>'Last Name',
            'agebrother2'=>'Age',
            'brotherdiv2'=>'Division',
            'brotherschool2'=>'School',
            'brotherclass2'=>'Class', 
            'firstnamebrother3'=>'First Name',
            'lastnamebrother3'=>'Last Name',
            'agebrother3'=>'Age',
            'brotherdiv3'=>'Division',
             'brotherschool2'=>'School',
            'brotherclass2'=>'Class', 
            'firstnamesister1'=>'First Name',
            'lastnamesister1'=>'Last Name',
            'agesister1'=>'Age',
            'sisterschool1'=>'School',
            'sisterclass1'=>'Class',
            'sisterdiv1'=>'Division',
            'sisterroll1'=>'Roll No',
            'sisterschool1'=>'School',
            'sisterclass1'=>'Class',
            'firstnamesister2'=>'First Name',
            'lastnamesister2'=>'Last Name',
            'agesister2'=>'Age',
            'sisterschool2'=>'School',
            'sisterclass2'=>'Class',
            'sisterdiv2'=>'Division',
            'sisterroll2'=>'Roll No',
            'sisterschool2'=>'School',
            'sisterclass2'=>'Class',
            'firstnamesister3'=>'First Name',
            'lastnamesister3'=>'Last Name',
            'agesister3'=>'Age',
            'sisterschool3'=>'School',
            'sisterclass3'=>'Class',
            'sisterdiv3'=>'Division',
            'sisterroll3'=>'Roll No',
            'sisterschool3'=>'School',
            'sisterclass3'=>'Class',
            'brotherroll1'=>'Roll No',
            'brotherroll2'=>'Roll No',
            'brotherroll3'=>'Roll No',
        ];
    }
    
    
}
