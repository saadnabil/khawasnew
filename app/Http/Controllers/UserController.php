<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);
        return response()->view('admins.users.user_list', compact('users'));
    }

    public function create()
    {
        $action = route('admin.users.store');
        $user = new User();
        $langs = availableLanguages();
        return response()->view('admins.users.create_user', compact('langs', 'action','user'));
    }


    public function store(UserRequest $userRequest)
    {
        // Validate user input
        $validatedData = $userRequest->validated();

        // Remove 'confirmpassword' from the data array
        unset($validatedData['confirmpassword']);

        // Handle image upload
        if(isset($validatedData['image'])){
            $validatedData['image'] = FileHelper::upload_file('users', $validatedData['image']);
        }

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['usercode'] = generate_code_unique();

        // Create user
        User::create($validatedData);

        session()->flash('success', 'User created successfully');
        return redirect()->route('admin.users.index');

    }


    public function edit(Request $request, User $user)
    {
        $method = true;
        $langs = availableLanguages();
        $action = route('admin.users.update', $user);
        return response()->view('admins.users.create_user', compact('user', 'langs', 'action', 'method'));
    }
    public function update(UserRequest $userRequest, User $user)
    {
        // Validate user input
        $validatedData = $userRequest->validated();

        // Remove 'confirmpassword' from the data array
        unset($validatedData['confirmpassword']);

       // Handle image upload
       if(isset($validatedData['image'])){
            $validatedData['image'] = FileHelper::update_file('users', $validatedData['image'], $user->image);
        }

        // Hash the password if provided
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        unset($validatedData['password']);

        // Update user attributes
        $user->update($validatedData);

        session()->flash('success', 'User updated successfully');

        return redirect()->route('admin.users.index');

    }


    




    public function destroy(Request $request, User $user)
    {
        $user->delete();
        session()->flash('success', __('translation.Item deleted successfully'));
        return redirect()->route('admin.users.index');
    }
    //
}
