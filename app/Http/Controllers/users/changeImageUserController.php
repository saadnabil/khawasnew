<?php

namespace App\Http\Controllers\users;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class changeImageUserController extends Controller
{

    public function showProfileImage(){
        return view('users.settings.ChangeProfileImage');
    }

    public function UserChangeImage(Request $request)
    {
        // Get the authenticated user
        $user = auth()->guard('web')->user();

        // Validate user input
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            //$fileName = time() . '_' . $file->getClientOriginalName();
            $fileName = FileHelper::update_file('users', $validatedData['image'], $user->image);
            if ($fileName !== false) {
                // Store the image file name in the validated data
                $validatedData['image'] = $fileName;
            } else {
                // If the file upload fails, redirect back with an error message
                return redirect()->back()->withErrors(['image' => 'Failed to upload image. Please try again.'])->withInput();
            }
        }

        // If image was uploaded, update the user record
        if (isset($validatedData['image'])) {
            $user->image = $validatedData['image'];
        }

        // Save the user record
        $user->save();

        Alert::toast('Yor are updated image successfully', 'success');
        return redirect()->back();
    }

    //
}