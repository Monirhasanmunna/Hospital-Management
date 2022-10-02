<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Pathology\PathologyCategoryController;
use App\Http\Controllers\Backend\Pathology\PathologyTestController;
use App\Http\Controllers\Backend\Pharmacy\PharmacyCategoryController;
use App\Http\Controllers\Backend\Pharmacy\PharmacySupplierController;
use App\Http\Controllers\Backend\Pathology\PathologyUnitController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';



Route::get('/', [AuthenticatedSessionController::class, 'login'])->middleware('guest');

Route::group(['as'=>'app.','prefix'=>'app','namespace'=>'Backend','middleware'=>['auth']],function(){

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::group(['as'=>'pharmacy.category.','prefix'=>'pharmacy/category','namespace'=>'Pharmacy'],function(){
        
        Route::get('/index',[PharmacyCategoryController::class,'index'])->name('index');
        Route::get('/create',[PharmacyCategoryController::class,'create'])->name('create');
        Route::post('/store',[PharmacyCategoryController::class,'store'])->name('store');
        Route::get('/edit/{id}',[PharmacyCategoryController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[PharmacyCategoryController::class,'update'])->name('update');
        Route::get('/delete/{id}',[PharmacyCategoryController::class,'destroy'])->name('delete');
    });

    Route::group(['as'=>'pharmacy.supplier.','prefix'=>'pharmacy/supplier','namespace'=>'Pharmacy'],function(){
        
        Route::get('/index',[PharmacySupplierController::class,'index'])->name('index');
        Route::get('/create',[PharmacySupplierController::class,'create'])->name('create');
        Route::post('/store',[PharmacySupplierController::class,'store'])->name('store');
        Route::get('/edit/{id}',[PharmacySupplierController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[PharmacySupplierController::class,'update'])->name('update');
        Route::get('/delete/{id}',[PharmacySupplierController::class,'destroy'])->name('delete');
    });


    Route::group(['as'=>'pathology.category.','prefix'=>'pathology/category','namespace'=>'Pathology'],function(){
        
        Route::get('/index',[PathologyCategoryController::class,'index'])->name('index');
        Route::get('/create',[PathologyCategoryController::class,'create'])->name('create');
        Route::post('/store',[PathologyCategoryController::class,'store'])->name('store');
        Route::get('/edit/{id}',[PathologyCategoryController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[PathologyCategoryController::class,'update'])->name('update');
        Route::get('/delete/{id}',[PathologyCategoryController::class,'destroy'])->name('delete');
    });

    Route::group(['as'=>'pathology.unit.','prefix'=>'pathology/unit','namespace'=>'Pathology'],function(){
        
        Route::get('/index',[PathologyUnitController::class,'index'])->name('index');
        Route::get('/create',[PathologyUnitController::class,'create'])->name('create');
        Route::post('/store',[PathologyUnitController::class,'store'])->name('store');
        Route::get('/edit/{id}',[PathologyUnitController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[PathologyUnitController::class,'update'])->name('update');
        Route::get('/delete/{id}',[PathologyUnitController::class,'destroy'])->name('delete');
    });


    Route::group(['as'=>'pathology.test.','prefix'=>'pathology/test','namespace'=>'Pathology'],function(){
        
        Route::get('/index',[PathologyTestController::class,'index'])->name('index');
        Route::get('/create',[PathologyTestController::class,'create'])->name('create');
        Route::post('/store',[PathologyTestController::class,'store'])->name('store');
        Route::get('/edit/{id}',[PathologyTestController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[PathologyTestController::class,'update'])->name('update');
        Route::get('/delete/{id}',[PathologyTestController::class,'destroy'])->name('delete');
    });
});
