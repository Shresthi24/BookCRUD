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
use App\dbmodel\mother;
use App\Http\Controllers\FileUploadMother;

class FileUploadMotherService
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

            $FileInfo->save();
            $lastinsertid = \Response::json(array('success' => true, 'last_insert_id' => $FileInfo->imageId), 200)->getData()->last_insert_id;
        }
        return $lastinsertid;
    }
    
    
        
      public function SaveAadharCard($aadharnumber,$extension, $filename, $filesize, $path) {
        //to save in image master
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = mother::select('aadharCard_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = mother::select('aadharCard_imageId')->Where([['user_userId', '=', $userId],['aadharCard_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->aadharCard_imageId );
        //to get last insert id ie birthid
        $lastinsertid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $motherid = json_decode(mother::select('motherId')->Where('user_userId', '=', $userId)->get());
        $motheridcount = mother::select('motherId')->Where('user_userId', '=', $userId)->get()->count();


        if ($motheridcount == 0) {

            $motherdata = new mother();
            $motherdata->user_userId = $userId;
            $motherdata->aadharCard_imageId = $lastinsertid;
            $motherdata->aadharCardNumber=$aadharnumber;
            $motherdata->save();
        } else {

            $motherdata = mother::find($motherid[0]->motherId);
            $motherdata->aadharCard_imageId = $lastinsertid;
            $motherdata->aadharCardNumber=$aadharnumber;
            $motherdata->save();
        }

        return;
    }
   
    
    
    
       public function SaveAddressProof($doctype,$extension, $filename, $filesize, $path) {
         
        //to save in image master
    
        $userId = User::find(Auth::user()->id)->id;
      
        $Docidjson = mother::select('addressProofDoc_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = mother::select('addressProofDoc_imageId')->Where([['user_userId', '=', $userId],['addressProofDoc_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->addressProofDoc_imageId );
        //to get last insert id ie birthid
        $lastinsertid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $motherid = json_decode(mother::select('motherId')->Where('user_userId', '=', $userId)->get());
        $motheridcount = mother::select('motherId')->Where('user_userId', '=', $userId)->get()->count();

        if ($motheridcount == 0) {
            $motherdata = new mother();
            $motherdata->user_userId = $userId;
            $motherdata->addressProofDoc_imageId = $lastinsertid;
            $motherdata->documents_serialId=$doctype;
            $motherdata->save();
        } else {
            $motherdata = mother::find($motherid[0]->motherId);
            $motherdata->aadharCard_imageId = $lastinsertid;
            $motherdata->documents_serialId=$doctype;
            $motherdata->save();
        }

        return;
    }
   
    
       public function SaveIdentityProof($doctype,$extension, $filename, $filesize, $path) {
        //to save in image master
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = mother::select('identityProofDoc_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = mother::select('identityProofDoc_imageId')->Where([['user_userId', '=', $userId],['identityProofDoc_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->identityProofDoc_imageId );
        //to get last insert id ie birthid
        $lastinsertid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);
        $motherid = json_decode(mother::select('motherId')->Where('user_userId', '=', $userId)->get());
        $motheridcount = mother::select('motherId')->Where('user_userId', '=', $userId)->get()->count();


        if ($motheridcount == 0) {

            $motherdata = new mother();
            $motherdata->user_userId = $userId;
            $motherdata->identityProofDoc_imageId = $lastinsertid;
            $motherdata->identityProof_serialId=$doctype;
            $motherdata->save();
        } else {
            $motherdata = mother::find($motherid[0]->motherId);
            $motherdata->identityProofDoc_imageId = $lastinsertid;
             $motherdata->identityProof_serialId=$doctype;
            $motherdata->save();
        }

        return;
    }
    
    

}