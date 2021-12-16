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
    // custom delete route
    Route::get('rfq/{id}/destroy', [
        RfqsController::class, 'destroy'
    ]);
    // pending  rfq route
    Route::get('rfq/pending', [
        RfqsController::class, 'pending_rfq'
    ])->name('rfq.pending');
    // resource route
    Route::resource('rfq', RfqsController::class);

    // ======================= Items Routes ====================== //
    // table actions route
    Route::post('items/actions', 
        [ItemsController::class , 'actions']
    )->name('items.actions');
    // custom delete route
    Route::get('items/{id}/destroy', [
        ItemsController::class, 'destroy'
    ]);
    // active items route
    Route::get('items/active', [
        ItemsController::class, 'active_items'
    ])->name('items.active');
    // resource route
    Route::resource('items', ItemsController::class, ['except' => ['destroy']]);
    
    // ======================= Categories Routes ====================== //
    // resource route
    Route::resource('categories', CategoriesController::class);

});





