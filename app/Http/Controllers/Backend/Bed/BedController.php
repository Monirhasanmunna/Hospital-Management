<?php

namespace App\Http\Controllers\Backend\Bed;

use App\Http\Controllers\Controller;
use App\Models\Bed\Bed;
use App\Models\Bed\BedGroup;
use App\Models\Bed\BedType;
use Illuminate\Http\Request;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beds       = Bed::orderBy('id','DESC')->get();
        $bedtypes   = BedType::all();
        $bedgroups  = BedGroup::all();
        return view('backend.bed.bed.index',compact('beds','bedtypes','bedgroups'));
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
            'name'      => 'required|unique:beds|max:100',
            'bed_type'  => 'required',
            'bed_group' => 'required'
        ]);

        Bed::create([
            'name'          => $request->name,
            'bedtype_id'    => $request->bed_type,
            'bedgroup_id'   => $request->bed_group,
            'status'        => $request->input('status'),
        ]);

        notify()->success('Bed Created');
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
        $bed = Bed::with('bedtype','bedgroup')->findOrfail($id);
        return response()->json($bed);
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
            'name'      => 'required|max:100',
            'bed_type'  => 'required',
            'bed_group' => 'required',
            'status'    => 'sometimes'
        ]);

        $bed = Bed::findOrfail($request->bed_id);
        $bed->name          = $request->name;
        $bed->bedtype_id    = $request->bed_type;
        $bed->bedgroup_id   = $request->bed_group;
        if($request->status == true){
            $bed->status = 1;
        }else{
            $bed->status = 0;
        }

        $bed->save();

        notify()->success('Bed Updated');
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
        $bed = Bed::findOrfail($id);
        $bed->delete();
        return response()->json($bed);
    }
}
