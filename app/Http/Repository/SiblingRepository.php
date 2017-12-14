<?php
namespace App\Http\Repository;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
 use Illuminate\Http\Request;
 use App\dbmodel\statemaster;
 use App\Http\common\GeneralQueries;
 use App\Http\business_services\siblingservice;
 use App\dbmodel\sibling;
 class SiblingRepository
 {
     
     public function InsertData($siblingdata,$applicantid)
     {
      
         if($siblingdata['applicantbrotherCount']!=null)
         {
             $this->InsertBrotherData($siblingdata,$applicantid);
         }
         
         if($siblingdata['applicantsisterCount']!=null){
             $this-> InsertSisterData($siblingdata,$applicantid);
         }
         
         return;
     }
     
     public function InsertBrotherData($siblingdata,$applicantid)
     {
         
     //    DIE(var_dump($siblingdata));
         
              $brocount=$siblingdata['applicantbrotherCount'];
          
               for($i=1;$i<=$brocount;$i++)       
               {  
                    $siblingFiller = new sibling();
                $siblingFiller->firstName=$siblingdata['firstnamebrother'.$i];
                $siblingFiller->lastName=$siblingdata['lastnamebrother'.$i];
                $siblingFiller->siblingName=$siblingdata['firstnamebrother'.$i].''.$siblingdata['lastnamebrother'.$i];
                $siblingFiller->age=$siblingdata['agebrother'.$i];
                $siblingFiller->gender_serialId=2;
                $siblingFiller->school_id=$siblingdata['brotherschool'.$i];
                $siblingFiller->siblingClass_serialId=$siblingdata['brotherclass'.$i];
                $siblingFiller->division=$siblingdata['brotherdiv'.$i];
                $siblingFiller->rollNo=$siblingdata['brotherroll'.$i];
                $siblingFiller->isBrother=$siblingdata['isbrother'.$i];
            
                $siblingFiller->applicantId = $applicantid[0];
                $siblingFiller->save();
                
                $lastinsertid = \Response::json(array('success' => true, 'last_insert_id'=>$siblingFiller->siblingId), 200)->getData()->last_insert_id;
                
            
          
                
               }
                
         return;
     }
     
         public function InsertSisterData($siblingdata,$applicantid)
     {
                
              $srocount=$siblingdata['applicantsisterCount'];
              
               for($i=1;$i<=$srocount;$i++)       
               {   
                $siblingFiller = new sibling();
               $siblingFiller->firstName=$siblingdata['firstnamesister'.$i];
                $siblingFiller->lastName=$siblingdata['lastnamesister'.$i];
                $siblingFiller->gender_serialId=3;
                 $siblingFiller->siblingName=$siblingdata['firstnamesister'.$i].''.$siblingdata['lastnamesister'.$i];
                $siblingFiller->age=$siblingdata['agesister'.$i];
                $siblingFiller->school_id=$siblingdata['sisterschool'.$i];
                $siblingFiller->siblingClass_serialId=$siblingdata['sisterclass'.$i];
                $siblingFiller->division=$siblingdata['sisterdiv'.$i];
                $siblingFiller->rollNo=$siblingdata['sisterroll'.$i];
                $siblingFiller->isBrother=$siblingdata['isSister'.$i];           
                $siblingFiller->applicantId = $applicantid[0];
                $siblingFiller->save();
                
                $lastinsertid = \Response::json(array('success' => true, 'last_insert_id'=>$siblingFiller->siblingId), 200)->getData()->last_insert_id;
              
             
            
             
             
             
     }
         return;
     }
     
     public function UpdateData($siblingdata,$applicantid)
     {
         
         if($siblingdata['applicantbrotherCount']!=null){
             
             $this->UpdateBrotherData($siblingdata, $applicantid);
         }
         
         if($siblingdata['applicantsisterCount']!=null){
             
             $this->UpdateSisterData($siblingdata, $applicantid);
         }
             
         return;
     }
     
     
     public function UpdateBrotherData($siblingdata,$applicantid){
          $brocount=$siblingdata['applicantbrotherCount'];
          
         $siblingdbid=sibling::where([['applicantId','=',$applicantid[0]],['isBrother','=',1]])->pluck('siblingId');
       
         $deleteCheck=count($brocount)-count($siblingdbid);
         
         if ($deleteCheck<0) {
            $this->DeleteBeforeUpdateBrotherData($siblingdata, $applicantid,$siblingdbid,$deleteCheck);
        }
        
        for($i=1;$i<=$brocount;$i++)       
               {   
            
            $siblingFiller = sibling::find($siblingdbid[$i - 1]);
            $siblingFiller->firstName=$siblingdata['firstnamebrother'.$i];
                $siblingFiller->lastName=$siblingdata['lastnamebrother'.$i];
                $siblingFiller->siblingName=$siblingdata['firstnamebrother'.$i].''.$siblingdata['lastnamebrother'.$i];
                $siblingFiller->age=$siblingdata['agebrother'.$i];
                $siblingFiller->gender_serialId=2;
                $siblingFiller->school_id=$siblingdata['brotherschool'.$i];
                $siblingFiller->siblingClass_serialId=$siblingdata['brotherclass'.$i];
                $siblingFiller->division=$siblingdata['brotherdiv'.$i];
                $siblingFiller->rollNo=$siblingdata['brotherroll'.$i];
                $siblingFiller->isBrother=$siblingdata['isbrother'.$i];
                $siblingFiller->applicantId = $applicantid[0];
                $siblingFiller->save();
        }
           return;
     }
     
     
     
     public function DeleteBeforeUpdateBrotherData($siblingdata, $applicantid,$siblingdbid,$deleteCheck){
       
         for($i=count($siblingdbid)-1;$i>=abs($deleteCheck);$i--){
             sibling::destroy($siblingdbid[$i]);
         }
         return;
     }
     
     public function UpdateSisterData($siblingdata,$applicantid){
          $srcount=$siblingdata['applicantsisterCount'];
          $siblingdbid=sibling::where([['applicantId','=',$applicantid[0]],['isBrother','=',0]])->pluck('siblingId');
            $councheck=count($srocount)-count($siblingdbid);
            if($councheck<0){
                
                $this->DeleteBeforeUpdateSisterData($siblingdata, $applicantid, $siblingdbid, $srcount, $councheck);
            }
            
            
            for ($i = 1; $i <= $srcount; $i++) {

            $siblingdafiller = sibling::find($siblingdbid[$i - 1]);
            $siblingFiller->firstName = $siblingdata['firstnamesister' . $i];
            $siblingFiller->lastName = $siblingdata['lastnamesister' . $i];
            $siblingFiller->gender_serialId = 3;
            $siblingFiller->siblingName = $siblingdata['firstnamesister' . $i] . '' . $siblingdata['lastnamesister' . $i];
            $siblingFiller->age = $siblingdata['agesister' . $i];
            $siblingFiller->school_id = $siblingdata['sisterschool' . $i];
            $siblingFiller->siblingClass_serialId = $siblingdata['sisterclass' . $i];
            $siblingFiller->division = $siblingdata['sisterdiv' . $i];
            $siblingFiller->rollNo = $siblingdata['sisterroll' . $i];
            $siblingFiller->isBrother = $siblingdata['isSister' . $i];
            $siblingFiller->applicantId = $applicantid[0];
            $siblingFiller->save();
        }
        return;
    }
    
    
     public function DeleteBeforeUpdateSisterData($siblingdata, $applicantid, $siblingdbid, $srcount, $councheck){
       
         for($i=count($siblingdbid)-1;$i>=abs($deleteCheck);$i--){
             sibling::destroy($siblingdbid[$i]);
         }
         return;
     }
    
    
     
 }

