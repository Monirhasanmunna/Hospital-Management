<?php

namespace App\Http\Controllers\Backend\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy\pharmacySupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PharmacySupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = pharmacySupplier::all();
        return view('backend.pharmacy.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pharmacy.supplier.create');
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
            'name'  => 'required|max:200|unique:pharmacy_suppliers',
            'code'  => 'required'
        ]);

        pharmacySupplier::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
            'code'  => $request->code
        ]);

        notify()->success('Supplier Created');
        return redirect()->route('app.pharmacy.supplier.index');
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
        $supplier = pharmacySupplier::findOrfail($id);
        return view('backend.pharmacy.supplier.create',compact('supplier'));
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
            'name'  => 'required|max:200',
            'code'  => 'required'
        ]);

        pharmacySupplier::findOrfail($id)->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
            'code'  => $request->code
        ]);

        notify()->success('Supplier Updated');
        return redirect()->route('app.pharmacy.supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = pharmacySupplier::findOrfail($id);
        $supplier->delete();
        return response()->json('success');
    }
}
