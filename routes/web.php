<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\ShippersController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\BuyersController;
use App\Http\Controllers\Admin\BuyerMessagesController;
use App\Http\Controllers\Admin\RfqInvoicesController;
use App\Http\Controllers\Admin\RfqsController;
use App\Http\Controllers\Admin\AbandonedRfqsController;
use App\Http\Controllers\Admin\ClosedRfqsController;
use App\Http\Controllers\Admin\GlobalRfqsController;
use App\Http\Controllers\Admin\ProductRfqsController;
use App\Http\Controllers\Admin\HomeSlidersController;
use App\Http\Controllers\Admin\HomeBannersController;
use App\Http\Controllers\Admin\AdsCategoriesController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\MembershipsPlansController;
use App\Http\Controllers\Admin\MembershipsTransactionsController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\ConfigsController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\StatesController;
use App\Http\Controllers\Admin\CurrenciesController;
use App\Http\Controllers\Admin\UnitsController;
use App\Http\Controllers\Admin\PaymentOptionsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\ModeratorsController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\EmailArchivesController;
use App\Http\Controllers\Admin\SuppliersVerificationController;
use App\Http\Controllers\Admin\CacheController;

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
    // custom update route 
    Route::post('suppliers/update', [ 
        SuppliersController::class, 'update'
    ])->name('suppliers.update');
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
    /**********************************************/
    // to list items has been added by supplier
    // supplier items actions route
    Route::post('suppliers/{id}/items/actions', 
        [SuppliersController::class , 'supplierItemsActions']
    )->name('suppliers.items.actions');    
    // get supplier items as json route 
    Route::get('suppliers/{id}/items/json', [
        SuppliersController::class, 'getSuppliersItemsAsJson'
    ])->name('suppliers.items.json');
    // filter supplier items  route 
    Route::post('suppliers/{id}/items/filter', [
        SuppliersController::class, 'filterSuppliersItems'
    ])->name('suppliers.items.filter');
    // export supplier items
    Route::get('suppliers/items/{id}/export/excel', [
        SuppliersController::class, 'supplierItemsExportExcel'
    ])->name('suppliers.items.export.excel');
    // import supplier items
    Route::get('suppliers/items/{id}/importExportView',  [
        SuppliersController::class, 'supplierItemsImportExportView'
    ]);
    Route::post('suppliers/items/{id}/import/excel', [
        SuppliersController::class, 'supplierItemsImportExcel'
    ])->name('suppliers.items.import.excel');
    // custom create route for supplier items
    Route::get('suppliers/items/{id}/create', [ 
        SuppliersController::class, 'createSupplierItems'
    ])->name('suppliers.items.create');
    // custom store route for supplier items
    Route::get('suppliers/items/{id}/store', [ 
        SuppliersController::class, 'createSupplierItems'
    ])->name('suppliers.items.store');
    // custom destroy route for supplier items
    Route::get('suppliers/items/{id}/destroy', [ 
        SuppliersController::class, 'destroySupplierItems'
    ]);
    Route::get('suppliers/{id}/items',  [
        SuppliersController::class, 'supplierItems'
    ])->name('suppliers.items');

    /**********************************************/
    // to get supplier store   
    // supplier stores actions route
    Route::post('suppliers/{id}/stores/actions', 
        [SuppliersController::class , 'supplierStoresActions']
    )->name('suppliers.stores.actions');    
    // get supplier stores as json route 
    Route::get('suppliers/{id}/stores/json', [
        SuppliersController::class, 'getSuppliersStoresAsJson'
    ])->name('suppliers.stores.json');
    // filter supplier stores  route 
    Route::post('suppliers/{id}/stores/filter', [
        SuppliersController::class, 'filterSuppliersStores'
    ])->name('suppliers.stores.filter'); 
    // export supplier stores
    Route::get('suppliers/stores/{id}/export/excel', [
        SuppliersController::class, 'supplierStoresExportExcel'
    ])->name('suppliers.stores.export.excel');
    // import supplier stores
    Route::get('suppliers/stores/{id}/importExportView',  [
        SuppliersController::class, 'supplierStoresImportExportView'
    ]);
    Route::post('suppliers/stores/{id}/import/excel', [
        SuppliersController::class, 'supplierStoresImportExcel'
    ])->name('suppliers.stores.import.excel');
    // custom create route for supplier stores
    Route::get('suppliers/stores/{id}/create', [ 
        SuppliersController::class, 'createSupplierStores'
    ])->name('suppliers.stores.create');
    // custom store route for supplier stores
    Route::get('suppliers/stores/{id}/store', [ 
        SuppliersController::class, 'createSupplierStores'
    ])->name('suppliers.stores.store');
    // custom destroy route for supplier stores
    Route::get('suppliers/stores/{id}/destroy', [ 
        SuppliersController::class, 'destroySupplierStores'
    ]);
    Route::get('suppliers/{id}/stores',  [
        SuppliersController::class, 'supplierStores'
    ])->name('suppliers.stores');
    /**********************************************/
    
    /**********************************************/
    // to get supplier buyers messages   
    // supplier buyers messages actions route
    Route::post('suppliers/{id}/buyersMessages/actions', 
        [SuppliersController::class , 'supplierBuyersMessagesActions']
    )->name('suppliers.buyersMessages.actions');    
    // get supplier buyersMessages as json route 
    Route::get('suppliers/{id}/buyersMessages/json', [
        SuppliersController::class, 'getSuppliersBuyersMessagesAsJson'
    ])->name('suppliers.buyersMessages.json');
    // filter supplier buyersMessages  route 
    Route::post('suppliers/{id}/buyersMessages/filter', [
        SuppliersController::class, 'filterSuppliersBuyersMessages'
    ])->name('suppliers.buyersMessages.filter'); 
    // export supplier buyersMessages
    Route::get('suppliers/buyersMessages/{id}/export/excel', [
        SuppliersController::class, 'supplierBuyersMessagesExportExcel'
    ])->name('suppliers.buyersMessages.export.excel');
    // import supplier buyersMessages
    Route::get('suppliers/buyersMessages/{id}/importExportView',  [
        SuppliersController::class, 'supplierBuyersMessagesImportExportView'
    ]);
    Route::post('suppliers/buyersMessages/{id}/import/excel', [
        SuppliersController::class, 'supplierBuyersMessagesImportExcel'
    ])->name('suppliers.buyersMessages.import.excel');
    // custom store route for supplier buyersMessages
    Route::get('suppliers/buyersMessages/{id}/store', [ 
        SuppliersController::class, 'createSupplierBuyersMessages'
    ])->name('suppliers.buyersMessages.store');
    // custom destroy route for supplier buyersMessages
    Route::get('suppliers/buyersMessages/{id}/destroy', [ 
        SuppliersController::class, 'destroySupplierBuyersMessages'
    ]);
    Route::get('suppliers/{id}/buyersMessages',  [
        SuppliersController::class, 'supplierBuyersMessages'
    ])->name('suppliers.buyersMessages');
    /**********************************************/

    /**********************************************/
    // to get supplier Buying requests   
    // supplier Buying requests actions route
    Route::post('suppliers/{id}/buyingRequests/actions', 
        [SuppliersController::class , 'supplierBuyingRequestsActions']
    )->name('suppliers.buyingRequests.actions');    
    // get supplier buyingRequests as json route 
    Route::get('suppliers/{id}/buyingRequests/json', [
        SuppliersController::class, 'getSuppliersBuyingRequestsAsJson'
    ])->name('suppliers.buyingRequests.json');
    // filter supplier buyingRequests  route 
    Route::post('suppliers/{id}/buyingRequests/filter', [
        SuppliersController::class, 'filterSuppliersBuyingRequests'
    ])->name('suppliers.buyingRequests.filter'); 
    // export supplier buyingRequests
    Route::get('suppliers/buyingRequests/{id}/export/excel', [
        SuppliersController::class, 'supplierBuyingRequestsExportExcel'
    ])->name('suppliers.buyingRequests.export.excel');
    // import supplier buyingRequests
    Route::get('suppliers/buyingRequests/{id}/importExportView',  [
        SuppliersController::class, 'supplierBuyingRequestsImportExportView'
    ]);
    Route::post('suppliers/buyingRequests/{id}/import/excel', [
        SuppliersController::class, 'supplierBuyingRequestsImportExcel'
    ])->name('suppliers.buyingRequests.import.excel');
    // custom create route for supplier buyingRequests
    Route::get('suppliers/buyingRequests/{id}/create', [ 
        SuppliersController::class, 'createSupplierBuyingRequests'
    ])->name('suppliers.buyingRequests.create');
    // custom store route for supplier buyingRequests
    Route::get('suppliers/buyingRequests/{id}/store', [ 
        SuppliersController::class, 'createSupplierBuyingRequests'
    ])->name('suppliers.buyingRequests.store');
    // custom destroy route for supplier buyingRequests
    Route::get('suppliers/buyingRequests/{id}/destroy', [ 
        SuppliersController::class, 'destroySupplierBuyingRequests'
    ]);
    Route::get('suppliers/{id}/buyingRequests',  [
        SuppliersController::class, 'supplierBuyingRequests'
    ])->name('suppliers.buyingRequests');
    /**********************************************/

    /**********************************************/
    // to get supplier files   
    // supplier files actions route
    Route::post('suppliers/{id}/files/actions', 
        [SuppliersController::class , 'supplierFilesActions']
    )->name('suppliers.files.actions');    
    // get supplier files as json route 
    Route::get('suppliers/{id}/files/json', [
        SuppliersController::class, 'getSuppliersFilesAsJson'
    ])->name('suppliers.files.json');
    // filter supplier files  route 
    Route::post('suppliers/{id}/files/filter', [
        SuppliersController::class, 'filterSuppliersFiles'
    ])->name('suppliers.files.filter'); 
    // export supplier files
    Route::get('suppliers/files/{id}/export/excel', [
        SuppliersController::class, 'supplierFilesExportExcel'
    ])->name('suppliers.files.export.excel');
    // import supplier files
    Route::get('suppliers/files/{id}/importExportView',  [
        SuppliersController::class, 'supplierFilesImportExportView'
    ]);
    Route::post('suppliers/files/{id}/import/excel', [
        SuppliersController::class, 'supplierFilesImportExcel'
    ])->name('suppliers.files.import.excel');
    // custom store route for supplier files
    Route::get('suppliers/files/{id}/store', [ 
        SuppliersController::class, 'createSupplierFiles'
    ])->name('suppliers.files.store');
    // custom destroy route for supplier files
    Route::get('suppliers/files/{id}/destroy', [ 
        SuppliersController::class, 'destroySupplierFiles'
    ]);
    Route::get('suppliers/{id}/files',  [
        SuppliersController::class, 'supplierFiles'
    ])->name('suppliers.files');
    /**********************************************/

    /**********************************************/
    // to get supplier invoices   
    // supplier invoices actions route
    Route::post('suppliers/{id}/invoices/actions', 
        [SuppliersController::class , 'supplierInvoicesActions']
    )->name('suppliers.invoices.actions');    
    // get supplier invoices as json route 
    Route::get('suppliers/{id}/invoices/json', [
        SuppliersController::class, 'getSuppliersInvoicesAsJson'
    ])->name('suppliers.invoices.json');
    // filter supplier invoices  route 
    Route::post('suppliers/{id}/invoices/filter', [
        SuppliersController::class, 'filterSuppliersInvoices'
    ])->name('suppliers.invoices.filter'); 
    // export supplier invoices
    Route::get('suppliers/invoices/{id}/export/excel', [
        SuppliersController::class, 'supplierInvoicesExportExcel'
    ])->name('suppliers.invoices.export.excel');
    // import supplier invoices
    Route::get('suppliers/invoices/{id}/importExportView',  [
        SuppliersController::class, 'supplierInvoicesImportExportView'
    ]);
    Route::post('suppliers/invoices/{id}/import/excel', [
        SuppliersController::class, 'supplierInvoicesImportExcel'
    ])->name('suppliers.invoices.import.excel');
    // custom create route for supplier invoices
    Route::get('suppliers/invoices/{id}/create', [ 
        SuppliersController::class, 'createSupplierInvoices'
    ])->name('suppliers.invoices.create');
    // custom store route for supplier invoices
    Route::get('suppliers/invoices/{id}/store', [ 
        SuppliersController::class, 'createSupplierInvoices'
    ])->name('suppliers.invoices.store');
    // custom destroy route for supplier invoices
    Route::get('suppliers/invoices/{id}/destroy', [ 
        SuppliersController::class, 'destroySupplierInvoices'
    ]);
    Route::get('suppliers/{id}/invoices',  [
        SuppliersController::class, 'supplierInvoices'
    ])->name('suppliers.invoices');
    /**********************************************/

    /**********************************************/
    // to get supplier verifications   
    // supplier verifications actions route
    Route::post('suppliers/{id}/verifications/actions', 
        [SuppliersController::class , 'supplierVerificationsActions']
    )->name('suppliers.verifications.actions');    
    // get supplier verifications as json route 
    Route::get('suppliers/{id}/verifications/json', [
        SuppliersController::class, 'getSuppliersVerificationsAsJson'
    ])->name('suppliers.verifications.json');
    // filter supplier verifications  route 
    Route::post('suppliers/{id}/verifications/filter', [
        SuppliersController::class, 'filterSuppliersVerifications'
    ])->name('suppliers.verifications.filter'); 
    // export supplier verifications
    Route::get('suppliers/verifications/{id}/export/excel', [
        SuppliersController::class, 'suppliersVerificationsExportExcel'
    ])->name('suppliers.verifications.export.excel');
    // import supplier verifications
    Route::get('suppliers/verifications/{id}/importExportView',  [
        SuppliersController::class, 'suppliersVerificationsImportExportView'
    ]);
    Route::post('suppliers/verifications/{id}/import/excel', [
        SuppliersController::class, 'suppliersVerificationsImportExcel'
    ])->name('suppliers.verifications.import.excel');
    // custom store route for supplier verifications
    Route::get('suppliers/verifications/{id}/store', [ 
        SuppliersController::class, 'createSuppliersVerifications'
    ])->name('suppliers.verifications.store');
    // custom destroy route for supplier verifications
    Route::get('suppliers/verifications/{id}/destroy', [ 
        SuppliersController::class, 'destroySuppliersVerifications'
    ]);
    Route::get('suppliers/{id}/verifications',  [
        SuppliersController::class, 'suppliersVerifications'
    ])->name('suppliers.verifications');
    /**********************************************/

    // resource route
    Route::resource('suppliers', SuppliersController::class, ['except' => ['destroy','update']]);


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
    // custom update route 
    Route::post('shippers/update', [ 
        ShippersController::class, 'update'
    ])->name('shippers.update');
    // custom delete route 
    Route::get('shippers/{id}/destroy', [ 
        ShippersController::class, 'destroy'
    ]);
    // to get city by country 
    Route::get('shippers/create/getCities/{country_code}', [
        ShippersController::class, 'getCites'
    ]);
    // resource route
    Route::resource('shippers', ShippersController::class, ['except' => ['destroy','update']]);


    // ======================= Shipping Routes ====================== //
    // table actions route
    Route::post('shipping/actions', 
        [ShippingController::class , 'actions']
    )->name('shipping.actions');    
    // get suppliers as json route 
    Route::get('shipping/json', [
        ShippingController::class, 'getShippingAsJson'
    ])->name('shipping.json');
       // filter shipping  route 
    Route::post('shipping/filter', [
        ShippingController::class, 'filterShipping'
    ])->name('shipping.filter');
     // to import & export excel 
     Route::get('shipping/export/excel', [
        ShippingController::class, 'exportExcel'
    ])->name('shipping.export.excel');
    Route::post('shipping/import/excel', [
        ShippingController::class, 'importExcel'
    ])->name('shipping.import.excel');
    Route::get('shipping/importExportView',  [
        ShippingController::class, 'importExportView'
    ]);
    // custom update route 
    Route::post('shipping/update', [ 
        ShippingController::class, 'update'
    ])->name('shipping.update');
    // custom delete route 
    Route::get('shipping/{id}/destroy', [ 
        ShippingController::class, 'destroy'
    ]);
    // resource route
    Route::resource('shipping', ShippingController::class, ['except' => ['destroy','update']]);


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
     // custom update route 
    Route::post('stores/update', [ 
        StoresController::class, 'update'
    ])->name('stores.update');

    // ****************************************************//
    // active activeStores routs
    // get activeStores route 
     Route::get('stores/active', [
        StoresController::class, 'getActiveStores'
    ])->name('stores.active.index');
    // get activeStores as json route 
    Route::get('activeStores/json', [
        StoresController::class, 'getActiveStoresAsJson'
    ])->name('activeStores.json');
        // filter activeStores  route 
    Route::post('activeStores/filter', [
        StoresController::class, 'filterActiveStores'
    ])->name('activeStores.filter'); 
    // to import & export excel 
    Route::get('activeStores/export/excel', [
        StoresController::class, 'activeStoresexportExcel'
    ])->name('activeStores.export.excel');
    Route::post('activeStores/import/excel', [
        StoresController::class, 'activeStoresimportExcel'
    ])->name('activeStores.import.excel');
    Route::get('activeStores/importExportView',  [
        StoresController::class, 'activeStoresimportExportView'
    ]);
    
    // ****************************************************//
    // pending activeStores routs
    // get pendingStores route 
    Route::get('stores/pending', [
        StoresController::class, 'getPendingStores'
    ])->name('stores.pending.index');
    // get pendingStores as json route 
    Route::get('pendingStores/json', [
        StoresController::class, 'getPendingStoresAsJson'
    ])->name('pendingStores.json');
        // filter pendingStores  route 
    Route::post('pendingStores/filter', [
        StoresController::class, 'filterPendingStores'
    ])->name('pendingStores.filter'); 
    // to import & export excel 
    Route::get('pendingStores/export/excel', [
        StoresController::class, 'pendingStoresexportExcel'
    ])->name('pendingStores.export.excel');
    Route::post('pendingStores/import/excel', [
        StoresController::class, 'pendingStoresimportExcel'
    ])->name('pendingStores.import.excel');
    Route::get('pendingStores/importExportView',  [
        StoresController::class, 'pendingStoresimportExportView'
    ]);

    // ****************************************************//
    // rejected Stores routs
    // get rejectedStores route 
    Route::get('stores/rejected', [
        StoresController::class, 'getRejectedStores'
    ])->name('stores.rejected.index');
    // get pendingStores as json route 
    Route::get('rejectedStores/json', [
        StoresController::class, 'getRejectedStoresAsJson'
    ])->name('rejectedStores.json');
        // filter rejectedStores  route 
    Route::post('rejectedStores/filter', [
        StoresController::class, 'filterRejectedStores'
    ])->name('rejectedStores.filter'); 
    // to import & export excel 
    Route::get('rejectedStores/export/excel', [
        StoresController::class, 'RejectedStoresexportExcel'
    ])->name('rejectedStores.export.excel');
    Route::post('rejectedStores/import/excel', [
        StoresController::class, 'RejectedStoresimportExcel'
    ])->name('rejectedStores.import.excel');
    Route::get('rejectedStores/importExportView',  [
        StoresController::class, 'RejectedStoresimportExportView'
    ]);

    // ****************************************************//
    // bulk Stores routs
    // get bulk Stores route 
    Route::get('stores/bulk', [
        StoresController::class, 'getBulkStores'
    ])->name('stores.bulk.index');
    // get pendingStores as json route 
    Route::get('bulkStores/json', [
        StoresController::class, 'getBulkStoresAsJson'
    ])->name('bulkStores.json');
        // filter bulkStores  route 
    Route::post('bulkStores/filter', [
        StoresController::class, 'filterBulkStores'
    ])->name('bulkStores.filter'); 
    // to import & export excel 
    Route::get('bulkStores/export/excel', [
        StoresController::class, 'BulkStoresexportExcel'
    ])->name('bulkStores.export.excel');
    Route::post('bulkStores/import/excel', [
        StoresController::class, 'BulkStoresimportExcel'
    ])->name('bulkStores.import.excel');
    Route::get('bulkStores/importExportView',  [
        StoresController::class, 'BulkStoresimportExportView'
    ]);
    
    // ======================================//
    // to get store items
    Route::get('stores/{id}/items',  [
        StoresController::class, 'storeItems'
    ])->name('stores.items.index'); 
    // to get stores items as json
    Route::get('stores/{id}/items/json',  [
        StoresController::class, 'getStoreItemsAsJson'
    ]); 
    // to filter stores items
    Route::post('stores/{id}/items/filter',  [
        StoresController::class, 'filterStoreItems'
    ]); 

    // resource route
    Route::resource('stores', StoresController::class, ['except' => ['destroy','update']]);


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
    // to get city by country 
    Route::get('buyers/create/getCities/{country_id}', [
        BuyersController::class, 'getCites'
    ]);
    // resource route
    Route::resource('buyers', BuyersController::class);


    // ======================= Buyers Messages Routes ====================== //
    // table actions route
    Route::post('buyerMessages/actions', 
        [BuyerMessagesController::class , 'actions']
    )->name('buyerMessages.actions');
    // get buyerMessages as json route 
      Route::get('buyerMessages/json', [
        BuyerMessagesController::class, 'getBuyerMessagesAsJson'
    ])->name('buyerMessages.json');
       // filter buyerMessages  route 
    Route::post('buyerMessages/filter', [
        BuyerMessagesController::class, 'filterBuyerMessages'
    ])->name('buyerMessages.filter');  
    // to import & export excel 
    Route::get('buyerMessages/export/excel', [
        BuyerMessagesController::class, 'exportExcel'
    ])->name('buyerMessages.export.excel');
    Route::post('buyerMessages/import/excel', [
        BuyerMessagesController::class, 'importExcel'
    ])->name('buyerMessages.import.excel');
    Route::get('buyerMessages/importExportView',  [
        BuyerMessagesController::class, 'importExportView'
    ]); 
    // custom delete route 
    Route::get('buyerMessages/{id}/destroy', [
        BuyerMessagesController::class, 'destroy'
    ]);
    // resource route
    Route::resource('buyerMessages', BuyerMessagesController::class);


    // ======================= rfqs Routes ====================== //
    // table actions route
    Route::post('rfqs/actions', 
        [RfqsController::class , 'actions']
    )->name('rfqs.actions');  
    // get rfqs as json route 
     Route::get('rfqs/json', [
        RfqsController::class, 'getRfqsAsJson'
    ])->name('rfqs.json');
    // filter rfqs  route 
    Route::post('rfqs/filter', [
        RfqsController::class, 'filterRfqs' 
    ])->name('rfqs.filter');
    // to import & export excel 
    Route::get('rfqs/export/excel', [
        RfqsController::class, 'exportExcel'
    ])->name('rfqs.export.excel');
    Route::post('rfqs/import/excel', [
        RfqsController::class, 'importExcel'
    ])->name('rfqs.import.excel');
    Route::get('rfqs/importExportView',  [
        RfqsController::class, 'importExportView'
    ]);  
    // to get suppliers details for approve rfqs  
    Route::get('rfqs/approve/getSuppliersDetails', [
        RfqsController::class, 'getSuppliersDetails'
    ])->name('rfqs.getSuppliersDetails');  
    // to get Buyer and Product Details for create page  
    Route::get('rfqs/create/getBuyerProductDetails', [
        RfqsController::class, 'getBuyerProductDetails'
    ])->name('rfqs.getSuppliersDetails');  
    // to approve single rfq 
    Route::get('rfqs/{id}/approve', [
        RfqsController::class, 'approve'
    ]);
    // custom update route
    Route::post('rfqs/update', [
        RfqsController::class, 'update'
    ])->name('rfqs.update');
    // custom delete route
    Route::get('rfqs/{id}/destroy', [
        RfqsController::class, 'destroy'
    ]);
    // resource route
    Route::resource('rfqs', RfqsController::class, ['except' => ['destroy','update']]);


    // ======================= global rfqs Routes ====================== //
    // table actions route
    Route::post('globalRfqs/actions', 
        [GlobalRfqsController::class , 'actions']
    )->name('globalRfqs.actions');  
    // get globalRfqs as json route 
     Route::get('globalRfqs/json', [
        GlobalRfqsController::class, 'getGlobalRfqsAsJson'
    ])->name('globalRfqs.json');
    // filter globalRfqs  route 
    Route::post('globalRfqs/filter', [
        GlobalRfqsController::class, 'filterGlobalRfqs'
    ])->name('globalRfqs.filter');
    // to import & export excel 
    Route::get('globalRfqs/export/excel', [
        GlobalRfqsController::class, 'exportExcel'
    ])->name('globalRfqs.export.excel');
    Route::post('globalRfqs/import/excel', [
        GlobalRfqsController::class, 'importExcel'
    ])->name('globalRfqs.import.excel');
    Route::get('globalRfqs/importExportView',  [
        GlobalRfqsController::class, 'importExportView'
    ]);  
    // to send rfq to suppliers 
    Route::get('globalRfqs/{id}/send', [
        GlobalRfqsController::class, 'sendToSupploersPage'
    ]);
    Route::post('globalRfqs/suppliers/filter', [
        GlobalRfqsController::class, 'filterSuppliers'
    ]);
    Route::post('globalRfqs/{id}/send', [
        GlobalRfqsController::class, 'sendToSupploers'
    ])->name('globalRfqs.sendToSupploers');
    // to get suppliers details for approve rfqs  
    Route::get('rfqs/send/getSuppliersDetails', [
        GlobalRfqsController::class, 'getSuppliersDetails'
    ])->name('rfqs.getSuppliersDetails');  
    // custom delete route
    Route::get('globalRfqs/{id}/destroy', [
        GlobalRfqsController::class, 'destroy'
    ]);
    // resource route
    Route::resource('globalRfqs', GlobalRfqsController::class);


    // ======================= products rfqs Routes ====================== //
    // table actions route
    Route::post('productRfqs/actions', 
        [ProductRfqsController::class , 'actions']
    )->name('productRfqs.actions');  
    // get productRfqs as json route 
     Route::get('productRfqs/json', [
        ProductRfqsController::class, 'getproductRfqsAsJson'
    ])->name('productRfqs.json');
    // filter productRfqs  route 
    Route::post('productRfqs/filter', [
        ProductRfqsController::class, 'filterproductRfqs'
    ])->name('productRfqs.filter');
    // to import & export excel 
    Route::get('productRfqs/export/excel', [
        GlobalRfqsController::class, 'exportExcel'
    ])->name('productRfqs.export.excel');
    Route::post('productRfqs/import/excel', [
        ProductRfqsController::class, 'importExcel'
    ])->name('productRfqs.import.excel');
    Route::get('productRfqs/importExportView',  [
        ProductRfqsController::class, 'importExportView'
    ]);  
    // to send rfq to suppliers 
    Route::get('productRfqs/{id}/send', [
        ProductRfqsController::class, 'sendToSupploersPage'
    ]);
    Route::post('productRfqs/suppliers/filter', [
        ProductRfqsController::class, 'filterSuppliers'
    ]);
    Route::post('productRfqs/{id}/send', [
        ProductRfqsController::class, 'sendToSupploers'
    ])->name('productRfqs.sendToSupploers');
    // to get suppliers details for approve rfqs  
    Route::get('rfqs/send/getSuppliersDetails', [
        ProductRfqsController::class, 'getSuppliersDetails'
    ])->name('rfqs.getSuppliersDetails');  
    // custom delete route
    Route::get('productRfqs/{id}/destroy', [
        ProductRfqsController::class, 'destroy'
    ]);
    // resource route
    Route::resource('productRfqs', ProductRfqsController::class);


    // ======================= rfqs Invoices Routes ====================== //
    // table actions route
    Route::post('rfqInvoices/actions', 
        [RfqInvoicesController::class , 'actions']
    )->name('rfqInvoices.actions');  
     // get rfqs as json route 
     Route::get('rfqInvoices/json', [
        RfqInvoicesController::class, 'getRfqInvoicesAsJson'
    ])->name('rfqInvoices.json');
        // filter rfqInvoices  route 
    Route::post('rfqInvoices/filter', [
        RfqInvoicesController::class, 'filterRfqInvoices'
    ])->name('rfqInvoices.filter');
    // to import & export excel 
    Route::get('rfqInvoices/export/excel', [
        RfqInvoicesController::class, 'exportExcel'
    ])->name('rfqInvoices.export.excel');
    Route::post('rfqInvoices/import/excel', [
        RfqInvoicesController::class, 'importExcel'
    ])->name('rfqInvoices.import.excel');
    Route::get('rfqInvoices/importExportView',  [
        RfqInvoicesController::class, 'importExportView'
    ]);    
    // custom delete route
    Route::get('rfqInvoices/{id}/destroy', [
        RfqInvoicesController::class, 'destroy'
    ]);
    // resource route
    Route::resource('rfqInvoices', RfqInvoicesController::class);


    // ======================= Abandoned rfqs Routes ====================== //
    // table actions route
    Route::post('abandonedRfqs/actions', 
        [AbandonedRfqsController::class , 'actions']
    )->name('abandonedRfqs.actions');  
     // get abandoned Rfqs as json route 
     Route::get('abandonedRfqs/json', [
        AbandonedRfqsController::class, 'getAbandonedRfqsAsJson'
    ])->name('abandonedRfqs.json');
        // filter abandoned Rfqs  route 
    Route::post('abandonedRfqs/filter', [
        AbandonedRfqsController::class, 'filterAbandonedRfqs'
    ])->name('abandonedRfqs.filter');
    // to import & export excel 
    Route::get('abandonedRfqs/export/excel', [
        AbandonedRfqsController::class, 'exportExcel'
    ])->name('abandonedRfqs.export.excel');
    Route::post('abandonedRfqs/import/excel', [
        AbandonedRfqsController::class, 'importExcel'
    ])->name('abandonedRfqs.import.excel');
    Route::get('abandonedRfqs/importExportView',  [
        AbandonedRfqsController::class, 'importExportView'
    ]);    
    // custom delete route
    Route::get('abandonedRfqs/{id}/destroy', [
        AbandonedRfqsController::class, 'destroy'
    ]);
    // resource route
    Route::resource('abandonedRfqs', AbandonedRfqsController::class);


    // ======================= Closed rfqs Routes ====================== //
    // table actions route
    Route::post('closedRfqs/actions', 
        [ClosedRfqsController::class , 'actions']
    )->name('closedRfqs.actions');  
     // get closed Rfqs as json route 
     Route::get('closedRfqs/json', [
        ClosedRfqsController::class, 'getClosedRfqsAsJson'
    ])->name('closedRfqs.json');
        // filter closed Rfqs  route 
    Route::post('closedRfqs/filter', [
        ClosedRfqsController::class, 'filterClosedRfqs'
    ])->name('closedRfqs.filter');
    // to import & export excel 
    Route::get('closedRfqs/export/excel', [
        ClosedRfqsController::class, 'exportExcel'
    ])->name('closedRfqs.export.excel');
    Route::post('closedRfqs/import/excel', [
        ClosedRfqsController::class, 'importExcel'
    ])->name('closedRfqs.import.excel');
    Route::get('closedRfqs/importExportView',  [
        ClosedRfqsController::class, 'importExportView'
    ]);    
    // custom delete route
    Route::get('closedRfqs/{id}/destroy', [
        ClosedRfqsController::class, 'destroy'
    ]);
    // resource route
    Route::resource('closedRfqs', ClosedRfqsController::class);


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
    // to get import view
    Route::get('items/import/excel',  [
        ItemsController::class, 'importView'
    ])->name('items.import.excel'); 
    // to get supplier and category 
    // for import bulk items
    Route::get('items/import/excel/getData',  [
        ItemsController::class, 'getData'
    ])->name('items.import.excel.getData'); 
    // custom delete route
    Route::get('items/{id}/destroy', [
        ItemsController::class, 'destroy'
    ]);
    // custom update route 
    Route::post('items/update', [ 
        ItemsController::class, 'update'
    ])->name('items.update');
    // resource route
    Route::resource('items', ItemsController::class, ['except' => ['destroy','update']]);
    

    // ======================= orders Routes ====================== //
    // table actions route
    Route::post('orders/actions', 
        [OrdersController::class , 'actions']
    )->name('orders.actions');
    // get orders as json route 
    Route::get('orders/json', [
        OrdersController::class, 'getOrdersAsJson'
    ])->name('orders.json');
        // filter orders  route 
    Route::post('orders/filter', [
        OrdersController::class, 'filterOrders'
    ])->name('orders.filter');
    // to import & export excel 
    Route::get('orders/export/excel', [
        OrdersController::class, 'exportExcel'
    ])->name('orders.export.excel');
    Route::post('orders/import/excel', [
        OrdersController::class, 'importExcel'
    ])->name('orders.import.excel');
    // to get import view
    Route::get('orders/import/excel',  [
        OrdersController::class, 'importView'
    ])->name('orders.import.excel'); 
    // custom delete route
    Route::get('orders/{id}/destroy', [
        OrdersController::class, 'destroy'
    ]);
    // custom update route 
    Route::post('orders/update', [ 
        OrdersController::class, 'update'
    ])->name('orders.update');
    // resource route
    Route::resource('orders', OrdersController::class, ['except' => ['destroy','update']]);


    // ======================= Categories Routes ====================== //
    // table actions route
    Route::post('categories/actions', 
        [CategoriesController::class , 'actions']
    )->name('categories.actions');
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
    // custom update route
    Route::post('homeSliders/update', [
        HomeSlidersController::class, 'update'
    ])->name('homeSliders.update');
    // custom delete route
    Route::get('homeSliders/{id}/destroy', [
        HomeSlidersController::class, 'destroy'
    ]);
    Route::resource('homeSliders', HomeSlidersController::class, ['except' => ['destroy','update']]);


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
    // custom update route
    Route::post('homeBanners/update', [
        HomeBannersController::class, 'update'
    ])->name('homebanners.update');
     // custom delete route
     Route::get('homeBanners/{id}/destroy', [
        HomeBannersController::class, 'destroy'
    ]);
    Route::resource('homeBanners', HomeBannersController::class, ['except' => ['destroy','update']]);


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
    // custom update route
    Route::post('ads/update', [
        AdsController::class, 'update'
    ])->name('ads.update');
    // custom delete route
    Route::get('ads/{id}/destroy', [
        AdsController::class, 'destroy'
    ]);
    Route::resource('ads', AdsController::class, ['except' => ['destroy','update']]);


    // ======================= services Routes ====================== //
    // table actions route
    Route::post('services/actions', 
        [ServicesController::class , 'actions']
    )->name('services.actions');
    // get services as json route 
    Route::get('services/json', [
        ServicesController::class, 'getServicesAsJson'
    ])->name('services.json');
        // filter services  route 
    Route::post('services/filter', [
        ServicesController::class, 'filterServices'
    ])->name('services.filter');
    // to import & export excel 
    Route::get('services/export/excel', [
        ServicesController::class, 'exportExcel'
    ])->name('services.export.excel');
    Route::post('services/import/excel', [
        ServicesController::class, 'importExcel'
    ])->name('services.import.excel');
    Route::get('services/importExportView',  [
        ServicesController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('services/{id}/destroy', [
        ServicesController::class, 'destroy'
    ]);
    Route::resource('services', ServicesController::class, ['except' => ['destroy']]);


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
        MembershipsPlansController::class, 'filterMembershipsPlans'
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


    // ======================= Members Routes ====================== //
    // table actions route
    Route::post('members/actions', 
        [MembersController::class , 'actions']
    )->name('members.actions');
    // get members as json route 
    Route::get('members/json', [
        MembersController::class, 'getMembersAsJson'
    ])->name('members.json');
    // filter members  route 
    Route::post('members/filter', [
        MembersController::class, 'filterMembers'
    ])->name('members.filter');
    // to import & export excel 
    Route::get('members/export/excel', [
        MembersController::class, 'exportExcel'
    ])->name('members.export.excel');
    Route::post('members/import/excel', [
        MembersController::class, 'importExcel'
    ])->name('members.import.excel');
    Route::get('members/importExportView',  [
        MembersController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('members/{id}/destroy', [
        MembersController::class, 'destroy'
    ]);
    Route::resource('members', MembersController::class, ['except' => ['destroy']]);


    // ======================= Configs Routes ====================== //
    // table actions route
    Route::post('configs/actions', 
        [ConfigsController::class , 'actions']
    )->name('configs.actions');
    // get configs as json route 
    Route::get('configs/json', [
        ConfigsController::class, 'getConfigsAsJson'
    ])->name('configs.json');
    // filter configs  route  
    Route::post('configs/filter', [
        ConfigsController::class, 'filterConfigs'
    ])->name('configs.filter');
    // to import & export excel 
    Route::get('configs/export/excel', [
        ConfigsController::class, 'exportExcel'
    ])->name('configs.export.excel');
    Route::post('configs/import/excel', [
        ConfigsController::class, 'importExcel'
    ])->name('configs.import.excel');
    Route::get('configs/importExportView',  [
        ConfigsController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('configs/{id}/destroy', [
        ConfigsController::class, 'destroy'
    ]);
    // custom update route
    Route::post('configs/update', [
        ConfigsController::class, 'update'
    ])->name('configs.update');
    Route::resource('configs', ConfigsController::class, ['except' => ['destroy','update']]);


    // ======================= Countries Routes ====================== //
    // table actions route
    Route::post('countries/actions', 
        [CountriesController::class , 'actions']
    )->name('countries.actions');
    // get countries as json route 
    Route::get('countries/json', [
        CountriesController::class, 'getCountriesAsJson'
    ])->name('countries.json');
    // filter countries  route 
    Route::post('countries/filter', [
        CountriesController::class, 'filterCountries'
    ])->name('countries.filter');
    // to import & export excel 
    Route::get('countries/export/excel', [
        CountriesController::class, 'exportExcel'
    ])->name('countries.export.excel');
    Route::post('countries/import/excel', [
        CountriesController::class, 'importExcel'
    ])->name('countries.import.excel');
    Route::get('countries/importExportView',  [
        CountriesController::class, 'importExportView'
    ]);
    // custom update route
    Route::post('countries/update', [
        CountriesController::class, 'update'
    ])->name('countries.update');
     // custom delete route
     Route::get('countries/{id}/destroy', [
        CountriesController::class, 'destroy'
    ]);
    Route::resource('countries', CountriesController::class, ['except' => ['destroy','update']]);


    // ======================= States Routes ====================== //
    // table actions route
    Route::post('states/actions', 
        [StatesController::class , 'actions']
    )->name('states.actions');
    // get states as json route 
    Route::get('states/json', [
        StatesController::class, 'getStatesAsJson'
    ])->name('states.json');
    // filter states  route 
    Route::post('states/filter', [
        StatesController::class, 'filterStates'
    ])->name('states.filter');
    // to import & export excel 
    Route::get('states/export/excel', [
        StatesController::class, 'exportExcel'
    ])->name('states.export.excel');
    Route::post('states/import/excel', [
        StatesController::class, 'importExcel'
    ])->name('states.import.excel');
    Route::get('states/importExportView',  [
        StatesController::class, 'importExportView'
    ]);
    // custom update route
    Route::post('states/update', [
        StatesController::class, 'update'
    ])->name('states.update');
    // custom delete route
    Route::get('states/{id}/destroy', [
        StatesController::class, 'destroy'
    ]);
    Route::resource('states', StatesController::class, ['except' => ['destroy','update']]);


    // ======================= Currencies Routes ====================== //
    // table actions route
    Route::post('currencies/actions', 
        [CurrenciesController::class , 'actions']
    )->name('currencies.actions');
    // get currencies as json route 
    Route::get('currencies/json', [
        CurrenciesController::class, 'getCurrenciesAsJson'
    ])->name('currencies.json');
    // filter currencies  route 
    Route::post('currencies/filter', [
        CurrenciesController::class, 'filterCurrencies'
    ])->name('currencies.filter');
    // to import & export excel 
    Route::get('currencies/export/excel', [
        CurrenciesController::class, 'exportExcel'
    ])->name('currencies.export.excel');
    Route::post('currencies/import/excel', [
        CurrenciesController::class, 'importExcel'
    ])->name('currencies.import.excel');
    Route::get('currencies/importExportView',  [
        CurrenciesController::class, 'importExportView'
    ]);
    // custom update route
    Route::post('currencies/update', [
        CurrenciesController::class, 'update'
    ])->name('currencies.update');
    // custom delete route
    Route::get('currencies/{id}/destroy', [
        CurrenciesController::class, 'destroy'
    ]);
    Route::resource('currencies', CurrenciesController::class, ['except' => ['destroy','update']]);


    // ======================= units Routes ====================== //
    // table actions route
    Route::post('units/actions', 
        [UnitsController::class , 'actions']
    )->name('units.actions');
    // get units as json route 
    Route::get('units/json', [
        UnitsController::class, 'getUnitsAsJson'
    ])->name('units.json');
    // filter units  route 
    Route::post('units/filter', [
        UnitsController::class, 'filterUnits'
    ])->name('units.filter');
    // to import & export excel 
    Route::get('units/export/excel', [
        UnitsController::class, 'exportExcel'
    ])->name('units.export.excel');
    Route::post('units/import/excel', [
        UnitsController::class, 'importExcel'
    ])->name('units.import.excel');
    Route::get('units/importExportView',  [
        UnitsController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('units/{id}/destroy', [
        UnitsController::class, 'destroy'
    ]);
    Route::resource('units', UnitsController::class, ['except' => ['destroy']]);


    // ======================= units Routes ====================== //
    // table actions route
    Route::post('paymentOptions/actions', 
        [PaymentOptionsController::class , 'actions']
    )->name('paymentOptions.actions');
    // get paymentOptions as json route 
    Route::get('paymentOptions/json', [
        PaymentOptionsController::class, 'getpaymentOptionsAsJson'
    ])->name('paymentOptions.json');
    // filter paymentOptions  route 
    Route::post('paymentOptions/filter', [
        PaymentOptionsController::class, 'filterpaymentOptions'
    ])->name('paymentOptions.filter');
    // to import & export excel 
    Route::get('paymentOptions/export/excel', [
        PaymentOptionsController::class, 'exportExcel'
    ])->name('paymentOptions.export.excel');
    Route::post('paymentOptions/import/excel', [
        PaymentOptionsController::class, 'importExcel'
    ])->name('paymentOptions.import.excel');
    Route::get('paymentOptions/importExportView',  [
        PaymentOptionsController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('paymentOptions/{id}/destroy', [
        PaymentOptionsController::class, 'destroy'
    ]);
    Route::resource('paymentOptions', PaymentOptionsController::class, ['except' => ['destroy']]);

    
    // ======================= moderators Routes ====================== //
    // table actions route
    Route::post('moderators/actions', 
        [ModeratorsController::class , 'actions']
    )->name('moderators.actions');
    // get moderators as json route 
    Route::get('moderators/json', [
        ModeratorsController::class, 'getModeratorsAsJson'
    ])->name('moderators.json');
    // filter moderators  route 
    Route::post('moderators/filter', [
        ModeratorsController::class, 'filterModerators'
    ])->name('moderators.filter');
    // to import & export excel 
    Route::get('moderators/export/excel', [
        ModeratorsController::class, 'exportExcel'
    ])->name('moderators.export.excel');
    Route::post('moderators/import/excel', [
        ModeratorsController::class, 'importExcel'
    ])->name('moderators.import.excel');
    Route::get('moderators/importExportView',  [
        ModeratorsController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('moderators/{id}/destroy', [
        ModeratorsController::class, 'destroy'
    ]);
    Route::resource('moderators', ModeratorsController::class, ['except' => ['destroy']]);


    // ======================= Admin Users Routes ====================== //
    // table actions route
    Route::post('users/actions', 
        [AdminUsersController::class , 'actions']
    )->name('users.actions');
    // get users as json route 
    Route::get('users/json', [
        AdminUsersController::class, 'getUsersAsJson'
    ])->name('users.json');
    // filter users  route 
    Route::post('users/filter', [
        AdminUsersController::class, 'filterUsers'
    ])->name('users.filter');
    // to import & export excel 
    Route::get('users/export/excel', [
        AdminUsersController::class, 'exportExcel'
    ])->name('users.export.excel');
    Route::post('users/import/excel', [
        AdminUsersController::class, 'importExcel'
    ])->name('users.import.excel');
    Route::get('users/importExportView',  [
        AdminUsersController::class, 'importExportView'
    ]);
    // custom delete route
    Route::get('users/{id}/destroy', [
        AdminUsersController::class, 'destroy'
    ]);
    Route::resource('users', AdminUsersController::class, ['except' => ['destroy']]);


    // ======================= Email Archived Routes ====================== //
    // table actions route
    Route::post('emailsArchives/actions', 
        [EmailArchivesController::class , 'actions']
    )->name('emailsArchives.actions');
    // get emails Archives as json route 
    Route::get('emailsArchives/json', [
        EmailArchivesController::class, 'getEmailsAsJson'
    ])->name('emailsArchives.json');
    // filter emails Archives  route 
    Route::post('emailsArchives/filter', [
        EmailArchivesController::class, 'filterEmails'
    ])->name('emailsArchives.filter');
    // to import & export excel 
    Route::get('emailsArchives/export/excel', [
        EmailArchivesController::class, 'exportExcel'
    ])->name('emailsArchives.export.excel');
    Route::post('emailsArchives/import/excel', [
        EmailArchivesController::class, 'importExcel'
    ])->name('emailsArchives.import.excel');
    Route::get('emailsArchives/importExportView',  [
        EmailArchivesController::class, 'importExportView'
    ]);
    // custom update route
    Route::post('emailsArchives/update', [
        EmailArchivesController::class, 'update'
    ])->name('emailsArchives.update');
    // custom delete route
    Route::get('emailsArchives/{id}/destroy', [
        EmailArchivesController::class, 'destroy'
    ]);
    Route::resource('emailsArchives', EmailArchivesController::class, ['except' => ['destroy','update']]);


    // ======================= Email Archived Routes ====================== //
    // table actions route
    Route::post('suppliersVerification/actions', 
        [SuppliersVerificationController::class , 'actions']
    )->name('suppliersVerification.actions');
    // get suppliers verification as json route 
    Route::get('suppliersVerification/json', [
        SuppliersVerificationController::class, 'getVerificationsAsJson'
    ])->name('suppliersVerification.json');
    // filter suppliers verification route 
    Route::post('suppliersVerification/filter', [
        SuppliersVerificationController::class, 'filterVerifications'
    ])->name('suppliersVerification.filter');
    // to import & export excel 
    Route::get('suppliersVerification/export/excel', [
        SuppliersVerificationController::class, 'exportExcel'
    ])->name('suppliersVerification.export.excel');
    Route::post('suppliersVerification/import/excel', [
        SuppliersVerificationController::class, 'importExcel'
    ])->name('suppliersVerification.import.excel');
    Route::get('suppliersVerification/importExportView',  [
        SuppliersVerificationController::class, 'importExportView'
    ]);
    // custom update route
    Route::post('suppliersVerification/update', [
        SuppliersVerificationController::class, 'update'
    ])->name('suppliersVerification.update');
    // custom delete route
    Route::get('suppliersVerification/{id}/destroy', [
        SuppliersVerificationController::class, 'destroy'
    ]);
    // get supplier for create & edit page 
    Route::get('suppliersVerification/getsupplierDetails', [
        SuppliersVerificationController::class, 'getsupplierDetails'
    ])->name('suppliersVerification.getsupplierDetails');
    Route::resource('suppliersVerification', SuppliersVerificationController::class, ['except' => ['destroy','update']]);


    // ======================= General Classes Routes ====================== //
    Route::get('cache/flush', [
        CacheController::class, 'flushcache'
    ])->name('cache.flush');
    
});





