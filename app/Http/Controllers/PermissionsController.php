<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Validator;

class PermissionsController extends Controller
{

    public function index()
    {
        $permissions = Permission::paginate(8);
        return view('permissions.index', ['permissions'=>$permissions]);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:50|alpha',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            Permission::create([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/permissions')->with('message', 'Cool! A new permission.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', ['permission'=>$permission]);
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

            $permission = Permission::findOrFail($id);
            $permission->update([
                'name'=>$request->input('name'),
            ]);

        }catch(\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/permissions')->with('message', 'You just changed a permission. Hmmm, not bad');
    }

    public function destroy($id)

    {
        $permission = permission::findOrFail($id);
        $permission->destroy($permission->id);

        permission::destroy($id);
        return redirect('/permissions')->with('message', 'Slayed that bitch!');
    }

}
