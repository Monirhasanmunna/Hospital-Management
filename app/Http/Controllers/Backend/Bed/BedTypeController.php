<?php

namespace App\Http\Controllers\Backend\Bed;

use App\Http\Controllers\Controller;
use App\Models\Bed\BedType;
use Illuminate\Http\Request;

class BedTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bedtypes = BedType::all();
        return view('backend.bed.bedtype.index',compact('bedtypes'));
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
            'name'  => 'required|string|unique:bed_types|max:100'
        ]);

        BedType::create([
            'name'  => $request->name
        ]);

        notify()->success('Bed Type Created');
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
        $bedtype = BedType::findOrfail($id);
        return response()->json($bedtype);
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
            'name'  => 'required|string|max:100'
        ]);

        BedType::findOrfail($request->bedtype_id)->update([
            'name'  => $request->name
        ]);

        notify()->success('Bed Type Updated');
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
        $bedtype = BedType::findOrfail($id);
        $bedtype->delete();
        return response()->json($bedtype);
    }
}
