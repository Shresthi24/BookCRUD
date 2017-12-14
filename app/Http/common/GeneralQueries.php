<?php
namespace App\Http\common;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use App\dbmodel\subcategory;
use Illuminate\Http\Request;
use App\dbmodel\areamaster;
use App\dbmodel\schoolmaster;
use App\dbmodel\statemaster;
use App\dbmodel\citymaster;
use App\dbmodel\system;
use App\dbmodel\countrymaster;
use App\dbmodel\languagetext;
use App\User;


class GeneralQueries {

    public $helplanguageselected = '';
    public $helplanguagedefault = '';
    public $countryname = '';
    public $statename = '';
    public $class = '';
    public $gender = '';
    public $language = '';
    public $religion = '';
    public $caste = '';
    public $bloodgroup = '';
    public $disability = '';
    public $schoolname = '';
    public $HigheshtQualificationFather='';
    public $OccuptionFather='';
    public $ProfessionFather='';
    public $AnnucalIncomeFather='';
    public $schoolmasteralldata='';
    public $formid='';
     public $HigheshtQualificationMother='';
    public $OccuptionMother='';
    public $ProfessionMother='';
    public $AnnucalIncomeMother='';
    public $IdentityProof='';
    public $AddressProof='';
    
    public function PrefilledDataHelptext() {

        $authuserid = User::find(Auth::user()->id)->first(['id', 'helpLanguage_serialId']);

        $serialid = json_decode(system::where('serialId', '=', $authuserid->helpLanguage_serialId)->get());
        $id = $serialid[0]->serialId;

        /* selected help text */
  
             
             $this->helplanguageselected = json_decode(languagetext::where('language_serialId', '=', $id)->get());
            
       
        /* english DEFAULT help texT */
        
        $this->helplanguagedefault = json_decode(languagetext::where('language_serialId', '=', 15)->get());



        /* below are for the data from queries to be filled in fields */
        $this->countryname = countrymaster::orderByRaw("FIELD(countryName,'India')Desc")->orderBy('countryName', 'ASC')->pluck('countryName', 'countryId');
        $this->statename = statemaster::all()->pluck('stateName', 'stateId');
        $this->class = system::where([['systemType', '=', 7], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->gender = system::where([['systemType', '=', 3], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->language = system::where([['systemType', '=', 1], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->religion = system::where([['systemType', '=', 0], ['status', '=', 1]])->orderByRaw("FIELD(value,'Other')ASC")->orderBy('value', 'ASC')->pluck('value', 'serialId');
        $this->caste = system::where([['systemType', '=', 8], ['status', '=', 1]])->orderByRaw("FIELD(value,'O.B.C')DESC")->orderBy('value', 'ASC')->pluck('value', 'serialId');
        $this->bloodgroup = system::where([['systemType', '=', 2], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->disability = system::where([['systemType', '=', 10], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->schoolname = schoolmaster::where('status', '=', 1)->pluck('schoolName', 'id');
        $this->formid= User::find(Auth::user()->id)->formId;
        
          $this->IdentityProof = system::where([['systemType', '=', 13], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->AddressProof = system::where([['systemType', '=', 12], ['status', '=', 1]])->pluck('value', 'serialId');
        }

    
    
    public function PrefilledDataFather()
    {
         $this->schoolmasteralldata = schoolmaster::all();
        $this->HigheshtQualificationFather=system::where([['systemType', '=', 18], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->OccuptionFather=system::where([['systemType', '=', 21], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->ProfessionFather=system::where([['systemType', '=', 27], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->AnnucalIncomeFather=system::where([['systemType', '=', 5], ['status', '=', 1]])->pluck('value', 'serialId');
        
        
    }
    
        public function PrefilledDataMother()
    {
         $this->schoolmasteralldata = schoolmaster::all();
        $this->HigheshtQualificationMother=system::where([['systemType', '=', 18], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->OccuptionMother=system::where([['systemType', '=', 21], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->ProfessionMother=system::where([['systemType', '=', 27], ['status', '=', 1]])->pluck('value', 'serialId');
        $this->AnnucalIncomeMother=system::where([['systemType', '=', 5], ['status', '=', 1]])->pluck('value', 'serialId');
        
        
    }
    
    
    
}
