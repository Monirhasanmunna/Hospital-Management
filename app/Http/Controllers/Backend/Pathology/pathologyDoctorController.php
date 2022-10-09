<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Pathology\pathologyDoctor;
use Illuminate\Http\Request;

class pathologyDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = pathologyDoctor::all();
        return view('backend.pathology.doctor.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pathology.doctor.create');
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
            'name'  => 'required',
            'title' => 'required',
            'mobile' => 'required|min:10'
        ]);

        pathologyDoctor::create([
            'name'  => $request->name,
            'title' => $request->title,
            'mobile' => $request->mobile
        ]);

        notify()->success('Doctor Created');
        return redirect()->route('app.setting.doctor.index');
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
        $doctor = pathologyDoctor::findOrfail($id);
        return response()->json($doctor);
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
            'name'  => 'required',
            'title' => 'required'
        ]);

        pathologyDoctor::findOrfail($request->doctor_id)->update([
            'name'  => $request->name,
            'title' => $request->title
        ]);

        notify()->success('Doctor Updated');
        return redirect()->route('app.setting.doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $doctor =  pathologyDoctor::findOrfail($id);
       $doctor->delete();
       return response()->json($doctor);
    }
}
