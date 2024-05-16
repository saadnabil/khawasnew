<?php
namespace App\Services\Users;

use Illuminate\Support\Facades\Auth;

class UserAuthService{

    public function makeLogin(array $credintials){

        // Check if the login field is email or phone
       $loginField = filter_var($credintials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

       // Append the login field to the credentials array
       $credintials[$loginField] = $credintials['login'];

       unset($credintials['login']);

       if (Auth::attempt($credintials)) {
            return true;
       }
       return ['error' => __('translation.Invalid email or phone number or password. Please try again')];
    }




}
