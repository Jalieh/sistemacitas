<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;
use Auth;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::paginate();
        return view('roles.index', ['roles'=>$roles]);
    }

    public function create()
    {
        if(!Auth::user()->can('CreateRole'))
            abort(403, 'Whoops');

        return view('roles.create');
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:10|alpha',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            Role::create([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/roles')->with('message', 'Cool! A new role.');
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', ['role'=>$role]);
    }

    public function edit($id)
    {
        if(!Auth::user()->can('EditRole'))
            abort(403, 'Whoops');

        $role = Role::findOrFail($id);
        return view('roles.edit', ['role'=>$role]);
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:50|alpha',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            $role = Role::findOrFail($id);
            $role->update([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/roles')->with('message', 'Cool! You just changed the role');
    }

    public function destroy($id)
    {
        try{
            \DB::beginTransaction();
            Role::destroy($id);
        }catch(\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }
        return redirect('/roles')->with('message', 'Removed role.');
    }

    public function permisos($id){
        if(!Auth::user()->can('RolePermissions'))
            abort(403, 'Whoops');

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.permissions', ['role'=>$role, 'permissions'=>$permissions]);
    }

    public function AssignPermissions(Request $request, $id){
        $role = Role::findOrFail($id);
        $role->revokePermissionTo(Permission::all());
        if($request->input('permissions'))
            $role->givePermissionTo($request->input('permissions'));
        return redirect('/roles')->with('message', 'Alright! This role has been remixed.');
    }
}
