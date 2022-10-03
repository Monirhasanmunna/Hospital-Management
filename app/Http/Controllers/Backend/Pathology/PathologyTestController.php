<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Pathology\pathologyCategory;
use App\Models\Pathology\pathologyTest;
use Illuminate\Http\Request;

class PathologyTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = pathologyTest::all();
        $categories = pathologyCategory::all();
        return view('backend.pathology.set_test.index',compact('tests','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = pathologyTest::orderBy('id','DESC')->first();
        $categories = pathologyCategory::all();
        return view('backend.pathology.set_test.create',compact('categories','data'));
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
            'name'  => 'required|unique:pathology_tests',
            'code'  => 'required',
            'category'  => 'required',
            'standard_rate' => 'required',
            'refd_percent'  => 'sometimes',
            'refd_amount'   => 'required'
        ]);

        pathologyTest::create([
            'name'  => $request->name,
            'code'  => $request->code,
            'category_id'   => $request->category,
            'standard_rate' => $request->standard_rate,
            'refd_percent'   => $request->refd_percent,
            'refd_amount'   => $request->refd_amount
        ]);

        notify()->success('Test Created');
        return redirect()->route('app.setting.test.index');
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
       $test = pathologyTest::with('category')->findOrfail($id);
       return response()->json($test);
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
            'category'  => 'required',
            'standard_rate' => 'required',
            'refd_percent'  => 'sometimes',
            'refd_amount'   => 'required'
        ]);

        pathologyTest::findOrfail($request->test_id)->update([
            'name'  => $request->name,
            'code'  => $request->code,
            'category_id'   => $request->category,
            'standard_rate' => $request->standard_rate,
            'refd_percent'   => $request->refd_percent,
            'refd_amount'   => $request->refd_amount
        ]);

        notify()->success('Test Updated');
        return redirect()->route('app.setting.test.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = pathologyTest::findOrfail($id);
        $test->delete();
        return response()->json($test);
    }
}
