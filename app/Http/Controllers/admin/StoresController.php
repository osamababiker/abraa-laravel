<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Country;

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

        $store_obj = Store::where('rejected',0);

        if($stores_status == 'active'){
            // $store_obj = 1;
        } 
        elseif($stores_status == 'pending'){
            // $store_obj = 1;
        }
        elseif($stores_status == 'rejected'){
            // $store_obj = 1;
        }
        elseif($stores_status == 'bulk'){
            // $store_obj = 1;
        }

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

        $store_obj = Store::where('rejected',0);

        if($stores_status == 'active'){
            // $store_obj = 1;
        }
        elseif($stores_status == 'pending'){
           // $store_obj = 1;
        }
        elseif($stores_status == 'rejected'){
            // $store_obj = 1;
        }
        elseif($stores_status == 'home'){
            // $store_obj = 1; 
        }
        
        if($store_name){
            $store_obj->where('name', $store_name);
        }

        if($store_country){
            $store_obj->whereIn('country', $store_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $store_obj->where('meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $stores_count = $store_obj->count();
        $stores = $store_obj->limit($rows_numbers)->with('user')
            ->orderBy('id','desc')->get();

   
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


    public function destroy($id)
    {
        //
    }
}
