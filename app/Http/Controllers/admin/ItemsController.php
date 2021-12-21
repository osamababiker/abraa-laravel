<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Country;
use App\Exports\ItemsExport;
use App\Imports\ItemsImport;
use Maatwebsite\Excel\Facades\Excel;

class ItemsController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        return view('admin.items.index', compact(['countries']));
    }

    public function getItemsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $items_status = $request->items_status;

        $item_obj = Item::leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0);

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
            $item_obj = $item_obj->where('items.rejected',1);
        }
        else {
            $item_obj = $item_obj->where('items.active',1)
                ->where('items.status',1)
                ->where('items.rejected',0)
                ->where('items.approved',1); 
        }

        $items_count = $item_obj->count();
        $items = $item_obj->limit($rows_numbers)
            ->with('category')->orderBy('items.id','desc')->get();
        
        return response()->json([
            'items' => $items,
            'items_count' => $items_count
        ]);
    }

    public function filterItems(Request $request){
        
        $product_name = $request->product_name;
        $manufacture_country = $request->manufacture_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword; 
        $items_status = $request->items_status;

        $item_obj = Item::leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0);

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
            $item_obj = $item_obj->where('items.rejected',1);
        }
        else {
            $item_obj = $item_obj->where('items.active',1)
                ->where('items.status',1)
                ->where('items.rejected',0)
                ->where('items.approved',1); 
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
        $items = $item_obj->limit($rows_numbers)->with('category')
            ->orderBy('items.id','desc')->get();

        
        return response()->json([
            'items' => $items,
            'items_count' => $items_count
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

    // to handel some sort of actions , like delete multiple 
    public function actions(Request $request)
    {
        $item_id = $request->item_id;
        if($request->all_colums){
            Item::delete();
        }
        elseif($item_id){
            foreach($item_id as $id){
                Item::where('id',$id)->delete();
            }
        }
        $message = 'Items hass been deleted successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
        
    }
   
    public function show($id)
    {
        dd($id);
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
        Item::where('id',$id)->delete();
        $message = 'Item hass been deleted successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new ItemsExport, 'stores.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new ItemsImport,request()->file('file'));
           
        return redirect()->back();
    }
}
