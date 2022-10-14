<?php

namespace App\Http\Controllers\Backend\Bed;

use App\Http\Controllers\Controller;
use App\Models\Bed\BedGroup;
use App\Models\Bed\Floor;
use Illuminate\Http\Request;

class BedGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $bedGroups  = BedGroup::all();
        $floors     = Floor::all();
        return view('backend.bed.bedGroup.index',compact('floors','bedGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'          => 'required|string|unique:bed_groups|max:100',
            'floor_id'      => 'required',
            'description'   => 'sometimes'
        ]);

        BedGroup::create([
            'name'          => $request->name,
            'floor_id'      => $request->floor_id,
            'description'   => $request->description
        ]);

        notify()->success('Bed Group Created');
        return redirect()->back();
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
        $bedGroup = BedGroup::with('floor')->findOrfail($id);
        return response()->json($bedGroup);
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
            'name'          => 'required|string|max:100',
            'floor_id'      => 'required',
            'description'   => 'sometimes'
        ]);

        BedGroup::findOrfail($request->bedgroup_id)->update([
            'name'          => $request->name,
            'floor_id'      => $request->floor_id,
            'description'   => $request->description
        ]);

        notify()->success('Bed Group Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bedgroup = BedGroup::findOrfail($id);
        $bedgroup->delete();
        return response()->json($bedgroup);
    }
}
