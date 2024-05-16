<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class contactUsController extends Controller
{

    public function index()
    {

        $data = ContactUs::latest()->paginate(8);

        // $contact = new ContactUs();

        $action = route('ContactUs.update');
        $contact = new ContactUs();

        return response()->view('admins.settings.contactUs', compact('data','contact','action'));
    }


    public function update(ContactUsRequest $contactUsRequest)
    {
        
            $validatedData = $contactUsRequest->validated();
            
            $contact = ContactUs::findOrFail(1);
    
            $contact->update($validatedData);
    
            // Flash a success message and redirect to the index route
            session()->flash('success', 'Information updated successfully');
            return redirect()->route('ContactUs.index');
       
        
    }
    //
}
