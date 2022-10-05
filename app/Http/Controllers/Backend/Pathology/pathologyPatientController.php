<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Pathology\pathologyDoctor;
use App\Models\Pathology\pathologyPatient;
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
        $request->validate([
            'name'              => 'required|max:100',
            'mobile'            => 'required|min:11',
            'age'               => 'required',
            'referral'          => 'required',
            'doctor'            => 'required',
            'test'              => 'required',
            'standard_rate'     => 'required',
            'discount_amount'   => 'sometimes',
            'vat_amount'        => 'required',
            'invoice_total'     => 'required',
            'total'             => 'required',
            'paid_amount'       => 'required',
            'due'               => 'sometimes'
        ]);

        // return $request->all();

       $patient = pathologyPatient::create([
            'referral_id'       => $request->referral,
            'doctor_id'         => $request->doctor,
            'name'              => $request->name,
            'mobile'            => $request->mobile,
            'age'               => $request->age,
            'vat_amount'        => $request->vat_amount,
            'total_amount'      => $request->total,
            'discount_amount'   => $request->discount_amount,
            'due_amount'        => $request->due
        ]);

        $patient->tests()->sync($request->input('test'));

        notify()->success('patient added success fully');
        return redirect()->route('app.pathology.patient.create');
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
