<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\BuyersController;
use App\Http\Controllers\Admin\RfqsController;

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
    // organic suppliers route
    Route::get('suppliers/organic', [
        SuppliersController::class, 'organic_suppliers'
    ])->name('suppliers.organic');
    // resource route
    Route::resource('suppliers', SuppliersController::class, ['except' => ['destroy']]);

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
    // custom delete route 
    Route::get('buyers/{id}/destroy', [
        BuyersController::class, 'destroy'
    ]);
    // resource route
    Route::resource('buyers', BuyersController::class);

     // ======================= Rfq Routes ====================== //
     // table actions route
     Route::post('rfq/actions', 
        [RfqsController::class , 'actions']
    )->name('buyers.actions');  
     // get rfq as json route 
     Route::get('rfq/json', [
        RfqsController::class, 'getRfqsAsJson'
    ])->name('rfq.json');
        // filter rfq  route 
    Route::post('rfq/filter', [
        RfqsController::class, 'filterRfqs'
    ])->name('rfq.filter');   
    // custom delete route
    Route::get('rfq/{id}/destroy', [
        RfqsController::class, 'destroy'
    ]);
    // resource route
    Route::resource('rfq', RfqsController::class);

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
    // custom delete route
    Route::get('categories/{id}/destroy', [
        CategoriesController::class, 'destroy'
    ]);
    // resource route
    Route::resource('categories', CategoriesController::class);

});





