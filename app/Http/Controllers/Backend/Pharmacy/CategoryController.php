<?php

namespace App\Http\Controllers\Backend\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy\Category;
use App\Models\Pharmacy\pharmacyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = pharmacyCategory::all();
        return view('backend.pharmacy.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pharmacy.category.create');
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
            'name'  => 'required|max:100|unique:pharmacy_categories'
        ]);

        pharmacyCategory::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name)
        ]);

        notify()->success("Category Created");
        return redirect()->route('app.pharmacy.category.index');
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
       $category = pharmacyCategory::findOrfail($id);
       return view('backend.pharmacy.category.create',compact('category'));
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
            'name'  => 'required|max:100',
        ]);

        $category = pharmacyCategory::findOrfail($id)->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name)
        ]);

        notify()->success("Category Updated");
        return redirect()->route('app.pharmacy.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = pharmacyCategory::findOrfail($id);
        $category->delete();
        return response()->json($category);
        
    }
}
