<?php

namespace App\Http\Controllers\Admin;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Store;
use App\Models\Country;
use App\Models\State; 
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
use App\Http\Traits\RandomStringTrait;
use App\Http\Traits\FilesUploadTrait;
use App\Http\Requests\StoresRequest;
use Illuminate\Pagination\Paginator;

class StoresController extends Controller
{

    use RandomStringTrait, FilesUploadTrait;
    
    public function index(){
        $countries = Country::all();
        return view('admin.stores.index', compact(['countries']));
    }
    
    public function getStoresAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $stores_status = $request->stores_status;

        $store_obj = new Store();

        $stores_count = $store_obj->count();
        $stores = $store_obj->with('user')->orderBy('id','desc')
            ->paginate($rows_numbers);
        
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
            'stores_count' => $stores_count
        ]);
    }
    public function filterStores(Request $request){
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;
        $stores_status = $request->stores_status;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $store_obj = Store::with('user')
            ->select('users_store.*')
            ->leftJoin('users', function($join) {
            $join->on('users.id', '=', 'users_store.sub_of');
        });

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
        $stores = $store_obj->orderBy('users_store.id','desc')
            ->paginate($rows_numbers);

   
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
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
        $stores = $store_obj->with('user')->orderBy('id','desc')
            ->paginate($rows_numbers);
        
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
            'stores_count' => $stores_count
        ]);
    }
    // filter active stores
    public function filterActiveStores(Request $request){
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $store_obj = Store::with('user')
            ->select('users_store.*')
            ->where('users_store.trash', 0)
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'users_store.sub_of');
        });
    
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
        $stores = $store_obj->orderBy('users_store.id','desc')
            ->paginate($rows_numbers);
   
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
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
        $stores = $store_obj->with('user')->orderBy('id','desc')
            ->paginate($rows_numbers);
        
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
            'stores_count' => $stores_count
        ]);
    }
    // filter pending stores
    public function filterPendingStores(Request $request){
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $store_obj = Store::with('user')
            ->select('users_store.*')
            ->where('users_store.trash', 1)
            ->where('users_store.rejected', 0)
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'users_store.sub_of');
        });
        
        if($store_name){
            $store_obj->where('users_store.name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('users_store.country', $store_country)
                ->orWhereIn('users.country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('users_store.meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->orderBy('users_store.id','desc')
            ->paginate($rows_numbers);

        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
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
        $stores = $store_obj->with('user')->orderBy('id','desc')
            ->paginate($rows_numbers);
        
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
            'stores_count' => $stores_count
        ]);
    }
    // filter rejected stores
    public function filterRejectedStores(Request $request){
        
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $store_obj = Store::with('user')
            ->select('users_store.*')
            ->where('users_store.trash', 1)
            ->where('users_store.rejected', 1)
            ->leftJoin('users', function($join){
                $join->on('users.id', '=', 'users_store.sub_of');
        });
        
        if($store_name){
            $store_obj->where('users_store.name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('users_store.country', $store_country)
                ->orWhereIn('users.country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('users_store.meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->orderBy('users_store.id','desc')
            ->paginate($rows_numbers);

   
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
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

        $store_obj = Store::with('user')
            ->select('users_store.*')
            ->where('users_store.trash', 1)
            ->where('users_store.rejected', 0)
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'users_store.sub_of');
            })
        ->where('users.external', 1)
        ->whereIn('users.user_source', [29, 35]);

        $stores_count = $store_obj->count();
        $stores = $store_obj->orderBy('users_store.id','desc')
            ->paginate($rows_numbers);
        
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
            'stores_count' => $stores_count
        ]);
    }
    // filter bulk stores
    public function filterBulkStores(Request $request){
        
        $store_name = $request->store_name;
        $store_country = $request->store_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $store_obj = Store::with('user')
            ->select('users_store.*')
            ->where('users_store.trash', 1)
            ->where('users_store.rejected', 0)
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'users_store.sub_of');
            })
        ->whereIn('users.user_source', [29, 35]);
        
        /*
        SELECT * FROM `users_store` store LEFT JOIN `users` supplier on supplier.id=store.sub_of WHERE store.rejected=0 AND store.trash=1 AND supplier.user_source=29 OR supplier.user_source=35
        */

        if($store_name){
            $store_obj->where('users_store.name', 'like',  '%'. $store_name .'%');
        }

        if($store_country){
            $store_obj->whereIn('users_store.country', $store_country)
                ->orWhereIn('users.country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('users_store.meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->with('user')
            ->orderBy('users_store.id','desc')->paginate($rows_numbers);

   
        return response()->json([
            'stores' => $stores,
            'pagination' => (string) $stores->links('pagination::bootstrap-4'),
            'stores_count' => $stores_count
        ]);
    }

    public function create(){
        $countries = Country::all();
        $states = State::all();
        return view('admin.stores.create', compact(['countries','states']));
    }

 
    public function store(StoresRequest $request){

        DB::beginTransaction();
        try {

            $user = new Member();
            $store = new Store();

            $salt = $this->getRandomString(3);
            $password = md5($request->password . $salt);
            $register_on = date('Y-m-d H:i:s');
            $verified = 1;
            $verification_token = md5(time() . rand(10000, 99999));
            $trash = 0;
            $user_source = 25;
            $added_by = Auth::user()->id;
            $user_type = 0;
            $member_type = 1;
            $is_organic = 0;
            $register_level = 3;
            $is_login = 0;

            // to save user info
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $password;
            $user->salt = $salt;
            $user->register_on = $register_on;
            $user->verified = $verified;
            $user->verification_token = $verification_token;
            $user->country = $request->country;
            $user->city = $request->city;
            $user->user_type = $user_type;
            $user->member_type = $member_type;
            $user->is_organic = $is_organic;
            $user->register_level = $register_level;
            $user->added_by = $added_by;
            $user->user_source = $user_source;
            $user->is_login = $is_login;
            $user->save();

            // to save store info
            $meta_title = '';
            foreach($request->meta_title as $title){
                $meta_title .= $title . ',';
            }
            $meta_description = '';
            foreach($request->meta_description as $description){
                $meta_description .= $description . ',';
            }
            $meta_keywords = '';
            foreach($request->meta_keywords as $keywords){
                $meta_keywords .= $keywords . ',';
            }

            // to logo file
            $logo_url = '';
            if($request->has('logo')){
                $image = $request->file('logo');
                $image_name = time().'.'.$image->extension();
                $temp_dir = $image->getPathName();
                $logo_url = $this->upload_image($image_name, $temp_dir, 'files'); 
            }

            // to upload banner 1 files
            $banner1_url = '';
            if($request->has('banner1')){
                $banner = $request->file('banner1');
                $banner_name = time().'.'.$banner->extension();
                $temp_dir = $banner->getPathName();
                $banner1_url = $this->upload_image($banner_name, $temp_dir, 'files');
            }

            // to upload banner 2 files
            $banner2_url = '';
            if($request->has('banner2')){
                $banner = $request->file('banner2');
                $banner_name = time().'.'.$banner->extension();
                $temp_dir = $banner->getPathName();
                $banner2_url = $this->upload_image($banner_name, $temp_dir, 'files');
            }

            // to upload banner 3 files
            $banner3_url = '';
            if($request->has('banner3')){
                $banner = $request->file('banner3');
                $banner_name = time().'.'.$banner->extension();
                $temp_dir = $banner->getPathName();
                $banner3_url = $this->upload_image($banner_name, $temp_dir, 'files');
            } 

            if($request->show_home_page){
                $show_home_page = 1;
            }else $show_home_page = 0;


            $store->sub_of = $user->id;
            $store->name = $request->store_name;
            $store->sub_domain = $request->sub_domain;
            $store->contact_address = $request->contact_address;
            $store->weburl = $request->website_url;
            $store->aboutpage = $request->about_store;
            $store->facebook_url = $request->facebook_url;
            $store->twitter_url = $request->twitter_url;
            $store->instagram_url = $request->instagram_url;
            $store->store_verified = $request->store_verified;
            $store->trash = $request->trash;
            $store->show_homepage = $show_home_page;
            $store->meta_title = $meta_title;
            $store->meta_description = $meta_description;
            $store->meta_keywords = $meta_keywords;
            $store->logo_url = $logo_url;
            $store->banner_url = $banner1_url;
            $store->banner_url1 = $banner2_url;
            $store->banner_url2 = $banner3_url;
            $store->save();

            DB::commit();

        }catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        
    }

  
    public function show($id){
        $store = Store::find($id);
        return view('admin.stores.show', compact(['store']));
    }


    public function edit($id){
        $store = Store::find($id);
        $countries = Country::all();
        $states = State::all();
        return view('admin.stores.edit', compact(
            ['store', 'countries', 'states']
        ));
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
