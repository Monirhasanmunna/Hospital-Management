<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        notify()->success("Welcome Dashboard");
        return view('backend.dashboard');
        
    }
}
