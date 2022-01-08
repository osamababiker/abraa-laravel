<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Country; 
use App\Exports\StoresExport;
use App\Imports\StoresImport;
use App\Exports\ActiveStoresExport;
use App\Imports\ActiveStoresImport;
use App\Exports\PendingStoresExport;
use App\Imports\PendingStoresImport;
use App\Exports\RejectedStoresExport;
use App\Imports\RejectedStoresImport;
use App\Exports\BulkStoresExport;
use App\Imports\BulkStoresImport;
use Maatwebsite\Excel\Facades\Excel;

class StoresController extends Controller
{
    
    public function index()
    {
        $countries = Country::all();
        return view('admin.stores.index', compact(['countries']));
    }
    
    public function getStoresAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $stores_status = $request->stores_status;

        $store_obj = new Store();

        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)
            ->with('user')->orderBy('id','desc')->get();
        
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }
    public function filterStores(Request $request){
        
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;
        $stores_status = $request->stores_status;

        $store_obj = Store::leftJoin('users', 'users.id', '=', 'users_store.sub_of');

        if($stores_status == 'active'){
            $store_obj->where('users_store.trash', 0); 
        }
        elseif($stores_status == 'pending'){
            $store_obj->where('users_store.trash', 1)
                ->where('users_store.rejected', 0); 
        }
        elseif($stores_status == 'rejected'){
            $store_obj->where('users_store.trash', 1)
                ->where('users_store.rejected', 1); 
        }
        elseif($stores_status == 'bulk'){
            $store_obj->where('users_store.trash', 1)
                ->whereIn('users.user_source', [29, 35]); 
        }
        
        if($store_name){
            $store_obj->where('users_store.name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('users_store.country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('users_store.meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)->with('user')
            ->orderBy('users_store.id','desc')->get();

   
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }

    // ***************************************************/

    // to get active stores only
    public function getActiveStores(){
        $countries = Country::all();
        return view('admin.stores.active.index', compact(['countries']));
    }
    // get active stores as json
    public function getActiveStoresAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $store_obj = Store::where('users_store.trash', 0);

        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)
            ->with('user')->orderBy('id','desc')->get();
        
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }
    // filter active stores
    public function filterActiveStores(Request $request){
        
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $store_obj = Store::leftJoin('users', 'users.id', '=', 'users_store.sub_of')
                        ->where('users_store.trash', 0);
        
        if($store_name){
            $store_obj->where('users_store.name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('users_store.country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('users_store.meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)->with('user')
            ->orderBy('users_store.id','desc')->get();

   
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }

    // ***************************************************/

    // to get pending stores only
    public function getPendingStores(){
        $countries = Country::all();
        return view('admin.stores.pending.index', compact(['countries']));
    }
    // get pending stores as json
    public function getPendingStoresAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $store_obj = Store::where('trash', 1)
            ->where('rejected', 0);

        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)
            ->with('user')->orderBy('id','desc')->get();
        
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }
    // filter pending stores
    public function filterPendingStores(Request $request){
        
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $store_obj = Store::leftJoin('users', 'users.id', '=', 'users_store.sub_of')
                        ->where('users_store.trash', 1)
                        ->where('users_store.rejected', 0);
        
        if($store_name){
            $store_obj->where('users_store.name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('users_store.country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('users_store.meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)->with('user')
            ->orderBy('users_store.id','desc')->get();

   
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }

    // ***************************************************/

    // to get rejected stores only
    public function getRejectedStores(){
        $countries = Country::all();
        return view('admin.stores.rejected.index', compact(['countries']));
    }
    // get rejected stores as json
    public function getRejectedStoresAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $store_obj = Store::where('users_store.trash', 1)
            ->where('users_store.rejected', 1);

        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)
            ->with('user')->orderBy('id','desc')->get();
        
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }
    // filter rejected stores
    public function filterRejectedStores(Request $request){
        
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $store_obj = Store::leftJoin('users', 'users.id', '=', 'users_store.sub_of')
                ->where('users_store.trash', 1)
                ->where('users_store.rejected', 1);
        
        if($store_name){
            $store_obj->where('users_store.name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('users_store.country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('users_store.meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)->with('user')
            ->orderBy('users_store.id','desc')->get();

   
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }
    
    // ***************************************************/

    // to get bulk stores only
    public function getBulkStores(){
        $countries = Country::all();
        return view('admin.stores.bulk.index', compact(['countries']));
    }
    // get bulk stores as json
    public function getBulkStoresAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $store_obj = Store::leftJoin('users', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash', 1)
            ->whereIn('users.user_source', [29, 35]);

        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)
            ->with('user')->orderBy('users_store.id','desc')->get();
        
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }
    // filter bulk stores
    public function filterBulkStores(Request $request){
        
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $store_obj = Store::leftJoin('users', 'users.id', '=', 'users_store.sub_of')
                ->where('users_store.trash', 1)
                ->whereIn('users.user_source', [29, 35]);
        
        if($store_name){
            $store_obj->where('users_store.name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('users_store.country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('users_store.meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)->with('user')
            ->orderBy('users_store.id','desc')->get();

   
        return response()->json([
            'stores' => $stores,
            'stores_count' => $stores_count
        ]);
    }

    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }

  
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {
        //
    }

    
    // to handel table actions 
    public function actions(Request $request){

        // to move selected stores to archived
        if($request->has('delete_selected_btn')){
            foreach($request->store_id as $store_id){
                $store = Store::find($store_id);
                $store->delete();
            }
            $message = 'stores hass been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }else 
        // to approve selected stores 
        if($request->has('approve_selected_btn')){
            foreach($request->store_id as $store_id){
                $store = Store::find($store_id);
                $store->trash = 0;
                $store->save();
            }
            $message = 'stores hass been approved successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }else 
        // to approve single store
        if($request->has('approve_single_store_btn')){
           $store = Store::find($request->store_id);
           $store->trash = 0;
           $store->save();
           
           $message = 'store hass been approved successfully';
           session()->flash('success', 'true');
           session()->flash('feedback_title', 'Success');
           session()->flash('feedback', $message);
           return redirect()->back();
        }
    }


    public function destroy($id){
        Store::where('id',$id)->delete();
        $message = 'Store hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new StoresExport, 'stores.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new StoresImport,request()->file('file'));
           
        return redirect()->back();
    }

    // import & export active stores to excel
    public function activeStoresexportExcel() 
    {
        return Excel::download(new ActiveStoresExport, 'active_stores.xlsx'); 
    }
   
    public function activeStoresimportExcel() 
    {
        Excel::import(new ActiveStoresImport,request()->file('file'));
           
        return redirect()->back();
    }

    // import & export pending stores to excel
    public function pendingStoresexportExcel() 
    {
        return Excel::download(new PendingStoresExport, 'pending_stores.xlsx'); 
    }
   
    public function pendingStoresimportExcel() 
    {
        Excel::import(new PendingStoresImport,request()->file('file'));
           
        return redirect()->back();
    }

    // import & export rejected stores to excel
    public function rejectedStoresexportExcel() 
    {
        return Excel::download(new RejectedStoresExport, 'rejected_stores.xlsx'); 
    }
   
    public function rejectedStoresimportExcel() 
    {
        Excel::import(new RejectedStoresImport,request()->file('file'));
           
        return redirect()->back();
    }

    // import & export bulk stores to excel
    public function bulkStoresexportExcel() 
    {
        return Excel::download(new BulkStoresExport, 'bulk_stores.xlsx'); 
    }
   
    public function bulkStoresimportExcel() 
    {
        Excel::import(new BulkStoresImport,request()->file('file'));
           
        return redirect()->back();
    }
}
