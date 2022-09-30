<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Pathology\pathologyUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PathologyUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = pathologyUnit::all();
        return view('backend.pathology.unit.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pathology.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:100|unique:pathology_units'
        ]);

        pathologyUnit::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name)
        ]);

        notify()->success('Unit Created');
        return redirect()->route('app.pathology.unit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = pathologyUnit::findOrfail($id);
        return response()->json($unit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:100|unique:pathology_units'
        ]);

        pathologyUnit::findOrfail($request->unit_id)->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name)
        ]);

        notify()->success('Unit Updated');
        return redirect()->route('app.pathology.unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = pathologyUnit::findOrfail($id);
        $unit->delete();
        return response()->json('success');
    }
}
