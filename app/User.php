<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\dbmodel\applicant;
use App\dbmodel\citymaster;
use App\dbmodel\statemaster;
use App\dbmodel\system;
use Auth;
class User extends Authenticatable
{
    use Notifiable;
        public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
        
        
        
        
        public static function formid()
        {
        $formid=  User::find(Auth::user()->id)->formId;
          return $formid;
        }
        
      public function applicant()
      {
           return $this->hasOne('app\dbmodel\applicant');
      }
      
      public function Cityid()
      {
           return $this->belongsTo('App\dbmodel\citymaster','city_cityId');
      }
      
      
      public function Stateid()
      {
           return $this->belongsTo('App\dbmodel\statemaster','state_stateId');
      }
      
      public function LanguageHelptext()
      {
       return $this->belongsTo('App\dbmodel\system','helpLanguage_serialId');
     
      }
      
      public static function authuserid()
      {
          $authuserid= User::find(Auth::user()->id)->id;
          return $authuserid;
          
      }
      
      

    protected $fillable = [
        'name','password','passwordtomobile','mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
}
