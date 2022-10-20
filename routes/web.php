<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\Bed\BedController;
use App\Http\Controllers\Backend\Bed\BedGroupController;
use App\Http\Controllers\Backend\Bed\BedTypeController;
use App\Http\Controllers\Backend\Bed\FloorController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Expense\AccountController;
use App\Http\Controllers\Backend\Expense\ExpenseCategoryController;
use App\Http\Controllers\Backend\Expense\ExpenseController;
use App\Http\Controllers\Backend\Finance\DueCollectionController;
use App\Http\Controllers\Backend\Income\incomeController;
use App\Http\Controllers\Backend\Pathology\PathologyCategoryController;
use App\Http\Controllers\Backend\Pathology\pathologyDoctorController;
use App\Http\Controllers\Backend\Pathology\pathologyPatientController;
use App\Http\Controllers\Backend\Pathology\pathologyReferralController;
use App\Http\Controllers\Backend\Pathology\PathologyTestController;
use App\Http\Controllers\Backend\Pharmacy\PharmacyCategoryController;
use App\Http\Controllers\Backend\Pharmacy\PharmacySupplierController;
use App\Http\Controllers\Backend\Pathology\PathologyUnitController;
use App\Http\Controllers\Backend\Report\ReportController;
use App\Http\Controllers\Backend\Setting\GeneralSettingController;
use App\Models\Pathology\pathologyPatient;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';


// Route::get('/',function(){
//     return view('backend.bed.floor.bed');
// });
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


    Route::group(['as'=>'setting.category.','prefix'=>'setting/category','namespace'=>'Pathology'],function(){
        
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
        Route::get('/show/{id}',[pathologyPatientController::class,'show'])->name('show');
        
        // Ajax Route
        Route::get('/test/{id}',[pathologyPatientController::class,'testInfoById']);
        Route::get('/patient/{id}',[pathologyPatientController::class,'patientInfoById']);
    });

    // Income route section 
    Route::group(['as'=>'income.','prefix'=>'income','namespace'=>'Income'],function(){
        
        Route::get('/index',[incomeController::class,'index'])->name('index');

    });
    
    // Expense route section 
    Route::group(['as'=>'expense.','prefix'=>'expense','namespace'=>'Expense'],function(){
        
        Route::get('/index',[ExpenseController::class,'index'])->name('index');
        Route::get('/create',[ExpenseController::class,'create'])->name('create');
        Route::post('/store',[ExpenseController::class,'store'])->name('store');
        Route::get('/edit/{id}',[ExpenseController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[ExpenseController::class,'update'])->name('update');
        Route::get('/delete/{id}',[ExpenseController::class,'destroy'])->name('delete');

    });

    // Expense category route
    Route::group(['as'=>'expense.category.','prefix'=>'expense/category','namespace'=>'Expense'],function(){
        
        Route::get('/index',[ExpenseCategoryController::class,'index'])->name('index');
        Route::get('/create',[ExpenseCategoryController::class,'create'])->name('create');
        Route::post('/store',[ExpenseCategoryController::class,'store'])->name('store');
        Route::get('/edit/{id}',[ExpenseCategoryController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[ExpenseCategoryController::class,'update'])->name('update');
        Route::get('/delete/{id}',[ExpenseCategoryController::class,'destroy'])->name('delete');

    });

    


    // Floor Route
    Route::group(['as'=>'floor.','prefix'=>'setting/floor','namespace'=>'Bed'],function(){
        
        Route::get('/index',[FloorController::class,'index'])->name('index');
        Route::post('/store',[FloorController::class,'store'])->name('store');
        Route::get('/edit/{id}',[FloorController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[FloorController::class,'update'])->name('update');
        Route::get('/delete/{id}',[FloorController::class,'destroy'])->name('delete');

    });


    // Bed Group Route
    Route::group(['as'=>'bed.group.','prefix'=>'setting/bed/group','namespace'=>'Bed'],function(){
        
        Route::get('/index',[BedGroupController::class,'index'])->name('index');
        Route::post('/store',[BedGroupController::class,'store'])->name('store');
        Route::get('/edit/{id}',[BedGroupController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[BedGroupController::class,'update'])->name('update');
        Route::get('/delete/{id}',[BedGroupController::class,'destroy'])->name('delete');

    });


    // Bed Group Route
    Route::group(['as'=>'bed.type.','prefix'=>'setting/bed/type','namespace'=>'Bed'],function(){
        
        Route::get('/index',[BedTypeController::class,'index'])->name('index');
        Route::post('/store',[BedTypeController::class,'store'])->name('store');
        Route::get('/edit/{id}',[BedTypeController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[BedTypeController::class,'update'])->name('update');
        Route::get('/delete/{id}',[BedTypeController::class,'destroy'])->name('delete');

    });

    // Bed Group Route
    Route::group(['as'=>'bed.','prefix'=>'setting/bed','namespace'=>'Bed'],function(){
        
        Route::get('/index',[BedController::class,'index'])->name('index');
        Route::post('/store',[BedController::class,'store'])->name('store');
        Route::get('/edit/{id}',[BedController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[BedController::class,'update'])->name('update');
        Route::get('/delete/{id}',[BedController::class,'destroy'])->name('delete');

    });
    // General Setting Route
    Route::group(['as'=>'general_setting.','prefix'=>'setting/general_setting','namespace'=>'Setting'],function(){
        
        Route::get('/index',[GeneralSettingController::class,'index'])->name('index');
        Route::get('/edit/{id}',[GeneralSettingController::class,'edit'])->name('edit');
        Route::post('/update',[GeneralSettingController::class,'update'])->name('update');

    });


    // Account Route
    Route::group(['as'=>'account.','prefix'=>'finance/account','namespace'=>'Expense'],function(){
        
        Route::get('/index',[AccountController::class,'index'])->name('index');
        Route::get('/create',[AccountController::class,'create'])->name('create');
        Route::post('/store',[AccountController::class,'store'])->name('store');
        Route::get('/edit/{id}',[AccountController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[AccountController::class,'update'])->name('update');
        Route::get('/delete/{id}',[AccountController::class,'destroy'])->name('delete');

    });

    // finance route 
    Route::group(['prefix'=>'finance','namespace'=>'Finance'],function(){
        
        Route::get('/due_collection',[DueCollectionController::class,'index'])->name('due_collection.index');
        Route::get('/previous/details/{id}',[DueCollectionController::class, 'previousDetails']);
        Route::post('/due/payment',[DueCollectionController::class,'due_payment'])->name('due_payment');
        Route::get('/due/payment/invoice/{id}/{paid}',[DueCollectionController::class,'duepaymentInvoice']);

        Route::get('/refferel_payment',[DueCollectionController::class,'refferel_pay'])->name('refferel_pay');
        Route::get('/previous/refferal/details/{id}',[DueCollectionController::class,'previousRefferalDetails']);
        Route::post('/refferal/payment',[DueCollectionController::class,'refferal_payment'])->name('refferal_payment');
        Route::get('/refferal/payment/invoice/{id}/{paid}',[DueCollectionController::class,'refferalpaymentInvoice']);

        Route::get('/doctor_payment',[DueCollectionController::class,'doctor_pay'])->name('doctor_pay');
        Route::post('/doctor/payment',[DueCollectionController::class,'doctor_payment'])->name('doctor_payment');
        Route::get('/doctor/payment/invoice/{id}/{paid}',[DueCollectionController::class,'doctorpaymentInvoice']);

        Route::post('/addDiscount',[DueCollectionController::class, 'addDiscount'])->name('addDiscount');

    });

    // report route 
    Route::group(['as'=>'report.','prefix'=>'report','namespace'=>'Report'],function(){
        
        Route::get('/collection',[ReportController::class,'collectionIndex'])->name('collectionIndex');
        Route::get('/collectio_report/{from}/{to}',[ReportController::class,'collectio_report'])->name('collection');
        Route::get('/collection_report_print/{from}/{to}',[ReportController::class,'collection_report_print']);

        Route::get('/refd_pay',[ReportController::class,'refd_payIndex'])->name('refd');
        Route::get('/refd_pay_report/{from}/{to}',[ReportController::class, 'refd_pay_report'])->name('refd_pay');
        Route::get('/refd_pay_report_print/{from}/{to}',[ReportController::class,'refd_pay_report_print']);

        Route::get('/doctor_pay',[ReportController::class,'doctor_payIndex'])->name('doctor');
        Route::get('/doctor_pay_report/{from}/{to}',[ReportController::class,'doctor_pay_report'])->name('doctor_pay');
        Route::get('/doctor_pay_report_print/{from}/{to}',[ReportController::class,'doctor_pay_report_print']);

        Route::get('/expense',[ReportController::class,'expenseIndex'])->name('expense');
        Route::get('/expense_report/{from}/{to}',[ReportController::class,'expense_report'])->name('expense_report');
        Route::get('/expense_report_print/{from}/{to}',[ReportController::class,'expense_report_print']);

        Route::get('/income',[ReportController::class,'incomeIndex'])->name('income');
        Route::get('/income/{from}/{to}',[ReportController::class,'income_report'])->name('income_report');
        Route::get('/income_report_print/{from}/{to}',[ReportController::class,'income_report_print']);

        Route::get('/due',[ReportController::class,'dueIndex'])->name('due');
        Route::get('/due/{from}/{to}',[ReportController::class,'due_report'])->name('due_report');
        Route::get('/due_report_print/{from}/{to}',[ReportController::class,'due_report_print']);

        Route::get('/discount',[ReportController::class,'discountIndex'])->name('discount');
        Route::get('/discount/{from}/{to}',[ReportController::class,'discount_report'])->name('discount_report');
        Route::get('/discount_report_print/{from}/{to}',[ReportController::class,'discount_report_print']);


    });

});
