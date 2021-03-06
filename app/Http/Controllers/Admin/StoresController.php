<?php

namespace App\Http\Controllers\Admin;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Store;
use App\Models\Country;
use App\Models\State; 
use App\Models\Supplier;
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
        $date_range = $request->date_range;
        
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
                ->where('users_store.rejected', 0)
                ->where('users.external', 0);
        }
        elseif($stores_status == 'rejected'){
            $store_obj->where('users_store.trash', 1)
                ->where('users_store.rejected', 1); 
        }
        elseif($stores_status == 'bulk'){
            $store_obj->where('users_store.trash', 1)
            ->whereIn('users.user_source', [29, 35])
            ->where('users.external', 0)
            ->where('users_store.rejected', 0);
        }

        if($request->subscription && (int) $request->subscription == 9){
            $store_obj->where('users.subscription_id', 2)
            ->where('users.premium', '<', date("Y-m-d H:i:s"));
        }elseif($request->subscription && (int) $request->subscription == 0){
  
            $store_obj->where('users.subscription_id', (int) $request->subscription);
        }elseif($request->subscription){
            $store_obj->where('users.subscription_id', (int) $request->subscription)
            ->where('users.premium', '>=', date("Y-m-d H:i:s"));
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

        
        if($date_range){
            $date_range = explode(' - ', $date_range);
            $store_obj->whereBetween('users_store.date_added', $date_range);
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
        $date_range = $request->date_range;

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

        if($request->subscription && (int) $request->subscription == 9){
            $store_obj->where('users.subscription_id', 2)
            ->where('users.premium', '<', date("Y-m-d H:i:s"));
        }elseif($request->subscription && (int) $request->subscription == 0){
            $store_obj->where('users.subscription_id', (int) $request->subscription);
        }elseif($request->subscription){
            $store_obj->where('users.subscription_id', (int) $request->subscription)
            ->where('users.premium', '>=', date("Y-m-d H:i:s"));
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

        
        if($date_range){
            $date_range = explode(' - ', $date_range);
            $store_obj->whereBetween('users_store.date_added', $date_range);
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

        $store_obj = Store::with('user')
        ->select('users_store.*')
        ->where('users_store.trash', 1)
        ->where('users_store.rejected', 0)
        ->leftJoin('users', function($join) {
            $join->on('users.id', '=', 'users_store.sub_of');
        })->where('users.external', 0);

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
        $external = (int) $request->external;
        $date_range = $request->date_range;

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
        })->where('users.external', $external);
        
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
            
        if($date_range){
            $date_range = explode(' - ', $date_range);
            $store_obj->whereBetween('users_store.date_added', $date_range);
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
        $date_range = $request->date_range;

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

        if($date_range){
            $date_range = explode(' - ', $date_range);
            $store_obj->whereBetween('users_store.date_added', $date_range);
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
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'users_store.sub_of');
            })
        ->where('users_store.trash', 1)
        ->whereIn('users.user_source', [29, 35])
        ->where('users.external', 0)
        ->where('users_store.rejected', 0);

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
        $external = (int) $request->external;
        $currentPage = $request->current_page;
        $date_range = $request->date_range;

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $store_obj = Store::with('user')
            ->select('users_store.*')
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'users_store.sub_of');
            })
        ->where('users_store.trash', 1)
        ->whereIn('users.user_source', [29, 35])
        ->where('users.external', $external)
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

        if($date_range){
            $date_range = explode(' - ', $date_range);
            $store_obj->whereBetween('users_store.date_added', $date_range);
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

            $supplier = new Supplier();
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

            // to save supplier info
            $supplier->full_name = $request->full_name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->password = $password;
            $supplier->salt = $salt;
            $supplier->register_on = $register_on;
            $supplier->verified = $verified;
            $supplier->verification_token = $verification_token;
            $supplier->country = $request->country;
            $supplier->city = $request->city;
            $supplier->user_type = $user_type;
            $supplier->member_type = $member_type;
            $supplier->is_organic = $is_organic;
            $supplier->register_level = $register_level;
            $supplier->added_by = $added_by;
            $supplier->user_source = $user_source;
            $supplier->is_login = $is_login;
            $supplier->save();

            // to save store info
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

            $store->sub_of = $supplier->id;
            $store->name = $request->store_name;
            $store->sub_domain = $request->sub_domain;
            $store->contact_address = $request->contact_address;
            $store->weburl = $request->weburl;
            $store->aboutpage = $request->aboutpage;
            $store->facebook_url = $request->facebook_url;
            $store->twitter_url = $request->twitter_url;
            $store->instagram_url = $request->instagram_url;
            $store->store_verified = $request->store_verified;
            $store->trash = $request->trash;
            $store->show_homepage = $show_home_page;
            $store->meta_title = $request->meta_title;
            $store->meta_description = $request->meta_description;
            $store->meta_keywords = $meta_keywords;
            $store->logo_url = $logo_url;
            $store->banner_url = $banner1_url;
            $store->banner_url1 = $banner2_url;
            $store->banner_url2 = $banner3_url;
            $store->save();

            DB::commit();

            $message = 'Store has been Added successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();

        }catch (\Exception $e) {
            DB::rollback();
            $message = 'Problem Updating Store Info';
            session()->flash('error', 'true');
            session()->flash('feedback_title', 'Opps , Somesting Went Wrong');
            session()->flash('feedback', $message);
            return redirect()->back();
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

 
    public function update(Request $request){
        $store = Store::findOrFail($request->store_id);
        $supplier = Supplier::findOrFail($store->sub_of);

        DB::beginTransaction(); 
        try {
            
            if($request->password){
                $salt = $this->getRandomString(3);
                $password = md5($request->password . $salt);
            }else $password = $supplier->password;
            
            $interested_keywords = '';
            foreach($request->interested_keywords as $keywords){
                $interested_keywords .= $keywords . ',';
            }

            $updated_by = Auth::user()->id;
            
            // to save supplier info
            $supplier->full_name = $request->full_name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->password = $password;
            $supplier->country = $request->country;
            $supplier->interested_keywords = $interested_keywords;
            $supplier->city = $request->city;
            $supplier->save();

            // to save store info
            $meta_keywords = '';
            foreach($request->meta_keywords as $keywords){
                $meta_keywords .= $keywords . ',';
            }

            // to logo file
            if($request->has('logo')){
                $image = $request->file('logo');
                $image_name = time().'.'.$image->extension();
                $temp_dir = $image->getPathName();
                $logo_url = $this->upload_image($image_name, $temp_dir, 'files'); 
            }else $logo_url = $store->logo_url;

            // to upload banner 1 files
            if($request->has('banner1')){
                $banner = $request->file('banner1');
                $banner_name = time().'.'.$banner->extension();
                $temp_dir = $banner->getPathName();
                $banner1_url = $this->upload_image($banner_name, $temp_dir, 'files');
            }else $banner1_url = $store->banner_url;

            // to upload banner 2 files
            if($request->has('banner2')){
                $banner = $request->file('banner2');
                $banner_name = time().'.'.$banner->extension();
                $temp_dir = $banner->getPathName();
                $banner2_url = $this->upload_image($banner_name, $temp_dir, 'files');
            }else $banner2_url = $store->banner_url1;

            // to upload banner 3 files
            if($request->has('banner3')){
                $banner = $request->file('banner3');
                $banner_name = time().'.'.$banner->extension();
                $temp_dir = $banner->getPathName();
                $banner3_url = $this->upload_image($banner_name, $temp_dir, 'files');
            }else $banner3_url = $store->banner_url2; 

            if($request->show_home_page){
                $show_home_page = 1;
            }else $show_home_page = 0;

            $store->name = $request->store_name;
            $store->company_email = $request->company_email;
            $store->company_mobile = $request->company_mobile;
            $store->company_whatsapp = $request->company_whatsapp;
            $store->is_whatsapp_contact = $request->is_whatsapp_contact;
            $store->sub_domain = $request->sub_domain;
            $store->contact_address = $request->contact_address;
            $store->weburl = $request->weburl;
            $store->aboutpage = $request->aboutpage;
            $store->facebook_url = $request->facebook_url;
            $store->twitter_url = $request->twitter_url;
            $store->instagram_url = $request->instagram_url;
            $store->store_verified = $request->store_verified;
            $store->trash = $request->trash;
            $store->show_homepage = $show_home_page;
            $store->meta_title = $request->meta_title;
            $store->meta_description = $request->meta_description;
            $store->meta_keywords = $meta_keywords;
            $store->logo_url = $logo_url;
            $store->banner_url = $banner1_url;
            $store->banner_url1 = $banner2_url;
            $store->banner_url2 = $banner3_url;
            $store->updated_by = $updated_by;
            $store->save();

            DB::commit();

            $message = 'Store hass been Updated successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();

        }catch (\Exception $e) {
            DB::rollback();
            $message = 'Problem Updating Store Info';
            session()->flash('error', 'true');
            session()->flash('feedback_title', 'Opps , Somesting Went Wrong');
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

    // to get store items 
    public function storeItems($supplier_id){
        $countries = Country::all();
        $supplier = Supplier::findOrFail($supplier_id);
        return view('admin.stores.items.index',compact(['countries','supplier']));   
    }
    // to get store items as json
    public function getStoreItemsAsJson(Request $request, $supplier_id){
        $rows_numbers = $request->rows_numbers;
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $item_obj = Item::where('user_id', $supplier_id); 

        $items_count = $item_obj->count();
        $items = $item_obj->orderBy('id','DESC')->with('category')
            ->with('supplier')->paginate($rows_numbers);
        
        return response()->json([ 
            'items' => $items,
            'pagination' => (string) $items->links('pagination::bootstrap-4'),
            'items_count' => $items_count
        ]);
    }
    // to filter store items
    public function filterStoreItems(Request $request, $supplier_id){
        $product_name = $request->product_name;
        $manufacture_country = $request->manufacture_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword; 
        $items_status = $request->items_status;
        $store_status = $request->store_status;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $item_obj = Item::where('user_id', $supplier_id)
            ->with('category')
            ->select("items.*")
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'items.user_id');
            })
            ->leftJoin('users_store', function($join) {
                $join->on('users_store.sub_of', '=', 'users.id');
            });
        
        // filter by item status
        if($items_status == 'active'){
            $item_obj = $item_obj->where('items.status', 1)
                ->where('items.rejected', 0)
                ->where('items.approved', 1);
        } 
        elseif($items_status == 'pending'){
            $item_obj = $item_obj->where('items.status', 0)
                ->where('items.rejected', 0)
                ->where('items.approved', 0);
        }
        elseif($items_status == 'rejected'){
            $item_obj = $item_obj->where('items.rejected',1);
        }
        elseif($items_status == 'home'){
            $item_obj = $item_obj->where('items.show_homepage',1);
        }
        elseif($items_status == 'featured'){
            $item_obj = $item_obj->where('items.featured',1);
        }

        // filter by store status
        if($store_status == 'active_stores'){
            $item_obj = $item_obj->where('users_store.trash', 0);
        } 
        elseif($store_status == 'pending_stores'){
            $item_obj = $item_obj->where('users_store.trash', 1);
        }

        if($product_name){
            $item_obj->where('items.title','like', '%' . $product_name . '%'); 
        }

        if($manufacture_country){
            $item_obj->whereIn('items.manufacture_country', $manufacture_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $item_obj->where('items.meta_keyword','like', '%' . $word . '%');
            }
        }
            
        $items_count = $item_obj->count();
        $items = $item_obj->orderBy('items.id','desc')
        ->paginate($rows_numbers);

        
        return response()->json([
            'items' => $items,
            'pagination' => (string) $items->links('pagination::bootstrap-4'),
            'items_count' => $items_count
        ]);
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
        // to reject selected stores
        if($request->has('reject_selected_btn')){
            foreach($request->store_id as $store_id){
                $store = Store::find($store_id);
                $store->trash = 1;
                $store->rejected = 1;
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
        }else
        // to reject single store
        if($request->has('reject_single_store_btn')){
            $store = Store::find($request->store_id);
            $store->trash = 1;
            $store->rejected = 1;
            $store->save();
            
            $message = 'store hass been approved successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }


    // import & export to excel
    public function exportExcel() {
        return Excel::download(new StoresExport, 'stores.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new StoresImport,request()->file('file'));
        return redirect()->back();
    }

    // import & export active stores to excel
    public function activeStoresexportExcel() {
        return Excel::download(new ActiveStoresExport, 'active_stores.xlsx'); 
    }
   
    public function activeStoresimportExcel() {
        Excel::import(new ActiveStoresImport,request()->file('file'));
        return redirect()->back();
    }

    // import & export pending stores to excel
    public function pendingStoresexportExcel() {
        return Excel::download(new PendingStoresExport, 'pending_stores.xlsx'); 
    }
   
    public function pendingStoresimportExcel() {
        Excel::import(new PendingStoresImport,request()->file('file'));
        return redirect()->back();
    }

    // import & export rejected stores to excel
    public function rejectedStoresexportExcel() {
        return Excel::download(new RejectedStoresExport, 'rejected_stores.xlsx'); 
    }
   
    public function rejectedStoresimportExcel() {
        Excel::import(new RejectedStoresImport,request()->file('file'));
        return redirect()->back();
    }

    // import & export bulk stores to excel
    public function bulkStoresexportExcel() {
        return Excel::download(new BulkStoresExport, 'bulk_stores.xlsx'); 
    }
   
    public function bulkStoresimportExcel() {
        Excel::import(new BulkStoresImport,request()->file('file'));
        return redirect()->back();
    }
}
