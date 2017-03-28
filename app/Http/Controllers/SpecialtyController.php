<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use Auth;

class SpecialtyController extends Controller
{


    public function __construct()
    {

    }

    public function index()
    {
        $specialties = Specialty::paginate(10);
        return view('specialties.index', ['specialties'=>$specialties]);
    }

    public function create()
    {
        /*
        $roles = Role::all();*/
        return view('specialties.create');
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(),[
            'name' => 'required|max:255',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            specialty::create([
                'name' => $request->input('name'),
            ]);

        }catch (\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }
        return redirect('/specialties')->with('message', 'New specialty offered');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $specialty = specialty::findOrFail($id);
        return view('specialties.edit', ['specialty'=>$specialty]);
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(),[
            'name' => 'required|max:255',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();
            $specialty = specialty::findOrFail($id);
            $specialty->update([
                'name' => $request->input('name'),
            ]);
        }catch (\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/specialties')->with('message', 'Specialty Modified');
    }


    public function destroy($id)
    {
        $specialty = specialty::findOrFail($id);
        $specialty->destroy($specialty->id);

        specialty::destroy($id);
        return redirect('/specialties')->with('message', 'Specialty removed');
    }


}