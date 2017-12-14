<?php
namespace App\helper;

use Auth;
use App\dbmodel\imagemaster;
use App\User;

class UserAvatarHelper
{
       
    public static function  getApplicantAvatar()            
    {
        $profilepicid=User::find(Auth::User()->id)->profileImage_imageId;
        
        if($profilepicid!=null)
        {
            $imagedata= json_decode(imagemaster::find($profilepicid));
          $path= $imagedata->imagePath;
          $imageName=$imagedata->imageName;
          $extension=$imagedata->extension;
          $location=$path.$imageName.'.'.$extension;
          return $location;
        }
        else           
        {
            return env('DEFAULT_AVATAR_PATH');
        }     
    }
}