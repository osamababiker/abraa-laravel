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
use App\Http\Controllers\Admin\HomeSlidersController;
use App\Http\Controllers\Admin\HomeBannersController;
use App\Http\Controllers\Admin\AdsCategoriesController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\MembershipsPlansController;
use App\Http\Controllers\Admin\MembershipsTransactionsController;

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


    // ======================= Home Sliders Routes ====================== //
    // table actions route
    Route::post('homeSliders/actions', 
        [HomeSlidersController::class , 'actions']
    )->name('homeSliders.actions');
    // get sliders as json route 
    Route::get('homeSliders/json', [
        HomeSlidersController::class, 'getSlidersAsJson'
    ])->name('homeSliders.json');
        // filter sliders  route 
    Route::post('homeSliders/filter', [
        HomeSlidersController::class, 'filterSliders'
    ])->name('homeSliders.filter');
    // to import & export excel 
    Route::get('homeSliders/export/excel', [
        HomeSlidersController::class, 'exportExcel'
    ])->name('homeSliders.export.excel');
    Route::post('homeSliders/import/excel', [
        HomeSlidersController::class, 'importExcel'
    ])->name('homeSliders.import.excel');
    Route::get('homeSliders/importExportView',  [
        HomeSlidersController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('homeSliders/{id}/destroy', [
        HomeSlidersController::class, 'destroy'
    ]);
    Route::resource('homeSliders', HomeSlidersController::class, ['except' => ['destroy']]);


    // ======================= Home banners Routes ====================== //
    // table actions route
    Route::post('homeBanners/actions', 
        [HomeBannersController::class , 'actions']
    )->name('homeBanners.actions');
    // get Banners as json route 
    Route::get('homeBanners/json', [
        HomeBannersController::class, 'getBannersAsJson'
    ])->name('homeBanners.json');
        // filter Banners  route 
    Route::post('homeBanners/filter', [
        HomeBannersController::class, 'filterBanners'
    ])->name('homeBanners.filter');
    // to import & export excel 
    Route::get('homeBanners/export/excel', [
        HomeBannersController::class, 'exportExcel'
    ])->name('homeBanners.export.excel');
    Route::post('homeBanners/import/excel', [
        HomeBannersController::class, 'importExcel'
    ])->name('homeBanners.import.excel');
    Route::get('homeBanners/importExportView',  [
        HomeBannersController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('homeBanners/{id}/destroy', [
        HomeBannersController::class, 'destroy'
    ]);
    Route::resource('homeBanners', HomeBannersController::class, ['except' => ['destroy']]);


    // ======================= Ads Categories Routes ====================== //
    // table actions route
    Route::post('adsCategories/actions', 
        [AdsCategoriesController::class , 'actions']
    )->name('adsCategories.actions');
    // get AdsCategories as json route 
    Route::get('adsCategories/json', [
        AdsCategoriesController::class, 'getadsCategoriesAsJson'
    ])->name('adsCategories.json');
        // filter AdsCategories  route 
    Route::post('adsCategories/filter', [
        AdsCategoriesController::class, 'filterAdsCategories'
    ])->name('adsCategories.filter');
    // to import & export excel 
    Route::get('adsCategories/export/excel', [
        AdsCategoriesController::class, 'exportExcel'
    ])->name('adsCategories.export.excel');
    Route::post('adsCategories/import/excel', [
        AdsCategoriesController::class, 'importExcel'
    ])->name('adsCategories.import.excel');
    Route::get('adsCategories/importExportView',  [
        AdsCategoriesController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('adsCategories/{id}/destroy', [
        AdsCategoriesController::class, 'destroy'
    ]);
    Route::resource('adsCategories', AdsCategoriesController::class, ['except' => ['destroy']]);


    // ======================= Ads Routes ====================== //
    // table actions route
    Route::post('ads/actions', 
        [AdsController::class , 'actions']
    )->name('ads.actions');
    // get ads as json route 
    Route::get('ads/json', [
        AdsController::class, 'getadsAsJson'
    ])->name('ads.json');
        // filter ads  route 
    Route::post('ads/filter', [
        AdsController::class, 'filterAds'
    ])->name('ads.filter');
    // to import & export excel 
    Route::get('ads/export/excel', [
        AdsController::class, 'exportExcel'
    ])->name('ads.export.excel');
    Route::post('ads/import/excel', [
        AdsController::class, 'importExcel'
    ])->name('ads.import.excel');
    Route::get('ads/importExportView',  [
        AdsController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('ads/{id}/destroy', [
        AdsController::class, 'destroy'
    ]);
    Route::resource('ads', AdsController::class, ['except' => ['destroy']]);


    // ======================= Memberships Plans Routes ====================== //
    // table actions route
    Route::post('membershipsPlans/actions', 
        [MembershipsPlansController::class , 'actions']
    )->name('membershipsPlans.actions');
    // get memberships Plans as json route 
    Route::get('membershipsPlans/json', [
        MembershipsPlansController::class, 'getMembershipsPlansAsJson'
    ])->name('membershipsPlans.json');
        // filter memberships Plans  route 
    Route::post('membershipsPlans/filter', [
        MembershipsPlansController::class, 'filterMembershipsPlansPlans'
    ])->name('membershipsPlans.filter');
    // to import & export excel 
    Route::get('membershipsPlans/export/excel', [
        MembershipsPlansController::class, 'exportExcel'
    ])->name('membershipsPlans.export.excel');
    Route::post('membershipsPlans/import/excel', [
        MembershipsPlansController::class, 'importExcel'
    ])->name('membershipsPlans.import.excel');
    Route::get('membershipsPlans/importExportView',  [
        MembershipsPlansController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('membershipsPlans/{id}/destroy', [
        MembershipsPlansController::class, 'destroy'
    ]);
    Route::resource('membershipsPlans', MembershipsPlansController::class, ['except' => ['destroy']]);


    // ======================= Memberships Transactions Routes ====================== //
    // table actions route
    Route::post('membershipsTransactions/actions', 
        [MembershipsTransactionsController::class , 'actions']
    )->name('membershipsTransactions.actions');
    // get memberships Plans as json route 
    Route::get('membershipsTransactions/json', [
        MembershipsTransactionsController::class, 'getMembershipsTransactionsAsJson'
    ])->name('membershipsTransactions.json');
        // filter memberships Plans  route 
    Route::post('membershipsTransactions/filter', [
        MembershipsTransactionsController::class, 'filterMembershipsTransactions'
    ])->name('membershipsTransactions.filter');
    // to import & export excel 
    Route::get('membershipsTransactions/export/excel', [
        MembershipsTransactionsController::class, 'exportExcel'
    ])->name('membershipsTransactions.export.excel');
    Route::post('membershipsTransactions/import/excel', [
        MembershipsTransactionsController::class, 'importExcel'
    ])->name('membershipsTransactions.import.excel');
    Route::get('membershipsTransactions/importExportView',  [
        MembershipsTransactionsController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('membershipsTransactions/{id}/destroy', [
        MembershipsTransactionsController::class, 'destroy'
    ]);
    Route::resource('membershipsTransactions', MembershipsTransactionsController::class, ['except' => ['destroy']]);


});





