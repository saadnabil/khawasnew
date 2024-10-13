<?php

namespace App\Http\Controllers\Admins;

use App\Exports\ExportAdmins;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\adminValditeRequest;
use App\Http\Requests\Admins\adminRolesValdite;
use App\Models\Admin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     function __construct()
     {
          $this->middleware('permission:admin-list', ['only' => ['index']]);
          $this->middleware('permission:admin-create', ['only' => ['create','store']]);
          $this->middleware('permission:admin-edit', ['only' => ['edit','update']]);
          $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
          $this->middleware('permission:admin-export', ['only' => ['export']]);
     }
   

    public function index()
    {
        $admins = Admin::latest()->get();
        return view('admins.admin.index',compact('admins'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = new Admin();
        $action = route('admins.store');
        $roles = Role::get();
        return view('admins.admin.form',compact('admin','action','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(adminRolesValdite $request)
    {
        $data = $request->validated();
        if(isset($data['image'])){
            $data['image'] = FileHelper::upload_file('admins', $data['image']);
        }
        unset($data['role']);
        unset($data['repassword']);
        $data['password'] = bcrypt($data['password']);
        $admin = Admin::create($data);
        $admin->assignRole($request->input('role'));
        Alert::toast(__('translation.Admin created successfully'),'success');
        return redirect()->route('admins.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
      
        $action = route('admins.update', $admin);
        $roles = Role::get();
        $method = true;
        return view('admins.admin.form',compact('admin','action','method','roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(adminRolesValdite $request, Admin $admin)
    {
        $data = $request->validated();
        
        if (isset($data['image'])) {
            $data['image'] = FileHelper::update_file('admins', $data['image'], $admin->image);
        }
    
        $role = $data['role'];  // Save the role separately
        unset($data['role'], $data['repassword']);
        
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
    
        $admin->update($data);
        $admin->roles()->detach();
        $admin->assignRole($role);
        
        Alert::toast(__('translation.Admin Updated successfully'), 'success');
        
        return redirect()->route('admins.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        Alert::toast(__('translation.Admin Deleted successfully'),'success');
        return redirect()->route('admins.index');
    }

    public function exportAdmins(){
        return Excel::download(new ExportAdmins, 'admins.xlsx');
    }

}
