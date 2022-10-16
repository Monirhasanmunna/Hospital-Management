<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.index');
    }

    public function edit($id)
    {
        $data = GeneralSetting::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $setting = GeneralSetting::find($request->general_setting_id);
        $data = $request->all();
        $data['logo'] = 'default.jpg';
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $des = 'backend/img/logo/';
            $name = time().'.'. $file->getClientOriginalExtension();
            $file->move($des,$name);
            $data['logo'] = $name;
        }
        $setting->update($data);
        notify()->success('General Setting Update Successfully');
        return redirect()->route('app.general_setting.index');
    }
}
