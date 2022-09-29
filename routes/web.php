<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Pharmacy\CategoryController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';



Route::get('/', [AuthenticatedSessionController::class, 'login'])->middleware('guest');

Route::group(['as'=>'app.','prefix'=>'app','namespace'=>'Backend','middleware'=>['auth']],function(){

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::group(['as'=>'pharmacy.category.','prefix'=>'pharmacy/category','namespace'=>'Pharmacy'],function(){
        
        Route::get('/index',[CategoryController::class,'index'])->name('index');
        Route::get('/create',[CategoryController::class,'create'])->name('create');
        Route::post('/store',[CategoryController::class,'store'])->name('store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[CategoryController::class,'update'])->name('update');
        Route::get('/delete/{id}',[CategoryController::class,'destroy'])->name('delete');
    });

});
