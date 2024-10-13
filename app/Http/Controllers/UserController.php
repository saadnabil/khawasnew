<?php

namespace App\Http\Controllers;

use App\Exports\ExportUsers;
use App\Helpers\FileHelper;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use mysql_xdevapi\TableInsert;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;
    function __construct()
    {
         $this->middleware('permission:user-list', ['only' => ['index']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
         $this->middleware('permission:user-export', ['only' => ['export']]);
         $this->middleware('log.registered.user.ip')->only('store','update');
            }

    public function index()
    {
        $users = User::latest()->paginate(10);
        return response()->view('admins.users.index', compact('users'));
    }



    public function create()
    {
        $action = route('admin.users.store');
        $user = new User();
        $langs = availableLanguages();
        return response()->view('admins.users.form', compact('langs', 'action','user'));
    }


    // public function store(UserRequest $userRequest)
    // {
    //     $validatedData = $userRequest->validated();

    //     unset($validatedData['confirmpassword']);

    //     if(isset($validatedData['image'])){
    //         $validatedData['image'] = FileHelper::upload_file('users', $validatedData['image']);
    //     }

    //     $validatedData['password'] = Hash::make($validatedData['password']);
    //     $validatedData['usercode'] = generate_code_unique();
    //     User::create($validatedData);
    //     session()->flash('success', 'User created successfully');
    //     return redirect()->route('admin.users.index');

    // }



    public function store(UserRequest $userRequest)
    {
        $validatedData = $userRequest->validated();

        unset($validatedData['confirmpassword']);

        if(isset($validatedData['image'])){
            $validatedData['image'] = FileHelper::upload_file('users', $validatedData['image']);
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        // Check if usercode is provided. If not, generate a unique code.
        if (empty($validatedData['usercode'])) {
            $validatedData['usercode'] = generate_code_unique();
        }

        // Add the IP address to the validated data
       $validatedData['ip_address'] = request()->ip();

        User::create($validatedData);

        Alert::toast(__('translation.User created successfully'),'success');
        return redirect()->route('admin.users.index');
    }



    public function edit(Request $request, User $user)
    {
        $method = true;
        $langs = availableLanguages();
        $action = route('admin.users.update', $user);
        return response()->view('admins.users.form', compact('user', 'langs', 'action', 'method'));
    }


    public function update(UserRequest $userRequest, User $user)
    {
        $validatedData = $userRequest->validated();

        unset($validatedData['confirmpassword']);

        if (isset($validatedData['image'])) {
            $validatedData['image'] = FileHelper::update_file('users', $validatedData['image'], $user->image);
        }

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user->password = $validatedData['password'];
        }

        if (empty($validatedData['usercode'])) {
            $validatedData['usercode'] = generate_code_unique();
        }
        $validatedData['ip_address'] = request()->ip();

        $user->update(array_filter($validatedData, fn($key) => $key !== 'password', ARRAY_FILTER_USE_KEY));

        Alert::toast(__('translation.User Updated successfully'),'success');

        return redirect()->route('admin.users.index');
    }


    public function exportUsers(){
        return Excel::download(new ExportUsers, 'users.xlsx');
    }








    public function destroy(Request $request, User $user)
    {
        $user->delete();
        Alert::toast(__('translation.User Deleted successfully'),'success');
        return redirect()->route('admin.users.index');
    }
    //
}
