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

class ItemsController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        return view('admin.items.index', compact(['countries']));
    }

    public function getItemsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $items_obj = Item::where('active',1)
            ->where('status',1)
            ->where('rejected',0)
            ->where('approved',1)->orderBy('id','desc'); 
            
        $items_count = $items_obj->count();
        $items = $items_obj->limit($rows_numbers)->with('category')->get();
        
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

        $items_obj = Item::where('active',1)
            ->where('status',1)
            ->where('rejected',0)
            ->where('approved',1);

        if($product_name){
            $items_obj->where('title', $product_name);
        }

        if($manufacture_country){
            $items_obj->whereIn('manufacture_country', $manufacture_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $items_obj->where('meta_keyword','like', '%' . $word . '%');
            }
        }
            
        $items_count = $items_obj->count();
        $items = $items_obj->limit($rows_numbers)->with('category')
            ->orderBy('id','desc')->get();
        
        return response()->json([
            'items' => $items,
            'items_count' => $items_count
        ]);
    }

    // to get approved items (products) only
    public function active_items()
    {
        $items_obj = DB::table('items')
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0)
            ->where('items.status', 1)
            ->where('items.rejected', 0)
            ->where('items.approved', 1);

        $items = $items_obj->paginate(10);
        $items_count = $items_obj->count();
        return view('admin.items.active_items', compact(['items','items_count']));
    }

    // to get pending items (products) only
    public function pending_items()
    {
        $items_obj = DB::table('items')
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0)
            ->where('items.status', 0)
            ->where('items.rejected', 0)
            ->where('items.approved', 0);

        $items = $items_obj->paginate(10);
        $items_count = $items_obj->count();
        return view('admin.items.active_items', compact(['items','items_count']));
    }

    // to get rejected items (products) only 
    public function rejected_items()
    {
        $items_obj = Item::where('rejected',1);

        $items = $items_obj->paginate(10);
        $items_count = $items_obj->count();
        return view('admin.items.active_items', compact(['items','items_count']));
    }

    // to get home items (products) only 
    public function home_items()
    {
        $items_obj = Item::where('rejected',1);

        $items = $items_obj->paginate(10);
        $items_count = $items_obj->count();
        return view('admin.items.active_items', compact(['items','items_count']));
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
}
