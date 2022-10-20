<?php

namespace App\Http\Controllers\Backend\Finance;

use App\Http\Controllers\Controller;
use App\Models\Expense\Account;
use App\Models\Pathology\pathologyPatient;
use App\Models\RefferedAmountDetail;
use Illuminate\Http\Request;

class DueCollectionController extends Controller
{
    public function index()
    {
        $patients = pathologyPatient::where('due_amount','!=',0)->get();
        return view('backend.finance.due_collection',compact('patients'));
    }

    public function previousDetails($id)
    {
        $data = pathologyPatient::find($id);
        return response()->json($data);
    }

    public function due_payment(Request $request)
    {
        
        $patient = pathologyPatient::find($request->patient_id);
        $paid_amount = $request->amount;
        $patient['paid_amount'] += $paid_amount;
        $patient['total_amount'] -= $request->discount;
        $patient['due_amount'] -= $paid_amount + $request->discount;
        $patient['discount_amount'] += $request->discount;
        $patient->save();

        $refferalPayment = RefferedAmountDetail::where('patient_id',$request->patient_id)->first();
        $refferalPayment['refd_amount'] -= $request->discount;
        $refferalPayment->save();

        $account = Account::find(1);
        $account['credit'] += $paid_amount;
        $account['balance'] += $paid_amount;
        $account->save();
        

        $patient_id = $request->patient_id;
        return response()->json(['id' => $patient_id,'paid'=>$paid_amount]);
    }
    public function duepaymentInvoice($id,$paid_amount)
    {
        $patient = pathologyPatient::find($id);
        return view('backend.finance.due_collection_invoice',compact('patient','paid_amount'));

    }

// refferal payment section 
    public function refferel_pay()
    {
        $patients = pathologyPatient::where('due_amount',0)->where('is_refferel_paid',0)
                    ->get();
        return view('backend.finance.refferel_pay',compact('patients'));
    }

    public function previousRefferalDetails($id)
    {
        $data = pathologyPatient::where('pathology_patients.id',$id)
                ->join('reffered_amount_details','reffered_amount_details.patient_id','pathology_patients.id')
                ->select('pathology_patients.*','reffered_amount_details.*')
                ->first();
        return response()->json($data);
    }

    public function refferal_payment(Request $request)
    {
        $id = $request->patient_id;
        $patient = pathologyPatient::find($id);
        $refferalPayment = RefferedAmountDetail::where('patient_id',$id)->first();
        $paid_amount = $request->amount;
        $refferalPayment['refd_paid_amount'] += $request->amount;
        $refferalPayment['refferel_paid'] += $request->amount;
        if ($refferalPayment['refd_paid_amount'] == $refferalPayment['refd_amount']) {
            $patient['is_refferel_paid'] = true;
        }

        $account = Account::find(1);
        $account['debit'] += $request->amount;
        $account['balance'] -= $request->amount;
        $account->save();
        $patient->save();
        $refferalPayment->save();

        return response()->json(['id' => $id,'paid'=>$paid_amount]);
        // return view('backend.finance.refferal_payment_invoice',compact('patient','refferalPayment','paid_amount'));
    }

    public function refferalpaymentInvoice($id,$paid_amount)
    {
        $patient = pathologyPatient::find($id);
        $refferalPayment = RefferedAmountDetail::where('patient_id',$id)->first();
        return view('backend.finance.refferal_payment_invoice',compact('patient','refferalPayment','paid_amount'));
    }

    // doctor payment section 
    public function doctor_pay()
    {
        $patients = pathologyPatient::where('due_amount',0)->where('is_refferel_paid',0)
        ->get();
        return view('backend.finance.doctor_pay',compact('patients'));
    }

    public function doctor_payment(Request $request)
    {
        $id = $request->patient_id;
        $patient = pathologyPatient::find($id);
        $refferalPayment = RefferedAmountDetail::where('patient_id',$id)->first();
        $refferalPayment['refd_paid_amount'] += $request->amount;
        $refferalPayment['doctor_paid'] += $request->amount;
        if ($refferalPayment['refd_paid_amount'] == $refferalPayment['refd_amount']) {
            $patient['is_refferel_paid'] = true;
        }
        $paid_amount = $request->amount;
        $account = Account::find(1);
        $account['debit'] += $request->amount;
        $account['balance'] -= $request->amount;
        $account->save();
        $patient->save();
        $refferalPayment->save();

        return response()->json(['id' => $id,'paid'=>$paid_amount]);
        // return view('backend.finance.doctor_payment_invoice',compact('patient','refferalPayment','paid_amount'));
    }

    public function doctorpaymentInvoice($id,$paid_amount)
    {
        $patient = pathologyPatient::find($id);
        $refferalPayment = RefferedAmountDetail::where('patient_id',$id)->first();
        return view('backend.finance.doctor_payment_invoice',compact('patient','refferalPayment','paid_amount'));
    }

    public function addDiscount(Request $request)
    {
        $patient = pathologyPatient::find($request->patient_id);
        $patient['discount_amount'] += $request->discount;
        $patient['total_amount'] -= $request->discount;
        $patient['paid_amount'] -= $request->discount;
        $patient->save();

        $refferalPayment = RefferedAmountDetail::where('patient_id',$request->patient_id)->first();
        $refferalPayment['refd_amount'] -= $request->discount;
        $refferalPayment->save();

        if ($refferalPayment['refd_amount'] == 0) {
            $patient['is_refferel_paid'] = true;
        }
        $patient->save();

        $account = Account::find(1);
        $account['credit'] -= $request->discount;
        $account['balance'] -= $request->discount;
        $account->save();
        return response()->json(['success' => 'discount addes successul']);
    }
}
