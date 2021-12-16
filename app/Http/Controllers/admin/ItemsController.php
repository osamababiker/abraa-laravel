<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemsController extends Controller
{

    public function index()
    {
        $items = Item::paginate(10);
        $items_count = Item::count(); 
        return view('admin.items.index', compact(['items','items_count']));
    }

    public function active_items()
    {
        $items_obj = DB::table('items')
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0)
            ->where('items.status', 1)
            ->where('items.rejected', 0);

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
