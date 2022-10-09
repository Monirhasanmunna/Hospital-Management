<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Pathology\pathologyDoctor;
use App\Models\Pathology\pathologyPatient;
use App\Models\Pathology\pathologyReferral;
use App\Models\Pathology\pathologyTest;
use Faker\Core\Number;
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
        $patients = pathologyPatient::orderBy('id','DESC')->get();
        $tests = pathologyTest::all();
        $referrals = pathologyReferral::all();
        $doctors = pathologyDoctor::all();
        return view('backend.pathology.patient.index',compact('patients','tests','referrals','doctors'));
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
            'invoice_total'     => 'invoice_total',
            'discount'          => 'sometimes',
            'discount_amount'   => 'sometimes',
            'tax'               => 'sometimes',
            'tax_amount'        => 'sometimes',
            'invoice_total'     => 'required',
            'total'             => 'required',
            'paid_amount'       => 'required',
            'due'               => 'sometimes'
        ]);

        if($request->total < $request->paid_amount){
            notify()->warning('Can not paid more than total amount');
            return redirect()->back();
        }else{
            $patient = pathologyPatient::create([
                'referral_id'       => $request->referral,
                'doctor_id'         => $request->doctor,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'age'               => $request->age,
                'invoice_total'     => $request->invoice_total,
                'address'           => $request->address,
                'tax'               => $request->tax,
                'tax_amount'        => $request->tax_amount,
                'total_amount'      => $request->total,
                'discount'          => $request->discount,
                'discount_amount'   => $request->discount_amount,
                'paid_amount'       => $request->paid_amount,
                'due_amount'        => $request->due
            ]);


            $stringSplit = str_split($request->set_input);
            $removeComas =  str_replace(',', '', $stringSplit);
    
            $stringToNumber = array_map(function($removeComas) {
            return intval($removeComas);
            },$removeComas);

            $deleteAllZeros = array_diff($stringToNumber, array(0));

            $patient->tests()->sync($deleteAllZeros);

            notify()->success('Patient Created');
            return redirect()->route('app.pathology.patient.index');
        }
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


    public function invoice($id)
    {
        $patient = pathologyPatient::with('tests')->findOrfail($id);
        return view('backend.pathology.patient.invoice',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = pathologyPatient::with('tests')->findOrfail($id);
        return view('backend.pathology.patient.index',compact('patient'));
    }

    public function patientInfoById($id)
    {
        $patient = pathologyPatient::with('doctor','referral','tests')->findOrfail($id);
        return response()->json($patient);
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
            'name'              => 'required|max:100',
            'mobile'            => 'required|min:11',
            'age'               => 'required',
            'referral'          => 'required',
            'doctor'            => 'required',
            'test'              => 'sometimes',
            'standard_rate'     => 'required',
            'discount_amount'   => 'sometimes',
            'tax_amount'        => 'required',
            'invoice_total'     => 'required',
            'total'             => 'required',
            'paid_amount'       => 'required',
            'due'               => 'sometimes'
        ]);

        if($request->total < $request->paid_amount){
            notify()->warning('Can not paid more than total amount');
            return redirect()->back();
        }else{
            $stringSplit = str_split($request->set_input);
            $removeComas =  str_replace(',', '', $stringSplit);
        
            $stringToNumber = array_map(function($removeComas) {
                return intval($removeComas);
            },$removeComas);
                
            $deleteAllZeros = array_diff($stringToNumber, array(0));


            $patient = pathologyPatient::findOrfail($request->patient_id);
            
            $patient->referral_id       = $request->referral;
            $patient->doctor_id         = $request->doctor;
            $patient->name              = $request->name;
            $patient->mobile            = $request->mobile;
            $patient->age               = $request->age;
            $patient->tax_amount        = $request->tax_amount;
            $patient->total_amount      = $request->total;
            $patient->discount_amount   = $request->discount_amount;
            $patient->paid_amount       = $request->paid_amount;
            $patient->due_amount        = $request->due;
            $patient->save();

            $patient->tests()->sync($deleteAllZeros);

            notify()->success('Patient Updated');
            return redirect()->route('app.pathology.patient.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = pathologyPatient::findOrfail($id)->delete();
        return response($patient);
    }
}
