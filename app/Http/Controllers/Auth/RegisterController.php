<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\mobilenotification\registernotification;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/postreg';

    /**
     * Create a new controller instance.
     *
     * @return void

     * 
     *    */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|unique:users|max:255',
                    'mobile' => 'required||min:10|max:10',
                    'password' => 'min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        /* generate random 6 letter string */
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
        ); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 6) as $k)
            $rand .= $seed[$k];
        $pass = strtoupper($rand);
        $passEncrypt = bcrypt($pass);


        /* send sms to mobile */
        $name = $data['name'];
        $message = 'Your registration User Name is ' . $name . ' and password is ' . $pass . ' Use this for login and complete application process';
        $registersms = new registernotification();
        $registersms->sendMessage($message, $data['mobile']);



        /* store in database */
        return User::create([
                    'name' => $data['name'],
                    'password' => $passEncrypt,
                    'passwordtomobile' => $pass,
                    'mobile' => $data['mobile'],
                   
        ]);
    }

}
