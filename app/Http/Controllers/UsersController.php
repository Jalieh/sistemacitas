<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::paginate();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        if(!Auth::user()->can('CreateUser'))
            abort(403,'Whoops');

        $roles = Role::all();
        return view('users.create', ['roles'=>$roles]);
    }


    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'lastname'=>'required|max:255',
            'birthdate'=>'nullable',
            'age'=>'required|max:3',
            'identification'=>'required|max:255|unique:users',
            'gender'=>'nullable',
            'phone'=>'required|max:255',
            'mobile'=>'required|max:255',
            'address'=>'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        try {
            \DB::beginTransaction();

            $user = User::create([
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'birthdate' => $request->input('birthdate'),
                'age' => $request->input('age'),
                'identification' => $request->input('identification'),
                'gender' => $request->input('gender'),
                'phone' => $request->input('phone'),
                'mobile' => $request->input('mobile'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            $user->assignRole($request->input('role'));

        } catch (\Exception $e) {
            \DB::rollback();
        } finally {
            \DB::commit();
        }
        return redirect('/users')->with('message', 'New user! We are ready to help.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(!Auth::user()->can('EditUser'))
            abort(403,'Whoops');

        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('users.edit', ['user'=>$user, 'roles'=>$roles]);
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(),
            [
                'name' => 'required|max:255',
                'lastname'=>'required|max:255',
                'birthdate'=>'nullable',
                'age'=>'required|max:3',
                'identification'=>'required|max:255|unique:users'.$id.',id',
                'gender'=>'nullable',
                'phone'=>'required|max:255',
                'mobile'=>'required|max:255',
                'address'=>'required',
                'email' => 'required|email|max:255|unique:users'.$id.',id',
                'password' => 'required|min:6|confirmed',
                'role' => 'required',
            ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v)->withInput();
        }
        try{
            // Iniciamos un proceso de transaccion
            \DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'birthdate' => $request->input('birthdate'),
                'age' => $request->input('age'),
                'identification' => $request->input('identification'),
                'gender' => $request->input('gender'),
                'phone' => $request->input('phone'),
                'mobile' => $request->input('mobile'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
            ]);

            if($request->input('password')){
                $v = Validator::make($request->all(),
                    [
                        'password' => 'required|min:6|confirmed',
                    ]);

                if ($v->fails())
                {
                    return redirect()->back()->withErrors($v)->withInput();
                }
                $user->update([
                    'password' => bcrypt($request->input('password')),
                ]);
            }

            // $user->removeRole(Role::all());
            // $user->assignRole($request->input('role'));

            $user->syncRoles($request->input('role'));

        }catch (\Exception $e){
            echo $e->getMessage();
            \DB::rollback();
        }finally{
            \DB::commit();
        }
        return redirect('/users')->with('message', 'User changed successfully!');
    }

    public function destroy($id)
    {
        if(!Auth::user()->can('DeleteUser'))
            abort(403, 'Whoops');

        User::destroy($id);
        return redirect('/users')->with('message', 'Aw! The user is now gone.');
    }

    public function permissions($id)
    {
        if(!Auth::user()->can('UsersPermissions'))
            abort(403, 'Whoops');

        $user = User::findOrFail($id);
        $permissions = Permission::all();
        return view('users.permissions', ['user' => $user, 'permissions' => $permissions]);
    }

    public function AssignPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->revokePermissionTo(Permission::all());
        if ($request->input('permissions'))
            $user->givePermissionTo($request->input('permissions'));
        return redirect('/users')->with('message', 'Permissions ready to work.');
    }
}
