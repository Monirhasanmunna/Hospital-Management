<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Expense\Account;
use App\Models\Income\Income;
use App\Models\Pathology\pathologyDoctor;
use App\Models\Pathology\pathologyPatient;
use App\Models\Pathology\pathologyReferral;
use App\Models\Pathology\pathologyTest;
use App\Models\RefferedAmountDetail;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


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

            // patient refferel payment details 
            if ($request->discount_amount ) {
                $refd_amount = $request->refd_amount - $request->discount_amount;
            }else{
                $refd_amount = $request->refd_amount;
            }
            RefferedAmountDetail::create([
                'patient_id' => $patient->id,
                'refd_amount' =>$refd_amount,
            ]);

            //tests inputs string to number array create
            $stringSplit = str_split($request->set_input);
            $removeComas =  str_replace(',', '', $stringSplit);
    
            $stringToNumber = array_map(function($removeComas) {
            return intval($removeComas);
            },$removeComas);

            $deleteAllZeros = array_diff($stringToNumber, array(0));
            $patient->tests()->sync($deleteAllZeros);


            //accounts table credit update here
            $account = Account::find(1);
            $account_credited   =  $account->credit + $patient->paid_amount;
            $account->credit    =  $account_credited;
            $account->balance   =  $account->credit - $account->debit;
            $account->save();

            return response()->json(['id' => $patient->id]);
            // return view('backend.pathology.patient.invoice',compact('patient')); 
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
        $patient = pathologyPatient::find($id);
        return view('backend.pathology.patient.invoice',compact('patient')); 
        
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
            'discount'          => 'sometimes',
            'discount_amount'   => 'sometimes',
            'tax_amount'        => 'required',
            'invoice_total'     => 'required',
            'total'             => 'required',
            'paid_amount'       => 'required',
            'due'               => 'sometimes'
        ]);

        $patient = pathologyPatient::findOrfail($request->patient_id);
        //accounts table credit update here
        $account = Account::find(1);;
        $account_credited   =  $account->credit - $patient->paid_amount;
        $account->credit    =  $account_credited;
        $account->balance   =  $account->credit - $account->debit;
        $account->save();

        if($request->total < $request->paid_amount){
            notify()->warning('Can not paid more than total amount');
            return redirect()->back();
        }else{
            $patient = pathologyPatient::findOrfail($request->patient_id);

            $patient->referral_id       = $request->referral;
            $patient->doctor_id         = $request->doctor;
            $patient->name              = $request->name;
            $patient->mobile            = $request->mobile;
            $patient->age               = $request->age;
            $patient->tax_amount        = $request->tax_amount;
            $patient->total_amount      = $request->total;
            $patient->discount          = $request->discount;
            $patient->discount_amount   = $request->discount_amount;
            $patient->paid_amount       = $request->paid_amount;
            $patient->due_amount        = $request->due;
            $patient->save();

            // refferel payment details update
            // $refd_amount = RefferedAmountDetail::find($patient->id)->refd_amount;
            
            // if ($request->discount_amount ) {
            //     $refd_amount -= $request->discount_amount;
            // }
            // $refferel_payment = RefferedAmountDetail::find($patient->id);
            // $refferel_payment->update([
            //     'refd_amount' =>$refd_amount,
            // ]);
            //tests inputs string to number array create
            $stringSplit = str_split($request->set_input);
            $removeComas =  str_replace(',', '', $stringSplit);
        
            $stringToNumber = array_map(function($removeComas) {
                return intval($removeComas);
            },$removeComas);
                
            $deleteAllZeros = array_diff($stringToNumber, array(0));
            $patient->tests()->sync($deleteAllZeros);

            
            //accounts table credit update here
            $account            = Account::find(1);
            $account_credited   =  $account->credit + $patient->paid_amount;
            $account->credit    =  $account_credited;
            $account->balance   =  $account->credit - $account->debit;
            $account->save();

            notify()->success('Patient Updated');
            return view('backend.pathology.patient.invoice',compact('patient'));
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
        $patient = pathologyPatient::findOrfail($id);
        $account    = Account::find(1);
        $refferel_paid_details = RefferedAmountDetail::where('patient_id',$id)->first();

        $account->credit = $account->credit - $patient->paid_amount;
        $account->balance   =  $account->credit - $account->debit;
        $account->save();
        $patient->delete();
        $refferel_paid_details->delete();
        return response('true');
    }
}
