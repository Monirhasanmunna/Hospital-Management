<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Pathology\PathologyCategoryController;
use App\Http\Controllers\Backend\Pathology\pathologyDoctorController;
use App\Http\Controllers\Backend\Pathology\pathologyPatientController;
use App\Http\Controllers\Backend\Pathology\pathologyReferralController;
use App\Http\Controllers\Backend\Pathology\PathologyTestController;
use App\Http\Controllers\Backend\Pharmacy\PharmacyCategoryController;
use App\Http\Controllers\Backend\Pharmacy\PharmacySupplierController;
use App\Http\Controllers\Backend\Pathology\PathologyUnitController;
use App\Models\Pathology\pathologyPatient;
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


    Route::group(['as'=>'setting.test.','prefix'=>'setting/test','namespace'=>'Pathology'],function(){
        
        Route::get('/index',[PathologyTestController::class,'index'])->name('index');
        Route::get('/create',[PathologyTestController::class,'create'])->name('create');
        Route::post('/store',[PathologyTestController::class,'store'])->name('store');
        Route::get('/edit/{id}',[PathologyTestController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[PathologyTestController::class,'update'])->name('update');
        Route::get('/delete/{id}',[PathologyTestController::class,'destroy'])->name('delete');
        
    });

    Route::group(['as'=>'setting.doctor.','prefix'=>'setting/doctor','namespace'=>'Pathology'],function(){
        
        Route::get('/index',[pathologyDoctorController::class,'index'])->name('index');
        Route::get('/create',[pathologyDoctorController::class,'create'])->name('create');
        Route::post('/store',[pathologyDoctorController::class,'store'])->name('store');
        Route::get('/edit/{id}',[pathologyDoctorController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[pathologyDoctorController::class,'update'])->name('update');
        Route::get('/delete/{id}',[pathologyDoctorController::class,'destroy'])->name('delete');
        
    });

    Route::group(['as'=>'setting.referral.','prefix'=>'setting/referral','namespace'=>'Pathology'],function(){
        
        Route::get('/index',[pathologyReferralController::class,'index'])->name('index');
        Route::get('/create',[pathologyReferralController::class,'create'])->name('create');
        Route::post('/store',[pathologyReferralController::class,'store'])->name('store');
        Route::get('/edit/{id}',[pathologyReferralController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[pathologyReferralController::class,'update'])->name('update');
        Route::get('/delete/{id}',[pathologyReferralController::class,'destroy'])->name('delete');
        
    });

    Route::group(['as'=>'pathology.patient.','prefix'=>'pathology/patient','namespace'=>'Pathology'],function(){
        
        Route::get('/index',[pathologyPatientController::class,'index'])->name('index');
        Route::get('/create',[pathologyPatientController::class,'create'])->name('create');
        Route::post('/store',[pathologyPatientController::class,'store'])->name('store');
        Route::get('/edit/{id}',[pathologyPatientController::class,'edit'])->name('edit');
        Route::get('/invoice/{id}',[pathologyPatientController::class,'invoice'])->name('invoice');
        Route::post('/update/{id}',[pathologyPatientController::class,'update'])->name('update');
        Route::get('/delete/{id}',[pathologyPatientController::class,'destroy'])->name('delete');
        
        // Ajax Route
        Route::get('/test/{id}',[pathologyPatientController::class,'testInfoById']);
        Route::get('/patient/{id}',[pathologyPatientController::class,'patientInfoById']);
        
    });

});
