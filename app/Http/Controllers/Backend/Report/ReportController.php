<?php

namespace App\Http\Controllers\Backend\Report;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Expense\Expense;
use App\Models\Pathology\pathologyPatient;
use App\Models\RefferedAmountDetail;

class ReportController extends Controller
{
    public function collectionIndex()
    {
        $income['from_date'] = today()->format('d-M-Y');
        $income['to_date'] = today()->format('d-M-Y');
        $incomes = pathologyPatient::whereDate('created_at',Carbon::today())
                ->where('paid_amount','!=',0)
                ->get();
        return view('backend.report.collection',compact('incomes','income'));
    }
    public function collectio_report($from_date,$to_date)
    {
        $income['from_date'] = $from_date;
        $income['to_date'] = $to_date;
        $incomes = pathologyPatient::whereDate('created_at','>=', $from_date)
                ->whereDate('created_at','<=', $to_date)
                ->where('paid_amount','!=',0)
                ->get();
        return view('backend.report.collection',compact('incomes','income'));
    }
    
    public function collection_report_print($from_date,$to_date)
    {
        $patient = pathologyPatient::whereDate('created_at','>=', $from_date)
                ->whereDate('created_at','<=', $to_date)
                ->where('paid_amount','!=',0)
                ->get();
        return view('backend.report.collection_report_print',compact('patient','from_date','to_date'));
    }


    public function refd_payIndex()
    {
        $date['from_date'] = today()->format('d-M-Y');
        $date['to_date'] = today()->format('d-M-Y');
        $refferal_pay = RefferedAmountDetail::whereDate('updated_at',Carbon::today())
                    ->where('refferel_paid','!=',0)
                    ->get();
        return view('backend.report.refferal_pay',compact('refferal_pay','date'));
    }
    public function refd_pay_report($from_date,$to_date)
    {
        $date['from_date'] = $from_date;
        $date['to_date'] = $to_date;
        $refferal_pay = RefferedAmountDetail::whereDate('updated_at','>=', $from_date)
                    ->whereDate('updated_at','<=', $to_date)
                    ->where('refferel_paid','!=',0)
                    ->get();
        // dd($doctor_pay);
        return view('backend.report.refferal_pay',compact('refferal_pay','date'));
    }
    public function refd_pay_report_print($from_date,$to_date)
    {
        $refferpay = RefferedAmountDetail::whereDate('updated_at','>=', $from_date)
                    ->whereDate('updated_at','<=', $to_date)
                    ->where('refferel_paid','!=',0)
                    ->get();
        return view('backend.report.refferal_pay_report_print',compact('refferpay','from_date','to_date'));
    }

    // doctor report function start 
    public function doctor_payIndex()
    {
        $date['from_date'] = today()->format('d-M-Y');
        $date['to_date'] = today()->format('d-M-Y');
        $doctor_pay = RefferedAmountDetail::whereDate('updated_at',Carbon::today())
                    ->where('doctor_paid','!=',0)
                    ->get();
        return view('backend.report.doctor_pay',compact('doctor_pay','date'));
    }
    public function doctor_pay_report($from_date,$to_date)
    {
        $date['from_date'] = $from_date;
        $date['to_date'] = $to_date;
        $doctor_pay = RefferedAmountDetail::whereDate('updated_at','>=', $from_date)
                    ->whereDate('updated_at','<=', $to_date)
                    ->where('doctor_paid','!=',0)
                    ->get();
        // dd($doctor_pay);
        return view('backend.report.doctor_pay',compact('doctor_pay','date'));
    }
    public function doctor_pay_report_print($from_date,$to_date)
    {
        $refferpay = RefferedAmountDetail::whereDate('updated_at','>=', $from_date)
                    ->whereDate('updated_at','<=', $to_date)
                    ->where('doctor_paid','!=',0)
                    ->get();
        return view('backend.report.doctor_pay_report_print',compact('refferpay','from_date','to_date'));
    }


    public function expenseIndex()
    {
        
        $date['from_date'] = today()->format('d-M-Y');
        $date['to_date'] = today()->format('d-M-Y');
        $expense = Expense::whereDate('date',Carbon::today())->get();
        return view('backend.report.expense',compact('expense','date'));
    }
    public function expense_report($from_date,$to_date)
    {
        $date['from_date'] = $from_date;
        $date['to_date'] = $to_date;
        $expense = Expense::whereDate('date','>=', $from_date)
                ->whereDate('date','<=', $to_date)
                ->get();
        return view('backend.report.expense',compact('expense','date'));
    }
    public function expense_report_print($from_date,$to_date)
    {
        $expense = Expense::whereDate('date','>=', $from_date)
                ->whereDate('date','<=', $to_date)
                ->get();
        return view('backend.report.expense_report_print',compact('expense','from_date','to_date'));
    }

    public function incomeIndex()
    {
        $date['from_date'] = today()->format('d-M-Y');
        $date['to_date'] = today()->format('d-M-Y');
        $patient = pathologyPatient::whereDate('created_at',Carbon::today())
                ->where('paid_amount','!=',0)
                ->get();
        return view('backend.report.income',compact('patient','date'));
    }
    public function income_report($from_date,$to_date)
    {
        $date['from_date'] = $from_date;
        $date['to_date'] = $to_date;
        $patient = pathologyPatient::whereDate('updated_at','>=', $from_date)
                ->whereDate('updated_at','<=', $to_date)
                ->where('paid_amount','!=',0)
                ->get();
        return view('backend.report.income',compact('patient','date'));
    }
    public function income_report_print($from_date,$to_date)
    {
        $patient = pathologyPatient::whereDate('created_at','>=', $from_date)
                ->whereDate('created_at','<=', $to_date)
                ->where('paid_amount','!=',0)
                ->get();
        return view('backend.report.income_report_print',compact('patient','from_date','to_date'));
    }

    // due report function start 
    public function dueIndex()
    {
        $date['from_date'] = today()->format('d-M-Y');
        $date['to_date'] = today()->format('d-M-Y');
        $patient = pathologyPatient::whereDate('created_at',Carbon::today())
                ->where('due_amount','!=',0)
                ->get();
        return view('backend.report.due',compact('patient','date'));
    }
    public function due_report($from_date,$to_date)
    {
        $date['from_date'] = $from_date;
        $date['to_date'] = $to_date;
        $patient = pathologyPatient::whereDate('updated_at','>=', $from_date)
                ->whereDate('updated_at','<=', $to_date)
                ->where('due_amount','!=',0)
                ->get();
        return view('backend.report.due',compact('patient','date'));
    }

    public function due_report_print($from_date,$to_date)
    {
        $patient = pathologyPatient::whereDate('created_at','>=', $from_date)
                ->whereDate('created_at','<=', $to_date)
                ->where('due_amount','!=',0)
                ->get();
        return view('backend.report.due_report_print',compact('patient','from_date','to_date'));
    }


    // discount report fuction start 
    public function discountIndex()
    {
        $date['from_date'] = today()->format('d-M-Y');
        $date['to_date'] = today()->format('d-M-Y');
        $patient = pathologyPatient::whereDate('created_at',Carbon::today())
                ->where('discount_amount','!=',0)
                ->get();
        return view('backend.report.discount',compact('patient','date'));
    }
    public function discount_report($from_date,$to_date)
    {
        $date['from_date'] = $from_date;
        $date['to_date'] = $to_date;
        $patient = pathologyPatient::whereDate('updated_at','>=', $from_date)
                ->whereDate('updated_at','<=', $to_date)
                ->where('discount_amount','!=',0)
                ->get();
        return view('backend.report.discount',compact('patient','date'));
    }

    public function discount_report_print($from_date,$to_date)
    {
        $patient = pathologyPatient::whereDate('created_at','>=', $from_date)
                ->whereDate('created_at','<=', $to_date)
                ->where('discount_amount','!=',0)
                ->get();
        return view('backend.report.discount_report_print',compact('patient','from_date','to_date'));
    }
}
