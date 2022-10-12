<?php

namespace App\Http\Controllers\Backend\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense\Account;
use App\Models\Expense\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.statement.expense.expense');
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
            'category_id' => 'required',
            'amount' => 'required',
            'details' => 'required',
            'date' => 'required',
        ]);
        $data = $request->all();
        $amount = Account::find(1);
        $debit = $amount['debit'] + $request->amount;
        $balance = $amount['balance'] - $request->amount;
        $amount->update([
            'debit' => $debit,
            'balance' => $balance,
        ]);
        Expense::create($data);
        notify()->success('Expense Create Successfully');
        return redirect()->route('app.expense.index');
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
        $data = Expense::find($id);
        return response()->json(['data' => $data]);
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
        $expense = Expense::find($request->expense_id);
        $request->validate([
            'category_id' => 'required',
            'amount' => 'required',
            'details' => 'required',
            'date' => 'required',
        ]);
        $data = $request->all();
        if ($expense['amount'] != $request->amount) {
            $amount = Account::find(1);
            if ($expense['amount'] > $request->amount) {
                $net = $expense['amount'] - $request->amount;
                $amount['debit'] -= $net;
                $amount['balance'] += $net;
                $amount->save();
            }else{
                $net = $request->amount - $expense['amount'];
                $amount['debit'] += $net;
                $amount['balance'] -= $net;
                $amount->save();
            }
            
        }
        $expense->update($data);
        notify()->success('Expense Update Successfully');
        return redirect()->route('app.expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $amount = Account::find(1);
        $amount['debit'] -= $expense['amount'];
        $amount['balance'] += $expense['amount'];
        $amount->save();
        $expense->delete();
        return response()->json($expense);
    }
}
