<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\ShippersController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\BuyersController;
use App\Http\Controllers\Admin\rfqsController;

/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ======================= Auth Routes ====================== //
Route::get('/login',[AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::get('/register',[AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);
Route::middleware('auth')->group(function () {
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
});

// to reset password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => 'auth'], function (){



    // ======================= Home Routes ====================== //
    Route::get('/', [
        HomeController::class , 'index'
    ])->name('admin.index');


    // ======================= Suppliers Routes ====================== //
    // table actions route
    Route::post('suppliers/actions', 
        [SuppliersController::class , 'actions']
    )->name('suppliers.actions');    
    // get suppliers as json route 
    Route::get('suppliers/json', [
        SuppliersController::class, 'getSuppliersAsJson'
    ])->name('suppliers.json');
       // filter suppliers  route 
    Route::post('suppliers/filter', [
        SuppliersController::class, 'filterSuppliers'
    ])->name('suppliers.filter');
     // custom delete route 
     Route::get('suppliers/{id}/destroy', [ 
        SuppliersController::class, 'destroy'
    ]);
    // to import & export excel 
    Route::get('suppliers/export/excel', [
        SuppliersController::class, 'exportExcel'
    ])->name('suppliers.export.excel');
    Route::post('suppliers/import/excel', [
        SuppliersController::class, 'importExcel'
    ])->name('suppliers.import.excel');
    Route::get('suppliers/importExportView',  [
        SuppliersController::class, 'importExportView'
    ]);
    // organic suppliers route
    Route::get('suppliers/organic', [
        SuppliersController::class, 'organic_suppliers'
    ])->name('suppliers.organic');
    // resource route
    Route::resource('suppliers', SuppliersController::class, ['except' => ['destroy']]);


    // ======================= Shippers Routes ====================== //
    // table actions route
    Route::post('shippers/actions', 
        [ShippersController::class , 'actions']
    )->name('shippers.actions');    
    // get suppliers as json route 
    Route::get('shippers/json', [
        ShippersController::class, 'getShippersAsJson'
    ])->name('shippers.json');
       // filter shippers  route 
    Route::post('shippers/filter', [
        ShippersController::class, 'filterShippers'
    ])->name('shippers.filter');
     // to import & export excel 
     Route::get('shippers/export/excel', [
        ShippersController::class, 'exportExcel'
    ])->name('shippers.export.excel');
    Route::post('shippers/import/excel', [
        ShippersController::class, 'importExcel'
    ])->name('shippers.import.excel');
    Route::get('shippers/importExportView',  [
        ShippersController::class, 'importExportView'
    ]);
     // custom delete route 
     Route::get('shippers/{id}/destroy', [ 
        ShippersController::class, 'destroy'
    ]);
    // resource route
    Route::resource('shippers', ShippersController::class, ['except' => ['destroy']]);


    // ======================= Stores Routes ====================== //
    // table actions route
    Route::post('stores/actions', 
        [StoresController::class , 'actions']
    )->name('stores.actions');
    // get stores as json route 
    Route::get('stores/json', [
        StoresController::class, 'getStoresAsJson'
    ])->name('stores.json');
        // filter stores  route 
    Route::post('stores/filter', [
        StoresController::class, 'filterStores'
    ])->name('stores.filter'); 
    // to import & export excel 
    Route::get('stores/export/excel', [
        StoresController::class, 'exportExcel'
    ])->name('stores.export.excel');
    Route::post('stores/import/excel', [
        StoresController::class, 'importExcel'
    ])->name('stores.import.excel');
    Route::get('stores/importExportView',  [
        StoresController::class, 'importExportView'
    ]);   
    // custom delete route 
    Route::get('stores/{id}/destroy', [
        StoresController::class, 'destroy'
    ]);
    // resource route
    Route::resource('stores', StoresController::class, ['except' => ['destroy']]);


    // ======================= Buyers Routes ====================== //
    // table actions route
    Route::post('buyers/actions', 
        [BuyersController::class , 'actions']
    )->name('buyers.actions');
    // get buyers as json route 
      Route::get('buyers/json', [
        BuyersController::class, 'getBuyersAsJson'
    ])->name('buyers.json');
       // filter buyers  route 
    Route::post('buyers/filter', [
        BuyersController::class, 'filterBuyers'
    ])->name('buyers.filter');  
    // to import & export excel 
    Route::get('buyers/export/excel', [
        BuyersController::class, 'exportExcel'
    ])->name('buyers.export.excel');
    Route::post('buyers/import/excel', [
        BuyersController::class, 'importExcel'
    ])->name('buyers.import.excel');
    Route::get('buyers/importExportView',  [
        BuyersController::class, 'importExportView'
    ]); 
    // custom delete route 
    Route::get('buyers/{id}/destroy', [
        BuyersController::class, 'destroy'
    ]);
    // resource route
    Route::resource('buyers', BuyersController::class);


     // ======================= rfqs Routes ====================== //
     // table actions route
     Route::post('rfqs/actions', 
        [rfqsController::class , 'actions']
    )->name('buyers.actions');  
     // get rfqs as json route 
     Route::get('rfqs/json', [
        rfqsController::class, 'getrfqsAsJson'
    ])->name('rfqs.json');
        // filter rfqs  route 
    Route::post('rfqs/filter', [
        rfqsController::class, 'filterrfqs'
    ])->name('rfqs.filter');
    // to import & export excel 
    Route::get('rfqs/export/excel', [
        rfqsController::class, 'exportExcel'
    ])->name('rfqs.export.excel');
    Route::post('rfqs/import/excel', [
        rfqssController::class, 'importExcel'
    ])->name('rfqs.import.excel');
    Route::get('rfqs/importExportView',  [
        rfqsController::class, 'importExportView'
    ]);    
    // custom delete route
    Route::get('rfqs/{id}/destroy', [
        rfqsController::class, 'destroy'
    ]);
    // resource route
    Route::resource('rfqs', rfqsController::class);


    // ======================= Items Routes ====================== //
    // table actions route
    Route::post('items/actions', 
        [ItemsController::class , 'actions']
    )->name('items.actions');
    // get items as json route 
    Route::get('items/json', [
        ItemsController::class, 'getItemsAsJson'
    ])->name('items.json');
        // filter items  route 
    Route::post('items/filter', [
        ItemsController::class, 'filterItems'
    ])->name('items.filter');
    // to import & export excel 
    Route::get('items/export/excel', [
        ItemsController::class, 'exportExcel'
    ])->name('items.export.excel');
    Route::post('items/import/excel', [
        ItemsController::class, 'importExcel'
    ])->name('items.import.excel');
    Route::get('items/importExportView',  [
        ItemsController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('items/{id}/destroy', [
        ItemsController::class, 'destroy'
    ]);
    // resource route
    Route::resource('items', ItemsController::class, ['except' => ['destroy']]);
    

    // ======================= Categories Routes ====================== //
    // table actions route
    Route::post('categories/actions', 
        [CategoriesController::class , 'actions']
    )->name('items.actions');
    // get categories as json route 
    Route::get('categories/json', [
        CategoriesController::class, 'getCategoriesAsJson'
    ])->name('categories.json');
        // filter categories  route 
    Route::post('categories/filter', [
        CategoriesController::class, 'filterCategories'
    ])->name('categories.filter');
    // to import & export excel 
    Route::get('categories/export/excel', [
        CategoriesController::class, 'exportExcel'
    ])->name('categories.export.excel');
    Route::post('categories/import/excel', [
        CategoriesController::class, 'importExcel'
    ])->name('categories.import.excel');
    Route::get('categories/importExportView',  [
        CategoriesController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('categories/{id}/destroy', [
        CategoriesController::class, 'destroy'
    ]);
    // resource route
    Route::resource('categories', CategoriesController::class);



});





