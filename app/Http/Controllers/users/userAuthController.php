<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserAuthRequest;
use App\Services\Users\UserAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class userAuthController extends Controller
{

    protected $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }



    public function showloginform(){
        $route = route('user.login');
        return view('layout.auth.login', compact('route'));
    }

    

    public function login(UserAuthRequest $request){
        $credentials = $request->validated();
        $response = $this->userAuthService->makeLogin($credentials);
        // Authentication failed...
        if(isset($response['error'])){
            return redirect()->route('user.showloginform')->withErrors(['login' => $response['error']])->withInput($request->only('login'));
        }
        return redirect()->route('user.items.index');
    }


















    public function UserShowPassword(){
        return response()->view('users.settings.changePassword');

    }

    public function UserChangePassword(Request $request)
    {
        $user = auth()->guard('web')->user();
    
        // Validate user input
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|different:current_password',
            'confirm_password' => 'required|string|min:6|same:new_password',
            'image' => 'nullable|image|mimes:png,jpg,gif,svg|max:2048',
        ]);
    
        // Check if the current password matches the one provided
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }
    
      
    
        // Update the user's password
        $user->password = Hash::make($validatedData['new_password']);
        // Save the user record
        $user->save();

        Alert::toast('Passowrd is change successfully', 'success');

    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Password changed successfully.');
    }




    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('login');
    }
    //
}
