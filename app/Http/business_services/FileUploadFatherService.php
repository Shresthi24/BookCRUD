<?php
namespace App\Http\business_services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Auth;
use App\User;
use App\dbmodel\imagemaster;
use Illuminate\Http\JsonResponse;
use App\dbmodel\father;

class FileUploadFatherService
{
      public function SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path) {


        if ($Docidcount == 0) {

            $FileInfo = new imagemaster();
            $FileInfo->active = 1;
            $FileInfo->size = $filesize;
            $FileInfo->imagePath = $path;
            $FileInfo->imageName = $filename;
            $FileInfo->extension = $extension;
            $FileInfo->createdBy_userId = User::find(Auth::user()->id)->id;
            if ($FileInfo->save()) {

                $lastinsertid = \Response::json(array('success' => true, 'last_insert_id' => $FileInfo->imageId), 200)->getData()->last_insert_id;
            }
        } else {

            $FileInfo = imagemaster::find($imagemasterid);
            $FileInfo->active = 1;
            $FileInfo->size = $filesize;
            $FileInfo->imagePath = $path;
            $FileInfo->imageName = $filename;
            $FileInfo->extension = $extension;
            $FileInfo->lastModifiedBy_userId = User::find(Auth::user()->id)->id;
            // die(var_dump($FileInfo));
            $FileInfo->save();
            $lastinsertid = \Response::json(array('success' => true, 'last_insert_id' => $FileInfo->imageId), 200)->getData()->last_insert_id;
        }
        return $lastinsertid;
    }
    
    
    
      public function SaveAadharCard($aadharnumber,$extension, $filename, $filesize, $path) {
        //to save in image master
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = father::select('aadharCard_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = father::select('aadharCard_imageId')->Where([['user_userId', '=', $userId],['aadharCard_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->aadharCard_imageId );
        //to get last insert id ie birthid
        $aadharid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $fatherid = json_decode(father::select('fatherId')->Where('user_userId', '=', $userId)->get());
        $fatheridcount = father::select('fatherId')->Where('user_userId', '=', $userId)->get()->count();


        if ($fatheridcount == 0) {

            $fatherdata = new father();
            $fatherdata->user_userId = $userId;
            $fatherdata->aadharCard_imageId = $aadharid;
            $fatherdata->aadharCardNumber=$aadharnumber;
            $fatherdata->save();
        } else {

            $fatherdata = father::find($fatherid[0]->fatherId);
            $fatherdata->aadharCard_imageId = $aadharid;
             $fatherdata->aadharCardNumber=$aadharnumber;
            $fatherdata->save();
        }

        return;
    }
   
    
     
      public function SaveAddressProof($doctype,$extension, $filename, $filesize, $path) {
         
        //to save in image master
      
        $userId = User::find(Auth::user()->id)->id;
   
        $Docidjson = father::select('addressProofDoc_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
     // 
        $Docidcount = father::select('addressProofDoc_imageId')->Where([['user_userId', '=', $userId],['addressProofDoc_imageId','!=',null]])->get()->count();
        
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->addressProofDoc_imageId );
        
        //to get last insert id ie birthid
        $lastinsertid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $fatherid = json_decode(father::select('fatherId')->Where('user_userId', '=', $userId)->get());
        $fatheridcount = father::select('fatherId')->Where('user_userId', '=', $userId)->get()->count();

        if ($fatheridcount == 0) {
            $fatherdata = new father();
            $fatherdata->user_userId = $userId;
            $fatherdata->addressProofDoc_imageId = $lastinsertid;
            $fatherdata->documents_serialId=$doctype;
            $fatherdata->save();
        } else {
            $fatherdata = father::find($fatherid[0]->fatherId);
          $fatherdata->addressProofDoc_imageId = $lastinsertid;
            $fatherdata->documents_serialId=$doctype;
            $fatherdata->save();
        }

        return;
    }
    
      public function SaveIdentityProof($doctype,$extension, $filename, $filesize, $path) {
        //to save in image master
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = father::select('identityProofDoc_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = father::select('identityProofDoc_imageId')->Where([['user_userId', '=', $userId],['identityProofDoc_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->identityProofDoc_imageId );
        //to get last insert id ie birthid
        $lastinsertid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);
        $fatherid = json_decode(father::select('fatherId')->Where('user_userId', '=', $userId)->get());
        $fatheridcount = father::select('fatherId')->Where('user_userId', '=', $userId)->get()->count();


        if ($fatheridcount == 0) {

            $fatherdata = new father();
            $fatherdata->user_userId = $userId;
            $fatherdata->identityProofDoc_imageId = $lastinsertid;
            $fatherdata->identityProof_serialId=$doctype;
            $fatherdata->save();
        } else {
            $fatherdata = father::find($fatherid[0]->fatherId);
            $fatherdata->identityProofDoc_imageId = $lastinsertid;
             $fatherdata->identityProof_serialId=$doctype;
            $fatherdata->save();
        }

        return;
    }
   
    
 
    
    
}