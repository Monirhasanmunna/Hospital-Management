<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Pathology\pathologyReferral;
use Illuminate\Http\Request;

class pathologyReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referrals = pathologyReferral::all();
        return view('backend.pathology.referral.index',compact('referrals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $referral = pathologyReferral::orderBy('id','DESC')->first();
        return view('backend.pathology.referral.create',compact('referral'));
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
            'code'  => 'required',
            'mobile'=> 'required'
        ]);

        pathologyReferral::create([
            'name'      => $request->name,
            'code'      => $request->code,
            'mobile'    => $request->mobile
        ]);

        notify()->success('Referral Created');
        return redirect()->route('app.setting.referral.index');
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
        $referral = pathologyReferral::findOrfail($id);
        return response()->json($referral);
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
            'code'  => 'required',
            'mobile'=> 'required'
        ]);

        pathologyReferral::findOrfail($request->referral_id)->update([
            'name'      => $request->name,
            'code'      => $request->code,
            'mobile'    => $request->mobile
        ]);

        notify()->success('Referral Updated');
        return redirect()->route('app.setting.referral.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $referral = pathologyReferral::findOrfail($id)->delete();
        return response()->json($referral);
    }
}
