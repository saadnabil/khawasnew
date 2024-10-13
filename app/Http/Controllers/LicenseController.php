<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\License;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LicenseController extends Controller
{

    public function index()
    {
        $licenses = License::with('admin')->get();
        return view('admins.license.index', compact('licenses'));
    }
    public function create()
    {
        $admins = Admin::all();
        
        return view('admins.license.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'days' => 'required|integer|min:1',
        ]);
    
        // Check if the admin has an active license
        $activeLicense = License::where('admin_id', $request->admin_id)
                                ->where('end_date', '>', Carbon::now())
                                ->first();
    
        if ($activeLicense) {
            return redirect()->back()->withErrors(['admin_id' => 'The selected admin already has an active license.']);
        }
    
        $start_date = Carbon::now();
        $end_date = $start_date->copy()->addDays($request->days);

    
        License::create([
            'admin_id' => $request->admin_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    
        return redirect()->route('licenses.index');
    }
    
    public function edit(Request $request,$id){
        $license = License::findOrFail($id);
        $admins = Admin::all();
        return view('admins.license.edit', compact('admins','license'));

    }

    public function update(Request $request, $id)
{
    $request->validate([
        'admin_id' => 'required|exists:admins,id',
        'days' => 'required|integer|min:1',
    ]);

    $license = License::findOrFail($id);

    // Check if the admin has another active license
             $activeLicense = License::where('admin_id', $request->admin_id)
                            ->where('id', '!=', $id)
                            ->where('end_date', '>', Carbon::now())
                            ->first();

    if ($activeLicense) {
        return redirect()->back()->withErrors(['admin_id' => 'This admin already has another active license.']);
    }

    $start_date = Carbon::now();
    $end_date = $start_date->copy()->addDays($request->days);
    
  
    $license->update([
        'admin_id' => $request->admin_id,
        'start_date' => $start_date,
        'end_date' => $end_date,
    ]);

    return redirect()->route('licenses.index');
}

    

    public function destroy($id)
    {
        $license = License::findOrFail($id);
        $license->delete();

        return redirect()->route('licenses.index');
    }

   

    
    //
}
