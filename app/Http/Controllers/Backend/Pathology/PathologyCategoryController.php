<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Http\Controllers\Controller;
use App\Models\Pathology\pathologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PathologyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = pathologyCategory::all();
        return view('backend.pathology.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pathology.category.create');
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
            'name'  => 'required|unique:pathology_categories'
        ]);

        pathologyCategory::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name)
        ]);

        notify()->success('Category Created');
        return redirect()->route('app.pathology.category.index');
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
        $category = pathologyCategory::findOrfail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'  => 'required|unique:pathology_categories'
        ]);

        pathologyCategory::findOrfail($request->category_id)->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name)
        ]);

        notify()->success('Category Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = pathologyCategory::findOrfail($id);
        $category->delete();
        return response()->json($category);
    }
}
