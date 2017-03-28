<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use Auth;

class MedicineController extends Controller
{


    public function __construct()
    {

    }

    public function index()
    {
        $medicines = Medicine::paginate(10);
        return view('medicines.index', ['medicines'=>$medicines]);
    }

    public function create()
    {
        /*
        $roles = Role::all();*/
        return view('medicines.create');
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

            medicine::create([
                'name' => $request->input('name'),
            ]);

        }catch (\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }
        return redirect('/medicines')->with('message', 'Medicine added');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $medicine = medicine::findOrFail($id);
        return view('medicines.edit', ['medicine'=>$medicine]);
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
            $medicine = medicine::findOrFail($id);
            $medicine->update([
                'name' => $request->input('name'),
            ]);
        }catch (\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/medicines')->with('message', 'Medicine Updated');
    }


    public function destroy($id)
    {
        $medicine = medicine::findOrFail($id);
        $medicine->destroy($medicine->id);

        medicine::destroy($id);
        return redirect('/medicines')->with('message', 'Medicine removed');
    }


}
