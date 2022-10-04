<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Pathology\pathologyDoctor;
use App\Models\Pathology\pathologyReferral;
use App\Models\Pathology\pathologyTest;
use Illuminate\Http\Request;

class pathologyPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = pathologyDoctor::all();
        $referrals = pathologyReferral::all();
        $tests = pathologyTest::all();
        return view('backend.pathology.patient.create',compact('doctors','referrals','tests'));
    }




    // Ajax method
    public function testInfoById($id)
    {
        $test = pathologyTest::where('id',$id)->first();
        return response()->json($test);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
