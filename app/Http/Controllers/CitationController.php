<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitationController extends Controller
{


    public function __construct()
    {

    }

    public function index()
    {
        $citations = Citation::paginate(10);
        return view('citations.index', ['citations'=>$citations]);
    }

    public function create()
    {
        /*
        $roles = Role::all();*/
        return view('citations.create');
        $specialties = Specialty::all();
        return view('citations.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'specialties' => 'required',

        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v)->withInput();
        }

        try{
            \DB::beginTransaction();

            citation::create([
                'name' => $request->input('name'),
            ]);

        }catch (\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }
        return redirect('/citations')->with('message', 'Citation added');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $citation = citation::findOrFail($id);
        return view('citations.edit', ['citation'=>$citation]);
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
            $citation = citation::findOrFail($id);
            $citation->update([
                'name' => $request->input('name'),
            ]);
        }catch (\Exception $e){
            \DB::rollback();
        }finally{
            \DB::commit();
        }

        return redirect('/citations')->with('message', 'Citation Updated');
    }


    public function destroy($id)
    {
        $citation = citation::findOrFail($id);
        $citation->destroy($citation->id);

        citation::destroy($id);
        return redirect('/citations')->with('message', 'Citation removed');
    }


}