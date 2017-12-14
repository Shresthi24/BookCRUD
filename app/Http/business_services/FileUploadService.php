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
use App\dbmodel\applicant;

class FileUploadService {

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

    public function SaveprofileImageUser($extension, $filename, $filesize, $path) {

        $userId = User::find(Auth::user()->id)->id;

        $Docid = User::find(Auth::user()->id)->profileImage_imageId;
        // $Docid = json_decode($Docidjson);
        $Docidcount = User::select('profileImage_imageId')->Where([['id', '=', $userId],['profileImage_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid );
        //to get last insert id ie birthid
        $profileimageid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $applicantid = json_decode(applicant::select('applicantId')->Where('user_userId', '=', $userId)->get());
        $applicantidcount = applicant::select('applicantId')->Where('user_userId', '=', $userId)->get()->count();


        if ($applicantidcount == 0) {

            $userdata = new User();
            $profileImageIdSave->profileImage_imageId = $profileimageid;
            $profileImageIdSave->save();
        } else {

            $profileImageIdSave = User::find(Auth::user()->id);
            $profileImageIdSave->profileImage_imageId = $profileimageid;
            $profileImageIdSave->save();
        }
        $this->SaveApplicantPhotoToapplicant($extension, $filename, $filesize, $path);
        return;
    }

    public function SaveApplicantPhotoToapplicant($extension, $filename, $filesize, $path) {
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = applicant::select('applicantPhoto_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = applicant::select('applicantPhoto_imageId')->Where([['user_userId', '=', $userId],['applicantPhoto_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->applicantPhoto_imageId );
        //to get last insert id ie birthid
        $ApplicantPhotoId = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $applicantid = json_decode(applicant::select('applicantId')->Where('user_userId', '=', $userId)->get());
        $applicantidcount = applicant::select('applicantId')->Where('user_userId', '=', $userId)->get()->count();


        if ($applicantidcount == 0) {

            $applicantdata = new applicant();
            $applicantdata->user_userId = $userId;
            $applicantdata->applicantPhoto_imageId = $ApplicantPhotoId;
            $applicantdata->save();
        } else {

            $applicantdata = applicant::find($applicantid[0]->applicantId);
            $applicantdata->applicantPhoto_imageId = $ApplicantPhotoId;
            $applicantdata->save();
        }

        return;
    }

    public function SaveBirthCertificatetoApplicant($extension, $filename, $filesize, $path) {
        //to save in image master
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = applicant::select('birthcertificate_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = applicant::select('birthcertificate_imageId')->Where([['user_userId', '=', $userId],['birthcertificate_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->birthcertificate_imageId );
        //to get last insert id ie birthid
        $BirthCertId = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $applicantid = json_decode(applicant::select('applicantId')->Where('user_userId', '=', $userId)->get());
        $applicantidcount = applicant::select('applicantId')->Where('user_userId', '=', $userId)->get()->count();


        if ($applicantidcount == 0) {

            $applicantdata = new applicant();
            $applicantdata->user_userId = $userId;
            $applicantdata->birthcertificate_imageId = $BirthCertId;
            $applicantdata->save();
        } else {

            $applicantdata = applicant::find($applicantid[0]->applicantId);
            $applicantdata->birthcertificate_imageId = $BirthCertId;
            $applicantdata->save();
        }

        return;
    }

    public function SaveAdharCardtoApplicant($aadharnumber,$extension, $filename, $filesize, $path) {
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = applicant::select('childAadharCard_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = applicant::select('childAadharCard_imageId')->Where([['user_userId', '=', $userId],['childAadharCard_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->childAadharCard_imageId );
        //to get last insert id 
        $lastinsertid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $applicantid = json_decode(applicant::select('applicantId')->Where('user_userId', '=', $userId)->get());
        $applicantidcount = applicant::select('applicantId')->Where('user_userId', '=', $userId)->get()->count();


        if ($applicantidcount == 0) {

            $applicantdata = new applicant();
            $applicantdata->user_userId = $userId;
            $applicantdata->childAadharCard_imageId = $lastinsertid;
            $applicantdata->aadharNumber=$aadharnumber;
            $applicantdata->save();
        } else {

            $applicantdata = applicant::find($applicantid[0]->applicantId);
            $applicantdata->childAadharCard_imageId = $lastinsertid;
             $applicantdata->aadharNumber=$aadharnumber;
         
            $applicantdata->save();
        }
    }

    public function SaveMedicalCertificatetoApplicant($extension, $filename, $filesize, $path) {
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = applicant::select('disabilityCertificate_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = applicant::select('disabilityCertificate_imageId')->Where([['user_userId', '=', $userId],['disabilityCertificate_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->disabilityCertificate_imageId );
        //to get last insert id 
        $medicalcertid = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $applicantid = json_decode(applicant::select('applicantId')->Where('user_userId', '=', $userId)->get());
        $applicantidcount = applicant::select('applicantId')->Where('user_userId', '=', $userId)->get()->count();

        if ($applicantidcount == 0) {

            $applicantdata = new applicant();
            $applicantdata->user_userId = $userId;
            $applicantdata->disabilityCertificate_imageId = $medicalcertid;
            $applicantdata->save();
        } else {

            $applicantdata = applicant::find($applicantid[0]->applicantId);
            $applicantdata->disabilityCertificate_imageId = $medicalcertid;
            $applicantdata->save();
        }
    }

    public function SaveSchoolLeavingToApplicant($extension, $filename, $filesize, $path) {
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = applicant::select('leavingCertificate_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = applicant::select('leavingCertificate_imageId')->Where([['user_userId', '=', $userId],['leavingCertificate_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->leavingCertificate_imageId );
        //to get last insert id 
        $schoolLeavingCertId = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $applicantid = json_decode(applicant::select('applicantId')->Where('user_userId', '=', $userId)->get());
        $applicantidcount = applicant::select('applicantId')->Where('user_userId', '=', $userId)->get()->count();

        if ($applicantidcount == 0) {

            $applicantdata = new applicant();
            $applicantdata->user_userId = $userId;
            $applicantdata->leavingCertificate_imageId = $schoolLeavingCertId;
            $applicantdata->save();
        } else {

            $applicantdata = applicant::find($applicantid[0]->applicantId);
            $applicantdata->leavingCertificate_imageId = $schoolLeavingCertId;
            $applicantdata->save();
        }
    }

    public function SaveSemsterCertificateToApplicant($extension, $filename, $filesize, $path) {
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = applicant::select('marksheet_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = applicant::select('marksheet_imageId')->Where([['user_userId', '=', $userId],['marksheet_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->marksheet_imageId );
        //to get last insert id 

        $semesterCertId = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $applicantid = json_decode(applicant::select('applicantId')->Where('user_userId', '=', $userId)->get());
        $applicantidcount = applicant::select('applicantId')->Where('user_userId', '=', $userId)->get()->count();

        if ($applicantidcount == 0) {

            $applicantdata = new applicant();
            $applicantdata->user_userId = $userId;
            $applicantdata->marksheet_imageId = $semesterCertId;
            $applicantdata->save();
        } else {

            $applicantdata = applicant::find($applicantid[0]->applicantId);
            $applicantdata->marksheet_imageId = $semesterCertId;
            $applicantdata->save();
        }
    }

    public function CasteCertificateToApplicant($extension, $filename, $filesize, $path) {
        $userId = User::find(Auth::user()->id)->id;

        $Docidjson = applicant::select('casteCertificate_imageId')->Where('user_userId', '=', $userId)->get();
        $Docid = json_decode($Docidjson);
        $Docidcount = applicant::select('casteCertificate_imageId')->Where([['user_userId', '=', $userId],['casteCertificate_imageId','!=',null]])->get()->count();
        $imagemasterid = ($Docidcount == 0 ? null : $Docid[0]->casteCertificate_imageId );
        //to get last insert id 
        $casteCertId = $this->SaveFileInfoDB($Docidcount, $imagemasterid, $extension, $filename, $filesize, $path);

        $applicantid = json_decode(applicant::select('applicantId')->Where('user_userId', '=', $userId)->get());
        $applicantidcount = applicant::select('applicantId')->Where('user_userId', '=', $userId)->get()->count();

        if ($applicantidcount == 0) {

            $applicantdata = new applicant();
            $applicantdata->user_userId = $userId;
            $applicantdata->casteCertificate_imageId = $casteCertId;
            $applicantdata->save();
        } else {

            $applicantdata = applicant::find($applicantid[0]->applicantId);
            $applicantdata->casteCertificate_imageId = $casteCertId;
            $applicantdata->save();
        }
    }

}
