<?php

namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleFormValidateion;
use App\Http\Requests\Admins\adminRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;


class RoleController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->middleware('permission:role-export', ['only' => ['export']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = Role::get();
        return view('admins.roles.index' , compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('roles.store');
        $role = new Role();
        $permissions = Permission::get();
        
        return view('admins.roles.form', compact('permissions', 'action', 'role'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adminRoleRequest $request)
    {
        $data = $request->validated();
    
        // Create the role
        $role = Role::create(['name' => $data['name'], 'guard_name' => 'admin']);
    
        // Get the checked permissions from the form
        $permissions = $request->input('permission', []);
    
        // Sync only the checked permissions
        $role->syncPermissions($permissions);
    
        Alert::toast(__('translation.Roles created successfully'),'success');
        return redirect()->route('roles.index');
    }
    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role-> load('permissions');

        $permissions = Permission::get();

        $method = 'PUT';

        $action = route('roles.update', $role);

        return view('admins.roles.form', compact('role','permissions','action','method','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(adminRoleRequest $request, Role $role)
    {
       $data = $request -> validated();

       $data['permission'] =  $data['permission'] ?? [];

        $role -> update(['name' => $data ['name']]);

        $role->syncPermissions($data['permission']);

        Alert::toast(__('translation.Roles Updated successfully'),'success');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role -> delete();

        Alert::toast(__('translation.Roles Deleted successfully'),'success');

        return redirect()->route('roles.index');
    }

}
